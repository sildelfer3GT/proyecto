<?php 
include("../bd.php");


if(isset($_GET['idProyecto'])){
    
    $idp = (isset($_GET['idProyecto']))?$_GET['idProyecto']:"";

    $sentencia = $conexion->prepare("DELETE FROM proyectos WHERE id=:id");
    $sentencia->bindParam(":id",$idp);
    $sentencia->execute();
    header("Location:/proyecto/abm/eliminar.php?idUsuario=".$idUsuario);
}

$idUsuario = (isset($_GET['idUsuario']))?$_GET['idUsuario']:"";

$sentencia = $conexion->prepare("SELECT * FROM proyectos WHERE usuario=:id;");
$sentencia->bindParam(":id",$idUsuario);

$sentencia->execute();
$lista_proyectos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

try {

    $cant = array();
    foreach($lista_proyectos as $proyecto){
        $sentencia = $conexion->prepare("SELECT idempleado FROM empleados_actividad WHERE proyecto = :usuario");
        $sentencia->bindParam(":usuario", $user);
        $sentencia->execute();

        // Obtener todos los idempleados en un vector
        $idempleados = $sentencia->fetchAll(PDO::FETCH_COLUMN);
        $cant[] = count($idempleados);
    }

    foreach ($lista_proyectos as $indice => $proyecto) {
        // Agregar la información del empleado correspondiente a cada proyecto
        $lista_proyectos[$indice]['empleados'] = $cant[$indice];
    }

    

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

include("./templetes/cabezera.php");

?>


                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Panel</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row" id="proyectos">

                        <!-- Content Column -->
                        <div class="">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Proyectos</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col">Cant. Actividades</th>
                                                    <th scope="col">Cant. Empleados</th>
                                                    <th scope="col"></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($lista_proyectos as $proy){?>
                                                <tr class="">
                                                    <td><?php echo $proy['nombre'];?></td>
                                                    <td><?php echo $proy['estado'];?></td>
                                                    <td><?php echo $proy['actividades'];?></td>
                                                    <td><?php echo $proy['empleados'];?></td>
                                                    <td>
                                                        <a name="" id="" class="btn btn-danger" href="eliminar.php?idProyecto=<?php echo $proy['id'];?> &idUsuario=<?php echo $idUsuario;?>" role="button">Eliminar</a>
                                                    </td>

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