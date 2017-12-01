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
            <h1>Bienvenido</h1>
        </article>
	</body>
</html>