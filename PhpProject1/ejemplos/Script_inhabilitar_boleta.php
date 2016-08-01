<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";
$idComercio="FL662997";
$sid="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$nro_boleta = "4387";
try {
    $cobro_digital=new cliente_cobrodigital($idComercio,$sid);
    $cobro_digital->set_method("nusoap");
    $resultado=$cobro_digital->cancelar_boleta($nro_boleta);    
    print_r($resultado);
} catch (Exception $ex) {
    print_r($ex->getMessage());
}