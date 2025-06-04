<?php
$host = "localhost";
$dbname = "lamborghini_db";
$username = "root";    // Usuario por defecto en XAMPP/WAMP
$password = "";        // Contraseña vacía por defecto

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "¡Conexión exitosa!"; // Solo para pruebas (eliminar después)
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>