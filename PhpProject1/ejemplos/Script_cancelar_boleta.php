<?php
$array['mercalpha']="FL662997";
$array['sid']="ABZ0ya68K791phuu76gQ5L662J6F2Y4j7zqE2Jxa3Mvd22TWNn4iip6L9yq";
$array['nro_boleta'] = "4387";

$resultado=  cancelar_boleta($array);
print_r($resultado);
///funcion para llevar al webservice
function cancelar_boleta($array){
    define('PATH_APPS', './');
    define('CONSOLA', false);
    $GLOBALS['SISTEMA']='EXTERNO';
    require PATH_APPS.'core/config.ini';
    developer_log('+WS+ IdComercio: '.$array['mercalpha']); 
    developer_log('+WS+ SID: '.substr($array["sid"], 0,4).'...'); 
    developer_log('+WS+ datos de entrada: '.  json_encode($array["nro_boleta"])); 
    try{$boleta=new Webservice_cancelar_boleta($array['mercalpha'],$array["sid"]);}  catch (Exception $ex){ echo $ex->getMessage();}
    $respuesta=$boleta->ejecutar($array['nro_boleta']);
    return json_encode($respuesta);
}