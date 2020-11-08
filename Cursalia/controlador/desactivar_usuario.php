<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA DESACTIVAR UN USUARIO.
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
                if($RowData1['10'] == 1){
                    $Q_AdminUser = "SELECT COUNT(idUsuario) FROM `usuarios` WHERE FK_Rol = 1 AND Estado = 'Activo';";
                    $resultado2  = mysqli_query($conexion, $Q_AdminUser);
                    $RowData2    = mysqli_fetch_row($resultado2);
                    if ($RowData2['0'] > 1){
                        $Q_UpdateState = "UPDATE 
                                            `usuarios`
                                        SET 
                                            `Estado` = 'Inactivo' 
                                        WHERE `usuarios`.`idUsuario` = $idUser;";
                        $resultado1 = mysqli_query($conexion, $Q_UpdateState);
                        mysqli_close($conexion);
                        header('Location: ../menu_direccion.php');
                    } else {
                        mysqli_close($conexion);
                        header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">No se pudo desactivar este usuario Administrador, por que ya solo queda un usuario con este Rol... :(</p>');
                    }
                }
                if($RowData1['10'] == 2 || $RowData1['10'] == 3){
                    $Q_UpdateState = "UPDATE 
                                            `usuarios`
                                        SET 
                                            `Estado` = 'Inactivo' 
                                        WHERE `usuarios`.`idUsuario` = $idUser;";
                    $resultado3 = mysqli_query($conexion, $Q_UpdateState);
                    if (mysqli_affected_rows($conexion)>0){
                        mysqli_close($conexion);
                        header('Location: ../menu_direccion.php');
                    }else{
                        mysqli_close($conexion);
                        header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">No se pudo desactivar al Usuario... :(</p>');
                    }
                }
            } else {
                mysqli_close($conexion);
                header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">No se pudo desactivar al Usuario, por que este es el Jefe Maestro de Cursalia... :(</p>');
            }
        } else {
            mysqli_close($conexion);
            header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">no se recibio un identificador de usuario... :(</p>');
        }
    } else {
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>