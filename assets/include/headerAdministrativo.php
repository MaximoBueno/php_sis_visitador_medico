<div class="col-lg-12 border-bottom border-warning uGreen" id="uHeader" >
    <div class="row">
        <div class="col-lg-6 uCentrarCustom p-0" style="border: 1px solid red">
            <input type="checkbox" id="uCheck" onclick="check();" autocomplete="off" class="d-none">
            <label for="uCheck" class="uCentrarCustom mx-3 my-1" id="uLabel" onclick="clickLabel();">
                <i class="material-icons border text-white rounded p-1" style="cursor:pointer">menu</i>
            </label>
            <img src="<?php echo $ruta; ?>assets/img/unimed.png" width="auto" height="50px" alt="" class="m-2">
            <div class="uCentrarCustom text-center">
                <div class="text-warning">
                    <strong>UNIMED</strong>
                    <h6 class="font-weight-bold text-white mx-3">DEL PERÚ</h6>
                </div>
            </div>
            <div class="text-white centrar-custom" style="margin: 0px 25px 0px auto">
            </div>
        </div>
        <div class="col-lg-6" style="border: 1px solid red">
           <div class="row">
                <div class="col-lg-8 " style="border: 1px solid red">
                    <h6 style="color: white"><strong class="text-warning">USUARIO: </strong><?php echo $_SESSION['nro_doc_acc']; ?></h6>
                </div>
                <div class="col-lg-4" style="border: 1px solid red">
                    <a href="<?php echo $ruta; ?>modulo/nologin/index.php" class="my_salir"><i class="fa fa-power-off"></i></a>
                </div>
           </div>
        </div>
    </div>
</div>