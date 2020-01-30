<?php
class tools{
    public function siExisteE($valor, $i){
        if(isset($valor[$i]) == false){
            return "S.D.";
        }else{
            return self::vistaValorE($valor, $i);
        }
    }

    private function vistaValorE($valor, $i){
        $numero = (count($valor[$i]) / 2); // EVALUAR CUANDO IMPAR =  - 1
        $vista = "";
        for($j = 0; $j < $numero ; $j++){
            $vista.= self::desConvertE($valor[$i][$j], $j)."\r\n";
        }
        return $vista;
    }

    
    private function desConvertE($valor, $i){
        switch($i){
            case 0:
                return "Fecha: ".$valor;
                break;
            case 1:
                return self::convertDia($valor);
                break;
            case 2:
                return self::convertHora($valor);
                break;
            case 3:
                return "Distrito: ".$valor;
                break;
            case 4:
                return "Centro Salud: ".$valor;
                break;
            case 5:
                return "Medico: ".$valor;
                break;
            case 6:
                return "Dir.: ".$valor;
                break;
            case 7:
                return "Prod.: ".$valor;
                break;
            default:
                return $valor;
                break;
        }
    }


    public function siExiste($valor, $i){
        if(isset($valor[$i]) == false){
            return "<center>---</center>";
        }else{
            return self::vistaValor($valor, $i);
        }
    }

  
    private function vistaValor($valor, $i){
        $numero = (count($valor[$i]) / 2); // EVALUAR CUANDO IMPAR =  - 1
        $vista = "";
        for($j = 0; $j < $numero ; $j++){
            $vista.= self::desConvert($valor[$i][$j], $j)."<br>";
        }
        return $vista;
    }

    private function desConvert($valor, $i){
        switch($i){
            case 0:
                return "<b>Fecha: </b>".$valor;
                break;
            case 1:
                return "<b>".self::convertDia($valor)."</b>";
                break;
            case 2:
                return "<b>".self::convertHora($valor)."</b>";
                break;
            case 3:
                return "<b>Distrito: </b>".$valor;
                break;
            case 4:
                return "<b>Centro Salud: </b>".$valor;
                break;
            case 5:
                return "<b>Medico: </b>".$valor;
                break;
            case 6:
                return "<b>Dir.: </b>".$valor;
                break;
            case 7:
                return "<b>Prod.: </b>".$valor;
                break;
            default:
                return $valor;
                break;
        }
    }

    private function convertHora($valor){
        switch($valor){
            case 1:
                return "A.M.";
                break;
            case 2:
                return "P.M.";
                break;
            default:
                return "S.D.";
                break;
        }
    }

    private function convertDia($valor){
        switch($valor){
            case 1:
                return "Lunes";
                break;
            case 2:
                return "Martes";
                break;
            case 3:
                return "Miercoles";
                break;
            case 4:
                return "Jueves";
                break;
            case 5:
                return "Viernes";
                break;
            default:
                return "S.D.";
                break;
        }
    }
}
?>