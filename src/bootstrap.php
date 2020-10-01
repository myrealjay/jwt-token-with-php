<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv= new DotEnv(__DIR__.'/../');
$dotenv->load();

//load the handler class
use Src\jwt\Handler;

$handler = new Handler();
$token= $handler->attempt(['email'=>'test@gmail.com','password'=>'secret']);
echo $token;