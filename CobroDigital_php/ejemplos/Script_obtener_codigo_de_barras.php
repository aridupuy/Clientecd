<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";
$idComercio="CI366779";
$sid="MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs";
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