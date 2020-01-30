<?php
class privilegios
{
    private $misAccesos = null;
    
    public function __construct() {
        self::almacenarAccesos();
    }

    public function isAdminSession(){
        if(!isset($_SESSION['nro_doc_acc']) && !isset($_SESSION['tipo_persona_acc'])){
            return 0;
        }else{
            $my_valor = $_SESSION['tipo_persona_acc'];
            $this->permisoAcceso($my_valor);
            return $my_valor;
        }
    }

    private function almacenarAccesos(){
        $this->misAccesos = array(
            3 => "medico/producto/centroSalud/ruta/clinica/horario/reporte",
            1 => "personal/usuario",
        );
    }

    public function permisoAcceso($acceso = 0){
        if($acceso != 0){
            $mi_acceso = self::detectarAcceso($acceso);
            $modulo_actual = self::detectarModulo();
            if($modulo_actual == "|"){
            }else{
                $n = sizeof($mi_acceso);
                $acc = 0;
                for($i = 0; $i < $n; $i++){
                    if($modulo_actual == $mi_acceso[$i]){
                        //echo "MA =".$modulo_actual."<br>";
                        //echo "MIA =".$mi_acceso[$i]."<br>";
                        $acc = 0;
                        break;
                    }else{
                        //echo "MA =".$modulo_actual."<br>";
                        //echo "MIA =".$mi_acceso[$i]."<br>";
                        $acc +=1;
                    }
                }
                if ($acc > 1){
                    //echo "Largo!";
                    $acc = 0;
                    header("Location: ../../ ");
                }
                $acc = 0;
            }
        }else{
            header("Location: ../ ");
        }
    }

    private function detectarModulo(){
        $myModulos = explode("/", self::urlActual());
        $valor = sizeof($myModulos);
        if($valor > 4){
            return $myModulos[3];
        }else{
            return "|";   
        }
    }

    private function detectarAcceso($acceso = 0){
        if($acceso == 0){
            return "|";   
        }else{
            $myAcceso = explode("/", $this->misAccesos[$acceso]);
            return $myAcceso;
        }
    }

    private function urlActual(){
        // =>  /visitadorMedico/modulo/medico/registroMedico/
        //echo $_SERVER['REQUEST_URI'];
        return $_SERVER['REQUEST_URI'];
    }
}
?>


