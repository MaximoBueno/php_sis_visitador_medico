<?php
include("../nologin/seguridad.php");
$security = new seguridad();
$security->getSeguridad();
$security->returnInitialPage();
?>