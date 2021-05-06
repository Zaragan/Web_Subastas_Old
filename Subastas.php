<?php
include('assets/php/funciones.php');
include('subasta.php');

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
            <?php if(isset($_GET['ID'])){$subasta = new Subasta(); $subasta->sacarDatos();}else{echo "No hay subasta seleccionada";}?>
    </div>
</body>
</html>