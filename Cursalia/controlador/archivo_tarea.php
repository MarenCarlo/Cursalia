<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA AGREGAR ARCHIVOS DE TAREAS DE ACTIVIDADES.
     */
    session_start();
    if($_SESSION['active'] == true){
        if(isset($_POST['Activity'])){
            require_once 'conexion.php';
            /**
             * Meta-Data del archivo correspondiente a subir...
             */
            $Nombre_File_Enc = $_FILES['BFile1']['name'];
            $Size_File1      = $_FILES['BFile1']['size'];
            $Type_File1      = $_FILES['BFile1']['type'];
            $Tmp_File1       = $_FILES['BFile1']['tmp_name'];
            $FK_Usuario1     = mysqli_real_escape_string($conexion,$_SESSION['idUsuario1']);
            $FK_Usuario1     = $_SESSION['idUsuario1'];
            $FK_DetalleAct1  = mysqli_real_escape_string($conexion, trim($_POST['Activity'])); 
            
            if($Size_File1 <= 5000000){
                /**
                 * Condicional que valida el tamaño del archivo
                 * En este caso son 5MB o 5,000,000 de bytes. 
                 */
                if(
                    /**
                     * Tipos de extensiones MIME de imagenes...
                     */
                       $Type_File1 == 'image/jpeg'//.jpeg
                    || $Type_File1 == 'image/jpg'//.jpg
                    || $Type_File1 == 'image/png'//.png
                    /**
                     * Tipos de extensiones MIME de documentos Microsoft Word...
                     */
                    || $Type_File1 == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'//.docx
                    || $Type_File1 == 'application/vnd.openxmlformats-officedocument.wordprocessingml.template'//.dotx
                    || $Type_File1 == 'application/vnd.ms-word.document.macroEnabled.12'//.docm
                    || $Type_File1 == 'application/vnd.ms-word.template.macroEnabled.12'//.dotm
                    || $Type_File1 ==  'application/msword'//.doc, .dot
                    /**
                     * Tipos de extensiones MIME de documentos Microsoft Excel...
                     */
                    || $Type_File1 == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'//.xlsx
                    || $Type_File1 == 'application/vnd.openxmlformats-officedocument.spreadsheetml.template'//.xltx
                    || $Type_File1 == 'application/vnd.ms-excel.sheet.macroEnabled.12'//.xlsm
                    || $Type_File1 == 'application/vnd.ms-excel.template.macroEnabled.12'//.xltm
                    || $Type_File1 == 'application/vnd.ms-excel.addin.macroEnabled.12'//.xlam
                    || $Type_File1 == 'application/vnd.ms-excel.sheet.binary.macroEnabled.12'//.xlsb
                    || $Type_File1 == 'application/vnd.ms-excel'//.xls, .xlt, .xla
                    /**
                    * Tipos de extensiones MIME de documentos Microsoft Power Point...
                    */
                    || $Type_File1 == 'application/vnd.openxmlformats-officedocument.presentationml.presentation'//.pptx
                    || $Type_File1 == 'application/vnd.openxmlformats-officedocument.presentationml.template'//.potx
                    || $Type_File1 == 'application/vnd.openxmlformats-officedocument.presentationml.slideshow'//.ppsx
                    || $Type_File1 == 'application/vnd.ms-powerpoint.addin.macroEnabled.12'//.ppam
                    || $Type_File1 == 'application/vnd.ms-powerpoint.presentation.macroEnabled.12'//.pptm
                    || $Type_File1 == 'application/vnd.ms-powerpoint.template.macroEnabled.12'//.potm
                    || $Type_File1 == 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12'//.ppsm
                    || $Type_File1 == 'application/vnd.ms-powerpoint'//.ppt, .pot, .pps, .ppa
                    /**
                     * Tipo de Extension MIME de documento PDF...
                     */
                    || $Type_File1 == 'application/pdf'//.pdf
                    /**
                     * Tipo de Extension MIME de documentos comprimidos...
                     */
                    || $Type_File1 == 'application/rar'//.zip
                    || $Type_File1 == 'application/x-rar-compressed'//.rar
                    || $Type_File1 == 'application/zip'//.zip
                    || $Type_File1 == 'application/x-zip-compressed'//.zip
                    || $Type_File1 == 'multipart/x-zip'//.zip
                    || $Type_File1 == 'application/x-7z-compressed'//.7z
                    || $Type_File1 == 'application/gzip'//.gzip
                ){
                    /**
                     * Se fija la carpeta destino en donde se almacenaran los datos.
                     */
                    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/cursalia/media/archivos_tareas/';
                    move_uploaded_file($Tmp_File1 ,$carpeta_destino.$Nombre_File_Enc);
                    echo $_FILES['BFile1']['error'];

                    /**
                     * Consulta que Guarda el archivo en el directorio, junto con su
                     * respectivo nombre y demas datos especificados en la consulta...
                     */
                    $SQL1  = "INSERT INTO `archivos_tareas`
                                (`idArchivo`, `NombreArchivo`, `RutaArchivo`, `FK_Usuario`)
                            VALUES 
                                (NULL, '$Nombre_File_Enc', '$carpeta_destino', '$FK_Usuario1');";
                    $resultado1 = mysqli_query($conexion, $SQL1);

                    /**
                     * Se Obtiene el id del ultimo archivo agregado por ese usuario,
                     * esto nos servira para agregarlo en la FK_Archivo de la tabla,
                     * detalle_actividades y conectarlo con su respectivo Usuario.
                     */
                    $SQL2 = "SELECT MAX(idArchivo)
                            FROM archivos_tareas
                            WHERE FK_Usuario = $FK_Usuario1
                            AND NombreArchivo = '$Nombre_File_Enc'";
                    $resultado2  = mysqli_query($conexion, $SQL2);
                    $columna2    = mysqli_fetch_array($resultado2);
                    $FK_Archivo1 = $columna2['0'];

                    /**
                     * Se actualiza la tabla detalles_actividades, para colocar el estado
                     * de la actividad como "Entregado" y colocar el Id del archivo de la
                     * Tarea correspondiente subida por el usuario
                     */
                    $SQL3 = "UPDATE `detalle_actividades` 
                        SET `Estado_Entrega` = 'Entregado', `FK_Archivos` = '$FK_Archivo1'  
                        WHERE `detalle_actividades`.`FK_Usuario` = '$FK_Usuario1'
                        AND `detalle_actividades`.`FK_Actividad` = '$FK_DetalleAct1';";
                    $resultado3 = mysqli_query($conexion, $SQL3);

                    /**
                     * Condicional que nos valida si la fila afectada es mayor que cero,
                     * es decir que si mas de una fila fue afectada en la tabla de MySql
                     * haga lo respectivo adentro de la misma.
                     */
                    if(mysqli_affected_rows($conexion)>0){
                        //agregar alerta!
                        $conexion->close();
                        header('Location: ../menu?alert_success=<p class="msg_success">Actividad Entregada con Exito... :)</p>');                    
                    } else {
                        /**
                         * Controles de errores varios ;)
                         */
                        $conexion->close();
                        header('Location: ../menu?alert_null_pointer=<p class="msg_error_permissions">Ha habido un error al insertar el archivo en Base de Datos... :(</p>');
                    }
                } else {
                    //echo '<p>el archivo no es compatible</p>';
                    $conexion->close();
                    header('Location: ../menu?alert_null_pointer=<p class="msg_error_permissions">Este tipo de Archivo no es permitido por el servidor... :(</p>');
                }
            }
            if($Size_File1 > 5000000){
                //echo '<p>el archivo es mayor de 5MB</p>';
                header('Location: ../menu?alert_null_pointer=<p class="msg_error_permissions">El Archivo excede el limite permitido por el servidor, este es de 5MB... :(</p>');
            }
        }
    }else{
        header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>