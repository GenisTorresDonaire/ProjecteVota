var anchuraMax=0;

var alturaMax=0;

var copos=new Array;



/**

 * Funcion inicial

 * Tiene que recibir:

 *  numeroCopos a mostrar

 *  anchura y altura por donde aparecen los copos

 *  velocidad de movimiento de los mismos

 */

function inicializar(numeroCopos, anchura, altura, velocidad){

    var i, x, y;
    copos = new Array(numeroCopos);

    for (i = 0; i<numeroCopos; i++){
        x = parseInt(Math.random()*anchura);
        y = parseInt(Math.random()*altura);
        dibujaCopo(i,x,y);
        copos[i] = document.getElementById("c"+i);
    }

    alturaMax = altura;
    anchuraMax = anchura;
    setInterval(nevar, velocidad);
}

// Función inicial que dibuja los copos en la pantalla
function dibujaCopo(numeroCopo, x, y){
    var tamano = Math.floor(Math.random()*4)+1;
    document.write('<div id="c'+numeroCopo+'" class="copo copo'+tamano+'" style="left:'+x+'px; top:'+y+'px;"></div>');
}

// Función que controla el movimiento de los copos por la pantalla
function nevar(){
    var i, x, y;

    for (i = 0; i < copos.length; i++){

        // cogemos las posiciones de cada elemento
        y = parseInt(copos[i].style.top);
        x = parseInt(copos[i].style.left);
        y+=Math.floor(Math.random()*4)+1;
        copos[i].style.top = y;

        // si ha llegado al final de la pantalla
        if(y>document.body.scrollTop+alturaMax){

            // posicionamos nuevamente en la parte superior
            copos[i].style.top = document.body.scrollTop-(Math.round(Math.random()*10)+1);

            // cogemos una posicion horizontal aleatoria
            copos[i].style.left=parseInt((Math.random()*anchuraMax)+1);
        }
    }
}