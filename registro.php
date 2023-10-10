<?php
include("./bd.php");

if($_POST){
    $apellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
    $nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $email=(isset($_POST['email']))?$_POST['email']:"";
    $contrasenia=(isset($_POST['contrasenia']))?$_POST['contrasenia']:"";

    
    $sentencia = $conexion->prepare("INSERT INTO `usuarios` (`id`, `apellido`, `nombre`, `email`, `contra`, `proyectos`) VALUES (NULL, :apellido, :nombre, :email, :contra, :proyectos);");
    $sentencia->bindParam(":apellido",$apellido);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":email",$email);
    $sentencia->bindParam(":contra",$contrasenia);
    $proyectos = "";
    $sentencia->bindParam(":proyectos",$proyectos);


    try {
        $sentencia->execute();
        $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE email=:email");
        $sentencia->bindParam(":email",$email);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        $iduser=$registro['id'];
        header("Location: index.php?idUsuario=".$iduser);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    

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

    <title>Registro</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">CREA TU CUENTA</h1>
                            </div>
                            <form action="" enctype="multipart/form-data" method="post" class="user" >
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="apellido" placeholder="Apellido" name="apellido" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="nombre" placeholder="Nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <input type="password" class="form-control form-control-user"
                                            id="contrasenia" placeholder="Contraseña" name="contrasenia" required>
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="contrasenia" placeholder="Repita Contraseña" required>
                                    </div> -->
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block"> Crear Cuenta</button>

                                
                            </form>
                            <hr>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Olvidaste la contraseña</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="login.html">Tienes cuenta? Ingresa!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Custom scripts for all pages
    <script src="js/sb-admin-2.min.js"></script> -->

</body>

</html>