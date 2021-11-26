<?php
//Cuando php se encuentra una linea en la que se hace llamada a una clase, se ejecuta este codigo (autocarga)
spl_autoload_register(function($clase)
{
    //$fichero busca la ruta
    $fichero=$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/')).'/Clases/'.$clase.'.php';
    if(file_exists($fichero))
    {
        require_once $fichero;
    }
});

//Cuando queramos llamarlos tan solo: require(".cargadores/cargarclases.php")

?>

