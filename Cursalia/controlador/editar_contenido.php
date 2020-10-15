<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA EDITAR UN CONTENIDO AGREGADO EN UN CURSO.
     */
    session_start();

    if($_SESSION['active'] == true){
      require_once "conexion.php";
      /**
       * NOTA IMPORTANTE: Este controlador debe obtener de distinta manera el idGrado,
       * porque se planea hacer que las actividades se ingesen desde el curso y no desde
       *  el boton del Side-Nav, (BOTON QUE DEBE SER BORRADO)...
       */
      if (isset($_POST['IdContent'])){
          /**
           * Se obtienen los datos desde el post enviado, con las respectivas
           * variables y utilizando real string por seguridad.
           */
          $UpdateTitleC = mysqli_real_escape_string($conexion,$_POST['ContentTitUp']);
          $UpdateDescrC = mysqli_real_escape_string($conexion,$_POST['ContentDesUp']);
          $idContentU   = mysqli_real_escape_string($conexion,$_POST['IdContent']);

          /**
           * Se realiza la consulta para ingresar a
           * Base de Datos la nueva actividad.
           */
          $Q_UpdateContent =   "UPDATE
                                    `archivos_contenidos`
                                SET
                                    `Titulo_Contenido` = '$UpdateTitleC',
                                    `Descripcion_Contenido` = '$UpdateDescrC'
                                WHERE
                                    `archivos_contenidos`.`idContenido` = $idContentU;";
          $resultadoUpdate = mysqli_query($conexion, $Q_UpdateContent);

          /**
           * Nos redirige al menu y cerramos la conexion :3
           */
          if ($resultadoUpdate){
              mysqli_close($conexion);
              header('Location: ../menu?alert_success=<p class="msg_success">Contenido Editado con Exito... :)</p>');
          }else{
              mysqli_close($conexion);
              header('Location: ../menu?alert_null_pointer=<p class="msg_error_permissions">El Contenido no pudo ser editado... :(</p>');
          }
      }
    }else{
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>