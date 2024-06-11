<?php

namespace Tests;

use GuzzleHttp\Client;

trait WithServerTesting
{
    private static bool $openserver = false;

    public function up(): void
    {
        if(!self::$openserver) {
            $port = '8998';

            $command = 'APP_ENV=testing nohup php -S localhost:' . $port . ' -t public/  > .server.testing.log 2>&1 &';

            exec($command);

            sleep(3);

            self::$openserver = true;
        }
    }

    public function getClient(): Client
    {
        return new Client([
            'base_uri' => 'http://localhost:8998',
            'http_errors' => false
        ]);
    }

    public function removeLogs()
    {
        if(file_exists('.server.testing.log'))
            unlink('.server.testing.log');
    }

    public function down(): void
    {
        $port = '8998';

        $command = "ps aux | grep 'php -S localhost:".$port."' | grep -v grep | awk '{print $2}'";

        $output = shell_exec($command);

        $pids = preg_split('/\s+/', trim($output));

        foreach ($pids as $pid) {
            if (!empty($pid)) {
                exec("kill $pid");
            }
        }
    }

    public function hasUp()
    {
        $port = '8998';
        $command = "ps aux | grep 'php -S localhost:".$port."' | grep -v grep | awk '{print $2}'";
        $output = shell_exec($command);

        return !empty($output);
    }

    public function refresh()
    {
        $this->down();
        
        $port = '8998';

        $command = 'APP_ENV=testing nohup php -S localhost:' . $port . ' -t public/  > .server.testing.log 2>&1 &';

        exec($command);
    }
}
