<?php
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ProjecteVota</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style.css">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
	</head>
	<body>
		<div class="divLogoGrande">
           <img id="logoGrande" src="imagenes/vota.png"/>
       </div>
		<div class="formInicio">
			<form>
            	<h2>Has sido invitado!!</h2>
            	<p>Nombre: <input type="text" name="nombre"></p>
            	<p>Apellido: <input type="text" name="apellido"></p>
            	<p>Correo: <input type="email" name="correo"></p>
            	<p>Introduce la contraseña: <input type="password" name="password1"></p>
            	<p>Vuelve a introducir la contraseña: <input type="password" name="password2"></p>
            	<input type="Submit" value="Entrar">
            </form>
		</div>        
	</body>
</html>