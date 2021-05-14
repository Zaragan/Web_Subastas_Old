<?php
include('db.php');
$usuario = strip_tags(addslashes($_POST['p_username']));
$password = strip_tags(addslashes($_POST['p_password']));

$dbCall = new Database();
$userlist = $dbCall->setQuery("SELECT * FROM `subastausers` WHERE `email`=$usuario");

$fila = mysqli_fetch_assoc($userlist);
$passok = password_verify($password, $fila['password']);

if($fila['email'] == $usuario && $passok==true) {
	
	session_start();
	$_SESSION['id'] = $fila['id'];
	$_SESSION['email'] = $fila['email'];
	$_SESSION['level'] = $fila['level'];
	$_SESSION['subastas'] = $fila['subastas'];
	$_SESSION['moneda'] = $fila['moneda'];

	header('Location: ../../index.php');

} else {
	header('Location: ../../index.php?mensaje=mensaje_error');
}
?>