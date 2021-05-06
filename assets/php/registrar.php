<?php
include('db.php');
$usuario = strip_tags(addslashes($_POST['r_username']));
$password = strip_tags(addslashes($_POST['r_password']));
$hashpass = password_hash($password, PASSWORD_ARGON2ID); 

$dbCall = new Database();
$users = $dbCall->setQuery("SELECT email FROM subastausers");
if ($users->num_rows > 0) {
    $mun = false;
    while ($fila = $users->fetch_assoc()) {
        if ($fila['email']==$usuario) {
            $mun = true;
            header('Location: ../../registro.php?mensaje=en_uso');
            break;
        }       
    }
    if ($mun == false) {
        $dbCall->setQuery("INSERT INTO `subastausers`(email, password) VALUES ('$usuario','$hashpass')");
        header('Location: ../../index.php?mensaje=inicia');
    }
}

?>