<?php

require_once '../src/bootstrap.php';

use Packages\App\AppBoot;

$registers = require '../src/registers.php';

$app = new AppBoot($registers);

$app->start();