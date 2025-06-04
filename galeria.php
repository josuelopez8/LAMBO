<?php
session_start();
include 'header.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<style>
    .gallery-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 20px;
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
    }

    .media-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        transition: transform 0.3s;
        margin-bottom: 20px;
    }

    .media-item .video-wrapper {
        margin-top: 15px;
    }

    .media-item img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        margin-bottom: 15px;
    }

    .video-wrapper {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
    }

    .video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: nome;
    }
</style>

<div class="gallery-container">
    <h2>Galería Multimedia</h2>
    
    <div class="media-grid">
        <div class="media-item">
            <img src="imagenes/s.jpg" loading="lazy">
        </div>
        <div class="media-item">
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/dFQ5U0YzzDo" allowfullscreen></iframe>
            </div>
        </div>
        <!-- Agregar más elementos -->
    </div>
</div>
<div class="media-grid">
        <div class="media-item">
            <img src="imagenes/HP.jpg" loading="lazy">
        </div>
        <div class="media-item">
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/-Kh9SGVn9vQ" allowfullscreen></iframe>
            </div>
        </div>
        <!-- Agregar más elementos -->
    </div>
</div>
<div class="media-grid">
        <div class="media-item">
            <img src="imagenes/R2.jpg" loading="lazy">
        </div>
        <div class="media-item">
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/jvBlxjQdmwE" allowfullscreen></iframe>
            </div>
        </div>

<?php include 'footer.php'; ?>