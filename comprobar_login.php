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

	$query = $pdo->prepare("select * from usuarios where nombre=:nombre and password=SHA2(:password, 256);");
	//$_SESSION['pas'] = SHA2( $_POST['loginPassword'], 256);
	$query->bindParam(":nombre", $_POST['loginNombre']);
	$query->bindParam(":password", $_POST['loginPassword']);
	$query->execute();

	if( $row = $query->fetch() ) {
		$_SESSION['estado'] = "Autenticado";
		$_SESSION['nombre'] = $_POST['loginNombre'];
		$_SESSION['esadmin'] = $row['Admin'];
		$_SESSION['pas'] = $_POST['loginPassword'];
		if( $_SESSION['esadmin'] == '0' ){
			$_SESSION['rol'] = 'Cliente';
			header('Location: consultes.php');
		}
		else if( $_SESSION['esadmin'] == '1' ){
			$_SESSION['rol'] = 'Administrador';
			header('Location: bienvenido.php');
		}
	}else{
		header('Location: inicio.php');
	}

	unset($pdo);
	unset($query);
?>
