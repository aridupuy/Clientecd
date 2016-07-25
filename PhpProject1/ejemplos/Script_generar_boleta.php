<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";

$idComercio="FL662997";
$sid="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$identificador = "NRO CLIENTE";
$campo_a_buscar = "1";
$vencimiento_1='10/01/2018';
$vencimiento_2='22/01/2018';
//$vencimiento_3='25/01/2018';
$importe_1="18.4";
$importe_2="20.51";
//$importe_3="31.80";
$concepto="Couta mensual";
$modelo="init";
try {
    $cobro_digital=new Cliente_cobrodigital($idComercio,$sid);
    if(!($nro_boleta=$cobro_digital->generar_boleta($identificador,$campo_a_buscar,$concepto,$vencimiento_1,$importe_1,$modelo,$vencimiento_2,$importe_2,false,false)))
        print_r($cobro_digital->obtener_log());
    else
        print_r($nro_boleta);
} catch (Exception $ex) {
    print_r($ex->getMessage());
}




