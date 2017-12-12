contCreador = 0;
arrayOpciones = 0;
contOpciones = 0;
consultaNull = true;

function desplegar(){
	var longitud = document.body.children[2].children[2].children.length;
	
	for (var x=0; x<longitud; x++){
		var elemento = document.body.children[2].children[2].children[x].children[0];
		elemento.className += "desplegado";
	}
}

function crearConsulta(){
	arrayOpciones = 0;
	contCreador++;
	if (contCreador == 1){
		var padre = document.body.childNodes[5];

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
    opcion.setAttribute("class", "labels");
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
    boton.setAttribute("class", "botones");
    boton.setAttribute("onclick", 'eliminar('+contOpciones+')');
    document.getElementById("myForm").appendChild(boton);

    var arriba = document.createElement("button");
    var text = document.createTextNode("⬆");
    arriba.appendChild(text);
    arriba.setAttribute("type", "button");
    arriba.setAttribute("id", "flechA"+contOpciones);
    arriba.setAttribute("class", "arriba");
    arriba.setAttribute("onclick", 'subirRespuesta('+contOpciones+')');
    document.getElementById("myForm").appendChild(arriba);

    var bajar = document.createElement("button");
    var text = document.createTextNode("⬇");
    bajar.appendChild(text);
    bajar.setAttribute("type", "button");
    bajar.setAttribute("id", "flechB"+contOpciones);
    bajar.setAttribute("class", "abajo");
    bajar.setAttribute("onclick", 'bajarRespuesta('+contOpciones+')');
    document.getElementById("myForm").appendChild(bajar);

	var br = document.createElement("br");
	br.setAttribute("id", contOpciones);
	br.setAttribute("class", "contbr");
	document.getElementById("myForm").appendChild(br);

    padre.insertBefore(form,padre);
}

function eliminar(id){
	var nuevoNumero = 1;
	contOpciones--;

	var contLabel = 1;
	var blabel = document.getElementById("b"+id);
	var ilabel = document.getElementById("i"+id);
	var olabel = document.getElementById("o"+id);
	var br = document.getElementById(id);
	var flechArriba = document.getElementById("flechA"+id);
	var flechAbajo = document.getElementById("flechB"+id);
	blabel.parentNode.removeChild(blabel);
	ilabel.parentNode.removeChild(ilabel);
	olabel.parentNode.removeChild(olabel);
	br.parentNode.removeChild(br);
	flechArriba.parentNode.removeChild(flechArriba);
	flechAbajo.parentNode.removeChild(flechAbajo);

	var opciones = document.getElementsByClassName('labels');

	for(var num = 0; num < opciones.length; num++){
		opciones[num].innerHTML = "Opcion " + nuevoNumero + ": ";
		nuevoNumero++;
	}
}

function eliminarRespuestas(){

	var nuevoNumero = 1;
	contOpciones--;

	var contLabel = 1;
	var borrarLabel = document.getElementsByClassName('labels');
	var borrarOpciones = document.getElementsByClassName('opciones');
	var borrarBr = document.getElementsByClassName('contbr');
	var borrarBotones = document.getElementsByClassName('botones');
	var borrarArriba = document.getElementsByClassName('arriba');
	var borrarAbajo = document.getElementsByClassName('abajo');

	for(var num = 0; num <= contOpciones; num++){
		borrarLabel[0].parentNode.removeChild(borrarLabel[0]);
		borrarOpciones[0].parentNode.removeChild(borrarOpciones[0]);
		borrarBr[0].parentNode.removeChild(borrarBr[0]);
		borrarBotones[0].parentNode.removeChild(borrarBotones[0]);
		borrarArriba[0].parentNode.removeChild(borrarArriba[0]);
		borrarAbajo[0].parentNode.removeChild(borrarAbajo[0]);
	}

	contOpciones = 0;

}

function subirRespuesta(id){

	var inputNuevo = id - 1;

	var input = document.getElementById('i'+id);
	var inputDos = document.getElementById('i'+inputNuevo);

	if(inputDos != null){
	
		var valor = input.value;
		var valorDos = inputDos.value;

		input.value = valorDos;
		inputDos.value = valor;
	}

}

function bajarRespuesta(id){

	var inputNuevo = id + 1;

	var input = document.getElementById('i'+id);
	var inputDos = document.getElementById('i'+inputNuevo);

	if(inputDos != null){
	
		var valor = input.value;
		var valorDos = inputDos.value;

		input.value = valorDos;
		inputDos.value = valor;
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
	var hh = hoy.getHours();

	if (dd<10) {
		dd = '0'+dd;
	}

	if(mm<10){
		mm = '0'+mm;
	}

	hoy = mm+'-'+dd+'-'+yyyy+'-'+hh;

}

function cogerDiaPosterior(){
	var hoy = new Date();

	var dd = hoy.getDate()+1;
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();
	var hh = hoy.getHours();

	if (dd<10) {
		dd = '0'+dd;
	}

	if(mm<10){
		mm = '0'+mm;
	}

	hoy = mm+'-'+dd+'-'+yyyy+'-'+hh;
}

function comprobarfechas(){
	var diaEntrada = document.getElementById("inicio").value;
	var diaTancament =  document.getElementById("final").value;

	var hoy = new Date();
	
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();
	var hh = hoy.getHours();

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