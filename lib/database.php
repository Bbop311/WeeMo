<?php

function dbConnect(){

    /* Connexion à une base MySQL avec l'invocation de pilote */
    $dsn = 'mysql:dbname=dvf;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    return new PDO($dsn, $user, $password);
}