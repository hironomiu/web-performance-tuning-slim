<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

$app = new \Slim\Slim(array(
    'mode' => 'production',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => '../views'
));

$app->db = function() use($app,$host,$mysqldConfig){
    $con = new PDO(sprintf('mysql:host=%s;dbname=%s;charset=utf8', $host, $mysqldConfig['database']), $mysqldConfig['user'], $mysqldConfig['password'], array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_PERSISTENT => true));
    return $con;
};

$app->container['memcached'] = function() use($app,$host,$memcachedConfig){
    $mem = new Memcached();
    $mem->addServer($host,$memcachedConfig['port']);
    return $mem;
};

