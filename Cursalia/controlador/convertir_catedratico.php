<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA HACER A UN USUARIO ADMINISTRADOR, UN CATEDRATICO.
     */
    session_start();
    if($_SESSION['active'] == true){
        require_once "conexion.php";
        if (isset($_GET['user'])){
            $idUser     = mysqli_real_escape_string($conexion,$_GET['user']);
            $Q_DataUser = "SELECT * FROM `usuarios` WHERE idUsuario = $idUser";
            $resultado1 = mysqli_query($conexion, $Q_DataUser);
            $RowData1   = mysqli_fetch_row($resultado1);

            if($RowData1['12'] != 1){
                $Q_UpdateState = "UPDATE 
                                        `usuarios`
                                    SET 
                                        `FK_Rol` = '2' 
                                    WHERE `usuarios`.`idUsuario` = $idUser;";
                $resultado3 = mysqli_query($conexion, $Q_UpdateState);
                if (mysqli_affected_rows($conexion)>0){
                    mysqli_close($conexion);
                    header('Location: ../menu_direccion.php');
                }else{
                    mysqli_close($conexion);
                    header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">No se pudo Activar al Usuario... :(</p>');
                }
            } else {
                mysqli_close($conexion);
                header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">No se pudo convertir en Catedratico al Usuario, por que este es el Jefe Maestro de Cursalia... :(</p>');
            }
        } else {
            mysqli_close($conexion);
            header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">no se recibio un identificador de usuario... :(</p>');
        }
    } else {
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>