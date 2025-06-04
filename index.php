<?php
session_start();
include 'header.php';
include 'db.php';

if(isset($_SESSION['username'])) {
    echo "<h2>Bienvenido al Club Lamborghini, ".$_SESSION['username']."!</h2>";
    echo "<p>Explora nuestra exclusiva colección de vehículos y historia.</p>";
    echo "<img src='imagenes/R.jpg' style='max-width: 20%;'>";
} else {
    echo "<h2>Bienvenido al Club Lamborghini</h2>";
    echo "<p>Regístrate para acceder a contenido exclusivo sobre nuestros superdeportivos.</p>";
}

include 'footer.php';
?>