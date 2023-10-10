<?php
include("../bd.php");

$idUsuario = (isset($_GET['idUsuario']))?$_GET['idUsuario']:"";
$idProyecto  = (isset($_GET['idProyecto']))?$_GET['idProyecto']:"";
// obtengo id actividad y empleado del mismo proyecto
$sentencia = $conexion->prepare("SELECT idempleado, idactividad, id FROM empleados_actividad WHERE proyecto=:id");
$sentencia->bindParam(":id", $idProyecto);
$sentencia->execute();
$lista_empleados_actividades = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//datos completos
$nueva_matriz = array();

foreach ($lista_empleados_actividades as $registro) {
    $idempleado = $registro['idempleado'];
    $idactividad = $registro['idactividad'];
    $id = $registro['id'];


    // Consultar la tabla empleados para obtener nombre y apellido del empleado
    $sentenciaEmpleado = $conexion->prepare("SELECT nombre, apellido FROM empleados WHERE id = :idempleado");
    $sentenciaEmpleado->bindParam(":idempleado", $idempleado);
    $sentenciaEmpleado->execute();
    $empleado = $sentenciaEmpleado->fetch(PDO::FETCH_ASSOC);

    // Consultar la tabla actividades para obtener el nombre de la actividad
    $sentenciaActividad = $conexion->prepare("SELECT nombre FROM actividades WHERE id = :idactividad");
    $sentenciaActividad->bindParam(":idactividad", $idactividad);
    $sentenciaActividad->execute();
    $actividad = $sentenciaActividad->fetch(PDO::FETCH_ASSOC);

    // Crear un nuevo array con la información obtenida
    $nueva_matriz[] = array(
        'id' => $id,
        'idempleado' => $idempleado,
        'nombre' => $empleado['nombre'],
        'apellido' => $empleado['apellido'],
        'idactividad' => $idactividad,
        'actividad' => $actividad['nombre']
    );
}
//uso el nombre del proyecto
$sentencia = $conexion->prepare("SELECT * FROM proyectos WHERE id=:id");
$sentencia->bindParam(":id",$idProyecto);
$sentencia->execute();
$proyecto = $sentencia->fetch(PDO::FETCH_LAZY);




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
                <h6 class="m-0 font-weight-bold text-primary">Empleados del Proyecto</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Apellido</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Actividades</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($nueva_matriz as $per){?>
                            <tr class="">
                                <td><?php echo $per['apellido'];?></td>
                                <td><?php echo $per['nombre'];?></td>
                                <td><?php echo $per['actividad'];?></td>
                                <td>
                                    <a name="" id="" class="btn btn-danger" href="<?php echo $url_base; ?>abm/proyectoEmpleado.php?idUsuario=<?php echo $idUsuario; ?>&perId=<?php echo $per['id'];?>" role="button">Eliminar</a>
                                </td>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="d-flex">
                    <a href="<?php echo $url_base; ?>abm/empleoActivida.php?idUsuario=<?php echo $idUsuario;?>&idProyecto=<?php echo $idProyecto;?>" name="" id="" class="btn btn-primary" role="button">Agregar</a>
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