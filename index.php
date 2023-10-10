<?php
include("./bd.php");

$idUsuario = (isset($_GET['idUsuario']))?$_GET['idUsuario']:"";

$sentencia = $conexion->prepare("SELECT * FROM proyectos WHERE usuario=:id;");
$sentencia->bindParam(":id",$idUsuario);

$sentencia->execute();
$lista_proyectos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Todas las actividades
$sentencia = $conexion->prepare("SELECT * FROM actividades WHERE idjefe=:id;");
$sentencia->bindParam(":id",$idUsuario);
$sentencia->execute();
$lista_act=$sentencia->fetchAll(PDO::FETCH_ASSOC);
//Todas los empleados
$sentencia = $conexion->prepare("SELECT * FROM empleados WHERE idjefe=:id;");
$sentencia->bindParam(":id",$idUsuario);
$sentencia->execute();
$lista_empl=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['actId'])){
    $idAct = (isset($_GET['actId']))?$_GET['actId']:"";

    $sentencia = $conexion->prepare("DELETE FROM actividades WHERE id=:id");
    $sentencia->bindParam(":id",$idAct);
    $sentencia->execute();
    header("Location:index.php?idUsuario=".$idUsuario);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WILL POWER</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                
                <div class="sidebar-brand-text mx-3">WILL POWER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Proyectos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#proyectos" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span>Mis Proyectos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Acciones:</h6>
                        <a class="collapse-item" href="./abm/nuevo.php?idUsuario=<?php echo $idUsuario; ?>">Nuevo</a>
                        <a class="collapse-item" href="./abm/eliminar.php?idUsuario=<?php echo $idUsuario; ?>">Eliminar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Actividades
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#actividades" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Actividades</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Acciones:</h6>
                        <a class="collapse-item" href="./abm/nuevoAct.php?idUsuario=<?php echo $idUsuario; ?>">Nuevo</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Empleados
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#empleados" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-person-half-dress"></i>
                    <span>Empleados</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Acciones:</h6>
                        <a class="collapse-item" href="login.html">Nuevo</a>
                        <a class="collapse-item" href="register.html">Eliminar</a>
                    </div>
                </div>
            </li>


            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
                        <h1></h1>
                        <a href="login.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fa-solid fa-door-open"></i> Cerrar Sesion</a>
                    </div>
                    

                </nav>
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
                                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                        <?php foreach($lista_proyectos as $proyecto){?>
                                                <div class="col mb-2 mt-2 text-center">
                                                    <div class="card h-100">
                                                        <!-- name-->
                                                        <h5 class="fw-bolder"><?php echo $proyecto['nombre'];?></h5>
                                                        <!--  details-->
                                                        <div class="card-body p-2">
                                                            <div class="text-center">
                                                                <p class="">Estado: <?php echo $proyecto['estado'];?></p>
                                                                <p class="">Actividades: <?php echo $proyecto['actividades'];?></p>
                                                            </div>
                                                        </div>
                                                        <!--  actions-->
                                                        <div class="card-footer p-2 pt-0 border-top-0 bg-transparent ">
                                                            <div class="text-center">
                                                                <a class="btn btn-outline-dark mt-auto" href="./abm/proyectoEmpleado.php?idUsuario=<?php echo $idUsuario; ?>&idProyecto=<?php echo $proyecto['id'] ; ?>">Empleados</a>
                                                                <a class="btn btn-outline-dark mt-auto" href="./abm/proyectoActivida.php?idUsuario=<?php echo $idUsuario; ?>&idProyecto=<?php echo $proyecto['id'] ; ?>">Actividades</a>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            
                        </div>

                    </div>

                    <!-- Content Row -->
                    <div class="row" id="actividades">

                        <!-- Content Column -->
                        <div class="">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Mis Actividades</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Acciones</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($lista_act as $act){?>
                                            <tr class="">
                                                <td><?php echo $act['nombre'];?></td>
                                                <td>
                                                    <a name="" id="" class="btn btn-danger" href="index.php?idUsuario=<?php echo $idUsuario; ?>&actId=<?php echo $act['id'];?>" role="button">Eliminar</a>
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

                    <!-- Content Row -->
                    <div class="row" id="empleados">

                        <!-- Content Column -->
                        <div class="">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Empleados</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Apellido</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Disponible</th>
                                                    <th scope="col"></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($lista_empl as $empl){?>
                                                <tr class="">
                                                    <td><?php echo $empl['nombre'];?></td>
                                                    <td><?php echo $empl['apellido'];?></td>
                                                    <td><?php if($empl['disp']==0){echo "NO";}else{echo "SI";};?></td>
                                                    <td>
                                                        <a name="" id="" class="btn btn-danger" href="index.php?idUsuario=<?php echo $idUsuario; ?>&empId=<?php echo $empl['id'];?>" role="button">Eliminar</a>
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

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Will Power</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://kit.fontawesome.com/64843cb2e5.js" crossorigin="anonymous"></script>

</body>

</html>