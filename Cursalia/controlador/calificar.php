<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA CALIFICAR LAS TAREAS ENTREGADAS.
     */
    session_start();
    if($_SESSION['active'] == true){
        $FK_Usuario1  = $_SESSION['idUsuario1'];

        if(isset($_POST)){
            require_once 'conexion.php';
            /**
             * Se obtienen del POST las variables de calificacion 
             * y detalle de la actividad 
             */
            $Calificacion1  = mysqli_real_escape_string($conexion, trim($_POST['calificacion1'])); 
            $idDetalleAct1 = mysqli_real_escape_string($conexion, trim($_POST['idDetalleAct1']));

            /**
             * Condicional que valida si la calificacion es mayor
             * o igual que 100.
             */
            if($Calificacion1 >= 100){
                /**
                 * Se setea automaticamente en la variable como un
                 * entero con el valor de 100.
                 */
                $Calificacion1 = 100;
                /**
                 * Consulta que nos ayuda a cambiar el estado de la entrega
                 * de "No Calificado" a "Calificado" y la calificacion de 0
                 * a la cantidad que el catedratico nos haya indicado con el
                 * POST
                 */
                $SQL1 = "UPDATE 
                            `detalle_actividades` 
                        SET 
                            `Estado_Calificacion` = 'Calificada', 
                            `Calificacion` = '$Calificacion1' 
                        WHERE 
                            `detalle_actividades`.`idDetalleActividad` = $idDetalleAct1";
                $resultado1 = mysqli_query($conexion, $SQL1);

                if(mysqli_affected_rows($conexion)>0){
                    echo 'La tarea ha sido calificada con exito!';
        
                    $conexion->close();
                    header('Location: ../menu?alert_success=<p class="msg_success">Actividad Calificada con Exito :)... :)</p>'); 
                }else{
                    echo '<br> error 32: Ha habido un error al insertar el archivo en el servidor';
                    $conexion->close();
                }
                
            /**
             * Condicional que valida si la calificacion es menor
             * o igual que 0.
             */
            }else if($Calificacion1 <= 0){
                /**
                 * Se setea automaticamente en la variable como un
                 * entero con el valor de 0.
                 */
                $Calificacion1 = 0;
                /**
                 * Consulta que nos ayuda a cambiar el estado de la entrega
                 * de "No Calificado" a "Calificado" y la calificacion de 0
                 * a la cantidad que el catedratico nos haya indicado con el
                 * POST
                 */
                $SQL1 = "UPDATE 
                            `detalle_actividades` 
                        SET 
                            `Estado_Calificacion` = 'Calificada', 
                            `Calificacion` = '$Calificacion1' 
                        WHERE 
                            `detalle_actividades`.`idDetalleActividad` = $idDetalleAct1";
                $resultado1 = mysqli_query($conexion, $SQL1);

                if(mysqli_affected_rows($conexion)>0){
                    echo 'La tarea ha sido calificada con exito!';
        
                    $conexion->close();
                    header('Location: ../menu?alert_success=<p class="msg_success">Actividad Calificada con Exito :)... :)</p>');     
                }else{
                    echo '<br> error 32: Ha habido un error al calificar la tarea!';
                    $conexion->close();
                }
            /**
             * condicional que nos coloca el numero exacto que el Catedratico ingreso en
             * el POST si no es mayor que 100, ni menor que 0.
             */
            }else{
                /**
                 * Consulta que nos ayuda a cambiar el estado de la entrega
                 * de "No Calificado" a "Calificado" y la calificacion de 0
                 * a la cantidad que el catedratico nos haya indicado con el
                 * POST
                 */
                $SQL1 = "UPDATE 
                            `detalle_actividades` 
                        SET 
                            `Estado_Calificacion` = 'Calificada', 
                            `Calificacion` = '$Calificacion1' 
                        WHERE 
                            `detalle_actividades`.`idDetalleActividad` = $idDetalleAct1";
                $resultado1 = mysqli_query($conexion, $SQL1);

                if(mysqli_affected_rows($conexion)>0){
                    echo 'La tarea ha sido calificada con exito!';
        
                    $conexion->close();
                    header('Location: ../menu?alert_success=<p class="msg_success">Actividad Calificada con Exito :)... :)</p>');                    
                }else{
                    echo '<br> error 32: Ha habido un error al calificar la tarea!';
                    $conexion->close();
                }
            }
        }
    }else{
        header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>