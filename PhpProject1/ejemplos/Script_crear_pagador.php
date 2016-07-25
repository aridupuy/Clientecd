<?php
define("PATH_ROOT", "../");
include_once PATH_ROOT."lib/cliente_cobrodigital.php";
$array_pagador = array('Nombre' => 'mi_nombre_', 'Banda' => 'mi_banda_', 'Instrumento' => 'mi_instrumento_');
$array = array();
$idComercio = 'CI366779';
$sid = 'MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs';
try{
    $cobro_digital = new Cliente_cobrodigital($idComercio,$sid);
    $cobro_digital->crear_pagador($array_pagador);
    print_r($cobro_digital->obtener_log());
}
 catch (Exception $e){
    print_r($e->getMessage());
 }
    