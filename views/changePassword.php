<?php include '../db.php'; include '../php/class/user.php';
$user = new ProgramUser($pdo, $_GET['email']);
if (!$user->checkBooleanCheckedCode()) {+
    $user->alerta("UPS...");
    $user->redirect("../index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Seguro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Cambia tu contraseña</h2>
        <form id="loginForm" method="POST" action="../php/controller/changePassword.php">

            <div class="form-group">
                <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">

                <label for="codeToken">Ingresa la nueva contraseña:</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Lel0zIqAAAAAJ4Lj8KIxWUQOCKG1Y-ga7nrgD9y"></div>
            </div>
            <button type="submit" class="btn btn-success">Cambiar contraseña</button>
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