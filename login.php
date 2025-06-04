<?php
session_start();
include 'header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        /* Paleta de colores mejorada */
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #9b59b6;
            --accent: #2ecc71;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --danger: #e74c3c;
            --background-start: #1a1a2e;
            --background-mid: #16213e;
            --background-end: #0f3460;
            --purple: #8e44ad;
            --orange: #e67e22;
            --pink: #e84393;
            --cyan: #00cec9;
        }
        
        /* Animaciones personalizadas */
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.2); opacity: 0.8; }
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes colorChange {
            0% { background-color: var(--background-start); }
            25% { background-color: var(--purple); }
            50% { background-color: var(--background-mid); }
            75% { background-color: var(--pink); }
            100% { background-color: var(--background-start); }
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(-45deg, var(--background-start), var(--background-mid), var(--background-end), var(--background-start));
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }
        
        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 0;
        }
        
        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 2;
        }
        
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            animation: slideIn 0.6s ease-out;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(52, 152, 219, 0.1), transparent);
            transform: rotate(45deg);
            z-index: 0;
            animation: shine 6s infinite linear;
        }
        
        @keyframes shine {
            0% { transform: rotate(45deg) translateX(-50%); }
            100% { transform: rotate(45deg) translateX(50%); }
        }
        
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            color: var(--dark);
            position: relative;
            z-index: 1;
        }
        
        h2::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--primary);
            margin: 10px auto;
            animation: lineExpand 0.5s ease-out;
        }
        
        @keyframes lineExpand {
            from { width: 0; }
            to { width: 50px; }
        }
        
        .input-group {
            position: relative;
            margin: 20px 0;
            z-index: 1;
        }
        
        input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            margin: 10px 0;
            border: 2px solid var(--light);
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 1em;
            background-color: rgba(236, 240, 241, 0.5);
        }
        
        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(52, 152, 219, 0.2);
            outline: none;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark);
            font-size: 1.2em;
        }
        
        .button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1em;
            font-weight: 600;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--secondary), var(--primary));
            transition: all 0.5s ease;
            z-index: -1;
        }
        
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .button:hover::before {
            left: 0;
        }
        
        .error-message {
            color: var(--danger);
            text-align: center;
            animation: shake 0.4s ease;
            padding: 10px;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        
        .additional-links {
            text-align: center;
            margin-top: 25px;
            z-index: 1;
            position: relative;
        }
        
        .additional-links a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0 10px;
            font-weight: 500;
            position: relative;
        }
        
        .additional-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }
        
        .additional-links a:hover::after {
            width: 100%;
        }
        
        .additional-links a:hover {
            color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        /* Elementos decorativos */
        .decoration {
            position: absolute;
            z-index: 1;
            opacity: 0.7;
            animation-timing-function: ease-in-out;
            pointer-events: none;
        }
        
        .decoration.circle {
            border-radius: 50%;
        }
        
        .decoration.square {
            border-radius: 5px;
        }
        
        .decoration.triangle {
            width: 0;
            height: 0;
            border-style: solid;
        }
        
        /* Posiciones y animaciones específicas */
        .dec-1 {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 15%;
            background: linear-gradient(45deg, var(--primary), transparent);
            animation: float 8s infinite;
        }
        
        .dec-2 {
            width: 120px;
            height: 120px;
            bottom: 20%;
            right: 10%;
            background: linear-gradient(45deg, var(--orange), transparent);
            animation: float 10s infinite 2s;
        }
        
        .dec-3 {
            width: 60px;
            height: 60px;
            top: 40%;
            left: 5%;
            background: linear-gradient(45deg, var(--cyan), transparent);
            animation: float 7s infinite 1s;
        }
        
        .dec-4 {
            width: 100px;
            height: 100px;
            bottom: 10%;
            left: 20%;
            background: linear-gradient(45deg, var(--pink), transparent);
            animation: float 9s infinite 3s;
        }
        
        .dec-5 {
            width: 70px;
            height: 70px;
            top: 15%;
            right: 20%;
            background: linear-gradient(45deg, var(--purple), transparent);
            animation: float 11s infinite 0.5s;
        }
        
        .dec-6 {
            width: 90px;
            height: 90px;
            bottom: 30%;
            right: 5%;
            background: linear-gradient(45deg, var(--accent), transparent);
            animation: float 8s infinite 1.5s;
        }
        
        .dec-7 {
            width: 50px;
            height: 50px;
            top: 60%;
            left: 25%;
            background: linear-gradient(45deg, var(--secondary), transparent);
            animation: pulse 4s infinite;
        }
        
        .dec-8 {
            width: 110px;
            height: 110px;
            top: 25%;
            right: 25%;
            background: linear-gradient(45deg, var(--danger), transparent);
            animation: rotate 20s infinite linear;
        }
        
        .dec-9 {
            width: 85px;
            height: 85px;
            bottom: 45%;
            left: 12%;
            background: linear-gradient(45deg, var(--cyan), transparent);
            animation: float 7s infinite 2.5s;
        }
        
        .dec-10 {
            width: 65px;
            height: 65px;
            top: 75%;
            right: 18%;
            background: linear-gradient(45deg, var(--orange), transparent);
            animation: float 9s infinite 1.8s;
        }
        
        .tri-1 {
            border-width: 0 40px 69.3px 40px;
            border-color: transparent transparent rgba(155, 89, 182, 0.6) transparent;
            top: 20%;
            left: 10%;
            animation: float 9s infinite 0.7s;
        }
        
        .tri-2 {
            border-width: 0 60px 103.9px 60px;
            border-color: transparent transparent rgba(46, 204, 113, 0.5) transparent;
            bottom: 15%;
            right: 15%;
            animation: float 11s infinite 2.5s;
            transform: rotate(45deg);
        }
        
        .tri-3 {
            border-width: 0 30px 51.96px 30px;
            border-color: transparent transparent rgba(52, 152, 219, 0.5) transparent;
            top: 70%;
            right: 25%;
            animation: float 7s infinite 1.2s;
            transform: rotate(70deg);
        }
        
        .tri-4 {
            border-width: 69.3px 40px 0 40px;
            border-color: rgba(231, 76, 60, 0.4) transparent transparent transparent;
            top: 45%;
            left: 30%;
            animation: float 8s infinite 3s;
        }
        
        .tri-5 {
            border-width: 40px 0 69.3px 40px;
            border-color: transparent transparent rgba(142, 68, 173, 0.5) transparent;
            top: 65%;
            left: 8%;
            animation: float 10s infinite 1.3s;
        }
        
        .tri-6 {
            border-width: 0 50px 86.6px 50px;
            border-color: transparent transparent rgba(230, 126, 34, 0.5) transparent;
            top: 25%;
            right: 8%;
            animation: float 8s infinite 0.9s;
            transform: rotate(30deg);
        }
        
        .sq-1 {
            width: 70px;
            height: 70px;
            top: 35%;
            left: 15%;
            background: linear-gradient(135deg, var(--accent), transparent);
            animation: float 8s infinite 2s;
        }
        
        .sq-2 {
            width: 90px;
            height: 90px;
            bottom: 25%;
            right: 20%;
            background: linear-gradient(135deg, var(--pink), transparent);
            animation: float 10s infinite 1s;
        }
        
        .sq-3 {
            width: 50px;
            height: 50px;
            top: 50%;
            right: 10%;
            background: linear-gradient(135deg, var(--orange), transparent);
            animation: float 7s infinite 0.5s;
        }
        
        .sq-4 {
            width: 110px;
            height: 110px;
            top: 10%;
            left: 30%;
            background: linear-gradient(135deg, var(--purple), transparent);
            animation: float 12s infinite 3s;
        }
        
        .sq-5 {
            width: 80px;
            height: 80px;
            bottom: 40%;
            left: 5%;
            background: linear-gradient(135deg, var(--cyan), transparent);
            animation: pulse 5s infinite;
        }
        
        .sq-6 {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            background: linear-gradient(135deg, var(--danger), transparent);
            animation: float 9s infinite 2.2s;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
            z-index: 1;
        }
        
        .logo {
            font-size: 2.5em;
            font-weight: bold;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            margin-bottom: 10px;
        }
        
        .tagline {
            color: var(--dark);
            font-size: 1.1em;
            margin-top: -10px;
            font-style: italic;
        }
        
        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 2em;
            }
            
            .decoration {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="background-overlay"></div>
    
    <!-- Elementos decorativos - Círculos -->
    <div class="decoration circle dec-1"></div>
    <div class="decoration circle dec-2"></div>
    <div class="decoration circle dec-3"></div>
    <div class="decoration circle dec-4"></div>
    <div class="decoration circle dec-5"></div>
    <div class="decoration circle dec-6"></div>
    <div class="decoration circle dec-7"></div>
    <div class="decoration circle dec-8"></div>
    <div class="decoration circle dec-9"></div>
    <div class="decoration circle dec-10"></div>
    
    <!-- Elementos decorativos - Triángulos -->
    <div class="decoration triangle tri-1"></div>
    <div class="decoration triangle tri-2"></div>
    <div class="decoration triangle tri-3"></div>
    <div class="decoration triangle tri-4"></div>
    <div class="decoration triangle tri-5"></div>
    <div class="decoration triangle tri-6"></div>
    
    <!-- Elementos decorativos - Cuadrados -->
    <div class="decoration square sq-1"></div>
    <div class="decoration square sq-2"></div>
    <div class="decoration square sq-3"></div>
    <div class="decoration square sq-4"></div>
    <div class="decoration square sq-5"></div>
    <div class="decoration square sq-6"></div>
    
    <div class="login-wrapper">
        <div class="form-container">
            <div class="logo-container">
                <div class="logo">QuantumLogin</div>
                <div class="tagline">Tu portal seguro</div>
            </div>
            <h2>Iniciar Sesión</h2>
            <?php if(isset($error)) echo "<p class='error-message'>$error</p>"; ?>
            <form method="post">
                <div class="input-group">
                    <span class="input-icon">👤</span>
                    <input type="text" name="username" placeholder="Nombre de usuario" required>
                </div>
                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="button">Ingresar</button>
            </form>
            <div class="additional-links">
                <a href="forgot_password.php">¿Olvidaste tu contraseña?</a>
                <a href="register.php">Registrarse</a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>