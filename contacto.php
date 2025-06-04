<?php
session_start();
include 'header.php';

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Procesar el formulario cuando se envía
$formSubmitted = false;
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simular el procesamiento del formulario (en un caso real, aquí se enviaría el correo)
    sleep(1); // Simular tiempo de procesamiento
    
    // Validar los datos (en un caso real se haría una validación más robusta)
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $formSubmitted = true;
        $successMessage = '¡Mensaje enviado con éxito! El equipo de Lamborghini Club se pondrá en contacto contigo pronto.';
    } else {
        $errorMessage = 'Por favor completa todos los campos requeridos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Lamborghini Club</title>
    <style>
        :root {
            --lamborghini-yellow: #FFD800;
            --lamborghini-black: #000000;
            --lamborghini-gray: #1A1A1A;
            --lamborghini-light-gray: #F0F0F0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', 'Arial', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 40px;
            color: var(--lamborghini-gray);
            position: relative;
            padding-bottom: 15px;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--lamborghini-yellow);
        }
        
        .contact-section {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 20px;
        }
        
        .contact-info {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .contact-form-container {
            flex: 1;
            min-width: 300px;
        }
        
        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        
        .info-icon {
            background: var(--lamborghini-yellow);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .info-content h3 {
            margin-bottom: 5px;
            color: var(--lamborghini-gray);
        }
        
        .info-content p {
            color: #666;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--lamborghini-gray);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--lamborghini-yellow);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 216, 0, 0.2);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .btn {
            display: inline-block;
            background: var(--lamborghini-yellow);
            color: var(--lamborghini-black);
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn:hover {
            background: #e6c200;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .map-container {
            margin-top: 40px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .map-container iframe {
            width: 100%;
            height: 300px;
            border: none;
        }
        
        .message-container {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .form-header h3 {
            color: var(--lamborghini-gray);
            margin-bottom: 10px;
        }
        
        .form-header p {
            color: #666;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
            vertical-align: middle;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .contact-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h1 class="page-title">Contacto Lamborghini Club</h1>
        
        <div class="contact-section">
            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon">
                        <i>📞</i>
                    </div>
                    <div class="info-content">
                        <h3>Teléfono</h3>
                        <p>+52 712 229 0160</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i>📍</i>
                    </div>
                    <div class="info-content">
                        <h3>Dirección</h3>
                        <p>Via Modena, 12, 40019 Sant'Agata Bolognese BO, Italia</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i>⏰</i>
                    </div>
                    <div class="info-content">
                        <h3>Horario de Atención</h3>
                        <p>Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                        <p>Sábados: 10:00 AM - 4:00 PM</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i>✉</i>
                    </div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>info@lamborghiniclub.com</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-container">
                <div class="contact-form">
                    <div class="form-header">
                        <h3>Envíanos un Mensaje</h3>
                        <p>Estamos aquí para responder cualquier pregunta que tengas</p>
                    </div>
                    
                    <?php if ($formSubmitted && $successMessage): ?>
                        <div class="message-container success-message">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php elseif ($errorMessage): ?>
                        <div class="message-container error-message">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form id="contactForm" method="post" action="contacto.php">
                        <div class="form-group">
                            <label for="name">Nombre completo *</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Tu nombre" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Correo electrónico *</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="tu@email.com" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Teléfono (opcional)</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Tu número de teléfono">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Asunto</label>
                            <select id="subject" name="subject" class="form-control">
                                <option value="">Selecciona un asunto</option>
                                <option value="events">Eventos</option>                                
                                <option value="testdrive">Solicitud de Prueba de Manejo</option>
                                <option value="support">Soporte Técnico</option>
                                <option value="other">Otro</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mensaje *</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Tu mensaje..." required></textarea>
                        </div>
                        
                        <button type="submit" id="submitBtn" class="btn">
                            <span id="submitText">Enviar Mensaje</span>
                            <span id="submitLoader" class="loading" style="display:none;"></span>
                        </button>
                    </form>
                    
                    <div class="form-footer">
                        <p>* Campos obligatorios</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11377.677665200497!2d11.1205583!3d44.658956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477fc3c2b9c86a6f%3A0x6d1a73b88d804db1!2sAutomobili%20Lamborghini%20S.p.A.!5e0!3m2!1ses!2smx!4v1654800000000!5m2!1ses!2smx" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoader = document.getElementById('submitLoader');
            
            // Validar formulario antes de enviar
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            
            if (!name || !email || !message) {
                return; // La validación HTML5 debería manejar esto
            }
            
            // Mostrar estado de carga
            submitBtn.disabled = true;
            submitText.textContent = 'Enviando...';
            submitLoader.style.display = 'inline-block';
        });
    </script>
</body>
</html>

<?php include 'footer.php'; ?>