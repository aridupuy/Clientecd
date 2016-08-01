<?php
$array_pagador = array('Nombre' => 'mi_nombre_', 'Banda' => 'mi_banda_', 'Instrumento' => 'mi_instrumento_');
$array_a_enviar['idComercio']= 'CI366779';
$array_a_enviar['sid'] ='MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs';
$array_a_enviar['metodo_webservice']=  "editar_pagador";
$array_a_enviar['identificador']="Musico Id";
$array_a_enviar["buscar"]="Musico_id_1";
$array_a_enviar['pagador']=$array_pagador;
$url = "https://172.20.10.133:356/externo/script_landing_webservice_2.php";
//usando nusoap
include_once '../../lib/nusoap/nusoap.php';
$client = new nusoap_client($url);
$datos= $client->call('webservice_cobrodigital', array(json_encode($array_a_enviar)));
///
///usando POST///
//$postdata = http_build_query($array_a_enviar);
//$opts = array('http' =>
//            array(
//                'method' => "POST",
//                'header' => 'Content-type: application/x-www-form-urlencoded',
//                'content' => $postdata
//                )
//        );
//$context = stream_context_create($opts);
//$datos = file_get_contents($url, false, $context);
$resultado = json_decode($datos,true);
foreach ($resultado['log'] as $mensaje){
    error_log($mensaje);
}

foreach ($resultado['log'] as $log) {
    echo '<pre>';
    echo $log;
    echo '</pre>';
}
foreach ($resultado['datos'] as $dato) {
    echo '<pre>';
    echo $dato;
    echo '</pre>';
}
echo $resultado['ejecucion_correcta'] ;
