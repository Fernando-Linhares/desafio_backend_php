<?php

namespace Packages\App;

use Packages\Exceptions\{BadRequestException, DatabaseConnectionFailExcetion, NotFoundException };
use Packages\Router\Http\Response;
use Packages\Router\Router;

class AppBoot
{
    public function __construct(
        private array $entries
    ){}

    public function start()
    {
        try
        {
            $container = new Container();
    
            foreach($this->entries as $entry) {
                [$id, $value] = $entry;

                $container->set($id, $value);
            }

            Router::setContainer($container);

            Router::bootRoutes();

            $response = Router::response();

            return $this->output($response);
        }
        catch(\PDOException $exception)
        {
            return $this->error($exception);
        }
        catch (BadRequestException $exception)
        {
            return $this->error($exception, 400);
        }
        catch (NotFoundException $exception)
        {
            return $this->error($exception);
        }
        catch (\Exception $exception)
        {
            return $this->error($exception);
        }
    }

    public function output(Response $response)
    {
        http_response_code($response->getStatus());

        foreach($response->getHeaders() as $header => $content) {
            header("{$header}: {$content}");
        }

        echo $response->render();

        exit;
    }

    public function error($exception, $status=500)
    {
        $response = Router::response();

        $response->setStatus($status);

        $response->setContent([
            'error' => $exception->getMessage()
        ]);

        $this->output($response);

        exit;
    }
}