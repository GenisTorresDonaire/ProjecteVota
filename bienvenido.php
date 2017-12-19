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
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/fontello.css">
	</head>

	<body>
		<header>
			<img src="imagenes/banner.png"/>
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
					<li><a href="bienvenido.php">Inicio</button></a></li>
					<?php
						if( $_SESSION['rol'] == 'Cliente' ){
							echo "<li><a href='consultes.php'>Consultas</a></li>";
						}
						else if( $_SESSION['rol'] == 'Administrador' ) {
							echo "<li><a href='crearconsultes.php'>Crear Consultas</a></li>";
							echo "<li><a href='invitarConsulta.php'>Invitar a consultas</a></li>";
						}
					?>
				</ul>
            </div>
        </nav>

        <article>
            <h1>RESULTADOS</h1>
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

			// obtencion de consultas que hay
			$query = $pdo->prepare("select distinct id_consulta from opciones");
                	$query->execute();
               	 	$row = $query->fetch();

                	while ($row){
				// DEVUELVE LAS PREGUNTAS DE ENCUESTA
				//echo "SELECT DISTINCT pregunta from consulta where id_consulta=".$row['id_consulta']."";
				$query1 = $pdo->prepare("SELECT DISTINCT pregunta from consulta where id_consulta=".$row['id_consulta']."");
        	                $query1->execute();
	                        $row1 = $query1->fetch();

				while($row1){
					// DEVUELVE CADA OPCION DE CADA ENCUESTA
					//echo "select id_opciones, descripcionOpciones from opciones where id_consulta=".$row['id_consulta']."";
					$query2 = $pdo->prepare("select id_opciones, descripcionOpciones from opciones where id_consulta=".$row['id_consulta']."");
                                	$query2->execute();
                               	 	$row2 = $query2->fetch();
					echo "<br>";
					echo "<table>";
                                        	echo "<tr>";
                                                	echo "<td>";
                                                        	echo "<h3>".$row1['pregunta']."</h3>";
                                                        echo "</td>";
                                                echo "</tr>";

					while($row2){
						// DEVUELVE EL TOTAL DE VOTOS REALIZADOS EN CADA OPCION
						//echo "select count(id_opciones) from votos_opciones where id_opciones=".$row2['id_opciones']."";
                                        	$query3 = $pdo->prepare("select count(id_opciones) from votos_opciones where id_opciones=".$row2['id_opciones']."");
                                        	$query3->execute();
                                        	$row3 = $query3->fetch();

						echo "<tr>";
							echo "<td>";
                                                	        echo $row2['descripcionOpciones'];
                                                        echo "</td>";
							echo "<td>";
                                                                echo $row3['count(id_opciones)'];
                                                        echo "</td>";
						echo "</tr>";

						$row2 = $query2->fetch();
					}
					echo "</table>";
					$row1 = $query1->fetch();
				}
			     	$row = $query->fetch();
			}
		?>
        </article>
	</body>
</html>
