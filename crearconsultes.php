<?php
	session_start();
    
    if(!isset($_SESSION['nombre']) and $_SESSION['estado'] != 'Autenticado'){
       header('Location: inicio.php');
       exit();
    }

    if(isset($_POST['pregunta'])){
    	$pregunta = $_POST['pregunta'];
    	$respuestas = $_POST['input'];

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

		$query = $pdo->prepare("select id_usuario from usuarios where nombre='".$_SESSION['nombre']."'");
		$query->execute();
		$row = $query->fetch();

		$query = $pdo->prepare("insert into consulta (pregunta, id_usuario) values ('".$pregunta."','".$row['id_usuario']."')");
		$query->execute();

		$query = $pdo->prepare("select id_consulta from consulta where pregunta='".$pregunta."'");
		$query->execute();
		$row = $query->fetch();
		
		foreach ($respuestas as $key) {
			$query = $pdo->prepare("insert into opciones (descripcionOpciones, id_consulta) values('".$key."','".$row['id_consulta']."')");
			$query->execute();
		}	
		
		unset($pdo); 
		unset($query);
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
        	<h1>Crear consultas</h1>

        	<input type="submit" name="submit" value="Crear consulta" onclick="crearConsulta()"></input>

        	<input type="submit" name="submit" value="Crear respuestas" onclick="validarTextos()" ></input>

        	<input type="submit" name="submit" value="Enviar" onclick="validarRespuestas()"></input>
        	  
        </article>


	</body>
</html>