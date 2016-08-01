<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT.'lib/cliente_cobrodigital.php';
$idComercio="FL662997";
$sid="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$identificador="NRO CLIENTE";
$campo_a_buscar="10000";
$pagador= array("APELLIDO Y NOMBRE" => "SILVIA GULISANO",
    "NRO CLIENTE" => "10000",
    "DIRECCION" => "ravignani 2010",
    "ENTRE CALLES" => "Olazabal=1 De Mayo",
    "TARJETA" => "73859002468000131122000000008",
    "PPPOE" => "test",
    "W MAC" => "test",
    "Tipo Documento" => "test",
    "Nro documento" => "test",
    "COD ELECTRONICO" => "test",
);
//REPETAR TAL CUAL APARECE EN LA ESTRUCTURA DE CLIENTES!!!!! CASE SENSITIVE
try {
    $cobro_digital=new Cliente_cobrodigital($idComercio,$sid);
    $cobro_digital->set_method("nusoap");
    $cobro_digital->editar_pagador($identificador, $campo_a_buscar, $pagador);
    print_r($cobro_digital->obtener_log());
} catch (Exception $ex) {
    print_r($ex->getMessage());
}


