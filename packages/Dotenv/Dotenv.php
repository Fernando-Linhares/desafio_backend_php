<?php

namespace Packages\Dotenv;

class Dotenv
{
    /**
     * @param string $path
     * @return void
     */
    public function load($path='.env')
    {
        $content = file_get_contents($path);

        $vars = explode("\n", $content);

        foreach($vars as $variable) {
            if(!empty($variable) && !preg_match('/^[#]/i', $variable)) {
                [$key, $value] = explode('=', $variable);

                $_ENV[$key] = $value;
            }
        }
    }

    public function __get($name)
    {
        if(!empty(getenv($name)))
            return getenv($name);

       return $_ENV[$name] ?? '';
    }
}