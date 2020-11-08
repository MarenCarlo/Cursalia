<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA AGREGAR ARCHIVOS DE CONTENIDOS A UN CURSO.
     */
    session_start();
    if($_SESSION['active'] == true){
        $UserNick1  = $_SESSION['User1'];
        $FK_Usuario1 = $_SESSION['idUsuario1'];
        if(isset($_POST['ContentCurs'])){
            require_once 'conexion.php';
            /**
             * Meta-Data del archivo correspondiente a subir...
             */
            $Nombre_File_Enc = $FK_Usuario1."-".$UserNick1."-".$_FILES['ContentFile']['name'];
            $Size_File1      = $_FILES['ContentFile']['size'];
            $Type_File1      = $_FILES['ContentFile']['type'];
            $Tmp_File1       = $_FILES['ContentFile']['tmp_name'];
            $FK_Usuario1     = $_SESSION['idUsuario1'];
            $FK_Curso1       = mysqli_real_escape_string($conexion, trim($_POST['ContentCurs']));
            $Titulo_Cont     = mysqli_real_escape_string($conexion, trim($_POST['ContentTit1'])); 
            $Descrip_Cont    = mysqli_real_escape_string($conexion, trim($_POST['ContentDesc1'])); 
            
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
                    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/cursalia/media/archivos_contenidos/';
                    move_uploaded_file($Tmp_File1 ,$carpeta_destino.$Nombre_File_Enc);

                    /**
                     * Consulta que Guarda el archivo en el directorio, junto con su
                     * respectivo nombre y demas datos especificados en la consulta...
                     */
                    $SQL1 = "INSERT INTO 
                                `archivos_contenidos` 
                                    (`idContenido`, 
                                    `Nombre_Contenido`, 
                                    `Ruta_Contenido`, 
                                    `Tipo_Contenido`, 
                                    `URL_Contenido`, 
                                    `Titulo_Contenido`, 
                                    `Descripcion_Contenido`, 
                                    `FK_Curso`, 
                                    `FK_Usuario`) 
                            VALUES 
                                (NULL, '$Nombre_File_Enc', '$carpeta_destino', 'Archivo', NULL, 
                                '$Titulo_Cont', '$Descrip_Cont', '$FK_Curso1', '$FK_Usuario1')";

                    $resultado1 = mysqli_query($conexion, $SQL1);

                    /**
                     * Condicional que nos valida si la fila afectada es mayor que cero,
                     * es decir que si mas de una fila fue afectada en la tabla de MySql
                     * haga lo respectivo adentro de la misma.
                     */
                    if(mysqli_affected_rows($conexion)>0){
                        //agregar alerta!
                        $conexion->close();
                        header('Location: ../menu.php?alert_success=<p class="msg_success">Contenido Agregado con Exito... :)</p>');                    
                    } else {
                        /**
                         * Controles de errores varios ;)
                         */
                        $conexion->close();
                        header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">Ha habido un error al insertar el archivo en Base de Datos... :(</p>');
                    }
                } else {
                    //echo '<p>el archivo no es compatible</p>';
                    $conexion->close();
                    header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">Este tipo de Archivo no es permitido por el servidor... :(</p>');
                }
            }
            if($Size_File1 > 5000000){
                //echo '<p>el archivo es mayor de 5MB</p>';
                header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">El Archivo excede el limite permitido por el servidor, este es de 5MB... :(</p>');
            }
        }
    }else{
        header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>