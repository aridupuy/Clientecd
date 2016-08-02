<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";
$idComercio='CI366779';
$sid='MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs';
$desde='20161201';
$hasta='20161210';
$filtros=array('tipo'=>'egresos');
try {
    $cobro_digital=new cliente_cobrodigital($idComercio,$sid);
    $cobro_digital->set_method("NUSOAP");
    //    $cobro_digital->set_method("POST");
    //    $cobro_digital->set_method("GET"  );
    $cobro_digital->consultar_transacciones($desde, $hasta, $filtros);
        if($cobro_digital->obtener_log()!="")
            print_r($cobro_digital->obtener_log());
    else{
            print_r($cobro_digital->obtener_datos());
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
}
