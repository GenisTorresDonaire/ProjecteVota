<?php
	session_start();

	try {
	    $hostname = "localhost";
	    $dbname = "ProjecteVota";
	    $username = "root";
	    $pw = "P@ssw0rd";
	    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	} catch (PDOException $e) {
	    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	    exit;
	}

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$correo = $_POST['correo'];
	$passwordNueva = $_POST['passwordNueva'];
	$passwordNuevaRepetida = $_POST['passwordNuevaRepetida'];
	$token = $_POST['token'];


	$query = $pdo->prepare("select * from usuarios where email='".$correo."' and token='".$token."';");
	$query->execute();
	$row = $query->fetch();

	while($row){
		if ($row['token'] == $token and $row['email'] == $correo){
			if ($passwordNueva == $passwordNuevaRepetida){
               			$query = $pdo->prepare("UPDATE usuarios SET nombre='".$nombre."', apellido='".$apellido."', email='".$correo."', password=SHA2('".$passwordNueva."', 256),token='' WHERE token='".$token."' and email='".$correo."';");
               			$query->execute();

               			header('Location: inicio.php');
        		}
		}
	}
?>
