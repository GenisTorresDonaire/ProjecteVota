<?php
	try {
	    $hostname = "localhost";
	    $dbname = "ProjecteVotaCopia";
	    $username = "root";
	    $pw = "mysql1234";
	    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	} catch (PDOException $e) {
	    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	    exit;
	}

	// CORREOS PARA INVITAR
	$arrayInvitados = explode("\n",$_POST['correo']);
	$consultaInvitado = $_POST['consulta'];

	for ($x = 0; $x < sizeof($arrayInvitados); $x++){
		$rand_part = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());
		$correoSinEspacio = trim($arrayInvitados[$x]);

		// PARTE DE ENVIAR EMAIL DE REGISTRO O ALERTA DE INVITACION
		$query = $pdo->prepare("select * from usuarios where email='".$correoSinEspacio."';");
                $query->execute();
		$row = $query->fetch();


		if (empty($row)){
			// INSERTAR USUARIO EN LA BBDD SI NO EXISTE
			$query1 = $pdo->prepare("insert into usuarios (password, email, Admin, token) values ('".$rand_part."','".$correoSinEspacio."',0,'".$rand_part."');");
	                $query1->execute();

			$query2 = $pdo->prepare("select * from usuarios where email='".$correoSinEspacio."';");
	                $query2->execute();
        	        $row2 = $query2->fetch();

			if( $row2 ){
				// INSERTANDO LA INVITACION
				$query = $pdo->prepare("insert into invitaciones (id_usuario, id_consulta) values ('".$row['id_usuario']."','".$consultaInvitado."');");
                	        $query->execute();
			}

			// ENVIAR EMAIL
			$destino   = $arrayInvitados[$x];
			$titulo    = "INVITACION AL PROJECTEVOTA!";
			$mensaje   = "genis.tk/ProjecteVota/registrarse.php?token=".$rand_part;
			mail($destino, $titulo, $mensaje);
		}
		else{
			$query1 = $pdo->prepare("SELECT u.id_usuario, c.id_consulta FROM usuarios u, invitaciones i, consulta c WHERE u.id_usuario=i.id_usuario and c.id_consulta=i.id_consulta and u.email='".$correoSinEspacio."'");
                        $query1->execute();
                        $row1 = $query1->fetch();

			//if( !$row ){
			//$query2 = $pdo->prepare("select id_usuario from usuarios where email='".$correoSinEspacio."'");
	                //$query2->execute();
			//$row2 = $query2->fetch();

			while($row1){
				// INVITACION
				//echo "insert into invitaciones (id_usuario, id_consulta) values (".$row['id_usuario'].",".$consultaInvitado.");";
                       		$query3 = $pdo->prepare("insert into invitaciones (id_usuario, id_consulta) values (".$row['id_usuario'].",".$consultaInvitado.");");
                        	$query3->execute();
				$row1 = $query3->fetch();
			}

			// ENVIAR EMAIL
                        $destino   = $arrayInvitados[$x];
                        $titulo    = "TE HAN INVITADO A UNA NUEVA CONSULTA!!";
                        $mensaje   = "Loggeate y vota!! genis.tk/ProjecteVota/inicio.php";
                        mail($destino, $titulo, $mensaje);
		}
	}
	header('Location: invitarConsulta.php');
?>
