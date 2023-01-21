<?php

$host    =   $_SERVER['MYSQL_HOST'];
$dbname  =   $_SERVER['MYSQL_DATABASE'];

return [
    'class'     =>  'yii\db\Connection',
    'dsn'       =>  "mysql:host={$host};dbname={$dbname}",
    'username'  =>  $_SERVER['MYSQL_USER'],
    'password'  =>  $_SERVER['MYSQL_PASSWORD'],
    'charset'   =>  'utf8',
];