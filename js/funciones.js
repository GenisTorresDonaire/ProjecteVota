var estado = false;

function votarConsulta(id) {
	window.location.href = "paginaVotacion.php?id_consulta="+id;
}

function desplegar(id){
	alert("hola");
	var elemento = document.getElementById(id).children[0];;
	elemento.className += "desplegado";

	//document.body.children[1].children[2].children[0];
	
}