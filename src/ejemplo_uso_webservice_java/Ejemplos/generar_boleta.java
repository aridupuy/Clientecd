package ejemplo_uso_webservice_java.Ejemplos;
import ejemplo_uso_webservice_java.lib.ClienteCobroDigital;
import java.util.LinkedHashMap;
public class generar_boleta {
         public static void main(String[] args) {
        String sid = "MeAOO0d8tpk87Ud3AG0mZO7WCIP76GuKfU48UMVCuLO66aQGa0Iw3R6cDVs";
        String mercalpha = "CI366779";
        String identificador="Musico Id";
        String campo_a_buscar ="Musico_id_1";
        String vencimiento_1 ="20171230";
        String vencimiento_2 ="20171222";
        String importe_1 ="18.4";
        String importe_2 ="20.51";
        //String importe_3 ="31.80";
        //String vencimiento_3="25/01/2018";
        String concepto = "Couta mensual";
        String plantilla = "init";
        try {
            ClienteCobroDigital cobro_digital = new ClienteCobroDigital(mercalpha, sid);
            if (null!=cobro_digital.generar_boleta(identificador, campo_a_buscar, concepto, vencimiento_1, importe_1,plantilla,vencimiento_2, importe_2)){
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
