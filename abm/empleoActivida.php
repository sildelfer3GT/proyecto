<?php
include("../bd.php");

$idUsuario = (isset($_GET['idUsuario']))?$_GET['idUsuario']:"";
$idProyecto  = (isset($_GET['idProyecto']))?$_GET['idProyecto']:"";

//empleados del mismo jefe
$sentencia = $conexion->prepare("SELECT * FROM empleados WHERE idjefe=:idusuario AND disp=:disp");
$sentencia->bindParam(":idusuario",$idUsuario);
$disp= 1;
$sentencia->bindParam(":disp",$disp);
$sentencia->execute();
$misempleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//uso el nombre del proyecto
$sentencia = $conexion->prepare("SELECT * FROM proyectos WHERE id=:id");
$sentencia->bindParam(":id",$idProyecto);
$sentencia->execute();
$proyecto = $sentencia->fetch(PDO::FETCH_LAZY);

//buscar todas actividades del mismo jefe
$sentencia = $conexion->prepare("SELECT * FROM actividades WHERE idjefe=:id");
$sentencia->bindParam(":id", $idUsuario);
$sentencia->execute();
$misact = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if($_POST){
    
    $idUsuario=(isset($_POST['idUser']))?$_POST['idUser']:"";
    $idProyecto=(isset($_POST['idProy']))?$_POST['idProy']:"";
    $idEmpleado=(isset($_POST['idEmpleado']))?$_POST['idEmpleado']:"";
    $idActividad=(isset($_POST['actividad']))?$_POST['actividad']:"";

    

    $sentencia = $conexion->prepare("INSERT INTO `empleados_actividad` (`id`, `idempleado`, `idactividad`, `proyecto`, `estado`) VALUES (NULL, :idempleado, :idactividad, :proyecto, :estado);");
    $sentencia->bindParam(":idempleado",$idEmpleado);
    $sentencia->bindParam(":idactividad",$idActividad);
    $sentencia->bindParam(":proyecto",$idProyecto);
    $estado = 0;
    $sentencia->bindParam(":estado",$estado);

    $sentencia->execute();

    $sentencia = $conexion->prepare("UPDATE empleados SET disp=:disp WHERE id=:id");
    $disp=0;
    $sentencia->bindParam(":disp",$disp);
    $sentencia->bindParam(":id",$idEmpleado);

    $sentencia->execute();

    header("Location:http://localhost/proyecto/abm/empleoActivida.php?idUsuario=".$idUsuario."&idProyecto=".$idProyecto);

}

include("./templetes/cabezera.php");

?>


<!-- Begin Page Content -->
<div class="container-fluid ">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $proyecto['nombre'];?></h1>
    
</div>

<!-- Content Row -->
<div class="row" id="proyectos">

    <!-- Content Column -->
    <div class="">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mis Empleados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Actividades</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($misempleados as $per){?>
                            <tr class="">
                                
                                <form action="" method="post">
                                    <input type="hidden" name="idProy" value="<?php echo $idProyecto;?>">
                                    <input type="hidden" name="idUser" value="<?php echo $idUsuario;?>">

                                    <td><input type="text" class=" form-control-user" id="id" name="idEmpleado" value="<?php echo $per['id'];?>" readonly></td>
                                    <td><?php echo $per['apellido'];?></td>
                                    <td><?php echo $per['nombre'];?></td>
                                    <td><select name="actividad" id="actividades" class="form-select">
                                            <?php
                                            // Generar las opciones del select
                                            foreach ($misact as $actividad) {
                                                echo "<option value=\"{$actividad['id']}\">{$actividad['nombre']}-{$actividad['id']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-user btn-block"> Agregar</button>
                                        <!-- <a name="" id="" class="btn btn-danger" href="<?php echo $url_base; ?>abm/proyectoEmpleado.php?idUsuario=<?php echo $idUsuario; ?>&perId=<?php echo $per['id'];?>" role="button">Agregar</a> -->
                                    </td>
                                </form>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div> 
    </div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include("./templetes/footer.php");?>