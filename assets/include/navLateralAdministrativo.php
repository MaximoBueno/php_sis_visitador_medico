<style>
    .uTreen{
        background-image: url('<?php echo $ruta ?>assets/img/Imagen1.png');
        background-repeat: repeat;
    }
</style>


<div class="contensMenuLat uGreenMenu">
    <div class="uCentrarCustom p-1">
        <input class="form-control form-control-sm" placeholder="Buscador" id="buscadorMV" onkeypress="pulsarTecla(event,this);" onchange="" >
        <input type="checkbox" id="uCheck" onclick="check();" autocomplete="off" class="d-none">
        <label for="uCheck" class="uCentrarCustom my-0 " id="uLabel" onclick="clickLabel();">
            <i class="fa fa-angle-double-left border text-white rounded p-1 px-2 m-1" style="cursor:pointer;"></i>
        </label>
    </div>

    <ul class="border-top border-warning pt-2 mb-4" id="myMenuVertical">
        <?php include("menu.php");
            $my_menu = new menu();
            echo $my_menu->iniciarPaginas($ruta, $plix);
            //VER SI EL MODULO VISITADOR MEDICO SIRVE -> ABAJO
        ?>

        <li class="fiList d-none">
            <a class="btnList" onclick="desplega('uListVisitadorMedico');">
                <div class="d-flex">
                    <i class="text-warning fa fa-address-card iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">VISITADOR MEDICO</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListVisitadorMedico">
                <a href="<?php echo $ruta; ?>modulo/reporte/reportede" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Registro Reporte</h6>
                    </li>
                </a>
                <a href="<?php echo $ruta; ?>modulo/reporte/reportede" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Visualizar Productos</h6>
                    </li>
                </a>
                <a href="<?php echo $ruta; ?>modulo/reporte/reportede" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Visualizar Horarios</h6>
                    </li>
                </a>
            </ul>
        </li>
        <li class="fiList">
            <a class="btnList" onclick="desplega('uListUsuario');">
                <div class="d-flex">
                    <i class="text-warning fa fa-user-circle iconMenu mr-1"></i>
                    <h5 class="text-warning m-0 textMenu">USUARIO</h5>
                </div>
            </a>
            <ul class="ulistMenu noneCustom" id="uListUsuario">
                <a href="<?php echo $ruta; ?>modulo/nologin/index.php" style="text-decoration:none;">
                    <li class="listMenu">
                        <h6 class="text-white m-0 textMenu">Cerrar Sesión</h6>
                    </li>
                </a>
            </ul>
        </li>
    </ul>
</div>