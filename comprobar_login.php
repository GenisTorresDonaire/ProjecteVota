<?php
	session_start();

	try {
	    $hostname = "localhost";
	    $dbname = "ProjecteVota";
	    $username = "root";
	    $pw = "mysql1234";
	    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	} catch (PDOException $e) {
	    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	    exit;
	}

	$nombre = $_POST['loginNombre'];
	$contraseña = $_POST['loginPassword'];

	$query = $pdo->prepare("select * from usuarios where nombre='".$nombre."';");
	$query->execute();

	$row = $query->fetch();
	if ($row['password'] == $contraseña){
		$_SESSION['estado'] = "Autenticado";
		$autenticado = $_SESSION['estado'];
		$_SESSION['nombre'] = $nombre;
		header('Location: consultes.php');
	}else{
		header('Location: inicio.php');
	}

	unset($pdo); 
	unset($query)
?>