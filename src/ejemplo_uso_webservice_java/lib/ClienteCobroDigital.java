package ejemplo_uso_webservice_java.lib;

import java.util.LinkedHashMap;
//import org.apache.axis.client.Service;
//import org.apache.axis.client.Call;
//import javax.xml.namespace.QName;
//import javax.xml.ParameterMode;
//import javax.xml.rpc.ServiceException;
//import java.rmi.RemoteException;
import java.net.URL;
import java.io.*;
import java.lang.reflect.Array;
import java.net.MalformedURLException;
import java.net.URLEncoder;
import java.security.KeyManagementException;
import java.security.NoSuchAlgorithmException;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Vector;
import javax.net.ssl.HttpsURLConnection;
import jdk.nashorn.internal.objects.NativeArray;
public class ClienteCobroDigital {

    public LinkedHashMap resultado = new LinkedHashMap();
    protected String metodo_web_service = "";
    protected String method = "POST";
    protected LinkedHashMap<String, Object> array_a_enviar = new LinkedHashMap();
    protected String idComercio = null;
    protected String sid = null;

    /**
     *
     * @param idComercio
     * @param sid
     * @throws Exception
     */
    public ClienteCobroDigital(String idComercio, String sid) throws Exception {
        if (idComercio == "") {
            throw new Exception("No definio idComercio");
        }
        if (sid == "") {
            throw new Exception("No definio sid");
        }
        this.idComercio = idComercio;
        this.sid = sid;
    }

    //Funciones que dan una interfaz al usuario///
    public boolean crear_pagador(LinkedHashMap nuevo_pagador /* nuevo_pagador debe ser un array asociativo*/) throws Exception {
        this.metodo_web_service = "crear_pagador";
        this.array_a_enviar.put("pagador", nuevo_pagador);
        this.ejecutar();
        return this.obtener_resultado();
    }

    public boolean editar_pagador(String identificador, String campo_a_buscar, LinkedHashMap nuevo_pagador /* nuevo_pagador debe ser un array asociativo*/) throws Exception {
        this.metodo_web_service = "editar_pagador";
        this.array_a_enviar.put("identificador", identificador);
        this.array_a_enviar.put("buscar", campo_a_buscar);
        this.array_a_enviar.put("pagador", nuevo_pagador);
        this.ejecutar();
        return this.obtener_resultado();
    }

    public boolean verificar_existencia_pagador(String identificador, String dato_a_buscar) throws Exception {
        this.metodo_web_service = "verificar_existencia_pagador";
        this.array_a_enviar.put("identificador", identificador);
        this.array_a_enviar.put("buscar", dato_a_buscar);
        this.ejecutar();
        return this.obtener_resultado();
    }
    public String generar_boleta(String identificador, String campo_a_buscar, String concepto, String fecha_1, String importe_1, String modelo, String fecha_2, String importe_2) throws Exception {
        System.out.println("generar_boleta");
        String nro_boleta=generar_boleta(identificador, campo_a_buscar, concepto, fecha_1, importe_1, modelo, fecha_2, importe_2, null,null);
        return nro_boleta;
    }
    public String generar_boleta(String identificador, String campo_a_buscar, String concepto, String fecha_1, String importe_1, String modelo) throws Exception {
        String nro_boleta=generar_boleta(identificador, campo_a_buscar, concepto, fecha_1, importe_1, modelo, null,null, null,null);
        return nro_boleta;
    }
    public String generar_boleta(String identificador, String campo_a_buscar, String concepto, String fecha_1, String importe_1, String modelo, String fecha_2, String importe_2, String fecha_3, String importe_3) throws Exception {
        this.metodo_web_service = "generar_boleta";
        this.array_a_enviar.put("identificador", identificador);
        this.array_a_enviar.put("buscar", campo_a_buscar);
        if (modelo != "") {
            this.array_a_enviar.put("plantilla", modelo);
        }
        String [] fechas ={fecha_1,fecha_2,fecha_3};
        String [] importes={importe_1,importe_2,importe_3};
        this.array_a_enviar.put("concepto", concepto);
        this.array_a_enviar.put("fechas_vencimiento", fechas);
        this.array_a_enviar.put("importes", importes);
        this.ejecutar();
        System.out.println("despues");
        if (this.obtener_resultado()) {
            String[] nro_boletas;
            nro_boletas = this.obtener_datos();
            return nro_boletas[0];
        }
        return null;
    }
    public boolean inhabilitar_boleta(int nro_boleta) throws Exception {
        this.metodo_web_service = "inhabilitar_boleta";
        this.array_a_enviar.put("nro_boleta", nro_boleta);
        this.ejecutar();
        if (this.obtener_resultado()) {
            return true;
        }
        return false;
    }
    public boolean consultar_transacciones(String fecha_desde, String fecha_hasta, LinkedHashMap filtros/*Filtros debe ser un array asociativo*/) throws MalformedURLException, IOException {
        try {
            metodo_web_service = "consultar_transacciones";
            System.out.println(array_a_enviar.toString());
            array_a_enviar.put("desde", fecha_desde);
            array_a_enviar.put("hasta", fecha_hasta);
            if(!filtros.isEmpty())
                array_a_enviar.put("filtros", filtros);
            ejecutar();
        } catch (Exception e) {
//            System.out.println("hola error");
            System.out.println(e.getLocalizedMessage());
        }
        return obtener_resultado();
    }
    public Object consultar_actividad_micrositio(String identificador,String campo_a_buscar, String fecha_desde, String fecha_hasta) throws MalformedURLException, IOException {
        try {
            metodo_web_service = "consultar_actividad_micrositio";
            array_a_enviar.put("identificador", identificador);
            array_a_enviar.put("buscar", campo_a_buscar);
            array_a_enviar.put("desde", fecha_desde);
            array_a_enviar.put("hasta", fecha_hasta);
            ejecutar();
        } catch (Exception e) {
            System.out.println(e.getLocalizedMessage());
            return null;
        }
        return obtener_resultado();
    }
    public String cancelar_boleta(int nro_boleta) throws Exception {
        this.metodo_web_service = "cancelar_boleta";
        this.array_a_enviar.put("nro_boleta", nro_boleta);
        this.ejecutar();
        return this.obtener_log();
    }
    public Object obtener_codigo_de_barras(int nro_boleta) throws Exception {
        this.metodo_web_service = "obtener_codigo_de_barras";
        this.array_a_enviar.put("nro_boleta", nro_boleta);
        this.ejecutar();
        return this.obtener_resultado();
    }
    public Object obtener_codigo_electronico(String identificador,String campo_a_buscar) throws Exception{
            this.metodo_web_service = "obtener_codigo_electronico";
            this.array_a_enviar.put("identificador", identificador);
            this.array_a_enviar.put("buscar", campo_a_buscar);
            this.ejecutar();
            return this.obtener_resultado();
    }
    //Fin de funciones/////
    public void ejecutar() throws Exception {
        System.out.println("ejecutar()");
        ejecutar(metodo_web_service, (LinkedHashMap) array_a_enviar);
    }
    public void ejecutar(String metodo_webservice, LinkedHashMap array) throws UnsupportedEncodingException, MalformedURLException, IOException, KeyManagementException, NoSuchAlgorithmException, Exception {
        this.array_a_enviar.put("idComercio", this.idComercio);
        this.array_a_enviar.put("sid", this.sid);
        if (metodo_webservice == null) {
            metodo_webservice = this.metodo_web_service;
        }
        Map<String, Object> array_a_enviar;
        if (array == null) {
            array_a_enviar = (LinkedHashMap) this.array_a_enviar;
        } else {
            array_a_enviar = (LinkedHashMap) array;
        }
        array_a_enviar.put("metodo_webservice", metodo_webservice);
        String httpsurl = "https://cobrodigital.com:14365/ws3/";
        enviar_https(httpsurl, array_a_enviar);

    }
    public void enviar_https(String httpsurl, Map<?, ?> array_a_enviar) throws IOException, Exception {
        URL myurl = new URL(httpsurl);
        System.out.println("entre");
        HttpsURLConnection con = (HttpsURLConnection) myurl.openConnection();
        con.setRequestMethod(method);
        con.setRequestProperty("User-Agent", "Mozilla/5.0");
        con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
        con.setRequestProperty("Content-type", "application/x-www-form-urlencoded");
        String url_parameters = http_build_query(array_a_enviar);
        con.setDoOutput(true);
        DataOutputStream wr = new DataOutputStream(con.getOutputStream());
        wr.writeBytes(url_parameters);
        wr.flush();
        wr.close();
        
        int responseCode = con.getResponseCode();
        InputStream ins = con.getInputStream();
        InputStreamReader isr = new InputStreamReader(ins);
        BufferedReader in = new BufferedReader(isr);
        String inputLine;
        while ((inputLine = in.readLine()) != null) {
            System.out.println(inputLine);
        }
        in.close();
    }
    public String http_build_query(Map<?, ?> data) throws Exception {
//        return "?idComercio=CI366779&sid=MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs&pagador=[Musico+Id=Musico_id_1&Nombre=Nombre_1&Banda=Banda_1&Instrumento=Instrumento_1&Correo+Electronico=wscarano@cobrodigital.com]&metodo_webservice=crear_pagador";
        StringBuilder queryString = new StringBuilder();
         for (Map.Entry<?,?> entry : data.entrySet()) {
            if (queryString.length() > 0) {
                queryString.append("&");
            }
            if(entry.getValue() instanceof java.util.LinkedHashMap){
                LinkedHashMap array=(LinkedHashMap) entry.getValue();
                queryString.append(urlEncodeUTF8(entry.getKey().toString())+"=");
                for (Iterator it = array.entrySet().iterator(); it.hasNext();) {
                    Map.Entry<?,?> row = (Map.Entry<?,?>) it.next();
                    queryString.append(entry.getKey()+"%5B"+row.getKey()+"%5D="+row.getValue()+"&");
                }
            }
            else if(entry.getValue() instanceof String[]){
                String [] valor=(String[]) entry.getValue();
                for (int i = 0; i < valor.length; i++) {
                    if(valor[i]!=null)
                        queryString.append(entry.getKey()+"[]="+valor[i]+"&");
                }
            }
            else{
                queryString.append(String.format("%s=%s",
                    urlEncodeUTF8(entry.getKey().toString()),
                    urlEncodeUTF8(entry.getValue().toString())
                ));
            }
        }
         System.out.println(queryString);
         return queryString.toString();
    }
    public String urlEncodeUTF8(String s) {
        try {
            return URLEncoder.encode(s, "UTF-8");
        } catch (UnsupportedEncodingException e) {
            throw new UnsupportedOperationException(e);
        }
    }
    public String[] obtener_datos() {
        return (String[]) this.resultado.get("datos");
    }
    public boolean obtener_resultado() {
        if ((int) this.resultado.get("ejecucion_correcta") == 1) {
            return true;
        }
        return false;
    }
    public String obtener_log() {
        return (String) this.resultado.get("log");
    }

    
    
}
