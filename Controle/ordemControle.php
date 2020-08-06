<?php

include_once __DIR__ . '/../Controle/ordemPDO.php';

$classe = new OrdemPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

