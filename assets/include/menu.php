<?php
class menu{
    public function __construct() {}

    public function iniciarPaginas($ruta, $acceso = 0){
        //IMPRIMIMOS LA VISTA DE LA BARRA DE MENÚ
        $myreturn = "";
        $myreturn.=self::getPersonal($ruta, $acceso);
        $myreturn.=self::getUsuario($ruta, $acceso);
        $myreturn.=self::getMedico($ruta, $acceso);
        $myreturn.=self::getProducto($ruta, $acceso);
        $myreturn.=self::getCentroSalud($ruta, $acceso);
        $myreturn.=self::getRuta($ruta, $acceso);
        $myreturn.=self::getClinica($ruta, $acceso);
        $myreturn.=self::getHorario($ruta, $acceso);
        $myreturn.=self::getReporte($ruta, $acceso);
        return $myreturn;
    }

    private function getPersonal($ruta, $acceso = 0){
        if($acceso == 1){
            return '
             <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListPersonal'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-address-book iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">PERSONAL</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListPersonal">
                <a href="'.$ruta.'modulo/personal/registroPersonal" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Personal</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/personal/personalEliminado" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Personal Eliminado</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getUsuario($ruta, $acceso = 0){
        if($acceso == 1){
            return '
             <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListUsuario'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-address-card-o iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">USUARIO</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListUsuario">
                <a href="'.$ruta.'modulo/usuario/registroUsuario" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Usuario</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/usuario/usuarioEliminado" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Usuario Eliminado</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getMedico($ruta, $acceso = 0){
        if($acceso == 3){
            return '
             <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListMedico'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-address-book iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">MEDICO</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListMedico">
                <a href="'.$ruta.'modulo/medico/registroMedico" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Medico</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/medico/medicoEliminado" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Medico Eliminado</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getProducto($ruta, $acceso){
        if($acceso == 3){
            return '
             <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListProducto'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-archive iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">PRODUCTO</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListProducto">
                <a href="'.$ruta.'modulo/producto/registroProducto" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Producto</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/producto/productoEliminado" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Producto Eliminado</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/producto/registroLineaProducto" style="text-decoration: none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Linea Producto</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/producto/lineaProductoEliminado" style="text-decoration: none;" >
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Linea Producto Eliminado</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getCentroSalud($ruta, $acceso){
        if($acceso == 3){
            return '
            <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListCentroSalud'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-university iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 ">CENTRO SALUD</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListCentroSalud">
                <a href="'.$ruta.'modulo/centroSalud/registroCentroSalud" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Centro Salud</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/centroSalud/centroSaludEliminado" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Centro Salud Eliminado</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getClinica($ruta, $acceso){
        if($acceso == 3){
            return '
                <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListClinicas'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-briefcase iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">CLINICA</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListClinicas">
                <a href="'.$ruta.'modulo/clinica/registroPClinica" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Producto - Clinica</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/clinica/pClinicaEliminada" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Producto - Clinica Eliminado</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getRuta($ruta, $acceso){
        if($acceso == 3){
            return '
                <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListRutas'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-truck iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">RUTA</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListRutas">
                <a href="'.$ruta.'modulo/ruta/registroRuta" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Ruta</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/ruta/rutaEliminada" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Ruta Eliminada</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getHorario($ruta, $acceso){
        if($acceso == 3){
            return '
            <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListHorario'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-calendar iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">HORARIO</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListHorario">
                <a href="'.$ruta.'modulo/horario/registroHorario" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Gestión de Horarios</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }

    private function getReporte($ruta, $acceso){
        if($acceso == 3){
            return '
            <li class="fiList">
            <a class="btnList" onclick="desplega('."'uListReporte'".');">
                <div class="d-flex">
                    <i class="text-warning fa fa-clone iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">REPORTES</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListReporte">
                <a href="'.$ruta.'modulo/reporte/asistenciaHorario" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Asistencia - Horario</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/reporte/centroSaludProd" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Centro Salud - Producto</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/reporte/productoMedico" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Producto - Medico</h6>
                    </li>
                </a>
                <a href="'.$ruta.'modulo/reporte/medicoDistrito" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Medico - Distrito</h6>
                    </li>
                </a>
            </ul>
        </li>';
        }else{
            return '';
        }
    }
}
?>