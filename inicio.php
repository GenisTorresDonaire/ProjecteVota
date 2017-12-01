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
			<form action="comprobar_login.php" method="post">
	            <h2>Formulario de Login</h2>
	            <input type="text" name="loginNombre" placeholder="&#128272; Usuario">
	            <input type="password" name="loginPassword" placeholder="&#128272; Contraseña">
	            <input type="Submit" value="Entrar">
        	</form>
		</div>        
	</body>
</html>