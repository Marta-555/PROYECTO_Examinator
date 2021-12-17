window.addEventListener("load", function(){
    const contenedor = document.getElementById("contenedor");
    const btFinalizar = document.getElementById("finaliza");


    pedirDatos();


    function pedirDatos(){
        //Pedimos el json al servidor
        fetch("pedirExamenJson.php", {
            method:"GET"
        }).then (response => response.json())
        .catch(error => console.error("Error", error))
        .then(response =>{
            pintarExamen(response);
        })
    }

    function pintarExamen(objExamen){
        preguntas = objExamen.preguntas;
        id_examen = objExamen.id;

        pintarPreguntas(preguntas);
        pintarPaginador(preguntas);

        btFinalizar.onclick = function(){
            finExamen(id_examen);
        }
    }


    function pintarPreguntas(preguntas){

        for(let i=0; i<preguntas.length; i++){
            var contPregunta = document.createElement("section");
            contPregunta.setAttribute("id", "preg_"+preguntas[i].id_pregunta);

            if(i==0){
                contPregunta.setAttribute("class", "");
            } else {
                contPregunta.setAttribute("class", "oculto");
            }


            var h2 = document.createElement("h2");
            h2.innerText = "Pregunta "+ (i+1);

            var preg = document.createElement("div");
            preg.setAttribute("id", "enunciado");
            preg.innerHTML = preguntas[i].enunciado;

            contPregunta.appendChild(h2);
            contPregunta.appendChild(preg);

            var resp = document.createElement("div");
            resp.setAttribute("id", "respuestas");

            for(let j=0; j<preguntas[i].respuestas.length; j++){
                var p = document.createElement("p");

                var radio = document.createElement("input");
                radio.setAttribute("type", "radio");
                radio.setAttribute("name", "preg_"+preguntas[i].id_pregunta);
                radio.setAttribute("id", "resp_"+preguntas[i].respuestas[j].id);

                radio.ondblclick = function() {
                    if(this.checked == true){
                        this.checked = false;
                    }
                }
                var span = document.createElement("span");
                span.innerText = preguntas[i].respuestas[j].enunciado;

                p.appendChild(radio);
                p.appendChild(span);
                resp.appendChild(p);
                contPregunta.appendChild(resp);
            }
            contenedor.appendChild(contPregunta);
        }
    }

    function pintarPaginador(preguntas){

        var paginador = document.getElementById("paginador");

        for(let i=0; i<preguntas.length; i++){
            var btn = document.createElement("input");
            btn.setAttribute("type", "button");
            btn.setAttribute("id", "preg_"+preguntas[i].id_pregunta);
            btn.setAttribute("value", i+1);

            btn.onclick = function(){
                pasarPregunta(this.id, preguntas);
            }
            paginador.appendChild(btn);
        }
    }

    function pasarPregunta(id, preguntas){

        for(let i=0; i<preguntas.length; i++){
            var pregunts = document.getElementById("preg_"+preguntas[i].id_pregunta);
            pregunts.setAttribute("class", "oculto");

            var boton = document.getElementById("paginador").childNodes[i];
            boton.setAttribute("class", "");
        }

        var pregPulsada = document.getElementById(id);
        pregPulsada.setAttribute("class", "");

        for(let i=0; i<preguntas.length; i++){
            if(id == document.getElementById("paginador").childNodes[i].id){
                var boton = document.getElementById("paginador").childNodes[i];
                boton.setAttribute("class", "marcado");
            }
        }
    }


    function finExamen(id_examen){

        var preguntas = contenedor.children;
        var respuestas = [{"id_examen": id_examen}];

        for(let i=0; i<preguntas.length; i++){

            for(let j=0; j<3; j++){
                if(preguntas[i].children[2].children[j].children[0].checked == true){
                    //Añadir enunciado de la pregunta
                    respuestas.push({"pregunta": preguntas[i].id.substring(5), "respuesta":{"id": preguntas[i].children[2].children[j].children[0].id.substring(5), "enunciado": preguntas[i].children[2].children[j].children[1].textContent}});
                    break;
                }
            }
        }

        var examenjson = JSON.stringify(respuestas);

        var formData = new FormData();
        formData.append("examen", examenjson);

        fetch("entregarExamen.php", {
            method: "POST",
            body: formData
        }).catch(error => console.error("Error", error))
        .then(response =>{

            if(response.ok){
                location.href="indexAlumno.php";
            } else {
                alert("Error al enviar el examen");

            }
        })

    }

})