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
                <div id="my_titulo" class="form-control form-control-sm text-center uGreen py-1">
                    <span>Registro de Personal</span>
                </div>
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-lg-4 p-0">
                            <div class="col-lg-12 p-0">
                                <div class="card">
                                    <div class="card-header uGreen text-white py-1">Datos Personal</div>
                                    <div class="card-body p-1">
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ape. Paterno</span>
                                            </div>
                                            <input type="text" name="paterno" id="paterno" class="form-control" disabled required>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ape. Materno</span>
                                            </div>
                                            <input type="text" name="materno" id="materno" class="form-control" disabled required>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Nombres</span>
                                            </div>
                                            <input type="text" name="nombres" id="nombres" class="form-control" disabled required>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Tipo Documento</span>
                                            </div>
                                            <select name="tipo_documento" id="tipo_documento" class="form-control" disabled required>
                                                <option value="0">[NINGUNO]</option>
                                                <?php  include("./procesos/getTipoDocumento.php");?>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Nro. documento</span>
                                            </div>
                                            <input type="text" name="nro_documento" id="nro_documento" class="form-control" disabled required>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Género</span>
                                            </div>
                                            <select name="genero" id="genero" class="form-control" disabled required>
                                                <option value="0">[NINGUNO]</option>
                                                <?php  include("./procesos/getGenero.php");?>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Tipo de Persona</span>
                                            </div>
                                            <select name="tipo_persona" id="tipo_persona" class="form-control" disabled required>
                                                <option value="0">[NINGUNO]</option>
                                                <?php  include("./procesos/getTipoPersona.php");?>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Fecha de Nacimiento</span>
                                            </div>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" disabled required>
                                        </div>
                                        <div class="input-group input-group-sm my-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Dirección</span>
                                            </div>
                                            <input type="text" name="direccion" id="direccion" class="form-control" disabled required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 border rounded shadow bg-white text-center py-1">
                                <button type="button" id="btn-nuevo" class="btn btn-warning btn-sm my-1" onclick="  nuevo();">
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
                        </div>
                        <div class="col-lg-8 p-0">
                            <div class="card">
                                <div class="card-header uGreen text-white py-1">Buscar Personal</div>
                                <div class="input-group input-group-sm p-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Buscar Persona</span>
                                    </div>
                                    <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Apellidos" onkeypress="buscarPersonal(0);">
                                    <a href="#" class="btn btn-success btn-sm mx-1" onclick="exportarExcel();" title="Exportar a Excel"><i class="fa fa-file-excel-o tam-icon px-1"></i></a>
                                </div>
                                <div class="card-body p-1">
                                    <div class="col-lg-12 p-0 table-responsive" style="height:400px;">
                                        <table class="table table-sm table-hover table-bordered" style="font-size:12px;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width:30px;" class="text-center">N°</th>
                                                    <th style="width:50px;display:none;" class="text-center" style="">C</th>
                                                    <th style="width:150px;" class="text-center" >Ap. Paterno</th>
                                                    <th style="width:150px;" class="text-center">Ap. Materno</th>
                                                    <th style="width:150px;" class="text-center">Nombres</th>
                                                    <th style="width:40px;" class="text-center">Tipo documento</th>
                                                    <th style="width:100px;" class="text-center" >Nro. documento</th>
                                                    <th style="width:50px;" class="text-center">Género</th>
                                                    <th style="width:50px;" class="text-center">Tipo Persona</th>
                                                    <th style="width:80px;" class="text-center">Fecha nacimiento</th>
                                                    <th style="width:60px;" class="text-center">Dirección</th>
                                                </tr>
                                            </thead>

                                            <tbody id="contenidoIngreso">
                                                <?php include("./procesos/buscarPersonal.php"); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="./procesos/registroPersonal.js"></script>
    </body>
</html>