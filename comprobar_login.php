<?php
	
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

	$nombre = $_POST['loginNombre'];
	$contraseña = $_POST['loginPassword'];

	//preparem i executem la consulta
	$query = $pdo->prepare("select * from usuarios where nombre='".$nombre."';");
	$query->execute();

	//anem agafant les fileres d'amb una amb una
	$row = $query->fetch();

	if ($row['password'] == $contraseña){
		header('Location: consultes.php');
	}else{
		header('Location: inicio.php');
	}
	

	//eliminem els objectes per alliberar memòria 
	unset($pdo); 
	unset($query)


?>