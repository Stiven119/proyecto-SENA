<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #e0e0e0;
        }
        
        .welcome-container {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 500px;
            width: 90%;
            animation: fadeIn 0.8s ease-out;
            border: 1px solid #333;
        }
        
        h1 {
            color: #ff6d00; /* Naranja brillante */
            margin-bottom: 30px;
            font-size: 2.2em;
            text-shadow: 0 0 10px rgba(255, 109, 0, 0.3);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #ff6d00;
            color: #121212;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(255, 109, 0, 0.3);
        }
        
        .btn:hover {
            background-color: #ff8c00;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 109, 0, 0.5);
            color: #000;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenid@ a mi pagina <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
        <a href="cerrar_sesion.php" class="btn">Ir a la página principal</a>
    </div>
</body>
</html>