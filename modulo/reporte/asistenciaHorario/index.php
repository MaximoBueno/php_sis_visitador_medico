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
                    <span>Asistencia - Horario</span>
                </div>
                <div class="container-fluid ">
                    <div class="row border rounded shadow">
                        <div class="col-lg-6 px-1">
                            <div class="input-group input-group-sm my-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white">Fecha de Inicio</span>
                                </div>
                                <input class="form-control"
                                       type="date"
                                       name="fechaHorario"
                                       id="fechaHorario"
                                       value="<?php echo date('Y-m-d');?>" required>
                                <button type="button" class="btn btn-info btn-group btn-sm" onclick="buscarHorario();">
                                    <i class="material-icons">search</i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 px-1 text-right">
                            <a href="#" class="btn btn-success btn-sm my-1" onclick="exportarExcel();" title="Exportar a Excel"><i class="fa fa-file-excel-o tam-icon p-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 p-0 table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="font-size:12px;">
                        <thead>
                            <tr class="text-center">
                                <th style="width:30px;" class="text-center">N°</th>
                                <th style="width:50px;display:none;" class="text-center" style="">C</th>
                                <th style="width:120px;" class="text-center">LUNES</th>
                                <th style="width:120px;" class="text-center">MARTES</th>
                                <th style="width:120px;" class="text-center">MIERCOLES</th>
                                <th style="width:120px;" class="text-center">JUEVES</th>
                                <th style="width:120px;" class="text-center">VIERNES</th>
                            </tr>
                        </thead>

                        <tbody id="contenidoIngreso">
                            <?php include("./procesos/getHorarios.php"); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Fin Modal OKI-->
        <script src="<?php echo $ruta; ?>assets/js/newjs.js"></script>
        <script src="./procesos/reporte.js"></script>
    </body>
</html>