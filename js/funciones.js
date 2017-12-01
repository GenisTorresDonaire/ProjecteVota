function desplegar(){
	var longitud = document.body.children[1].children[2].children.length;
	
	for (var x=0; x<longitud; x++){
		var elemento = document.body.children[1].children[2].children[x].children[0];
		elemento.className += "desplegado";
	}
}

contCreador = 0;
arrayOpciones = 0;
contOpciones = 0;
consultaNull = true;

function crearConsulta(){
	arrayOpciones = 0;
	contCreador++;
	if (contCreador == 1){
		var padre = document.body.childNodes[3];

		/*Creacio del form*/
	    var form = document.createElement("form");
	    form.setAttribute("id", "myForm");
	    form.setAttribute("action", "crearconsultes.php");
	    form.setAttribute("method", "post");
	    padre.appendChild(form);

	    // CREACION DE LA LABEL CON SU TEXTO
	    var data_obertura = document.createElement("label");
	    var text = document.createTextNode("Data de obertura: ");

	    // CREACION DE LA FECHA DE OBERTURA
	    data_obertura.appendChild(text);
	    document.getElementById("myForm").appendChild(data_obertura);
	   	// INPUT
	    var input = document.createElement("input");
	    input.setAttribute("id", "inicio");
	    input.setAttribute("onblur", "validarFocus(event)");
	    input.setAttribute("placeholder", "DD-MM-YYYY");
	    input.setAttribute("min", ""+hoy()+"")
	    input.setAttribute("type", "date");
	    input.setAttribute("value", "");
	    document.getElementById("myForm").appendChild(input);
	    // LABEL
	    var data_tancament = document.createElement("label");
	    var text = document.createTextNode("Data de tancament: ");
	    data_tancament.appendChild(text);
	    document.getElementById("myForm").appendChild(data_tancament);

	    // INPUT 
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

    padre.insertBefore(form,padre);
}

function eliminar(id){
	contOpciones--;
	var blabel = document.getElementById("b"+id);
	var ilabel = document.getElementById("i"+id);
	var olabel = document.getElementById("o"+id);
	blabel.parentNode.removeChild(blabel);
	ilabel.parentNode.removeChild(ilabel);
	olabel.parentNode.removeChild(olabel);
	resetearDespuesBorrado();
}

function resetearDespuesBorrado(){
	alert("contOpciones: " + contOpciones);
	/*
	//var padre = document.body.childNodes[3];
	var padre = document.body.children[1].children[4].children[7];
	for (var x=7; x <= (7+contOpciones);x++){
		alert(x);
	}
	*/
	for ( var y= 1; y <= contOpciones; y++){
		var elemento = document.body.children[1].children[4].children.o+y;
		elemento.innerHTML= "opcioN"+y;
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

	comprobarfechar();
	
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
	var yyyy= hoy.getFullYear();

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

function comprobarfechar(){
	var diaEntrada = document.getElementById("inicio").value;
	var diaTancament =  document.getElementById("final").value;

	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy= hoy.getFullYear();

	if (dd<10) {
		dd = '0'+dd;
	}

	if(mm<10){
		mm = '0'+mm;
	}

	hoy = mm+'-'+dd+'-'+yyyy;

	if (diaEntrada > diaTancament){
		alert("La fecha de inicio tiene que ser mas pequeña que la del tancament!!");
	}
	else if (diaEntrada == hoy){
		alert("La fecha de inicio no puede ser la actual!!");
	}
}