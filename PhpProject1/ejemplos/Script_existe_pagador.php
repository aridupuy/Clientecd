<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT.'lib/cliente_cobrodigital.php';
$idComercio="FL662997";
$sid="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$identificador="NRO CLIENTE";
$dato_a_buscar="10000";
//REPETAR TAL CUAL APARECE EN LA ESTRUCTURA DE CLIENTES!!!!! CASE SENSITIVE
try{
    $cobro_digital=new Cliente_cobrodigital($idComercio,$sid);
    if(!$cobro_digital->existe_pagador($identificador, $dato_a_buscar) AND $cobro_digital->obtener_log()==="")
        print_r($cobro_digital->obtener_log());
    else{
        print_r("Pagador encontrado correctamente");
    }
} 
catch (Exception $ex) {
    print_r($ex->getMessage());
}


