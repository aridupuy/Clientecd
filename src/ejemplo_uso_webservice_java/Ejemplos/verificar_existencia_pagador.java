package ejemplo_uso_webservice_java.Ejemplos;

import ejemplo_uso_webservice_java.lib.ClienteCobroDigital;

public class verificar_existencia_pagador {
    public static void main(String[] args) {
        String sid = "MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs";
        String mercalpha = "CI366779";
        String identificador="Musico Id";
        String campo_a_buscar ="Musico_id_1";  
        try {
            ClienteCobroDigital cobro_digital = new ClienteCobroDigital(mercalpha, sid);
            if (false!=cobro_digital.verificar_existencia_pagador(identificador, campo_a_buscar)){
                System.out.println(cobro_digital.obtener_log());
            } else {
                System.out.println(cobro_digital.obtener_datos());
            }
        } catch (Exception ex) {
            System.out.println(ex.getMessage());
        }
  }
    
}
