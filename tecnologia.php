<?php
session_start();
include 'header.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<style>
    .tech-section {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 20px;
    }

    .tech-card {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin: 40px 0;
        align-items: center;
    }

    .tech-image {
        max-width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .tech-card {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="tech-section">
    <h2>Tecnología Innovadora</h2>
    
    <div class="tech-card">
        <img src="imagenes/ALA.jpg" class="tech-image">
        <div>
            <h3>ALA 2.0 (Aerodinámica Lamborghini Attiva)</h3>
            <p>Sistema de aerodinámica activa que optimiza el flujo de aire en tiempo real</p>
        </div>
    </div>

    <div class="tech-card">
        <img src="imagenes/idvi.jpg" class="tech-image">
        <div>
            <h3>LDVI (Lamborghini Dinamica Veicolo Integrata)</h3>
            <p>Unidad central de control que coordina todos los sistemas dinámicos del vehículo</p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>