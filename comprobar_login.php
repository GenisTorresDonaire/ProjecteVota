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

	$nombre = $_POST['loginNombre'];
	$contraseña = $_POST['loginPassword'];

	//preparem i executem la consulta
	$query = $pdo->prepare("select * from usuarios where nombre='".$nombre."';");
	$query->execute();

	//anem agafant les fileres d'amb una amb una
	$row = $query->fetch();

	if ($row['password'] == $contraseña){
		while ( $row ) {
			echo $row['id_usuario'];
		    echo $row['nombre'];
		    echo $row['apellido'];
		    echo $row['password'];
			echo $row['email'];
		    $row = $query->fetch();
		}
	}else{
		header('Location: inicio.php');
	}
	

	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query)


?>