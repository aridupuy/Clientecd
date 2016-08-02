<?php
class Cliente_cobrodigital {
    const URL = "https://www.cobrodigital.com:14365/ws3/";
//    const URL = "https://172.20.10.133:356/externo/script_landing_webservice_2.php";
    protected $resultado =array();
    protected $metodo_web_service=false;
    protected $method = "nusoap";
    protected $array_a_enviar;
    protected $idComercio;
    public function __construct($idComercio=false, $sid=false) {
        if(!$idComercio){
            throw new Exception("No definio idComercio");
        }
        if(!$sid){
            throw new Exception("No definio sid");
        }
        $this->idComercio=$idComercio;
        $this->sid=$sid;
        return $this;
    }
    //Funciones que dan una interfaz al usuario///
    public function crear_pagador($nuevo_pagador /* nuevo_pagador debe ser un array asociativo*/){
        $this->metodo_web_service="crear_pagador";
        $this->array_a_enviar['pagador']=$nuevo_pagador;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function editar_pagador($identificador, $dato_a_buscar,$nuevo_pagador /* nuevo_pagador debe ser un array asociativo*/){
        $this->metodo_web_service="editar_pagador";
        $this->array_a_enviar['identificador']=$identificador;
        $this->array_a_enviar['buscar']=$dato_a_buscar;
        $this->array_a_enviar['pagador']=$nuevo_pagador;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function verificar_existencia_pagador($identificador,$dato_a_buscar){
        $this->metodo_web_service="verificar_existencia_pagador";
        $this->array_a_enviar["identificador"]=$identificador;
        $this->array_a_enviar["buscar"]=$dato_a_buscar;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function generar_boleta($identificador,$dato_a_buscar, $concepto,$fecha_1, $importe_1,$modelo=false,$fecha_2=false,$importe_2=false,$fecha_3=false,$importe_3=false){
        
        $this->metodo_web_service="generar_boleta";
        $this->array_a_enviar['identificador']=$identificador;
        $this->array_a_enviar['buscar']=$dato_a_buscar;
        if($modelo!=false)
            $this->array_a_enviar['plantilla']=$modelo;
        $this->array_a_enviar['fechas_vencimiento'][]=$fecha_1;
        if($fecha_2!=false)
            $this->array_a_enviar['fechas_vencimiento'][]=$fecha_2;
        if($fecha_3!=false)
            $this->array_a_enviar['fechas_vencimiento'][]=$fecha_3;
        $this->array_a_enviar['importes'][]=$importe_1;
        if($importe_2!=false)
            $this->array_a_enviar['importes'][]=$importe_2;
        if($importe_3!=false)
            $this->array_a_enviar['importes'][]=$importe_3;
        $this->array_a_enviar['concepto']=$concepto;
        $this->ejecutar();
        if ($this->obtener_resultado()){
            $nro_boletas=  $this->obtener_datos();
            return $nro_boletas[0];
        }
            
    }
    public function consultar_transacciones($fecha_desde,$fecha_hasta,$filtros/*Filtros debe ser un array asociativo*/){
        $this->metodo_web_service="consultar_transacciones";
        $this->array_a_enviar['desde']=$fecha_desde;
        $this->array_a_enviar['hasta']=$fecha_hasta;
        $this->array_a_enviar['filtros']=$filtros;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function inhabilitar_boleta($nro_boleta){
        $this->metodo_web_service="inhabilitar_boleta";
        $this->array_a_enviar['nro_boleta']=$nro_boleta;
        $this->ejecutar();
        return $this->obtener_log();
    }
    public function obtener_codigo_de_barras($nro_boleta){
        $this->metodo_web_service="obtener_codigo_de_barras";
        $this->array_a_enviar['nro_boleta']=$nro_boleta;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function obtener_codigo_electronico($identificador,$dato_a_buscar){
        $this->metodo_web_service="obtener_codigo_electronico";
        $this->array_a_enviar["identificador"]=$identificador;
        $this->array_a_enviar["buscar"]=$dato_a_buscar;
        $this->ejecutar();
        return $this->obtener_resultado();
    }
    public function consultar_actividad_micrositio($identificador, $dato_a_buscar, $desde, $hasta)
    {
        $this->array_a_enviar["identificador"]=$identificador;
        $this->array_a_enviar["buscar"]=$dato_a_buscar;
        $this->array_a_enviar["desde"]=$desde;
        $this->array_a_enviar["hasta"]=$hasta;
        $this->ejecutar();
        return $this->obtener_resultado();   
    }
    //Fin de funciones de interfaz/////
    public function ejecutar($metodo_webservice=false, $array=false) {
        $this->array_a_enviar['idComercio']=$this->idComercio;
        $this->array_a_enviar['sid']=$this->sid;
        if($metodo_webservice===false)
            $metodo_webservice=$this->metodo_web_service;
        if($array===false){
            $array=$this->array_a_enviar;
        }
        $array['metodo_webservice']=  $metodo_webservice;
        if ($this->method=='nusoap')
            $this->enviar_nusoap ($array);
        else
            $this->enviar_http($array);
    }
    public function obtener_datos() {
        if(isset($this->resultado['datos']) AND $this->resultado['datos']!=false)
            return $this->resultado['datos'];
        return false;
    }
    public function obtener_resultado() {
        if($this->resultado['ejecucion_correcta']==1)
            return true;
        return false;
    }
    public function obtener_log() {
        if(isset($this->resultado['log']) AND $this->resultado['log']!=false)
            return $this->resultado['log'];
        return false;
            
    }
    public function enviar_http($array){
        $postdata = http_build_query($array);
        $opts = array('http' =>
                    array(
                        'method' => strtoupper($this->method),
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                        )
                );
        $context = stream_context_create($opts);
        $datos = file_get_contents(self::URL, false, $context);
        $this->resultado = json_decode($datos,true);
        foreach ($this->resultado['log'] as $mensaje){
            error_log($mensaje);
        }
        $this->array_a_enviar=array(); //funcion reinicializar

    }
    public function enviar_nusoap($array){
        include_once 'nusoap/nusoap.php';
        $client = new nusoap_client(self::URL);
        $result = $client->call('webservice_cobrodigital', array(json_encode($array)));
        error_log('Recibido:');
        error_log($result);
        $this->resultado=  json_decode($result,true);
    }
    public function set_method($method){
        $whitelist=array("nusoap","post","get");
        if(in_array( strtolower(trim($method)),$whitelist))
            $this->method=strtolower(trim($method));
        else
            throw new Exception ("Metodo de conección no admitido.");
    }
}
