<?php

function config(string $key = null)
{
    $config = include __DIR__ . "/../config.php";

    if(null === $key){
        return $config;
    }

    if(array_key_exists($key, $config)){
        return $config[$key];
    }
    return null;
}

