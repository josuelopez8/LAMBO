<?php
session_start();
include 'header.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<style>
    .configurator {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 20px;
    }

    .config-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .config-option {
        border: 1px solid #eee;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .color-preview {
        width: 100px;
        height: 100px;
        margin: 10px auto;
        border-radius: 50%;
    }

    .preview-image {
        max-width: 100%;
        height: 300px;
        object-fit: contain;
    }
</style>

<div class="configurator">
    <h2>Personaliza tu Lamborghini</h2>
    
    <div class="config-steps">
        <div class="config-option">
            <h3>Color Exterior</h3>
            <select id="colorSelect">
                <option value="#FF0000">Rosso Mars (Rojo)</option>
                <option value="#000000">Nero Noctis (Negro)</option>
                <option value="#FFFF00">Giallo Inti (Amarillo)</option>
            </select>
            <div class="color-preview" id="colorPreview"></div>
        </div>

        <div class="config-option">
            <h3>Rines</h3>
            <div class="rim-options">
                <img src="images/rims/design1.jpg" class="preview-image">
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('colorSelect').addEventListener('change', function() {
    document.getElementById('colorPreview').style.backgroundColor = this.value;
});
</script>

<?php include 'footer.php'; ?>