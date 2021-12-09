window.addEventListener("load", function(){
    const tabla = document.getElementById("cuerpo");
    const paginador = document.getElementById("paginador");
    var pagina = 1;

    pedirDatosJson(pagina);
    pintarPaginador();

    function pedirDatosJson(pagina){
        //Cogemos los datos del servidor
        fetch("pedirDatosJson.php?tabla=examen&pagina="+pagina+"&filas=4", {
            method:"GET"
        }).then(response => response.json())
        .catch(error => console.error("Error", error))
        .then(response =>{
            pintarTabla(response);
        })
    }


    function pintarTabla(objetoAlumno){
        objetoAlumno.forEach(elemento => {
            var fila = document.createElement("tr");

            var columna1 = document.createElement("td");
            var columna2 = document.createElement("td");
            var columna3 = document.createElement("td");
            var columna4 = document.createElement("td");
            var columna5 = document.createElement("td");
            var columna6 = document.createElement("td");


            columna1.innerHTML = elemento.id;
            columna2.innerHTML = elemento.descripcion;
            columna3.innerHTML = elemento.n_preguntas;
            columna4.innerHTML = elemento.duracion;
            if(elemento.activo == "1"){
                columna5.innerHTML = "Si"
            } else {
                columna5.innerHTML = "No"
            }

            //Botón editar
            var btEditar = document.createElement("span");
            btEditar.innerHTML = "Editar";
            btEditar.style.textDecoration = "underline";
            btEditar.onclick = editarFila;
            //Botón desactivar
            var btDesactivar = document.createElement("span");
            btDesactivar.innerHTML = " Desactivar ";
            btDesactivar.style.textDecoration = "underline";
            btDesactivar.onclick = desactivarFila;

            //Botón borrar
            var btBorrar = document.createElement("span");
            btBorrar.innerHTML = "Borrar";
            btBorrar.style.textDecoration = "underline";
            btBorrar.onclick = borrarFila;

            columna6.appendChild(btEditar);
            columna6.appendChild(btDesactivar);
            columna6.appendChild(btBorrar);


            tabla.appendChild(fila);
            fila.appendChild(columna1);
            fila.appendChild(columna2);
            fila.appendChild(columna3);
            fila.appendChild(columna4);
            fila.appendChild(columna5);
            fila.appendChild(columna6);

        });
    }


    function borrarFila(){}

    function editarFila(){}

    function desactivarFila(){}

    function pintarPaginador(){

        for(let i=0; i<7; i++){
            var btPagina = document.createElement("input");
            btPagina.type ="button";

            if(i == 0){
                btPagina.value = "<<";
            } else if(i == 6){
                btPagina.value = ">>";
            } else {
                btPagina.value = i;
            }
            btPagina.onclick = function(){

                var filasTabla = tabla.getElementsByTagName("tr");
                var totalFilas = filasTabla.length;
                for(let i=totalFilas-1; i>=0; i--){
                    tabla.removeChild(filasTabla[i]);
                }

                if(this.value == "<<" || this.value == "1"){
                    pagina = 1;
                    pedirDatosJson(pagina);
                } else if(this.value == ">>"){
                    pagina = 5;
                    pedirDatosJson(pagina);
                } else {
                    pagina = this.value;
                    pedirDatosJson(pagina);
                }

            }

            paginador.appendChild(btPagina);
        }


    }

})