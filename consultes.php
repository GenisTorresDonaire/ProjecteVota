<?php
	session_start();
    
    if(!isset($_SESSION['nombre']) and $_SESSION['estado'] != 'Autenticado'){
       header('Location: inicio.php');
       exit();
    }

    if(isset($_POST['respuesta'])){
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

		$query = $pdo->prepare("select id_usuario from usuarios where nombre='".$_POST['loginNombre']."';");
		$query->execute();
		$row = $query->fetch();		
	
		while ($row){
			$query = $pdo->prepare("insert into votos (id_opciones, id_usuario) values (".$_POST['respuesta'].",".$row['id_usuario'].");");
			$query->execute();
			$row = $query->fetch();	
		}
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
		<script type="text/javascript" src="js/funciones.js"></script>
	</head>
	<body onload="setTimeout(desplegar, 2000);">
		<header>
            <img src="imagenes/banner.png"/>
        </header>
        
        <nav class="contenedorMenu">
        	<div class="menuIcono">
	            <ul>	
               		<li><label for="btn-menu" onclick="location.href='cerrarsesion.php'"><span class="icon-off"></span></label></li>
                	<li><label><?php echo "Bienvenido, ".$_SESSION['nombre'] ?></label></li>
	            </ul>
            </div>

            <div class="menuBotones">
	            <ul>
					<li><a href="bienvenido.php">Inicio</button></a></li>
					<li><a href="consultes.php">Consultas</a></li>
					<li><a href="crearconsultes.php">Crear Consultas</a></li>
				</ul> 
            </div>
        </nav>
        
        <article>
        	<h1>Consultas</h1>
        	<br>
        	  
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

				$query1 = $pdo->prepare("select * from consulta;");
				$query1->execute();
				$row1 = $query1->fetch();
		
				$contador = 0;
				echo "<div class='consultas'>";
				while ($row1) {
					$contador = $contador+1;
					echo "<div id='".$contador."' onclick='desplegar(".$contador.")'>".$contador." - ".$row1['pregunta'];

						$query2 = $pdo->prepare("select * from opciones where id_consulta='".$row1['id_consulta']."';");
						$query2->execute();
						$row2 = $query2->fetch();
						
						echo "<div class='plegable'>";
						echo "<form action='consultes.php' method='post'>";
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

	</body>
</html>
