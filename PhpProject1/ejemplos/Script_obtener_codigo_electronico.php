<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT.'lib/cliente_cobrodigital.php';
$idComercio="CI366779";
$sid="MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs";
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


