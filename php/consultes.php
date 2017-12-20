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
        	<h1>CONSULTAS PENDIENTES</h1>
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

				$query = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE nombre='".$_SESSION['nombre']."'");
                                $query->execute();
                                $row = $query->fetch();

				while($row){
					$query1 = $pdo->prepare("select id_consulta, pregunta from consulta where id_consulta IN (select id_consulta from invitaciones where votado=0 and id_usuario=".$row['id_usuario'].");");
					$query1->execute();
					$row1 = $query1->fetch();

					echo "<div class='consultas'>";
						while ($row1) {
							echo "<form action='votar.php' method='post'>";
                                                               	echo $row1['pregunta'];
								echo "<input type='hidden' name='id_consulta' value='".$row1['id_consulta']."'>";
								echo "<input type='submit' value='Enviar'>";
							echo "<br>";
							echo "</form>";
                                                       	$row1 = $query1->fetch();
						}
					echo "</div>";

					echo "<div class='votados'>";
						echo "<br>";
						echo "<h1>CONSULTAS RESPONDIDAS</h1>";

						$query3 = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE nombre='".$_SESSION['nombre']."'");
 			                        $query3->execute();
		               		        $row3 = $query3->fetch();

						while($row3){
        						//$query1 = $pdo->prepare("SELECT c.pregunta FROM consulta c, votos v, usuarios u WHERE c.id_consulta=v.id_consulta and u.id_usuario='".$row['id_usuario']."';");
                                        		$query1 = $pdo->prepare("select id_consulta, pregunta from consulta where id_consulta IN (select id_consulta from invitaciones where votado=1 and id_usuario=".$row3['id_usuario'].");");
							$query1->execute();
                                       			$row1 = $query1->fetch();

							while($row1){
								echo "<form action='cambiovoto.php' method='post'>";
									echo "<label>".$row1['pregunta']."</label>";
									echo "<input type='hidden' name='id_consulta' value='".$row1['id_consulta']."'>";
									//echo "<input type='submit' value='Editar' />";
								echo "</form>";
								//echo "<br>";
								$row1 = $query1->fetch();
							}
							$row3 = $query->fetch();
						}
					echo "</div>";
					$row = $query->fetch();
				}
				unset($pdo);
				unset($query);
			?>
        </article>
        <footer>
        	<h5>© Copyright 2007-2018 - Created by Genis and Alejandro</h5>
        </footer>
	</body>
</html>
