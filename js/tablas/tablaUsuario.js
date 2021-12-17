window.addEventListener("load", function(){
    const tabla = document.getElementById("cuerpo");
    const paginador = document.getElementById("paginador");
    var pagina = 1;

    pedirDatosJson(pagina);
    pintarPaginador();

    function pedirDatosJson(pagina){
        //Cogemos los datos del servidor
        fetch("pedirDatosJson.php?tabla=usuario&pagina="+pagina+"&filas=4", {
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


            columna1.innerHTML = elemento.id;
            columna2.innerHTML = elemento.nombre + ", " + elemento.apellidos;
            columna3.innerHTML = elemento.email;
            columna4.innerHTML = elemento.rol;

            //Botón editar
            var btEditar = document.createElement("i");
            btEditar.setAttribute("class", "far fa-edit");
            btEditar.onclick = editarFila;

            //Botón borrar
            var btBorrar = document.createElement("i");
            btBorrar.setAttribute("class", "far fa-trash-alt");
            btBorrar.onclick = borrarFila;

            columna5.appendChild(btEditar);
            columna5.appendChild(btBorrar);


            tabla.appendChild(fila);
            fila.appendChild(columna1);
            fila.appendChild(columna2);
            fila.appendChild(columna3);
            fila.appendChild(columna4);
            fila.appendChild(columna5);

        });
    }


    /*Método borrarFila()
    Método para eliminar una fila de la tabla*/
    function borrarFila(){
        var fila = this.parentElement.parentElement;
        var id = fila.children[0].textContent;

        var formData = new FormData();
        formData.append("borrarUsuario", id);

        fetch("recibeDatos.php", {
            method: "POST",
            body: formData
        }).catch(error => console.error("Error", error))
        .then(response =>{

            if(response.ok){
                fila.parentElement.removeChild(fila);
                alert("Usuario borrado correctamente");
                window.location="tablaUsuarios.php";
            } else {
                alert("Error al borrar el usuario");

            }
        })
    }

    //Método editarFila() Método para modificar los datos de la tabla.
    function editarFila(){
        var fila = this.parentElement.parentElement;
        var contenedor=document.createElement("div");
        var td =this.parentElement;
        fila.contenedor=contenedor;
        contenedor.appendChild(td.children[0]);
        contenedor.appendChild(td.children[0]);

        var tds=fila.children;
        for (let i=0; i<tds.length-1; i++){
            var contenido = tds[i].innerText;
            tds[i].setAttribute("valor",contenido);
            if(i == 1){
                var input=document.createElement("input");
                input.type="text";
                input.value=contenido;
                tds[i].removeChild(tds[i].childNodes[0]);
                tds[i].appendChild(input);
            } else {
                var input=document.createElement("input");
                input.type="text";
                input.setAttribute("readonly", true);
                input.value=contenido;
                tds[i].removeChild(tds[i].childNodes[0]);
                tds[i].appendChild(input);
            }

        }

        //Creamos los botones Cancelar/Guardar y les damos funcionalidad
        var btCancelar = document.createElement("i");
        btCancelar.setAttribute("class", "far fa-window-close");
        btCancelar.onclick = cancelarModificacion;

        var btGuardar = document.createElement("i");
        btGuardar.setAttribute("class", "far fa-save");
        btGuardar.onclick = guardarModificacion;

        td.appendChild(btCancelar);
        td.appendChild(btGuardar);
    }

    /*Método cancelarModificacion()
    Método para cancelar las modificaciones realizadas en los campos*/
    function cancelarModificacion(){
        var fila = this.parentElement.parentElement;
        var columna = this.parentElement;
        var columnas = fila.children;

        for(let i=0; i<columnas.length-1; i++){
            var valor = columnas[i].getAttribute("valor");
            columnas[i].innerHTML = valor;
        }
        columna.innerHTML = "";
        columna.appendChild(fila.contenedor.children[0]);
        columna.appendChild(fila.contenedor.children[0]);
    }

    /*Método guardarModificacion
    Método que permite guardar los cambios realizados en los campos*/
    function guardarModificacion(){
        var fila =  this.parentElement.parentElement;
        var columna = this.parentElement;
        var columnas = fila.children;

        //Validamos los datos
        var respuestas = [];
        respuestas.push((columnas[1].children[0].value != "")? true:false);

        if(respuestas.every(function(valor, indice){return valor})){
            for(let i=0; i<columnas.length-1; i++){
                let valor = columnas[i].children[0].value;
                columnas[i].innerHTML = valor;
            }
            columna.innerHTML="";
            columna.appendChild(fila.contenedor.children[0]);
            columna.appendChild(fila.contenedor.children[0]);
        }

        var id = columnas[0].textContent;
        var nombre = columnas[1].textContent;

        var formData = new FormData();
        formData.append("modificaUsuario", id);
        formData.append("valor", nombre);
        fetch("recibeDatos.php", {
            method: "POST",
            body: formData
        }).catch(error => console.error("Error", error))
        .then(response =>{
            if(response.ok){
                alert("Usuario modificado correctamente");
                window.location="tablaUsuarios.php";
            } else {
                alert("Error al modificar usuario");

            }
        })
    }

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