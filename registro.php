<?php
session_start();

// Generar un token CSRF si no existe uno en la sesión
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Registro de Usuario</h2>
        <form id="registerForm" action="php/controller/register_user.php" method="POST">
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <label for="registerUsername">Usuario:</label>
                <input type="text" class="form-control" id="registerUsername" name="registerUsername" autocomplete="false" required>
            </div>
            <div class="form-group">
                <label for="registerEmail">Email:</label>
                <input type="email" class="form-control" id="registerEmail" name="registerEmail" required>
            </div>
            <div class="form-group">
                <label for="registerPassword">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="registerPassword" name="registerPassword" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordRegister">Ver</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="generatePassword">Generar Contraseña Fuerte</button>
            </div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Lel0zIqAAAAAJ4Lj8KIxWUQOCKG1Y-ga7nrgD9y"></div>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <br><br>
        <a href="index.php">Iniciar Sesión</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.all.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="script.js"></script>
</body>
</html>