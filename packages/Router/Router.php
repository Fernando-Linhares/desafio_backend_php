<?php

namespace Packages\Router;

use Packages\Exceptions\NotFoundException;
use Packages\Router\Http\{ ResponseJson, Request };
use Psr\Container\ContainerInterface;

class Router
{
    use Rest;

    private static ContainerInterface $container;

    private string $namespace = '';

    public static function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }

    public function setNamespace(string $value)
    {
        $this->namespace = $value;
    }

    public function request($method, $uri, string|callable $handler)
    {
        if($this->matchRoute($uri) && $this->matchMethod($method)) {
            $request = new Request();

            $params = $this->getParams($uri);

            if(!empty($params))
                $request->setParams($this->getParams($uri));

            if(is_callable($handler)) {

                $args = $this->getArgs($handler);

                return $this->response()->setContent(call_user_func($handler, ...$args));
            }

            if(preg_match('/.*[@].*/i', $handler)) {

                [$controller, $action] = explode('@', $handler);

                $controller = $this->init($controller);

                $args = $this->getArgsObject($controller, $action);

                return $this->response()->setContent(call_user_func_array([$controller, $action], $args));
            }

            return $this->response()->setContent($handler);
        }
    }

    public function getParams($uri): array
    {
        $slashesUri = explode('/', $uri);
        $slashesCurrent = explode('/', $_SERVER['REQUEST_URI']);

        $params = [];

        $amout = count($slashesCurrent);

        for($i=0; $i<$amout; $i++) {
            $param = $slashesUri[$i];

            if(preg_match('/[\{][a-z0-9]+[\}]/i', $param)) {
                $name = substr($param, 1);
                $name = substr($name, 0, -1);
                $params[$name] = $slashesCurrent[$i];
            }
        }

        return $params;
    }

    public function matchRoute($uri)
    {
        $current = $_SERVER['REQUEST_URI'];

        $uriRegex = $this->makeRegex($uri);

        return preg_match('/^'.addcslashes($uriRegex, '/').'$/i', $current);
    }

    public function matchMethod($method)
    {
        $current = $_SERVER['REQUEST_METHOD'];

        return $current == $method;
    }

    public function makeRegex(string $uri)
    {
        return preg_replace('/[\{][a-z]+[\}]/i', '[0-9]+', $uri);
    }

    private function hasInContaner($parameter)
    {
        return !empty($parameter?->getType()?->getName())
            && self::$container->has($parameter?->getType()?->getName());
    }

    public function getArgs(callable $func)
    {
        $method = new \ReflectionFunction($func);

        $parameters = $method->getParameters();
        $args = [];

        foreach($parameters as $parameter) {

            if($this->hasInContaner($parameter)) {
                $entry = self::$container->get($parameter?->getType()?->getName());

                if($entry && class_exists($entry))
                    $args[] = $this->init($entry);

                continue;
            }

            $entry = $parameter?->getType()?->getName();

            if($entry && class_exists($entry))
                $args[] = $this->init($entry);
        }

        return $args;
    }

    public function getArgsObject($obj, $method)
    {
        $method = new \ReflectionMethod($obj, $method);

        $request = new Request();

        $parameters = $method->getParameters();

        $args = [];

        foreach($parameters as $parameter) {

            if($this->hasInContaner($parameter)) {
                $entry = self::$container->get($parameter?->getType()?->getName());
                $args[] = $this->init($entry);
                continue;
            }

            $entry = $parameter?->getType()?->getName();

            if($entry && class_exists($entry))
                $args[] = $this->init($entry);

            if($request->hasParams()) {
                $params = $request->getParams();

                $type = $parameter?->getType()?->getName();
                
                if($type && $this->isPrimitiveType($type)) {
                    $args[] = $this->castVar($params[$parameter?->getName()], $type);
                    continue;
                }

                $args[] = $params[$parameter?->getName()];
            }
        }

        return $args;
    }

    private function init(string $entry)
    {
        if(!class_exists($entry)) {
            $entry = $this->namespace . $entry;
        }

        if(!class_exists($entry))
            throw new NotFoundException("Class not Found - {$entry}");

        $reflectionclass = new \ReflectionClass($entry);

        $parameters = $reflectionclass?->getConstructor()?->getParameters();

        if($parameters) {

            $args = [];

            foreach($parameters as $parameter) {
                if(self::$container->has($parameter->getType()->getName())) {
                    $argEntry = self::$container->get($parameter->getType()->getName());
                    $args[] = $this->init($argEntry);
                    continue;
                }

                $argEntry =  $parameter->getType()->getName();
                $args[] = $this->init($argEntry);
            }

            if(count($args) > 0)
                return new $entry(...$args);
        }

        return new $entry();
    }

    public static function response()
    {
        return new ResponseJson();
    }

    public static function bootRoutes()
    {
        require_once '../routes/api.php';
    }
    
    public function isPrimitiveType(string $type)
    {
        $typesPrimitives = [
            "boolean",
            "integer",
            "float",
            "string",
            "array",
            "object",
            "resource",
            "NULL"
        ];

        return in_array($type, $typesPrimitives);
    }

    public function castVar($var, $type)
    {
        return match($type) {
            "boolean" => boolval($var),
            "integer" => intval($var),
            "float" => floatval($var),
            "string" => strval($var),
            "array" => (array) $var,
            "object" => (object) $var
        };
    }

    public function notFound(callable $handler)
    {
        if($this->response()->notHas()) {
            $args = $this->getArgs($handler);

            $response = $this->response();
            $response->setStatus(404);

            return $response->setContent(call_user_func($handler, ...$args));
        }
    }
}