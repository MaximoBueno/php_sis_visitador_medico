<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Bienvenido</title>
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
    </head>

    <body>
        <!-- navbar -->

        <?php include ($ruta.'assets/include/headerAdministrativo.php') ?>
        <!-- navbar -->

        <!-- content -->
        <div class="bg-socendary" id="uMdi">
            <!-- INICIO DEL LATERAL -->
            <div id="uLateral" class="uLateral-lg uGreen">
                <?php include($ruta.'assets/include/navLateralAdministrativo.php') ?>
            </div>
            <!-- INICIO DEL MAIN -->
            <div class="uMain-lg border-left border-warning bg-white" id="uMain">
                <div id="my_titulo" class="form-control form-control-sm text-center uGreen py-1">
                    <span>Gestión de Horario</span>
                </div>
                <div class="container-fluid">
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
                            <div class="input-group input-group-sm my-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Dia </span>
                                </div>
                                <select name="dia" id="dia" class="form-control" required disabled>
                                    <option value="0">[NINGUNO]</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miercoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm my-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Distrito </span>
                                </div>
                                <select name="distrito" id="distrito" class="form-control" required disabled>
                                    <option value="0">[NINGUNO]</option>
                                    <?php include("./procesos/getDistrito.php"); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 px-1">
                            <div class="input-group input-group-sm my-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Hora</span>
                                </div>
                                <select name="hora" id="hora" class="form-control" required disabled>
                                    <option value="0">[NINGUNO]</option>
                                    <option value="1">A.M.</option>
                                    <option value="2">P.M.</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm my-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Ruta </span>
                                </div>
                                <select name="ruta" id="ruta" class="form-control" required disabled>
                                    <option value="0">[NINGUNO]</option>
                                    <?php include("./procesos/getRuta.php"); ?>
                                </select>
                            </div>
                            <div class="input-group input-group-sm my-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Producto</span>
                                </div>
                                <select name="producto" id="producto" class="form-control" required disabled>
                                    <option value="0">[NINGUNO]</option>
                                    <?php include("./procesos/getLProducto.php"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-12 border rounded shadow bg-white text-center py-2">
                    <button type="button" id="btn-nuevo" class="btn btn-warning btn-sm my-1" onclick="nuevo();">
                        <i class="fa fa-sticky-note tam-icon px-2"></i>Nuevo</button>
                    <button type="button" id="btn-registrar" class="btn btn-warning btn-sm my-1"
                            onclick="modalMul(1);" disabled>
                        <i class="fa fa-floppy-o tam-icon px-2"></i>Registrar</button>
                    <button type="button" id="btn-modificar" class="btn btn-warning btn-sm my-1"
                            onclick="modalMul(2);" disabled>
                        <i class="fa fa-pencil-square-o tam-icon px-2"></i>Modificar</button>
                    <button type="button" id="btn-cancelar" class="btn btn-warning btn-sm my-1" onclick="modalMul(3);" disabled>
                        <i class="fa fa-ban tam-icon px-2"></i>Cancelar</button>
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
        <!-- Modal Multi-->
        <div class="modal fade" id="miModalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1 box-s bg-info">
                        <h5 class="modal-title text-white" id="exampleModalCenterTitle">Alerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4 pt-0 pb-0 pl-1 pr-0 centrar-custom">
                                        <i class="fa fa-exclamation text-warning" style="font-size:50px;" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-lg-8 p-0 centrar-custom">
                                        <h6 id="modalConcepto">--</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-1 border-0 align-self-center">
                        <button type="button" id="eventeame" class="btn btn-primary p-1 m-1" style="width:65px;">Si</button>
                        <button class="btn btn-danger p-1 m-1" id="cerrarMulti" data-dismiss="modal" aria-label="Close" style="width:65px;">No</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Multi-->
        
        <!-- Modal OKI-->
        <div class="modal fade" id="miModalOKI" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1 box-s bg-info">
                        <h5 class="modal-title text-white" id="exampleModalCenterTitle">Información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4 pt-0 pb-0 pl-1 pr-0 centrar-custom">
                                        <i class="fa fa-check text-success" style="font-size:50px;" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-lg-8 p-0 centrar-custom">
                                        <h6 id="OKIconcepto">--</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-1 border-0 align-self-center">
                        <button class="btn btn-success p-1 m-1" id="cerrarOKI" data-dismiss="modal" aria-label="Close" style="width:65px;">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal OKI-->
        <script src="<?php echo $ruta; ?>assets/js/newjs.js"></script>
        <script src="./procesos/registroHorario.js"></script>
    </body>
</html>