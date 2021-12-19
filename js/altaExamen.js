window.addEventListener("load", function(){
    var contenedorPos = document.getElementById("pPosibles");
    var contenedorSel = document.getElementById("pSeleccionadas");

    var descripcion = document.getElementById("descripcion");
    var duracion = document.getElementById("duracion");
    var preg_examen = contenedorSel.children;
    var guardar = document.getElementById("guardar");

    const divPreg = contenedorPos.children;
    const filtro=document.getElementById("filtro");

    //Filtro
    filtro.onchange = function(ev){
        ev.preventDefault();

        const indice = filtro.selectedIndex;
        const opcionSeleccionada = filtro.options[indice].text;

        for(let i=0; i<divPreg.length; i++){
            if(indice == "0"){
                divPreg[i].classList.remove("oculto");
            } else {
                if(opcionSeleccionada == divPreg[i].children[1].textContent){
                    divPreg[i].classList.remove("oculto");
                } else {
                    divPreg[i].classList.add("oculto");
                }
            }
        }
    }

    //Cogemos el json del servidor y pintamos las preguntas
    fetch("pedirPreguntasJson.php", {
        method:"GET"
    }).then (response => response.json())
    .catch(error => console.error("Error", error))
    .then(response =>{
        pintarPreguntas(response);
    })

    //Pintamos las preguntas y establecemos el drag and drop
    function pintarPreguntas(objetoPregunta){
        for(let i=0; i<objetoPregunta.length; i++){

            var div = document.createElement("div");
            div.id = "preg_"+objetoPregunta[i].id;
            div.className = "pregunta";
            div.draggable = "true";

            var div1 = document.createElement("div");
            div1.className = "enunciado";
            div1.innerHTML = objetoPregunta[i].enunciado;
            var div2 = document.createElement("div");
            div2.className = "tematica";
            div2.innerHTML = objetoPregunta[i].tematica.descripcion;

            div.ondragstart = function(ev){
                ev.dataTransfer.setData("text", ev.target.id);
            }
            div.ondragover = function(ev){
                ev.preventDefault();
            }

            div.appendChild(div1);
            div.appendChild(div2);
            contenedorPos.appendChild(div);
        }
    }

    //Establecemos el comportamiento ante eventos dragover and drop para los contenedores
    contenedorSel.ondragover = function(ev){
        ev.preventDefault();
    }

    contenedorPos.ondragover = function(ev){
        ev.preventDefault();
    }

    contenedorSel.ondrop = function(ev){
        ev.preventDefault();
        const id = ev.dataTransfer.getData("text");
        var elDiana = ev.target;
        var clase = elDiana.getAttribute("class");

        if(clase == null || clase == ""){
            this.appendChild(document.getElementById(id));
        }else if(clase == "pregunta"){
            this.insertBefore(document.getElementById(id),elDiana);
        }else{
            this.insertBefore(document.getElementById(id),elDiana.parentNode);
        }
        ev.stopPropagation();
    }

    contenedorPos.ondrop = function(ev){
        ev.preventDefault();
        var elDiana = ev.target;
        var clase = elDiana.getAttribute("class");
        const id = ev.dataTransfer.getData("text");
        if(clase == null || clase == ""){
            this.appendChild(document.getElementById(id));
        }else if(clase == "pregunta"){
            this.insertBefore(document.getElementById(id),elDiana);
        }else{
            this.insertBefore(document.getElementById(id),elDiana.parentNode);
        }
        ev.stopPropagation();

    }

    guardar.onclick = function(ev){
        ev.preventDefault();
        if(descripcion.value !="" && duracion.value !="" && preg_examen !=""){
            var descrip = descripcion.value;
            var dur = duracion.value;
            var preguntas = new Array();
            for(let i=0; i<preg_examen.length; i++){
                preguntas.push(preg_examen[i].id.substr(5,6));
            }
            var datos = encodeURI("guardar=guardar&descripcion="+descrip+"&duracion="+dur+"&id_preguntas="+preguntas+"&n_preguntas="+preguntas.length);

            const ajax = new XMLHttpRequest();
            ajax.open("POST", "altaExamen.php");
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send(datos);

            //Recargamos la página de nuevo para limpiar los datos

            //window.location="altaExamen.php";
        }

    }



})