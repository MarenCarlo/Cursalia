<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA ACTIVAR UN USUARIO.
     */
    session_start();
    if($_SESSION['active'] == true){
        require_once "conexion.php";
        if (isset($_GET['user'])){
            $idUser     = mysqli_real_escape_string($conexion,$_GET['user']);

            $Q_UpdateState = "UPDATE 
                                    `usuarios`
                                SET 
                                    `Estado` = 'Activo' 
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
            header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">no se recibio un identificador de usuario... :(</p>');
        }
    } else {
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>