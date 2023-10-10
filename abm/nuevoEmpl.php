<?php
include("../bd.php");

$idUsuario = (isset($_GET['idUsuario']))?$_GET['idUsuario']:"";

if($_POST){
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";

    
    $sentencia = $conexion->prepare("INSERT INTO `empleados` (`id`, `apellido`, `nombre`, `	idjefe`, `disp`) VALUES (NULL, :apellido, :nombre, :idjefe, :disp);");
    $sentencia->bindParam(":apellido",$apellido);
    $sentencia->bindParam(":nombre",$nombre);
    $disp = 1;
    $sentencia->bindParam(":idjefe",$idUsuario);
    $sentencia->bindParam(":disp",$disp);


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
                        <h1 class="h3 mb-0 text-gray-800">Empleados</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row" >

                        <!-- Content Column -->
                        <div class="">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Nuevo Empleados</h6>
                                </div>
                                <div class="card-body">
                                    <form action="" enctype="multipart/form-data" method="post" >
                                        <div class="mb-3">
                                            <label for="nomproy" class="form-label">Nombre del Proyecto:</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre"required >
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomproy" class="form-label">Nombre del Proyecto:</label>
                                            <input type="text" class="form-control" name="apellido" id="apellido"required >
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