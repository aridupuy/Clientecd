<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";

$idComercio="FL662997";
$sid="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$identificador = "NRO CLIENTE";
$campo_a_buscar = "2026";
$vencimiento_1='10/07/2017';
$vencimiento_2='22/07/2017';
$vencimiento_3='25/07/2017';
$importe_1="18.4";
$importe_2="20.51";
$importe_3="31.80";
$concepto="Couta mensual";
$modelo="init";
try {
    $cobro_digital=new cobrodigital($idComercio,$sid);
    $cobro_digital->generar_boleta($identificador, $campo_a_buscar, $vencimiento_1, $vencimiento_2, $vencimiento_3, $importe_1, $importe_2, $importe_3, $concepto, $modelo);
    print_r($cobro_digital->obtener_log());
} catch (Exception $ex) {
    print_r($ex->getMessage());
}




