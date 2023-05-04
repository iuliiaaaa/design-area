<?php

const CONFIG_CONNECTION = [
    'host' => 'localhost',	
    'dbname' => 'cz32886_kurs',
    'login' => 'cz32886_kurs',
    "password" => 'designarea',
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]
];