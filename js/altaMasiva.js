window.addEventListener("load", function(){
    const fichero = document.getElementById("archivoTexto").addEventListener("change", abrirArchivo);
    const txtAlta = document.getElementById("contenido");
    const btAceptar = document.getElementById("btAceptar");
    const form = document.getElementsByClassName("masiva");


    function abrirArchivo(evento){
        var archivo = evento.target.files[0];
        var reader = new FileReader();
        reader.onload = function(ev){
            var contenido = ev.target.result;
            var arrayLineas = lineasCSV(contenido);

            //Recorremos el array y pintamos en el textArea cada una de sus filas
            arrayLineas.forEach(fila => {
                for(let i=0; i<fila.length; i++){

                    //Si llegamos al último elemento del array, añadimos , y un salto de línea
                    if(fila.length == i+1){
                        txtAlta.value += fila[i] + "\n";
                    //Si no, tan solo añadimos , separando los campos
                    } else {
                        txtAlta.value += fila[i] + ",";
                    }
                }
            });
        };
        reader.readAsText(archivo);

    }

    function lineasCSV(contenido){
        //Array con las distintas filas del fichero
        var lineas = contenido.replace(/\r/g, '').split("\n");
        var resultado = []

        //Evitamos que tenga en cuenta la última línea
        for (let i=0; i<lineas.length-1; i++){
            var texto =[];
            var lineaActual = lineas[i].split(";");
            for(let j=0; j<lineaActual.length; j++){
                texto.push(lineaActual[j]);
            }
            resultado.push(texto);
        }
        return resultado;

    }

    btAceptar.onclick = function(){
        var contenido = document.getElementById("contenido").value;
        var lineas = contenido.split("\n");

        var datos = encodeURI("datos="+contenido);

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "altaMasivaUsuarios.php");
        ajax.onreadystatechange = function () {
            if (ajax.readyState != 4 || ajax.status != 200) {
                return alert("Success: Email registrados correctamente");
            }
        };
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send(datos);


        var errores = [];

        for(let i=0; i<lineas.length-1; i++){
            if(!(/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(lineas[i]))){
                errores.push(lineas[i]);
            }
        }

        var contenido = document.getElementById("contenido").value="";

        if(errores.length !=0) {
            for(let i=0; i<errores.length; i++){
                txtAlta.value += errores[i]+"\n";
            }

            var mensaje = document.getElementById("mensaje");
            mensaje.setAttribute("class", "");
        }

    }


})

