
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Seguro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Codigo de verificacion</h2>
        <form id="loginForm">
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
            <div class="form-group">
                <label for="codeToken">Ingresa el codigo de verificacion:</label>
                <input type="text" class="form-control" id="codeToken" name="codeToken" required>
            </div>
            
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Lel0zIqAAAAAJ4Lj8KIxWUQOCKG1Y-ga7nrgD9y"></div>
            </div>
            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
        </form>
        <br><br>
        <a href="registro.php">Registrarse</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.all.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/script.js"></script>
</body>
</html>
