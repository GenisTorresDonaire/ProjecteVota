<!DOCTYPE html>
<html>
	<head>
		<title>ProjecteVota</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<nav>
			<ul>
				<li>Usuario</li>
				<li><img src="imagenes/logout.png"></li>
			</ul>
		</nav>
		<div class="contenido">
			<div class="divForm">
				<form action="comprobar_login.php" method="post">
					<table>
						<tr>
							<td>Nombre:</td>
						</tr>
						<tr>
							<td><input type="text" name="loginNombre"></td>
						</tr>
						<tr>
							<td><br></td>
						</tr>
						<tr>	
							<td>Password: </td>
						</tr>
						<tr>
							<td><input type="password" name="loginPassword"></td>
						</tr>
						<tr>
							<td><br></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center;"><input type="Submit" value="Entrar"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		

	</body>
</html>