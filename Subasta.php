<?php
include("assets/php/db.php");
class Subasta {
    private $nombre, $fecha, $fecha_fin, $caducada, $precio_salida, $precio_actual, $puja, $subastas;

    public function crearSubasta() {
        $nombre = strip_tags(addslashes($_POST['nombre']));
        $fecha = strip_tags(addslashes($_POST['time']));
        $precio_salida = strip_tags(addslashes($_POST['precio']));
        $unixTime = time();
        switch ($fecha) {
            case '1day':
                $setTime = 86400;
                $fecha_fin = $unixTime+$setTime;
                break;
            case '1week':
                $setTime = 604800;
                $fecha_fin = $unixTime+$setTime;
                break;
            case '1month':
                $setTime = 18144000;
                $fecha_fin = $unixTime+$setTime;
                break;
        }
        $dbCall = new Database(); 
        $getSubastas = $dbCall->setQuery("SELECT subastas FROM subastausers WHERE email=$_SESSION[email]");
        $fila = mysqli_fetch_assoc($getSubastas);
        $fila['subastas']++;
        $dbCall->setQuery("INSERT INTO `subastas`(nombre, fecha, fecha_fin, precio_salida, precio_actual) VALUES ('$nombre','$unixTime','$fecha_fin','$precio_salida','$precio_salida')");
        $dbCall->setQuery("UPDATE `subastausers` SET `subastas`=$fila[subastas] WHERE email=$_SESSION[email]");
    }

    public function sacarDatos() {
        $dbCall = new Database();
        $datos = $dbCall->setQuery("SELECT * from subastas WHERE id=$_GET[ID]");
		while($fila = mysqli_fetch_assoc($datos)) {
            $fecha_creada = date("d m Y - G:i",$fila['fecha']);
            $fecha_final = date("d m Y - G:i",$fila['fecha_fin']);
            echo '<table><tr><th>Nombre</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Precio Salida</th><th>Precio Actual</th></tr><tr>';
            echo '<td>'. $fila['nombre'] . '</td>';
            echo '<td>' . $fecha_creada . '</td>';
            echo '<td>' . $fecha_final . '</td>';
            echo '<td>' . $fila['precio_salida'] . '</td>';
            echo '<td>' . $fila['precio_actual'] . '</td></tr></table>';
            echo '<form method="POST" class="usuario" style="margin-top: 50px;">
                    <label for="precio">Pujar: </label>
                    <input type="text" name="puja" id="puja" required><br>
                    <input type="submit" value="Enviar" name="pujar" class="btn subm">
                  </form>';
            echo '<div>Moneda: '.number_format($_SESSION['moneda']).'</div>';
		}
        if(isset($_POST['pujar'])){
            $puja = $_POST["puja"];
            $dbCall = new Database();
            $subastas = $dbCall->setQuery("SELECT * from subastas WHERE id=$_GET[ID]");
            while($fila = mysqli_fetch_assoc($subastas)) {
        
                if($puja <= $fila['precio_actual']) {
                    echo "Haz una puja mayor que el precio actual";
                } else {
                    $dbCall->setQuery("UPDATE `subastas` SET `precio_actual`=$puja");
                    header('Location: Subastas.php?ID='.$fila['id'].'');
                }
            }
            $moneda = $_SESSION['moneda']-$_POST['puja'];
            $dbCall->setQuery("UPDATE `subastausers` SET `moneda`=$moneda WHERE email=$_SESSION[email]");
        }   
	}
}

?>