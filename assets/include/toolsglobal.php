<?php
// Va a ser una clase
//-- Validar none, sies "" ó 0 ó 000000 OK
//-- Usuarios privilegios "Acceso" mediante matriz
//-- Cualquier cosa global que se me ocurra : )
class toolsglobal{
    public function validarNone($valores){
        $myReturn = 0;
        $tam = count($valores);
        for($i = 0; $i < $tam; $i++){
            if(self::catalogoVacio($valores[$i]) == true){
                $myReturn = $i;
                break;
            }else{
                $myReturn = 0;
            }
        }
        return $myReturn;
    }
    
    private function catalogoVacio($valor){
        switch($valor){
            case "":
                return true;
                break;
            case "0":
                return true;
                break;
            case "NIN":
                return true;
                break;
            case "0000-00-00":
                return true;
                break;
            case "00-00-0000":
                return true;
                break;
            default:
                return false;
                break;
        }
    }
}
?>