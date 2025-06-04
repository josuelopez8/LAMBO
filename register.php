<?php
session_start();
include 'header.php';
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        $error = "Error al registrar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Lamborghini Club</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #1a1a1a;
            overflow-x: hidden;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(-45deg, #b30000, #1a1a1a, #2c3e50);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        /* Destellos de luz */
        .light-flare {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
        }

        .flare {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 70%);
            filter: blur(10px);
            opacity: 0;
            animation: flareAnimation 8s infinite linear;
        }

        .flare:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .flare:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 60%;
            left: 80%;
            animation-delay: 1.5s;
        }

        .flare:nth-child(3) {
            width: 250px;
            height: 250px;
            top: 30%;
            left: 70%;
            animation-delay: 3s;
        }

        .flare:nth-child(4) {
            width: 180px;
            height: 180px;
            top: 80%;
            left: 10%;
            animation-delay: 4.5s;
        }

        .flare:nth-child(5) {
            width: 220px;
            height: 220px;
            top: 40%;
            left: 40%;
            animation-delay: 6s;
        }

        @keyframes flareAnimation {
            0% {
                opacity: 0;
                transform: scale(0.1) rotate(0deg);
            }
            10% {
                opacity: 0.8;
            }
            30% {
                opacity: 0.4;
            }
            50% {
                opacity: 0.9;
                transform: scale(1.2) rotate(180deg);
            }
            70% {
                opacity: 0.3;
            }
            100% {
                opacity: 0;
                transform: scale(0.1) rotate(360deg);
            }
        }

        /* Lamborghini animado */
        .lamborghini {
            position: absolute;
            top: 20px;
            left: -200px;
            font-size: 50px;
            animation: driveIn 8s forwards ease-out;
            z-index: 1;
            opacity: 0.7;
            color: #ffd700;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.7);
        }

        @keyframes driveIn {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(calc(100vw + 200px));
            }
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 50px rgba(179, 0, 0, 0.5), 0 0 100px rgba(255, 215, 0, 0.3);
            width: 100%;
            max-width: 500px;
            transform: translateY(0);
            opacity: 1;
            animation: formEntrance 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            position: relative;
            z-index: 10;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        /* Destello al pasar el ratón sobre el formulario */
        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.2) 0%, transparent 70%);
            opacity: 0;
            z-index: -1;
            transition: opacity 0.5s ease;
        }

        .form-container:hover::before {
            opacity: 1;
        }

        /* Animación de entrada del formulario */
        @keyframes formEntrance {
            0% {
                transform: translateY(50px) scale(0.95);
                opacity: 0;
            }
            100% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        h2 {
            text-align: center;
            color: #ffd700;
            margin-bottom: 30px;
            font-size: 2.2em;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            animation: titlePulse 2s infinite alternate;
        }

        @keyframes titlePulse {
            from { 
                text-shadow: 0 0 5px rgba(255, 215, 0, 0.5); 
            }
            to { 
                text-shadow: 0 0 20px rgba(255, 215, 0, 0.8), 
                             0 0 30px rgba(255, 215, 0, 0.6); 
            }
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .input-group {
            position: relative;
            animation: slideIn 0.6s ease-out forwards;
            opacity: 0;
        }

        /* Animación de entrada secuencial para los campos */
        .input-group:nth-child(1) { animation-delay: 0.2s; }
        .input-group:nth-child(2) { animation-delay: 0.4s; }
        .input-group:nth-child(3) { animation-delay: 0.6s; }

        @keyframes slideIn {
            from {
                transform: translateX(-30px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        input {
            width: 100%;
            padding: 15px 20px 15px 45px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: rgba(0, 0, 0, 0.4);
            color: white;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        input:focus {
            border-color: #ffd700;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            outline: none;
            transform: scale(1.02);
            background-color: rgba(0, 0, 0, 0.6);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
            font-size: 18px;
            transition: all 0.3s ease;
        }

        input:focus + .input-icon {
            color: #ffd700;
            transform: translateY(-50%) scale(1.2);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.7);
        }

        button.button {
            background: linear-gradient(45deg, #b30000, #990000);
            color: white;
            padding: 16px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-top: 15px;
            position: relative;
            overflow: hidden;
            animation: buttonEntrance 0.8s 0.8s forwards;
            opacity: 0;
            transform: translateY(20px);
            z-index: 2;
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        button.button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: 0.5s;
        }

        button.button:hover::before {
            left: 100%;
        }

        @keyframes buttonEntrance {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        button.button:hover {
            background: linear-gradient(45deg, #990000, #800000);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(179, 0, 0, 0.4),
                        0 0 30px rgba(255, 215, 0, 0.4);
        }

        button.button:active {
            transform: translateY(1px);
        }

        /* Efecto de onda al hacer clic */
        .ripple {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transform: scale(0);
            animation: rippleEffect 0.6s linear;
            pointer-events: none;
        }

        @keyframes rippleEffect {
            to {
                transform: scale(3);
                opacity: 0;
            }
        }

        .error-message {
            background: #990000;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            animation: shake 0.6s cubic-bezier(.36,.07,.19,.97) both;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(179, 0, 0, 0.5);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
            20%, 40%, 60%, 80% { transform: translateX(8px); }
        }

        /* Animación para el icono de carga */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 30px;
                border-radius: 10px;
            }
            
            h2 {
                font-size: 1.8em;
            }
            
            input {
                padding: 12px 15px 12px 40px;
            }
            
            .input-icon {
                font-size: 16px;
                left: 12px;
            }
            
            .lamborghini {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- Destellos de luz -->
        <div class="light-flare">
            <div class="flare"></div>
            <div class="flare"></div>
            <div class="flare"></div>
            <div class="flare"></div>
            <div class="flare"></div>
        </div>
        
        <!-- Lamborghini animado -->
        <div class="lamborghini">
            <i class="fas fa-car"></i>
        </div>
        
        <div class="form-container">
            <h2>Únete al Club</h2>
            <?php if(isset($error)) echo "<div class='error-message'>$error</div>"; ?>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Nombre de usuario" required>
                    <i class="fas fa-user input-icon"></i>
                </div>
                
                <div class="input-group">
                    <input type="email" name="email" placeholder="correo@lamborghiniclub.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" placeholder="Contraseña (mínimo 8 caracteres)" required minlength="8">
                    <i class="fas fa-lock input-icon"></i>
                </div>
                
                <button type="submit" class="button">
                    <span class="button-text">Registrarse Ahora</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Efecto ripple en el botón
        document.querySelector('.button').addEventListener('click', function(e) {
            // Crear efecto ripple
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            
            // Posicionamiento
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size/2;
            const y = e.clientY - rect.top - size/2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            this.appendChild(ripple);
            
            // Eliminar después de la animación
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Animación al enviar formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = this.querySelector('button');
            button.innerHTML = '<i class="fas fa-spinner"></i> Registrando...';
            button.style.opacity = '0.8';
            button.disabled = true;
            
            // Crear destello adicional
            const flash = document.createElement('div');
            flash.style.position = 'fixed';
            flash.style.top = '0';
            flash.style.left = '0';
            flash.style.width = '100%';
            flash.style.height = '100%';
            flash.style.background = 'radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%)';
            flash.style.zIndex = '100';
            flash.style.animation = 'flashEffect 0.5s forwards';
            document.body.appendChild(flash);
            
            // Eliminar después de la animación
            setTimeout(() => {
                flash.remove();
            }, 500);
        });
        
        // Crear estilos dinámicos para el efecto flash
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes flashEffect {
                0% { opacity: 0; transform: scale(0.1); }
                50% { opacity: 1; }
                100% { opacity: 0; transform: scale(2); }
            }
        `;
        document.head.appendChild(style);
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>