<?php
session_start();
include 'header.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<style>
    .dealer-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 20px;
        text-align: center;
    }

    .map-error {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin: 2rem 0;
    }

    .technical-info {
        color: #666;
        font-size: 0.9em;
        margin-top: 1rem;
    }
</style>

<div class="dealer-container">
    <h2>Concesionarios Autorizados</h2>
    
    <div class="map-error">
        <h3>⚠ Servicio de Mapas Temporalmente No Disponible</h3>
        <p>Estamos trabajando para resolver este inconveniente. Por favor consulta nuestra lista de concesionarios:</p>
        
        <div class="dealer-list">
            <div class="dealer-card">
                <h3>Sede Principal Lamborghini</h3>
                <p>📍 Via Modena, 12, 40019 Sant'Agata Bolognese BO, Italia</p>
                <p>📞 +39 051 9597 111</p>
                <p>🕒 Lunes a Viernes: 9:00 - 18:00</p>
            </div>
        </div>

        <div class="technical-info">
            <p>Código de error: GMAPS-403</p>
            <p>Para asistencia técnica contactar a: soporte@lamborghiniclub.com</p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>