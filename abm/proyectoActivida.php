<?php
include("../bd.php");

$idUsuario = (isset($_GET['idUsuario']))?$_GET['idUsuario']:"";
$idProyecto  = (isset($_GET['idProyecto']))?$_GET['idProyecto']:"";


include("./templetes/cabezera.php");

?>


<?php include("./templetes/footer.php");?>