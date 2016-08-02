<?php
$array_a_enviar['idComercio']= 'CI366779';
$array_a_enviar['sid'] ='MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs';
$array_a_enviar['metodo_webservice']=  "consultar_transacciones";
$array_a_enviar['desde']="20160706";
$array_a_enviar['hasta']="20160906";
$array_a_enviar['identificador']="Musico Id";
$array_a_enviar['campo_a_buscar']='Musico_id_1';
include_once '../../lib/nusoap/nusoap.php';
$url = "https://www.cobrodigital.com:14365/ws3/";
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
///usando GET///
//$postdata = http_build_query($array_a_enviar);
//$opts = array('http' =>
//            array(
//                'method' => "GET",
//                'header' => 'Content-type: application/x-www-form-urlencoded',
//                'content' => $postdata
//                )
//        );
//$context = stream_context_create($opts);
//$datos = file_get_contents($url, false, $context);
$resultado = json_decode($datos,true);
$resultado=  json_decode($result,true);
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
