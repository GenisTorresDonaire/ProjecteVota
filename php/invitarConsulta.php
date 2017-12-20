<?php
	session_start();

	if(!isset($_SESSION['nombre']) and $_SESSION['estado'] != 'Autenticado'){
		header('Location: inicio.php');
		exit();
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
        		<h1>Invitaciones</h1>
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

				echo "<form action='email.php' method='post'>";
					echo "<p>Correo Invitado: </p>";
					echo "<textarea class='textareaInvitar' name='correo' placeholder='Introducir un correo por linea' requiered></textarea>";
					$query = $pdo->prepare("select * from consulta;");
					$query->execute();
					$row = $query->fetch();

					echo "<p>Consulta: ";
					echo "<select name='consulta'>";
					while ($row) {
						echo "<option value='".$row['id_consulta']."'>".$row['pregunta']."</option>";
						$row = $query->fetch();
					}
					echo "</select></p>";

					echo "<input type='submit' value='Invitar'>";
				echo "</form>";

				unset($pdo);
				unset($query);
			?>
       		</article>
       		<footer>
        		<h5>© Copyright 2007-2018 - Created by Genis and Alejandro</h5>
        	</footer>
	</body>
</html>
