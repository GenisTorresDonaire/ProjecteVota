<?php
	session_start();

	if(!isset($_SESSION['nombre']) and $_SESSION['estado'] != 'Autenticado'){
       		header('Location: inicio.php');
       		exit();
    	}

	if(isset($_POST['respuesta'])){
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

		// SELECCION DE ID POR CORREO DE DICHO USUARIO
		$query = $pdo->prepare("select id_usuario from usuarios where nombre='".$_SESSION['nombre']."';");
		$query->execute();
		$row = $query->fetch();

		while ($row){
			// SELECCION DE LA CONSULTA A LA QUE ESTA VOTANDO DEVUELVE SU ID, AL ELEGIR UNA DE SUS OPCIONES
			$query2 = $pdo->prepare("select id_consulta from opciones where id_opciones=".$_POST['respuesta'].";");
                	$query2->execute();
                	$row2 = $query2->fetch();

			while ($row2){
				// SE INSERTA EL VOTO EN LA TABLA VOTOS
				$rand_part = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());
				//echo "insert into votos (id_usuario, id_consulta, hash_e) values (".$row['id_usuario'].",".$row2['id_consulta'].", AES_ENCRYPT('".$rand_part."','".$_SESSION['pas']."'))");
				$query3 = $pdo->prepare("insert into votos (id_usuario, id_consulta, hash_e) values (".$row['id_usuario'].",".$row2['id_consulta'].",AES_ENCRYPT('".$rand_part."','".$_SESSION['pas']."'));");
				$query3->execute();

				//echo "insert into votos_opciones (hash, id_opciones) values ('".$rand_part."',".$_POST['respuesta'].")";
				$query5 = $pdo->prepare("insert into votos_opciones (hash, id_opciones) values ('".$rand_part."',".$_POST['respuesta'].")");
				$query5->execute();

				$query4 = $pdo->prepare("update invitaciones SET votado=1 WHERE id_consulta=".$row2['id_consulta']." and id_usuario=".$row['id_usuario'].";");
                                $query4->execute();
	                        $row2 = $query2->fetch();
			}
			$row = $query->fetch();
		}
		header('Location: consultes.php');
    	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ProjecteVota</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/fontello.css">
		<script type="text/javascript" src="../js/funciones.js"></script>
	</head>
	<body onload="setTimeout(desplegar, 2000);">
		<header>
            <img src="../imagenes/banner.png"/>
        </header>

        <nav class="contenedorMenu">
        	<div class="menuIcono">
	            <ul>
               		<li><label for="btn-menu" onclick="location.href='cerrarsesion.php'"><span class="icon-off"></span></label></li>
                	<li><label><?php echo "Bienvenido ".$_SESSION['rol'].", ".$_SESSION['nombre'] ?></label></li>
	            </ul>
            </div>

            <div class="menuBotones">
	            <ul>
					<?php
						if( $_SESSION['rol'] == 'Cliente' ){
							echo "<li><a href='consultes.php'>Consultas</a></li>";
						}
						else if( $_SESSION['rol'] == 'Administrador' ) {
							echo "<li><a href='bienvenido.php'>Inicio</a></li>";
							echo "<li><a href='crearconsultes.php'>Crear Consultas</a></li>";
							echo "<li><a href='invitarConsulta.php'>Invitar a consultas</a></li>";
						}
					?>
				</ul>
            </div>
        </nav>

        <article>
        	<h1>A VOTAR</h1>
        	<br>
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

				$id_consulta = $_POST['id_consulta'];

				$query1 = $pdo->prepare("select * from consulta where id_consulta=".$_POST['id_consulta'].";");
				$query1->execute();
				$row1 = $query1->fetch();

				$contador = 0;
				echo "<div class='consultas'>";
				while ($row1) {
					$contador = $contador+1;
					echo "<div id='".$contador."'>".$contador." - ".$row1['pregunta'];

						$query2 = $pdo->prepare("select * from opciones where id_consulta='".$row1['id_consulta']."';");
						$query2->execute();
						$row2 = $query2->fetch();

						echo "<div class='plegable'>";
						echo "<form action='votar.php' method='post'>";
						while ($row2) {
							echo "<input type='radio' name='respuesta' value='".$row2['id_opciones']."'> ".$row2['descripcionOpciones']."</input>";
							echo "<br>";
							$row2 = $query2->fetch();
						}
						echo "<input type='submit' value='Vota'></input>";

						echo "</form>";
						echo "</div>";
					echo "</div>";

					$row1 = $query1->fetch();
				}
				echo "</div>";


				unset($pdo);
				unset($query);
			?>
        </article>
        <footer>
        	<h5>© Copyright 2007-2018 - Created by Genis and Alejandro</h5>
        </footer>
	</body>
</html>
