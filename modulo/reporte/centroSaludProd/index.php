<!DOCTYPE html>
<html lang="es">
    <head>
        <title>REPORTE</title>
        <?php 
        $ruta='./../../../';
        require($ruta.'assets/include/links.php');

        include("./../../nologin/seguridad.php");
        $security = new seguridad();
        $security->getSeguridad();

        include("./../../nologin/privilegios.php");
        $usuario = new privilegios();
        $plix = $usuario->isAdminSession();

        ?>
        <style>

        </style>
    </head>
    <body>
        <!-- navbar -->
        <?php include ($ruta.'assets/include/headerAdministrativo.php') ?>
        <!-- navbar -->
        <!-- content -->
        <div class="bg-socendary" id="uMdi">
            <!-- INICIO DEL LATERAL -->
            <div id="uLateral" class="uLateral-lg uGreen">
                <?php include ($ruta.'assets/include/navLateralAdministrativo.php') ?>
            </div>
            <!-- INICIO DEL MAIN -->
            <div class="uMain-lg border-left border-warning" id="uMain">
                <div id="my_titulo" class="form-control form-control-sm text-center uGreen py-2">
                    <span>Centro Salud - Producto</span>
                </div>
                
                <div class="container-fluid p-0">
                    <div class="col-lg-12 border rounded px-1">
                        <div class="input-group input-group-sm my-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Centro Salud</span>
                            </div>
                            <select name="centroSalud" id="centroSalud" class="form-control">
                                <option  selected="selected" value="0">[TODO]</option>
                                <?php include("procesos/getCentroSalud.php"); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 border rounded px-1">
                        <a href="#" class="btn btn-success btn-sm my-1" onclick="exportarExcel();" title="Exportar a Excel"><i class="fa fa-file-excel-o tam-icon p-1"></i></a>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Fin Modal OKI-->
        <script src="<?php echo $ruta; ?>assets/js/newjs.js"></script>
        <script src="./procesos/reporte.js"></script>
    </body>
</html>