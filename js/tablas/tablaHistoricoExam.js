window.addEventListener("load", function(){
    const tabla = document.getElementById("cuerpo");
    const paginador = document.getElementById("paginador");
    var pagina = 1;

    pedirDatosJson(pagina);
    pintarPaginador();

    function pedirDatosJson(pagina){
        //Cogemos los datos del servidor
        fetch("pedirDatosJson.php?tabla=historicoExam&pagina="+pagina+"&filas=4", {
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

            columna1.innerHTML = elemento.fecha;
            columna2.innerHTML = elemento.calificacion;

            //Botón Revisar
            var btRevisar = document.createElement("span");
            btRevisar.innerHTML = "Revisar";
            btRevisar.style.textDecoration = "underline";
            btRevisar.onclick = revisar;

            columna3.appendChild(btRevisar);


            tabla.appendChild(fila);
            fila.appendChild(columna1);
            fila.appendChild(columna2);
            fila.appendChild(columna3);

        });
    }


    function revisar(){}

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