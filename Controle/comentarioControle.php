<?php

include_once __DIR__ . '/Controle/comentarioPDO.php';

$classe = new comentarioPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}

