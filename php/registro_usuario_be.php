<?php
session_start();
include 'conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];

// Validar campos vacíos
if(empty($nombre_completo) || empty($correo) || empty($contrasena) || empty($confirmar_contrasena)) {
    echo '
        <script>
            alert("Por favor complete todos los campos");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

// Validar que las contraseñas coincidan
if($contrasena != $confirmar_contrasena) {
    echo '
        <script>
            alert("Las contraseñas no coinciden");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

// Validar formato de correo
if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '
        <script>
            alert("Por favor ingrese un correo electrónico válido");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

// Validar longitud de contraseña
if(strlen($contrasena) < 8) {
    echo '
        <script>
            alert("La contraseña debe tener al menos 8 caracteres");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

// Hashear contraseñas
$contrasena = hash('sha512', $contrasena);
$confirmar_contrasena = hash('sha512', $confirmar_contrasena);

// Verificar si el correo ya existe
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

if(mysqli_num_rows($verificar_correo) > 0) {
    echo '
        <script>
            alert("Este correo ya está registrado, por favor use otro diferente");
            window.location = "../index.php";
        </script>
    ';
    exit();
}

// Insertar nuevo usuario
$query = "INSERT INTO usuarios(nombre_completo, correo, contrasena) 
          VALUES('$nombre_completo', '$correo', '$contrasena')";

$ejecutar = mysqli_query($conexion, $query);

if($ejecutar) {
    echo '
        <script>
            alert("Usuario registrado exitosamente");
            window.location = "../index.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Inténtelo de nuevo, usuario no registrado");
            window.location = "../index.php";
        </script>
    ';
}

mysqli_close($conexion);
?>