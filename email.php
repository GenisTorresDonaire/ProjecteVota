<?php
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

	// CORREOS PARA INVITAR
	$arrayInvitados = explode("\n", $_POST['correo']);

	for ($x = 0; $x < sizeof($arrayInvitados); $x++){
		$rand_part = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());

	// INSERTAR EN LA BBDD
	$query = $pdo->prepare("insert into usuarios (password, email, Admin, token) values ('".$rand_part."','".$arrayInvitados[$x]."',0,'".$rand_part."');");
	$query->execute();

	echo $rand_part;
	echo $arrayInvitados[$x];

	// ENVIAR EMAIL
		$destino   = $arrayInvitados[$x];
		$titulo    = "INVITACION AL PROJECTEVOTA!";
		$mensaje   = $rand_part;

		echo $arrayInvitados[$x];
		echo $rand_part;

		mail($destino, $titulo, $mensaje);
	}
?>
