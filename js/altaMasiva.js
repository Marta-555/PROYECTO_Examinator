window.addEventListener("load", function(){
    const fichero = document.getElementById("archivoTexto").addEventListener("change", abrirArchivo);
    const txtAlta = document.getElementById("contenido");


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


})

