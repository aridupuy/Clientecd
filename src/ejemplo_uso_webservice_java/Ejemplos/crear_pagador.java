
package ejemplo_uso_webservice_java.Ejemplos;

import ejemplo_uso_webservice_java.lib.ClienteCobroDigital;
import java.util.LinkedHashMap;

public class crear_pagador {
      /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        String sid = "MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs";
        String mercalpha = "CI366779";
        LinkedHashMap pagador = new LinkedHashMap();
        pagador.put("Musico Id", "Musico_id_1");
        pagador.put("Nombre", "Nombre_1");
        pagador.put("Banda", "Banda_1");
        pagador.put("Instrumento", "Instrumento_1");
        pagador.put("Correo Electronico	", "wscarano@cobrodigital.com");
        try {
            ClienteCobroDigital cobro_digital = new ClienteCobroDigital(mercalpha, sid);
            if (!cobro_digital.crear_pagador(pagador)) {
                System.out.println(cobro_digital.obtener_log());
            } else {
                System.out.println(cobro_digital.obtener_datos());
            }
        } catch (Exception ex) {
            System.out.println(ex.getMessage());
        }

    }
}
