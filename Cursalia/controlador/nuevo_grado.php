<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA AGREGAR UN NUEVO GRADO.
     */
    session_start();
    if($_SESSION['active'] == true){
        if(isset($_POST)){
            if(empty($_POST['GraCode'])    || empty($_POST['GraNivel'])  ||
               empty($_POST['GraJornada']) || empty($_POST['GraSeccion'])||
               empty($_POST['GraNombre'])  || empty($_POST['GraDescrip'])){
                header('Location: ../agregar_grado.php?alert_null_pointer=<p class="msg_error_permissions">Todos los campos son obligatorios.</p>');
            } else {
                require_once 'conexion.php';
                $CodigGrado = mysqli_real_escape_string($conexion,$_POST['GraCode']);
                $NivelGrado = mysqli_real_escape_string($conexion,$_POST['GraNivel']);
                $JornaGrado = mysqli_real_escape_string($conexion,$_POST['GraJornada']);
                $SecciGrado = mysqli_real_escape_string($conexion,$_POST['GraSeccion']);
                $NombrGrado = mysqli_real_escape_string($conexion,$_POST['GraNombre']);
                $DescrGrado = mysqli_real_escape_string($conexion,$_POST['GraDescrip']);
                /**
                 * las siguientes lineas son para revisar en la Base de Datos
                 * si ese codigo ya ha sido registrado anteriormente
                 */
                $Query_Code = mysqli_query($conexion, "SELECT Codigo_Grado FROM Grados WHERE Codigo_Grado = '$CodigGrado';");
                $RowCodeExi = mysqli_fetch_row($Query_Code);
                if($RowCodeExi >= 1){
                    /**
                     * si el codigo existe redirige y envia la alerta de que ya existe...
                     */
                    header('Location: ../agregar_grado.php?alert_null_pointer=<p class="msg_error_permissions">Ese codigo ya fue agregado con anterioridad a un grado existente... :(</p>');
                } else {
                    /**
                     * si el codigo no existe en la base de datos,
                     * se procede a ver si no existe un grado previamente ingresado
                     * con todos los datos recogidos en el POST.
                     */
                    $Query_DataG = mysqli_query($conexion, "SELECT 
                                                                NombreGrado, Descripcion, FK_Seccion, FK_Jornada, FK_Nivel_Estudiantil
                                                            FROM 
                                                                Grados 
                                                            WHERE
                                                                NombreGrado = '$NombrGrado' 
                                                            AND Descripcion = '$DescrGrado'
                                                            AND FK_Seccion = '$SecciGrado'
                                                            AND FK_Jornada = '$JornaGrado'
                                                            AND FK_Nivel_Estudiantil = '$NivelGrado';");
                    $DataComparator = mysqli_fetch_row($Query_DataG);
                    if($DataComparator >= 1){
                        /**
                         * Si existe un grado con esos datos, se manda la alerta
                         * de que el grado ya existe.
                         */
                        header('Location: ../agregar_grado.php?alert_null_pointer=<p class="msg_error_permissions">Ya hay un grado registrado con esos datos exactos... :(</p>');
                    } else {
                        /**
                         * si esos datos no existen en la Base de Datos, se procede
                         * a hacer el insert de esos mismos para añadir el nuevo grado.
                         */
                        $Q_InsertGrado = mysqli_query($conexion,
                                        "INSERT INTO 
                                            `grados` 
                                        (`idGrado`, `Codigo_Grado`, `NombreGrado`, `Descripcion`, `FK_Seccion`, `FK_Jornada`, `FK_Nivel_Estudiantil`) 
                                            VALUES 
                                        (NULL, '$CodigGrado', '$NombrGrado', '$DescrGrado', '$SecciGrado', '$JornaGrado', '$NivelGrado');"
                                    );
                        mysqli_close($conexion);
                        header('location: ../menu.php?alert_success=<p class="msg_success">El Grado (' . $CodigGrado . '), fue Agregado con Exito... :)</p>');
                    }
                }
            }
        }
    } else {
        header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>