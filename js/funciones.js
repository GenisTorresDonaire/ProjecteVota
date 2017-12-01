
function desplegar(){
	var longitud = document.body.children[1].children[2].children.length;
	
	for (var x=0; x<longitud; x++){
		var elemento = document.body.children[1].children[2].children[x].children[0];
		elemento.className += "desplegado";
	}
}
contCreador = 0;
contOpciones = 0;
consultaNull = true;

function crearConsulta(){
	contCreador++;
	if (contCreador == 1){

		var padre = document.body.childNodes[3];

		/*Creacio del form*/
	    var form = document.createElement("form");
	    form.setAttribute("id", "myForm");
	    form.setAttribute("action", "crearconsultes.php");
	    form.setAttribute("method", "post");
	    padre.appendChild(form);

	    /*Creacio del label amb el seu text*/
	    var data_obertura = document.createElement("label");
	    var text = document.createTextNode("Data de obertura: ");

	    data_obertura.appendChild(text);
	    document.getElementById("myForm").appendChild(data_obertura);

	   	
	    var input = document.createElement("input");
	    input.setAttribute("id", "inicio");
	    input.setAttribute("onblur", "validarFocus(event)");
	    input.setAttribute("placeholder", "DD-MM-YYYY");
	    input.setAttribute("min", ""+hoy()+"")
	    input.setAttribute("type", "date");
	    input.setAttribute("value", "");
	    document.getElementById("myForm").appendChild(input);

	    var data_tancament = document.createElement("label");
	    var text = document.createTextNode("Data de tancament: ");

	    data_tancament.appendChild(text);
	    document.getElementById("myForm").appendChild(data_tancament);

	    var input = document.createElement("input");
	    input.setAttribute("id", "final");
	    input.setAttribute("type", "date");
	    input.setAttribute("onblur", "validarFocus(event)");
	    input.setAttribute("placeholder", "DD-MM-YYYY");
	    input.setAttribute("min", ""+cogerDiaPosterior()+"")
	    input.setAttribute("value", "");
	    document.getElementById("myForm").appendChild(input);

	    var salto = document.createElement("br");
	    document.getElementById("myForm").appendChild(salto);
	    var salto = document.createElement("br");
	    document.getElementById("myForm").appendChild(salto);

	    var pregunta = document.createElement("label");
	    var text = document.createTextNode("Pregunta: ");
	    pregunta.appendChild(text);
	    document.getElementById("myForm").appendChild(pregunta);

	    var input = document.createElement("input");
	    input.setAttribute("id", "pre");
	    input.setAttribute("onblur", "validarFocus(event)");
	    input.setAttribute("type", "text");
	    input.setAttribute("value", input.value);
	    input.setAttribute("name", "pregunta");
	    document.getElementById("myForm").appendChild(input);

	    var salto = document.createElement("br");
	    document.getElementById("myForm").appendChild(salto);
	  
	    padre.insertBefore(form,padre);
	}
}

function crearRespuestas(){
	contOpciones++;

	var salto = document.createElement("br");
	document.getElementById("myForm").appendChild(salto);

	var opcion = document.createElement("label");
    var text = document.createTextNode("Opcion "+contOpciones+": ");
    opcion.appendChild(text);
    opcion.setAttribute("id", "o"+contOpciones);
    document.getElementById("myForm").appendChild(opcion);

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("value", "");
    input.setAttribute("onblur", "validarFocus(event)");
    input.setAttribute('class','opciones');
    input.setAttribute("id", "i"+contOpciones);
    input.setAttribute("name","input[]")
    document.getElementById("myForm").appendChild(input);

    var boton = document.createElement("button");
    var text = document.createTextNode("X");
    boton.appendChild(text);
    boton.setAttribute("type", "button");
    boton.setAttribute("id", "b"+contOpciones);
    boton.setAttribute("onclick", 'eliminar('+contOpciones+')');
    document.getElementById("myForm").appendChild(boton);

	var salto = document.createElement("br");
	document.getElementById("myForm").appendChild(salto);

    padre.insertBefore(form,padre);
}

function eliminar(id){

	var contLabel = 1;

	var blabel = document.getElementById("b"+id);
	var ilabel = document.getElementById("i"+id);
	var olabel = document.getElementById("o"+id);
	blabel.parentNode.removeChild(blabel);
	ilabel.parentNode.removeChild(ilabel);
	olabel.parentNode.removeChild(olabel);

	contOpciones++;

	var label = document.getElementsByClassName("opciones");

	for(var numero=0; numero<label.length;numero++){
		label[numero].innerHTML = "Opcion" + contLabel + ": "
		contLabel++;

	}

}


function enviarRespuestas(){

	var form = document.getElementById("myForm");
	form.submit();
}

function validarTextos(){

	var buit = document.getElementById('pre');
	
	if(buit.value != ""){

		consultaNull = false;
		var rojo = document.getElementById("pre");
		rojo.setAttribute("style","border-color:none;");
		crearRespuestas();
	}
	else{
		
		consultaNull = true;
		var rojo = document.getElementById("pre");
		rojo.setAttribute("style","border-color:red;");
	}
}

function validarRespuestas(){

	var opciones_no_null = 0;
	var inputs = document.getElementsByClassName('opciones');

	comprobarfechas();
	
	for(var numero=0; numero<inputs.length;numero++){
		if(inputs[numero].value != ""){

			opciones_no_null++;

		}else{

			var rojo = document.getElementById("i"+contOpciones);
			rojo.setAttribute("style","border-color:red;");
		}
		
	}
	
	if(contOpciones >= 2 && opciones_no_null == inputs.length){
		enviarRespuestas();

	}else{
		alert("Tiene que haber mas de 2 opciones en la respuesta ì las respuestas no pueden estar vacias.")
	}
	
}

function validarFocus(event){

	var focus = event.currentTarget;

	if(focus.value.length == 0){
		focus.setAttribute("style", "border-color:red;"); 
	}
	else{
		focus.setAttribute("style","border-color:none;");
	}
}

function hoy(){

	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();

	if (dd<10) {
		dd = '0'+dd;
	}

	if(mm<10){
		mm = '0'+mm;
	}

	hoy = mm+'-'+dd+'-'+yyyy;

}

function cogerDiaPosterior(){
	var hoy = new Date();

	var dd = hoy.getDate()+1;
	var mm = hoy.getMonth()+1;
	var yyyy= hoy.getFullYear();

	if (dd<10) {
		dd = '0'+dd;
	}

	if(mm<10){
		mm = '0'+mm;
	}

	hoy = mm+'-'+dd+'-'+yyyy;
}

function comprobarfechas(){
	var diaEntrada = document.getElementById("inicio").value;
	var diaTancament =  document.getElementById("final").value;

	var hoy = new Date();

	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy= hoy.getFullYear();

	diaEntrada = diaEntrada.split("-")
	diaTancament = diaTancament.split("-")

	if(diaEntrada[2] < dd || diaEntrada[1] < mm || diaEntrada[0] < yyyy){
		alert("La fecha de inicio no puede ser mas pequena que la data actual!!");
	}

	else if (diaEntrada[2] < diaTancament[2] && diaTancament[1] < diaEntrada[1] && diaTancament[0] < diaEntrada[0]){
		alert("La fecha de inicio tiene que ser mas pequeña que la del tancament!!");
	}

	else if (diaEntrada[2] == dd && diaEntrada[1] == mm && diaEntrada[0] == yyyy){
		alert("La fecha de inicio no puede ser la actual!!");
	}

	else if ((diaTancament[2] == diaEntrada[2] && diaTancament[1] == diaEntrada[1] && diaTancament[0] == diaEntrada[0]) ||
			((diaTancament[0] < diaEntrada[0]) || (diaTancament[1] < diaEntrada[1])) || (diaTancament[2] < diaEntrada[2])){
		alert("La fecha de tancament tiene que ser mas grande que la del inicio!!");
	}
}