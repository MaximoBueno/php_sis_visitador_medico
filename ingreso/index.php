<?php
$usuario = NULL;
$clave = NULL;
$a=md5(uniqid(mt_rand(), true));
$b=(microtime(TRUE));
$r=$a."-".$b;
session_start();
$_SESSION['key_token']=$r;
try{
    if(isset($_POST['usuario']) && isset($_POST['clave'])){
        if(!empty($_POST['usuario']) && !empty($_POST['clave'])){
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];

            include("../modulo/conexion/funciones.php");

            $conectar = new Funciones();
            $consulta = "SELECT cod_usuario, cod_tp_persona FROM usuarios WHERE usuario='".$usuario."' AND contrasenia='".$clave."';";
            $resultado = $conectar->Seleccionar($consulta);

            $fila = $resultado->fetch_array();
            if ($fila != NULL){
                $_SESSION['nro_doc_acc']=$fila[0];
                $_SESSION['tipo_persona_acc']=$fila[1];
                
                header('Location: ../modulo/?t='.$r);
            }else{
                $_SESSION['fallo']="falloClave";
                header("Location: ../?v=falloClave&t=".$r);
            }
        }else{
            $_SESSION['fallo']="falloClave";
            header("Location: ../?v=falloClave&t=".$r);
        }
    }else{
        $_SESSION['fallo']="fallo";
        header("Location: ../?v=fallo&t=".$r);
    }
}catch (Exception $e){
    $_SESSION['fallo']="fallo";
    header("Location: ../?v=fallo&t=".$r);
}
?>