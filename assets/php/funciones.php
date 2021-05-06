<?php
session_start();

function menu(){
    if (!isset($_SESSION['level'])) {
        //          DESCONECTADO
        $menu = '<ul>
                    <li><a href="Index.php">Inicio</a></li>
                    <li><a href="registro.php" class="btn">Registro</a></li>
                    <form action="assets/php/identificar.php" method="POST" class="usuario">
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="p_username" id="p_username" required><br>
                        <label for="password">Contraseña:</label>
                        <input type="password" name="p_password" id="p_password" required><br>
                        <input type="submit" value="Identificarse" class="btn subm">
                    </form>
                </ul>';
    } else if ($_SESSION['level'] == 1){
        //          ADMIN ZONE
        $menu = '<ul>
                    <li><a href="Index.php">Inicio</a></li>
                    <li><a href="Subastar.php">Crear subastas</a></li>
                    <li class="usuario"><p>Bienvenido admin '.$_SESSION['email'].'</p><a href="assets/php/desconectar.php">Desconectar</a></li>
                </ul>';
    } else {
        //          USER ZONE
        $menu = '<ul>
                    <li><a href="Index.php">Inicio</a></li>
                    <li><a href="Subastar.php">Crear subastas</a></li>
                    <li class="usuario"><p>Bienvenido '.$_SESSION['email'].'</p><a href="assets/php/desconectar.php">Desconectar</a></li>
                </ul>';
    }
    echo $menu;
}

function page(){
    if (!isset($_SESSION['level'])) {
        //      NO LOGIN
        $page = '<p>Bienvenido. Esta es la página principal para las subastas, identifícate para poder ver la lista de subastas.</p>';
    } else {
        //      LOGGED
        include('assets/php/db.php');
        $dbCall = new Database();
        $users = $dbCall->setQuery("SELECT id,nombre,fecha,fecha_fin,caducada,precio_salida,precio_actual FROM subastas");
        
        if ($users->num_rows > 0) {
            while ($fila = $users->fetch_assoc()) {
                $fecha_creada = date("d m Y - G:i", $fila['fecha']);
                $fecha_fin = date("d m Y - G:i", $fila['fecha_fin']);
                echo '<tr>';
                    echo '<td><a href="Subastas.php?ID=' . $fila['id'] . '">' . $fila['nombre'] . '</a></td>';
                    echo '<td>' . $fecha_creada . '</td>';
                    echo '<td>' . $fecha_fin . '</td>';
                    echo '<td>' . $fila['precio_salida'] . '</td>';
                    echo '<td>' . $fila['precio_actual'] . '</td>';
                echo '</tr>';
            }
        }
    }
}

?>
