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
                <?php include ($ruta.'assets/include/navLateralAdministrativo.php') ?>
            </div>
            <!-- INICIO DEL MAIN -->
            <div class="uMain-lg border-left border-warning" id="uMain">
                <div id="my_titulo" class="form-control form-control-sm text-center uGreen py-1">
                    <span>Registro de Linea de Producto</span>
                </div>
                <div class="container-fluid p-0 bg-white">
                    <div class="col-lg-12 border rounded shadow py-1">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="btn-nuevo" class="btn btn-warning btn-sm my-1" onclick="nuevo();">
                                    <i class="fa fa-sticky-note tam-icon px-2"></i>Nuevo</button>
                                <button type="button" id="btn-regresar" class="btn btn-warning btn-sm my-1" onclick="volverLineaProducto();" disabled>
                                    <i class="fa fa-arrow-left tam-icon px-2"></i>Regresar</button>

                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="#" class="btn btn-success btn-sm my-1" onclick="exportarDLProducto();" title="Detalle Linea de Producto"><i class="fa fa-file-excel-o tam-icon px-1"></i></a>
                                <a href="#" class="btn btn-success btn-sm my-1" onclick="exportarLProducto();" title="Linea de Producto"><i class="fa fa-file-excel-o tam-icon px-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 p-0">
                        <div class="card">
                            <div class="input-group input-group-sm p-2" id="buscadorPL">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Buscar Linea de Producto</span>
                                </div>
                                <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Nombre Linea de Producto" onkeypress="buscarLineaProducto(0);">

                            </div>
                            <div class="text-center d-none" id="titlePL">
                                <h3>Hola</h3>
                            </div>
                            <div class="card-body p-1">
                                <div class="col-lg-12 p-0 table-responsive" style="height:400px;">
                                    <table class="table table-sm table-hover table-bordered" style="font-size:12px;">
                                        <thead>
                                            <tr class="text-center">
                                                <th style="width:30px;" class="text-center">N°</th>
                                                <th style="width:50px;display:none;" class="text-center" style="">C</th>
                                                <th style="width:200px;" class="text-center" id="changeA">Linea de Producto</th>
                                                <th style="width:350px;" class="text-center" id="changeB">Descripción</th>
                                                <th style="width:30px;" class="text-center" id="changeC">Modificar</th>
                                            </tr>
                                        </thead>

                                        <tbody id="contenidoIngreso">
                                            <?php include("./procesos/buscarLineaProducto.php"); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal Multi-->
        <div class="modal fade" id="miModalEliminar" tabindex="-1" role="dialog">
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

        <!-- Modal Registro-->
        <div class="modal fade" id="miModalRegistro" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header box-s bg-primary">
                        <h5 class="modal-title text-white" id="titulo">Registro Linea de Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Linea de Producto:</label>
                            <input type="text" class="form-control" id="lineaProducto" name="lineaProducto" placeholder="Nombre Linea de Producto">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción Linea de Producto">
                        </div>
                    </div>
                    <div class="modal-footer px-1 border-0 align-self-center">
                        <button type="button" id="guardarReg" class="btn btn-success" onclick="modalMul(1);">Registrar</button>
                        <button id="cerrarReg" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Registro-->

        <!-- Modal Modificar-->
        <div class="modal fade" id="miModalModificar" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header box-s bg-primary">
                        <h5 class="modal-title text-white" id="titulo">Modificar Linea de Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Linea de Producto:</label>
                            <input type="text" class="form-control" id="mlineaProducto" name="mlineaProducto" placeholder="Nombre Linea de Producto">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" id="mdescripcion" name="mdescripcion" placeholder="Descripción Linea de Producto">
                        </div>
                    </div>
                    <div class="modal-footer px-1 border-0 align-self-center">
                        <button type="button" id="guardarMod" class="btn btn-success" onclick="modalMul(2);">Modificar</button>
                        <button id="cerrarMod" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Modificar-->

        <!-- Modal Modificar-->
        <div class="modal fade" id="miModalRegPL" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header box-s bg-primary">
                        <h5 class="modal-title text-white" id="titulo">Agregar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Producto:</label>
                            <input type="text" class="form-control" id="mProducto" name="mProducto" placeholder="Nombre de Producto">
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-sm my-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Producto</span>
                                </div>
                                <select name="producto" id="producto" class="form-control">
                                    <option value="0">[NINGUNO]</option>
                                    <?php include("./procesos/getProducto.php"); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-1 border-0 align-self-center">
                        <button type="button" id="guardarMod" class="btn btn-success" onclick="modalMul(4);">Guardar</button>
                        <button id="cerrarRegPL" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Modificar-->

        <script src="<?php echo $ruta; ?>assets/js/newjs.js"></script>
        <script src="./procesos/registroLineaProducto.js"></script>
    </body>
</html>