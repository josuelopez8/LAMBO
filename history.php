<?php
session_start();
include 'header.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<style>
    .history-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 20px;
    }

    .timeline {
        position: relative;
        padding: 40px 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        width: 4px;
        height: 100%;
        background: #FF0000;
        transform: translateX(-50%);
    }

    .timeline-item {
        position: relative;
        width: 45%;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 40px;
        transition: transform 0.3s ease;
    }

    .timeline-item:hover {
        transform: translateY(-5px);
    }

    .timeline-item.left {
        left: 0;
    }

    .timeline-item.right {
        left: 55%;
    }

    .timeline-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .timeline-year {
        font-size: 1.8em;
        color: #FF0000;
        margin-bottom: 10px;
    }

    .history-header {
        text-align: center;
        padding: 60px 0;
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('imagenes/LO.jpg');
        background-size: cover;
        background-position: center 30%;
        color: white;
        margin-bottom: 40px;
        height: 600px;
    }

    .milestone-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        margin: 20px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .quote {
        font-size: 1.4em;
        text-align: center;
        margin: 40px 0;
        padding: 30px;
        background: #f8f8f8;
        border-left: 5px solid #FF0000;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .timeline::before {
            left: 20px;
        }
        
        .timeline-item {
            width: 100%;
            left: 0 !important;
            margin-left: 40px;
        }
        
        .history-header {
            height: 300px;
            padding: 40px 20px;
        }
        
        .timeline-img {
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .timeline-img {
            height: 120px;
        }
        
        .history-header {
            height: 250px;
        }
    }
</style>

<div class="history-header">
    <h1>Historia de Lamborghini</h1>
    <p>De tractores a superdeportivos: 60 años de pasión italiana</p>
</div>

<div class="history-container">
    <div class="milestone-card">
        <h2>Fundación</h2>
        <p>Ferruccio Lamborghini establece la compañía en 1963 en Sant'Agata Bolognese, Italia</p>
    </div>

    <div class="timeline">
        <div class="timeline-item left">
            <img src="imagenes/350gt2.jpg" 
                 class="timeline-img" 
                 alt="350 GT"
                 loading="lazy"
                 width="800"
                 height="450">
            <div class="timeline-year">1964</div>
            <h3>Primer automóvil: 350 GT</h3>
            <p>Motor V12 de 3.5L diseñado por Giotto Bizzarrini</p>
        </div>

        <div class="timeline-item right">
            <img src="imagenes/miura.jpg" 
                 class="timeline-img" 
                 alt="Miura"
                 loading="lazy"
                 width="800"
                 height="500">
            <div class="timeline-year">1966</div>
            <h3>Lanzamiento del Miura</h3>
            <p>Primer superdeportivo con motor central-trasero</p>
        </div>

        <div class="timeline-item left">
            <img src="imagenes/co.jpg" 
                 class="timeline-img" 
                 alt="Countach"
                 loading="lazy"
                 width="900"
                 height="600">
            <div class="timeline-year">1974</div>
            <h3>Countach LP400</h3>
            <p>Diseño revolucionario de Marcello Gandini</p>
        </div>

        <div class="timeline-item right">
            <img src="imagenes/D2.jpg" 
                 class="timeline-img" 
                 alt="Diablo"
                 loading="lazy"
                 width="800"
                 height="500">
            <div class="timeline-year">1990</div>
            <h3>Era del Diablo</h3>
            <p>Primer Lamborghini en superar 320 km/h</p>
        </div>

        <div class="timeline-item left">
            <img src="imagenes/LA.jpg" 
                 class="timeline-img" 
                 alt="Audi Era"
                 loading="lazy"
                 width="800"
                 height="500">
            <div class="timeline-year">1998</div>
            <h3>Adquisición por Audi</h3>
            <p>Nueva era de desarrollo tecnológico</p>
        </div>
    </div>

    <div class="quote">
        "Los automóviles son mi vida. Un buen tractor es importante, pero un automóvil es algo especial."<br>
        - Ferruccio Lamborghini
    </div>

    <div class="milestone-card">
        <h2>Datos Históricos</h2>
        <div class="spec-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); margin-top: 20px;">
            <div class="spec-item">
                <strong>Primer modelo</strong>
                <span>350 GT (1964)</span>
            </div>
            <div class="spec-item">
                <strong>Modelo más vendido</strong>
                <span>Huracán (20,000+ unidades)</span>
            </div>
            <div class="spec-item">
                <strong>Modelo más rápido</strong>
                <span>Aventador SVJ (350 km/h)</span>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>