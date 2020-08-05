<?php

include_once __DIR__ . '/../Controle/usuarioPDO.php';

$classe = new usuarioPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

