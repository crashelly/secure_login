<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <form action="" method="post">
            <label for="usuario">Nombre:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="email">Para:</label>
            <input type="email" name="email" required>

            <label for="asunto">Asunto:</label>
            <input type="text" id="asunto" name="asunto" required>

            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensaje"></textarea>

            <button type="submit" name="enviar">Enviar</button>
        </form>
    <?php
    include("correo.php");
    ?>
</body>
</html>
