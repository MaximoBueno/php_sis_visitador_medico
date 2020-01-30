<?php
class tools{
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
                return "<div class='col-lg-12'>
                    <div class='row'>
                        <div class='col-lg-6 my-1'>
                         <a class = 'btn btn btn-primary btn-sm text-white' onclick='actualizarIHorario(".$valor.")' title='Modificar'><i class='fa fa-pencil-square-o tam-icon px-0'></i></a>
                        </div>
                        <div class='col-lg-6 my-1'>
                         <a class = 'btn btn btn-danger btn-sm text-white' onclick='modalMul(7, ".$valor.")' title='Modificar'><i class='fa fa-window-close tam-icon px-0'></i></a>
                        </div>
                    </div>
                </div>";
                break;
            case 1:
                return "<b>Fecha: </b>".$valor;
                break;
            case 2:
                return "<b>".self::convertDia($valor)."</b>";
                break;
            case 3:
                return "<b>".self::convertHora($valor)."</b>";
                //return $valor;
                break;
            case 4:
                return "<b>Distrito: </b>".$valor;
                break;
            case 5:
                return "<b>Centro Salud: </b>".$valor;
                break;
            case 6:
                return "<b>Medico: </b>".$valor;
                break;
            case 7:
                return "<b>Dir.: </b>".$valor;
                break;
                //CONCAT(H.hecho, '-', H.cod_horario)
            case 8:
                return "<b>Prod.: </b>".$valor;
                break;
            case 9:
                $myvalor = explode("-", $valor);
                return "<br>
                        <center>
                            <select name='asistencia$valor' id='asistencia$valor' onchange='mAsistencia(\"".$valor."\");' class='form-control-sm'>".self::convertAsist($myvalor[0])."
                            </select>
                        </center>";
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
                return "---";
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
                return "---";
                break;
        }
    }
    private function convertAsist($valor){
        switch($valor){
            case 0:
                return "<option value='0'>[NINGUNO]</option>
                    <option value='1'>ASISTIO</option>
                    <option value='2'>NO ASISTIO</option>";
                break;
            case 1:
                return "<option value='1'>ASISTIO</option>
                    <option value='2'>NO ASISTIO</option>";
                break;
            case 2:
                return "<option value='2'>NO ASISTIO</option>
                    <option value='1'>ASISTIO</option>";
                break;
            default:
                return "<option value='0'>[NINGUNO]</option>";
                break;
        }
    }
}
?>