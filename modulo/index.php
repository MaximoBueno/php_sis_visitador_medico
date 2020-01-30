<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Bienvenido</title>
        <?php 
        $ruta='./../';
        require($ruta.'assets/include/links.php');

        include("./nologin/seguridad.php");
        $security = new seguridad();
        $security->getSeguridad();

        include("./nologin/privilegios.php");
        $usuario = new privilegios();
        $plix = $usuario->isAdminSession();
        ?>
        <style>
            .nav-item .active {
                color: #333 !important;
                font-weight:bold;
            }
            .somewhere-border{
                border-bottom: 1px solid #ffc107!important;
            }
            .somewhere-button:hover {
                background-color: red;
            }
        </style>
    </head>

    <body>
        <!-- navbar -->
        <?php include($ruta.'assets/include/headerAdministrativo.php'); ?>
        <!-- navbar -->
        <!-- content -->
        <div class="bg-socendary" id="uMdi">
            <!-- INICIO DEL LATERAL -->
            <div id="uLateral" class="uLateral-lg uGreen">
                <?php include($ruta.'assets/include/navLateralAdministrativo.php'); ?>
            </div>
            <!-- INICIO DEL MAIN -->
            <div class="uMain-lg bg-light border-left border-warning" id="uMain">

                <div class="somewhere uGreen" style="height: 100%; width: 100%">
                    <div class="col-lg-12 p-0 uGreen" style="min-height: 60%; position: relative;">
                        <div class="col-lg-12 p-0 text-center" style="position: absolute; top: 40%;">
                            <h2 class="text-white" style="">Bienvenido(a)</h2>
                        </div>
                        <div class="col-lg-12 p-0 text-center" style="position: absolute; top: 55%;">
                             <p class="text-white" style="">Sistema para el Mejoramiento de la Gestión del Visitador Médido</p>
                        </div>
                    </div>
                    <div class="col-lg-12 p-0 centrar-custom somewhere-border"  style="min-height: 40%;">
                        <div class="card text-center m-1 somewhere-button" style="width: 9rem;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="text-warning fa fa-address-book iconMenu mr-2"></i>
                                    <a href="#" class="card-link">Producto</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card text-center m-1 somewhere-button" style="width: 9rem;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="text-warning fa fa-address-book iconMenu mr-2"></i>
                                    <a href="#" class="card-link">Médico</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="<?php echo $ruta; ?>assets/js/newjs.js"></script>
    </body>
</html>