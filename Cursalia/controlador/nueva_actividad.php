<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA AGREGAR NUEVA ACTIVIDAD.
     */
    session_start();

    if($_SESSION['active'] == true){
      require_once "conexion.php";
      /**
       * NOTA IMPORTANTE: Este controlador debe obtener de distinta manera el idGrado,
       * porque se planea hacer que las actividades se ingesen desde el curso y no desde
       *  el boton del Side-Nav, (BOTON QUE DEBE SER BORRADO)...
       */

      if (isset($_POST)){
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

          $dated         = date_create($ActividadFec1);
          $datet         = date_create($ActividadTim1);
          $Date_Day      = date_format($dated, 'Y/m/d');
          $Date_Hour     = date_format($datet, 'H:i:s');
          /**
           * Se realiza la consulta para ingresar a
           * Base de Datos la nueva actividad.
           */
          $consulta1 = "INSERT INTO `actividades` 
                          (`idActividad`, `NombreActividad`, `DescripcionActividad`, `Fecha_Entrega`,
                          `FK_Curso`, `FK_Grado`, `FK_Tipo_Calificacion`)
                        VALUES 
                          (NULL, '$ActividadTit1', '$ActividadDes1', '$Date_Day $Date_Hour', '$ActividadCur1 ', '$ActividadGra1', '$ActividadTiC1');";
          $resultado1 = mysqli_query($conexion, $consulta1);

          /**
           * Se obtiene el id maximo donde el titulo y la descripcion
           * coincidan con el que recien se ingreso, esto se utilizara
           * para ingresar el idActividad en su llave foranea en la 
           * consulta de mas adelante: detalle_actividad.
           */
          $consulta2 = "SELECT
                          MAX(idActividad)
                      FROM
                          `actividades`
                      WHERE
                          `NombreActividad` = '$ActividadTit1'
                      AND
                          `DescripcionActividad` = '$ActividadDes1';";
          $resultado2     = mysqli_query($conexion, $consulta2);
          $columna2       = mysqli_fetch_array($resultado2);
          $idMaxActividad = $columna2['0'];
          /**
           * Se obtienen los alumnos que estan en ese grado,
           * a los cuales se les asignara el detalle actividad
           * en la proxima consulta.
           */
          $consulta3 = "SELECT
                          *
                        FROM
                          `usuarios`
                        WHERE
                          `FK_Rol` = 3
                        AND 
                          `FK_Grado` = ".$_POST['Grado1'].";";
          $resultado3     = mysqli_query($conexion, $consulta3);
          /**
           * Ciclo que recorre el array de alumnos con la FK_Grado recogida
           * anteriormente, para que luego segun el $idMaxActividad que recogimos,
           * ingrese una consulta por cada alumno que recibe clases en X Grado.
           */
          while ($columna3 = mysqli_fetch_array($resultado3)){
              $Q_DetalleAlumno = "SELECT idDetalle_Alumno 
                                  FROM detalle_alumno 
                                  WHERE FK_Usuario = '".$columna3['0']."';";
              $ResDetAlu       = mysqli_query($conexion, $Q_DetalleAlumno);
              $idDetalleAlumno = mysqli_fetch_row($ResDetAlu);

              $consulta4 = "INSERT INTO `detalle_actividades` 
                              (`idDetalleActividad`, 
                               `Estado_Entrega`, 
                               `Estado_Calificacion`, 
                               `Calificacion`, 
                               `FK_Actividad`, 
                               `FK_Usuario`, 
                               `FK_Archivos`,
                               `FK_DetalleAlumno`) 
                            VALUES 
                              (NULL, 'No Entregado', 'Sin Calificar', '0', '$idMaxActividad', '".$columna3['0']."', '1', '".$idDetalleAlumno['0']."');";
              $resultado4 = mysqli_query($conexion, $consulta4);
          }

          /**
           * Nos redirige al menu y cerramos la conexion :3
           */
          if ($resultado3){
              mysqli_close($conexion);
              header('Location: ../menu?alert_success=<p class="msg_success">Actividad Ingresada con Exito... :)</p>');
          }else{
              mysqli_close($conexion);
              header('Location: ../menu?alert_null_pointer=<p class="msg_error_permissions">La actividad no pudo ser ingresada... :(</p>');
          }
      }
    }else{
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>