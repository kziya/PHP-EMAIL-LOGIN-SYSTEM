<?php
session_start();
function callClass($className)
{
    return require __DIR__ . '/classes/' . $className . '.php';
}
spl_autoload_register('callClass');

$configs = require __DIR__ . '/configs.php';
$dbconfs = $configs['db'];
$mailconfs = $configs['mail'];
foreach(array_diff(scandir(__DIR__ . '/helpers/'), array('.', '..')) as $file){
    require __DIR__ . '/helpers/' . $file; 
}

$db = new PDO('mysql:host=' . $dbconfs['host'] . ';dbname=' . $dbconfs['name'],$dbconfs['user'],$dbconfs['pass']);