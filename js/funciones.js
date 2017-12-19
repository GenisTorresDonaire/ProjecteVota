// Fichero: funciones.js
// Data de creacion: 4/12/2017
// Creador: Alejandro Novoa Montolio y la funcion "desplegar()" lo ha echo Genis Torres Donaire
/* Descripcion: En este fichero encontraremos todas las funciones de "crear consultas" y la funcion 
				del desplegable de las consultas, es decir, aqui encontraremos esto:
                
                	- Creacion de la funcion desplegable de las consultas 
                	- Creacion de todas la funciones de "crear consultas"
                	- Creacion de la pregunta
                	- Creacion de los botones 
                	- Creacion de los labels
                	- Creacion de los inputs
                	- Creacion de las respuestas de la pagina
                	- Creacion de las validaciones de cada campo 
*/

//VARIABLES
contCreador = 0;
arrayOpciones = 0;
contOpciones = 0;
consultaNull = true;

//FUNCION PARA DESPLEGAR LAS CONSULTAS 
function desplegar(){
	// Creacio de la variable .
	var longitud = document.body.children[2].children[2].children.length;
	
	// Añade la clase desplegado a todos los divs.
	for (var x=0; x<longitud; x++){
		var elemento = document.body.children[2].children[2].children[x].children[0];
		elemento.className += "desplegado";
	}
}

//FUNCION QUE CREA LA CONSULTA
function crearConsulta(){
	// Variable que resetea las consultas cada vez que creamos una
	arrayOpciones = 0;
	// Contador para controlar que solo se pueda crear una consulta, es decir, cuando ledemos una vez no podra crear otra hasta que no creemos una
	contCreador++;
	if (contCreador == 1){
		var padre = document.body.childNodes[5];

		// Creacion del form
	    var form = document.createElement("form");
	    form.setAttribute("id", "myForm");
	    form.setAttribute("action", "crearconsultes.php");
	    form.setAttribute("method", "post");
	    padre.appendChild(form);

	    // Creacion del label de la data obertura
	    var data_obertura = document.createElement("label");
	    var text = document.createTextNode("Data de obertura: ");

	    data_obertura.appendChild(text);
	    document.getElementById("myForm").appendChild(data_obertura);

	   	// Creacion del input "data inicio" para la data_obertura
	    var input = document.createElement("input");
	    input.setAttribute("id", "inicio");
	    input.setAttribute("onblur", "validarFocus(event)");
	    input.setAttribute("type", "date");
	    input.setAttribute("value", "");
	    document.getElementById("myForm").appendChild(input);

	    // Creacion del input "hora inicio" para la data_obertura
	    var horaInicio = document.createElement("input");
	    horaInicio.setAttribute("id", "horasInicio");
	    horaInicio.setAttribute("type", "time");
	    horaInicio.setAttribute("onblur", "validarFocus(event)");
	    horaInicio.setAttribute("value", "");
	    document.getElementById("myForm").appendChild(horaInicio);

	    // Creacion del label de la data tancament
	    var data_tancament = document.createElement("label");
	    var text = document.createTextNode("Data de tancament: ");

	    data_tancament.appendChild(text);
	    document.getElementById("myForm").appendChild(data_tancament);

	    // Creacion del input "data final" para la data_tancament
	    var input = document.createElement("input");
	    input.setAttribute("id", "final");
	    input.setAttribute("type", "date");
	    input.setAttribute("onblur", "validarFocus(event)");
	    input.setAttribute("value", "");
	    document.getElementById("myForm").appendChild(input);

	    // Creacion del input "hora final" para la data_tancament
	    var horasFinal = document.createElement("input");
	    horasFinal.setAttribute("id", "horasFinal");
	    horasFinal.setAttribute("type", "time");
	    horasFinal.setAttribute("onblur", "validarFocus(event)");
	    horasFinal.setAttribute("value", "");
	    document.getElementById("myForm").appendChild(horasFinal);

	    // Creacion br
	    var salto = document.createElement("br");
	    document.getElementById("myForm").appendChild(salto);
	    var salto = document.createElement("br");
	    document.getElementById("myForm").appendChild(salto);

	    // Creacion del label de la pregunta
	    var pregunta = document.createElement("label");
	    var text = document.createTextNode("Pregunta: ");
	    pregunta.appendChild(text);
	    document.getElementById("myForm").appendChild(pregunta);

	    // Creacion del input para la pregunta
	    var input = document.createElement("input");
	    input.setAttribute("id", "pre");
	    input.setAttribute("onblur", "validarFocus(event)");
	    input.setAttribute("type", "text");
	    input.setAttribute("value", input.value);
	    input.setAttribute("name", "pregunta");
	    document.getElementById("myForm").appendChild(input);

	    // Creacion br
	    var salto = document.createElement("br");
	    document.getElementById("myForm").appendChild(salto);
	    var salto = document.createElement("br");
	    document.getElementById("myForm").appendChild(salto);

	    padre.insertBefore(form,padre);
	}
}

//FUNCION QUE CREA LAS RESPUESTAS
function crearRespuestas(){
	// Contador para las opciones
	contOpciones++;

	// Creacion del label de la opcion
	var opcion = document.createElement("label");
    var text = document.createTextNode("Opcion "+contOpciones+": ");
    opcion.appendChild(text);
    opcion.setAttribute("id", "o"+contOpciones);
    opcion.setAttribute("class", "labels");
    document.getElementById("myForm").appendChild(opcion);

    // Creacion del input para la opcion
    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("value", "");
    input.setAttribute("onblur", "validarFocus(event)");
    input.setAttribute('class','opciones');
    input.setAttribute("id", "i"+contOpciones);
    input.setAttribute("name","input[]")
    document.getElementById("myForm").appendChild(input);

    // Creacion del boton de eliminar cada respuesta
    var boton = document.createElement("button");
    var text = document.createTextNode("X");
    boton.appendChild(text);
    boton.setAttribute("type", "button");
    boton.setAttribute("id", "b"+contOpciones);
    boton.setAttribute("class", "botones");
    boton.setAttribute("onclick", 'eliminar('+contOpciones+')');
    document.getElementById("myForm").appendChild(boton);

    // Creacion del boton para subir la posicion de las respuestas
    var arriba = document.createElement("button");
    var text = document.createTextNode("⬆");
    arriba.appendChild(text);
    arriba.setAttribute("type", "button");
    arriba.setAttribute("id", "flechA"+contOpciones);
    arriba.setAttribute("class", "arriba");
    arriba.setAttribute("onclick", 'subirRespuesta('+contOpciones+')');
    document.getElementById("myForm").appendChild(arriba);

    // Creacion del boton para bajar la posicion de las respuestas
    var bajar = document.createElement("button");
    var text = document.createTextNode("⬇");
    bajar.appendChild(text);
    bajar.setAttribute("type", "button");
    bajar.setAttribute("id", "flechB"+contOpciones);
    bajar.setAttribute("class", "abajo");
    bajar.setAttribute("onclick", 'bajarRespuesta('+contOpciones+')');
    document.getElementById("myForm").appendChild(bajar);

    // Creacion br
	var br = document.createElement("br");
	br.setAttribute("id", contOpciones);
	br.setAttribute("class", "contbr");
	document.getElementById("myForm").appendChild(br);

    padre.insertBefore(form,padre);
}

//FUNCION PARA ELIMINAR TODAS LAS RESPUESTAS 
function eliminar(id){
	// Creacio nueva variable
	var nuevoNumero = 1;
	// Contador que resta el numero de cada opcion cada vez que eliminamos una opcion
	contOpciones--;

	// Indicamos las variables
	var contLabel = 1;
	var blabel = document.getElementById("b"+id);
	var ilabel = document.getElementById("i"+id);
	var olabel = document.getElementById("o"+id);
	var br = document.getElementById(id);
	var flechArriba = document.getElementById("flechA"+id);
	var flechAbajo = document.getElementById("flechB"+id);

	// Eliminamos las variables
	blabel.parentNode.removeChild(blabel);
	ilabel.parentNode.removeChild(ilabel);
	olabel.parentNode.removeChild(olabel);
	br.parentNode.removeChild(br);
	flechArriba.parentNode.removeChild(flechArriba);
	flechAbajo.parentNode.removeChild(flechAbajo);

	// Reseta los numeros de los labels cada vez que eliminamos
	var opciones = document.getElementsByClassName('labels');

	for(var num = 0; num < opciones.length; num++){
		opciones[num].innerHTML = "Opcion " + nuevoNumero + ": ";
		nuevoNumero++;
	}
}

//FUNCION PARA ELIMINAR UNA RESPUESTA
function eliminarRespuestas(){

	// Creacio nueva variable
	var nuevoNumero = 1;
	// Contador que resta el numero de cada opcion cada vez que eliminamos una opcion
	contOpciones--;

	// Indicamos las variables
	var contLabel = 1;
	var borrarLabel = document.getElementsByClassName('labels');
	var borrarOpciones = document.getElementsByClassName('opciones');
	var borrarBr = document.getElementsByClassName('contbr');
	var borrarBotones = document.getElementsByClassName('botones');
	var borrarArriba = document.getElementsByClassName('arriba');
	var borrarAbajo = document.getElementsByClassName('abajo');

	// Eliminamos cada elemento de la respuesta que queremos eliminar
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

//FUNCION PARA SUBIR LAS RESPUESTAS
function subirRespuesta(id){

	// Creacio de un nuevo input
	var inputNuevo = id - 1;

	// Indicamos el input de la respuesta i otro input
	var input = document.getElementById('i'+id);
	var inputDos = document.getElementById('i'+inputNuevo);

	// Cambiamos los valores de cada input cuando subimos una respuesta
	if(inputDos != null){
	
		var valor = input.value;
		var valorDos = inputDos.value;

		input.value = valorDos;
		inputDos.value = valor;


	}

}

// FUNCION PARA BAJAR LAS RESPUESTAS
function bajarRespuesta(id){

	// Creacio de un nuevo input
	var inputNuevo = id + 1;

	// Indicamos el input de la respuesta i otro input
	var input = document.getElementById('i'+id);
	var inputDos = document.getElementById('i'+inputNuevo);

	// Cambiamos los valores de cada input cuando bajamos una respuesta
	if(inputDos != null){
	
		var valor = input.value;
		var valorDos = inputDos.value;

		input.value = valorDos;
		inputDos.value = valor;
	}

}

//FUNCION PARA ENVIAR LAS RESPUESTAS
function enviarRespuestas(){

	var form = document.getElementById("myForm");
	form.submit();
}

//FUNCION PARA VALIDAR EL TEXTO DE LA PREGUNTA
function validarTextos(){

	var buit = document.getElementById('pre');
	
	// Comprueba si el value hay texto, si lo hay el borde estara por defecto
	if(buit.value != ""){
		consultaNull = false;
		var rojo = document.getElementById("pre");
		rojo.setAttribute("style","border-color:none;");
		crearRespuestas();
	}
	// Comprueba si el value hay texto, si no hay y salimos del focus saldra el borde en rojo
	else{
		consultaNull = true;
		var rojo = document.getElementById("pre");
		rojo.setAttribute("style","border-color:red;");
	}
}

//FUNCION PARA VALIDAR LAS RESPUESTAS
function validarRespuestas(){

	// Variables
	var opciones_no_null = 0;
	var inputs = document.getElementsByClassName('opciones');

	// Funcion para comprobar las fechas antes de enviar la consulta
	comprobarfechas();
	
	// Comprueba si las respuestas si estan vacias, si no lo estan augmentara el contador de las respuestas que enviaras
	for(var numero=0; numero<inputs.length;numero++){
		if(inputs[numero].value != ""){

			opciones_no_null++;

		}
		// Si hay respuestas vacias, el borde se volvera rojo
		else{

			var rojo = document.getElementById("i"+contOpciones);
			rojo.setAttribute("style","border-color:red;");
		}
		
	}

	// Si hay 2 opciones o mas, o si las opciones no estan vacios podra enviar la consulta
	if(contOpciones >= 2 && opciones_no_null == inputs.length && comprobarfechas()){
		enviarRespuestas();

	}
	// Si no lo cumple no podra enviar y le saldra un mensaje de alerta
	else{
		alert("Tiene que haber mas de 2 opciones en la respuesta ì las respuestas no pueden estar vacias.")
	}
	
}

//FUNCION PARA VALIDAR EL FOCUS 
function validarFocus(event){

	// Cuando se salga del focus de un elemento para introducir un valor el borde se volvera rojo
	var focus = event.currentTarget;
	if(focus.value.length == 0){

		focus.setAttribute("style", "border-color:red;");
	}

	// Cuando volvamos dentro y escribamos dentro volvera a ponerse por defecto
	else{
		focus.setAttribute("style","border-color:none;");
	}
}

//FUNCION PARA VALIDAR FECHAS
function comprobarfechas(){

	// Indicamos variables
	var hoy = new Date();
	
	hoy.setSeconds(00);
	hoy.setMilliseconds(00);

	// Indicamos las variables
	var diaEntrada = document.getElementById("inicio").value;
	var diaTancament =  document.getElementById("final").value;

	var horaInicio = document.getElementById("horasInicio").value;
	var horaFinal = document.getElementById("horasFinal").value;


	// Le damos formato
	diaEntrada = diaEntrada.split("-")
	diaTancament = diaTancament.split("-")

	horaInicio = horaInicio.split(":")
	horaFinal = horaFinal.split(":")

	// Los valores los comvertimos en formato fecha
	diaEntrada = new Date(parseInt(diaEntrada[0]),parseInt(diaEntrada[1]-1),parseInt(diaEntrada[2]),
						  parseInt(horaInicio[0]),parseInt(horaInicio[1]));
	diaTancament = new Date(parseInt(diaTancament[0]),parseInt(diaTancament[1]-1),parseInt(diaTancament[2]),
							parseInt(horaFinal[0]),parseInt(horaFinal[1]));

	var fechaHora = diaTancament - diaEntrada;
	
	fechaHora = fechaHora / 3600;

	// Validacions

	if(diaEntrada > hoy && diaEntrada < diaTancament && fechaHora >= 4000){
		return true; 
	}
	else if(diaEntrada <= hoy){
		alert("La fecha de inicio no puede ser mas pequeña ni igual que la data actual!!");
	}
	else if(fechaHora < 0){
		alert('La fecha de cierre no puede ser mas pequeña que la fecha de inicio!!');
	}
	else if(fechaHora < 4000 && fechaHora >= 0){
		alert('El tiempo minimo tiene que ser de 4 horas');
	}

	return false;
}

