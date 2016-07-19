<?php

class Cobrodigital {
    protected $resultado =array();
    protected $metodo_web_service=false;
    protected $method = "POST";
    protected $array_a_enviar;
    private function __construct($idComercio=false, $sid=false) {
        if(!$idComercio){
            throw new exeption("No definio idComercio");
        }
        if(!$sid){
            throw new exeption("No definio sid");
        }
        $this->array_a_enviar['idComercio']=$idComercio;
        $this->array_a_enviar['sid']=$sid;
        return $this;
    }
    //Funciones que dan una interfaz al usuario///
    public function crear_pagador($nuevo_pagador /* nuevo_pagador debe ser un array asociativo*/){
        $this->metodo_web_service="crear_pagador";
        $this->array_a_enviar['pagador']=$nuevo_pagador;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function editar_pagador($identificador, $campo_a_buscar,$nuevo_pagador /* nuevo_pagador debe ser un array asociativo*/){
        $this->metodo_web_service="editar_pagador";
        $this->array_a_enviar['identificador']=$identificador;
        $this->array_a_enviar['buscar']=$campo_a_buscar;
        $this->array_a_enviar['pagador']=$nuevo_pagador;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function generar_boleta($identificador,$campo_a_buscar, $fecha_1,$fecha_2,$fecha_3, $importe_1,$importe_2,$importe_3,$concepto,$modelo=false){
        $this->metodo_web_service="generar_boleta";
        $this->array_a_enviar['identificador']=$identificador;
        $this->array_a_enviar['buscar']=$campo_a_buscar;
        $this->array_a_enviar['fechas_de_vencimiento']=array($fecha_1,$fecha_2,$fecha_3);
        $this->array_a_enviar['importes']=array($importe_1,$importe_2,$importe_3);
        $this->array_a_enviar['concepto']=$concepto;
        if($modelo)
            $this->array_a_enviar['modelo']=$modelo;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function consultar_transacciones($fecha_desde,$fecha_hasta,$filtros/*Filtros debe ser un array asociativo*/){
        $this->metodo_web_service="consultar_transacciones";
        $this->array_a_enviar['desde']=$fecha_desde;
        $this->array_a_enviar['hasta']=$fecha_hasta;
        $this->array_a_enviar['filtros']=$filtros;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function cancelar_boleta($pagador){
        $this->metodo_web_service="cancelar_boleta";
    }
    //Fin de funciones/////
    public function ejecutar($metodo_webservice=false, $array=false) {
        if($metodo_webservice===false)
            $metodo_webservice=  $this->metodo_web_service;
        if($array===false)
            $array=  $this->array_a_enviar;
        $url = "https://172.20.10.133:356/externo/script_landing_webservice_2.php";
        $postdata = http_build_query($array);
        $opts = array('http' =>
                    array(
                        'method' => $this->method,
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                        )
                );
        $context = stream_context_create($opts);
        $datos = file_get_contents($url, false, $context);
        $this->resultado = json_decode($datos,true);
        
    }
    public function obtener_datos() {
        return $this->resultado['datos'];
    }
    public function obtener_resultado() {
        if($this->resultado['ejecucion_correcta']==1)
            return true;
        return false;
    }
    public function obtener_log() {
        return $this->resultado['log'];
    }
}
