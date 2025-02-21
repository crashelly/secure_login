
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Recuperar contraseña</h2>
        <form id="" method="post" action="php/controller/sendEmail.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <!-- <div class="form-group">
                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">Ver</button>
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Lel0zIqAAAAAJ4Lj8KIxWUQOCKG1Y-ga7nrgD9y"></div>
            </div>
            <button type="submit" class="">Recuperar</button>
        </form>
        <br><br>
        <a href="registro.php">Registrarse</a>
        <a href="recovery.php">Se te olvido la contraseña?</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.all.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/script.js"></script>
</body>
</html>