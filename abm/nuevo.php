<?php
include("../bd.php");

$idUsuario = (isset($_GET['idUsuario']))?$_GET['idUsuario']:"";

if($_POST){
    $nomproy=(isset($_POST['nomproy']))?$_POST['nomproy']:"";
    $estado=(isset($_POST['opcionesSelect']))?$_POST['opcionesSelect']:"";

    
    $sentencia = $conexion->prepare("INSERT INTO `proyectos` (`id`, `nombre`, `estado`, `actividades`, `usuario`) VALUES (NULL, :nombre, :estado, :actividades, :usuario);");
    $sentencia->bindParam(":nombre",$nomproy);
    $sentencia->bindParam(":estado",$estado);
    $actividades = "";
    $sentencia->bindParam(":actividades",$actividades);
    $sentencia->bindParam(":usuario",$idUsuario);


    try {
        $sentencia->execute();
        
        header("Location:/proyecto/index.php?idUsuario=".$idUsuario);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    

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
                                    <h6 class="m-0 font-weight-bold text-primary">Nuevo Proyecto</h6>
                                </div>
                                <div class="card-body">
                                    <form action="" enctype="multipart/form-data" method="post" >
                                        <div class="mb-3">
                                            <label for="nomproy" class="form-label">Nombre del Proyecto:</label>
                                            <input type="text" class="form-control" name="nomproy" id="nomproy"required >
                                        </div>
                                        <div class="mb-3">
                                            <label for="opcionesSelect" class="form-label">Estado:</label>
                                            <select class="form-select" id="opcionesSelect" name="opcionesSelect" required>
                                                <option value="" disabled selected>Elija estado</option>
                                                <option value="Proceso">Proceso</option>
                                                <option value="Pausa">Pausa</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success">CREAR</button>
                                    </form>
                                </div>
                            </div>

                            
                        </div>

                    </div>

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
 <?php include("./templetes/footer.php");?>