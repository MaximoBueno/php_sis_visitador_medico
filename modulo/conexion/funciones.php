<?php
require('conexion.php');
class Funciones extends conexion{
    #Listo el seleccionar generico:
    public function __construct() {
   
    }

    #Para Procediminetos Almacenados (Registrar o Actualizar)
    public function Ejecutar($Consulta){
        $resultado = $this->Consulta($Consulta);
    }
    
    #Para seleccionar información
    public function Seleccionar($Consulta){
        $resultado = $this->Consulta($Consulta);
        return $resultado;
    }
}
?>
