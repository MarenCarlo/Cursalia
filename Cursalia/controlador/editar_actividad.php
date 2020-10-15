<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA EDITAR UNA ACTIVIDAD.
     */
    session_start();

    if($_SESSION['active'] == true){
      require_once "conexion.php";
      /**
       * NOTA IMPORTANTE: Este controlador debe obtener de distinta manera el idGrado,
       * porque se planea hacer que las actividades se ingesen desde el curso y no desde
       *  el boton del Side-Nav, (BOTON QUE DEBE SER BORRADO)...
       */
      if (isset($_POST['Actividad'])){
          /**
           * Se obtienen los datos desde el post enviado, con las respectivas
           * variables y utilizando real string por seguridad.
           */
          $ActividadTit1 = mysqli_real_escape_string($conexion,$_POST['ActTitle1']);
          $ActividadTiC1 = mysqli_real_escape_string($conexion,$_POST['ActTipoCal1']);
          $ActividadDes1 = mysqli_real_escape_string($conexion,$_POST['ActDescrip1']);
          $ActividadFec1 = mysqli_real_escape_string($conexion,$_POST['ActFechaEnt1']);
          $ActividadTim1 = mysqli_real_escape_string($conexion,$_POST['ActTimeEnt1']);
          $ActividadCur1 = mysqli_real_escape_string($conexion,$_POST['Curso1']);
          $ActividadGra1 = mysqli_real_escape_string($conexion,$_POST['Grado1']);
          $ActividadIde1 = mysqli_real_escape_string($conexion,$_POST['Actividad']);

          $dated         = date_create($ActividadFec1);
          $datet         = date_create($ActividadTim1);
          $Date_Day      = date_format($dated, 'Y/m/d');
          $Date_Hour     = date_format($datet, 'H:i:s');
          /**
           * Se realiza la consulta para ingresar a
           * Base de Datos la nueva actividad.
           */
          $Q_UpdateActivity = "UPDATE 
                                    `actividades` 
                                SET 
                                    `NombreActividad` = '$ActividadTit1', 
                                    `DescripcionActividad` = '$ActividadDes1', 
                                    `Fecha_Entrega` = '$Date_Day $Date_Hour', 
                                    `FK_Tipo_Calificacion` = '$ActividadTiC1'
                                WHERE `actividades`.`idActividad` = $ActividadIde1;";
          $resultado1 = mysqli_query($conexion, $Q_UpdateActivity);

          /**
           * Nos redirige al menu y cerramos la conexion :3
           */
          if ($resultado1){
              mysqli_close($conexion);
              header('Location: ../menu?alert_success=<p class="msg_success">Actividad Editada con Exito... :)</p>');
          }else{
              mysqli_close($conexion);
              header('Location: ../menu?alert_null_pointer=<p class="msg_error_permissions">La actividad no pudo ser editada... :(</p>');
          }
      }
    }else{
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>