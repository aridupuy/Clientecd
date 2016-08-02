package ejemplo_uso_webservice_java.Ejemplos;

import ejemplo_uso_webservice_java.lib.ClienteCobroDigital;

public class inhabilitar_boleta {
 public static void main(String[] args) {
        String sid = "MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs";
        String mercalpha = "CI366779";
        int nro_boleta=434;
        try {
            ClienteCobroDigital cobro_digital = new ClienteCobroDigital(mercalpha, sid);
            if (false!=cobro_digital.inhabilitar_boleta(nro_boleta)){
                System.out.println(cobro_digital.obtener_datos());
            } else {
                System.out.println(cobro_digital.obtener_log());
            }
        } catch (Exception ex) {
            System.out.println("exception");
            System.out.println(ex.getMessage());
        }
    }    
}
