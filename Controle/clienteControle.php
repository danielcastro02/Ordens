<?php

include_once __DIR__ . '/../Controle/clientePDO.php';

$classe = new clientePDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

