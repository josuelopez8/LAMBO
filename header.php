<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lamborghini Club</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        .header { background-color: #000; color: #fff; padding: 15px; }
        .nav { background-color: #FF0000; padding: 10px; }
        .nav a { color: #fff; text-decoration: none; margin-right: 20px; }
        .content { padding: 20px; }
        .form-container { max-width: 400px; margin: 50px auto; }
        input[type="text"], input[type="password"], input[type="email"] { width: 100%; padding: 10px; margin: 5px 0; }
        .button { background-color: #FF0000; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Lamborghini Club</h1>
    </div>
    <div class="nav">
    <?php if(isset($_SESSION['username'])): ?>
        <a href="index.php">Inicio</a>
        <a href="models.php">Modelos</a>
        <a href="history.php">Historia</a>
        <a href="galeria.php">Galería</a>
        <a href="tecnologia.php">Tecnologia</a>
        <a href="concensionarios.php">Concensionarios</a>
        <a href="contacto.php">Contacto</a> <!-- Nuevo apartado -->
        <a href="logout.php">Cerrar Sesión</a>
    <?php else: ?>
        <a href="index.php">Inicio</a>
        <a href="register.php">Registro</a>
        <a href="login.php">Iniciar Sesión</a>
    <?php endif; ?>
</div>
