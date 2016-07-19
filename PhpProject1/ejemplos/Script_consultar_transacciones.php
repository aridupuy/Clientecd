<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";
$idComercio='FL662997';
$sid='ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq';
$desde='20160607';
$hasta='20160715';
$filtros=array('id_mp'=>'ingresos');

try {
    $cobro_digital=new cobrodigital($idComercio,$sid);
    $cobro_digital->consultar_transacciones($desde, $hasta, $filtros);
    print_r($cobro_digital->obtener_log());
} catch (Exception $ex) {
    print_r($ex->getMessage());
}
