<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "banco");
    
if(!$conn){
	die("Falha na conexao: " . mysqli_connect_error());
}

if(empty($_POST['login']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}

$login = mysqli_real_escape_string($conn, $_POST['login']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);

$query = "select login from usuarios where login = '{$login}' and senha ='{$senha}'";
$result = mysqli_query($conn, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['login'] = $login;
	header('Location: painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}