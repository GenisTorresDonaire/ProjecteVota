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
					<li><a href="">Consultas</a></li>
					<li><a href="consultes.php">Crear Consultas</a></li>
				</ul> 
            </div>
        </nav>

        <article>
            <h1>Bienvenido</h1>
        </article>
	</body>
</html>