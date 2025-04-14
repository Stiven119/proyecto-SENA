<?php
session_start();
include 'conexion_be.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

s
if(empty($correo) || empty($contrasena)) {
    echo '
        <script>
            alert("Por favor complete todos los campos");
            window.location = "../index.php";
        </script>
    ';
    exit();
}


$contrasena = hash('sha512', $contrasena);

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

if(mysqli_num_rows($validar_login) > 0) {
    $usuario = mysqli_fetch_assoc($validar_login);
    
    if($contrasena == $usuario['contrasena']) {
        $_SESSION['usuario'] = $usuario['nombre_completo'];
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['id'] = $usuario['id'];
        
        header("location: bienvenida.php");
        exit();
    } else {
        echo '
            <script>
                alert("Contraseña incorrecta");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }
} else {
    echo '
        <script>
            alert("Usuario no registrado, por favor verifique los datos introducidos");
            window.location = "../index.php";
        </script>
    ';
    exit();
}
?>
