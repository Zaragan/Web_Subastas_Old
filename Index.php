<?php
include('assets/php/funciones.php');
$log_error = "";
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_error')){$log_error = "Su usuario o contraseña son incorrectos";}
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='gracias')){$log_error = "Gracias por utilizar nuestra web";}
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='sin_permiso')){$log_error = "No tienes permiso para acceder a esta URL";}
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='inicia')){$log_error = "Registrado. Identificate ahora.";}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/reset.css">
	<link rel="stylesheet" href="assets/main copy.css">
    <title>Bienvenido</title>
</head>
<body>
    <div class="header">
        <?php menu(); ?>
    </div>
    <div class="page">
        <?php if (isset($_SESSION['level'])) { ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Precio Salida</th>
                <th>Precio Actual</th>
            </tr>
            <?php page(); ?>
        </table>
        <?php } ?>
        
    </div>
    <p style="width:100%"><?php echo $log_error ?></p>
	
    

</body>
</html>