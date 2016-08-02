package ejemplo_uso_webservice_java.Ejemplos;

import ejemplo_uso_webservice_java.lib.ClienteCobroDigital;

public class obtener_codigo_de_barras {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        String sid = "MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs";
        String mercalpha = "CI366779";
        int nro_boleta=434;
        try {
            ClienteCobroDigital cobro_digital = new ClienteCobroDigital(mercalpha, sid);
            if (null!=cobro_digital.obtener_codigo_de_barras(nro_boleta)){
                System.out.println("si");
                System.out.println(cobro_digital.obtener_log());
            } else {
                System.out.println("no");
                System.out.println(cobro_digital.obtener_datos());
            }
        } catch (Exception ex) {
            System.out.println("exception");
            System.out.println(ex.getMessage());
            System.out.println(ex.getStackTrace());
            System.out.println(ex.getSuppressed());
        }
    }
    
}
