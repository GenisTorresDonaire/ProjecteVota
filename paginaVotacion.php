<?php
	session_start();
    
    if(!isset($_SESSION['user']) and $_SESSION['estado'] != 'Autenticado'){
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
		<script type="text/javascript" src="js/funciones.js"></script>
	</head>
	<body>
        <nav class="contenedorMenu">
        	<div class="menuIcono">
	            <ul>
	                <li><input type="checkbox" id="btn-menu"></li>	
               		<li><label for="btn-menu"><span class="icon-user-male"></span></label></li>
                	<li><label><?php echo "Bienvenido, ".$_SESSION['nombre'] ?></label></li>
	            </ul>
            </div>

            <div class="menuDesplegable"> 
	            <nav>
	                <ul>
	                    <li><a><button onclick="location.href='cerrarsesion.php'">Logout</button></a></li>
	                </ul> 
	            </nav>
        	</div>

            <div class="menuBotones">
	            <ul>
					<li><a href="">Inicio</button></a></li>
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

				$id_consulta = $_GET['id_consulta'];

				$query = $pdo->prepare("select pregunta from consulta where id_consulta='".$id_consulta."';");
				$query->execute();
				$row = $query->fetch();
			
				echo "<div>";
				while ($row) {
					echo "<h4>".$row['pregunta']."</h4>";
					echo "<br>";
					$row = $query->fetch();
				}

				$query = $pdo->prepare("select * from opciones where id_consulta='".$id_consulta."';");
				$query->execute();
				$row = $query->fetch();
				
				echo "<form action='consultes.php' method='post'>";
				while ($row) {
					echo "<input type='radio' name='respuesta' value='".$row['id_opciones']."'> ".$row['descripcionOpciones']."</input>";
					echo "<br>";
					$row = $query->fetch();
				}
				echo "<input type='submit' value='Aplicar'></input>";
				echo "</form>";
				echo "</div>";

				unset($pdo); 
				unset($query);
			?>
        </article>

	</body>
</html>