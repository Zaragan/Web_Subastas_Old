<?php
include('assets/php/funciones.php');
include('Subasta.php');
$newSubasta = new Subasta();
if(isset($_POST['SubmitButton'])){
    $newSubasta->crearSubasta();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/reset.css">
	<link rel="stylesheet" href="assets/main copy.css">
    <title>Crear subasta</title>
</head>
<body>
    <div class="header">
        <?php menu(); ?>
    </div>
    <div class="page">
        <form method="POST" id="envio">
            <div><label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required></div>
            <div><label for="precio">Precio:</label>
            <input type="text" name="precio" required></div>
            <div><label for="tiempo">Tiempo:</label>
            <input type="radio" name="time" value="1day">
            <label for="time">1 día</label>
            <input type="radio" name="time" value="1week">
            <label for="time">1 semana</label>
            <input type="radio" name="time" value="1month">
            <label for="time">1 mes</label></div>
            <input type="submit" value="Enviar" name="SubmitButton" class="btn">
        </form>
    </div>
</body>
</html>