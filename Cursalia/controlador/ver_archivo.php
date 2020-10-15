<?php
    /**
     * CONTROLADOR QUE PERMITE LA DESCARGA DE LAS TAREAS
     */
    session_start();
    if($_SESSION['active'] == true){
        if(isset($_GET)){
            $Nombre_Archivo = $_GET['Nom'];
            $Ruta_Archivo   = $_GET['Rut'];
            $basefichero = basename($Nombre_Archivo);
            echo header('Content-Type:'.filetype($Ruta_Archivo . $Nombre_Archivo));
            echo header('Content-Length:'.filesize($Ruta_Archivo . $Nombre_Archivo));
            echo header('Content-Disposition:attachment;filename=' .$basefichero);
            echo readfile($Ruta_Archivo . $Nombre_Archivo);
        }
    }
?>