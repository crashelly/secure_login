
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
        <h2 class="text-center">validacion codigo de verificacion</h2>
        <form id="loginForm" method="POST" action="../php/controller/checkCode.php">
            <div class="form-group">
                <label for="tokenCode">Ingresa el codigo de verificacion:</label>
                <input type="text" class="form-control" id="tokenCode" name="tokenCode" required>
                <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>">
            </div>
            
            <button type="submit" class="btn btn-success">Validar</button>
        </form>
        <br><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.all.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
