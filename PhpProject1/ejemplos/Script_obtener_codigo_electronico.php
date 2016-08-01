<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT.'lib/cliente_cobrodigital.php';
$idComercio="FL662997";
$sid="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$identificador="NRO CLIENTE";
$campo_a_buscar="10000";
//REPETAR TAL CUAL APARECE EN LA ESTRUCTURA DE CLIENTES!!!!! CASE SENSITIVE
try {
    $cobro_digital=new Cliente_cobrodigital($idComercio,$sid);
    $cobro_digital->set_method("nusoap");
    //    $cobro_digital->set_method("POST");
    //    $cobro_digital->set_method("GET");
    $cobro_digital->obtener_codigo_electronico($identificador, $campo_a_buscar);
    if(!$cobro_digital->obtener_resultado())
        print_r($cobro_digital->obtener_log());
    print_r($cobro_digital->obtener_datos());
} catch (Exception $ex) {
    print_r($ex->getMessage());
}


