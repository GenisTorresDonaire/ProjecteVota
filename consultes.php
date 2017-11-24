<?php
	session_start();
    
    if(!isset($_SESSION['user']) and $_SESSION['estado'] != 'Autenticado'){
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

		$query = $pdo->prepare("select canVotos from votos where id_opciones='".$_POST['respuesta']."';");
		$query->execute();
		$row = $query->fetch();

		if ($row == null ){
			$query = $pdo->prepare("insert into votos (id_opciones,canVotos) values('".$_POST['respuesta']."',1);");
			$query->execute();
			$row = $query->fetch();
		}
		else{
			$contadorVotos = $row['canVotos']+1;
			$query = $pdo->prepare("insert into votos ('id_opciones', 'canVotos') values('".$_POST['respuesta']."','".$contadorVotos."');");
			$query->execute();
		}
		

		//INSERT INTO `votos`(`id_voto`, `id_opciones`, `canVotos`) VALUES ([value-1],[value-2],[value-3])
		//$query = $pdo->prepare("insert into votos ('id_opciones', 'canVotos') values();");
		//$query->execute();
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

				$query = $pdo->prepare("select * from consulta;");
				$query->execute();
				$row = $query->fetch();
		
				$contador = 0;
				while ($row) {
					$contador = $contador+1;
					echo "<div>".$contador."- ".$row['pregunta']."<button id='".$row['id_consulta']."' onclick='votarConsulta(".$row['id_consulta'].")'>Vota</button><button id='".$row['id_consulta']."' onclick='editarConsulta(".$row['id_consulta'].")'>Editar</button></div>";
					echo "<br>";

					$row = $query->fetch();
				}

				unset($pdo); 
				unset($query);
			?>
        </article>

	</body>
</html>