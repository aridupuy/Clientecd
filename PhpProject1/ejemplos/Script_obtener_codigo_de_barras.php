<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";
$idComercio="FL662997";
$sid="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$nro_boleta = "5445";
try {
    $cobro_digital=new cliente_cobrodigital($idComercio,$sid);
    $cobro_digital->set_method("nusoap");
    //    $cobro_digital->set_method("POST");
    //    $cobro_digital->set_method("GET");
    $resultado=$cobro_digital->obtener_codigo_de_barras($nro_boleta);    
    if($resultado){
        print_r($cobro_digital->obtener_datos());
        print_r($cobro_digital->obtener_log());
    }
    else {
        print_r($cobro_digital->obtener_log());
     }
} catch (Exception $ex) {
    print_r($ex->getMessage());
}