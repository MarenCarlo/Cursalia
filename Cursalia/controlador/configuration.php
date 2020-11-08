<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA MODIFICAR CONFIGURACIONES
     * VARIAS DE CURSALIA.
     */
    session_start();
    if($_SESSION['active'] == true){
        $Rol1  = $_SESSION['Rol1'];
        require_once "conexion.php";

        /**
         * Si se recibe alguna opcion de cambio del estado de la 
         * plataforma realiza lo siguiente
         */
        if (isset($_POST['customRadioInline1'])){
            $Status_Site    = mysqli_real_escape_string($conexion,$_POST['customRadioInline1']);
            /**
             * El Valor en el IF es de 1 para cambiarlo a modo mantenimiento
             * porque es el valor que llega seleccionado del FORM para colocar
             * el estado de mantenimiento del Sistema.
             */
            if($Status_Site == "1"){
                $Q_StateR = "SELECT (FK_Rol) FROM configuraciones_varias;";
                $Q_SendR  = mysqli_query($conexion,$Q_StateR);           
                $Rol2    = mysqli_fetch_array($Q_SendR);
                if($Rol1 == $Rol2['0']){
                    $Q_UpdateState = "UPDATE 
                                        `configuraciones_varias` 
                                    SET 
                                        `Estado_Plataforma` = 'Mantenimiento' 
                                    WHERE `configuraciones_varias`.`idConfiguracion` = 1;";
                    $resultado3 = mysqli_query($conexion, $Q_UpdateState);
                    if (mysqli_affected_rows($conexion)>0){
                        mysqli_close($conexion);
                        header('Location: ../menu_direccion.php');
                    }else{
                        mysqli_close($conexion);
                        header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">No se pudo cambiar el Estado del Sitio... :(</p>');
                    }
                } else {
                    mysqli_close($conexion);
                    header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">Usted no tiene permiso de realizar estos cambios... :(</p>');
                }
            }
            /**
             * El Valor en el IF es de 0 para cambiarlo a modo Activo
             * porque es el valor que llega seleccionado del FORM para colocar
             * el estado de Activo del Sistema.
             */
            if($Status_Site == "0"){
                $Q_StateR = "SELECT (FK_Rol) FROM configuraciones_varias;";
                $Q_SendR  = mysqli_query($conexion,$Q_StateR);           
                $Rol2    = mysqli_fetch_array($Q_SendR);
                if($Rol1 == $Rol2['0']){
                    $Q_UpdateState = "UPDATE 
                                        `configuraciones_varias` 
                                    SET 
                                        `Estado_Plataforma` = 'Activo' 
                                    WHERE `configuraciones_varias`.`idConfiguracion` = 1;";
                    $resultado3 = mysqli_query($conexion, $Q_UpdateState);
                    if (mysqli_affected_rows($conexion)>0){
                        mysqli_close($conexion);
                        header('Location: ../menu_direccion.php');
                    }else{
                        mysqli_close($conexion);
                        header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">No se pudo cambiar el Estado del Sitio... :(</p>');
                    }
                } else {
                    mysqli_close($conexion);
                    header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">Usted no tiene permiso de realizar estos cambios... :(</p>');
                }
            }
        } else {
            mysqli_close($conexion);
            header('Location: ../menu.php?alert_null_pointer=<p class="msg_error_permissions">no se recibieron datos en el envio de los mismos... :(</p>');
        }
    } else {
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>