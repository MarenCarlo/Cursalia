<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA AGREGAR UN NUEVO CURSO.
     */
    session_start();
    if($_SESSION['active'] == true){
      require_once "conexion.php";

      if (isset($_POST)){
          /**
           * Se obtienen los datos desde el post enviado, con las respectivas
           * variables y utilizando real string por seguridad.
           */
          $NombreCurso   = mysqli_real_escape_string($conexion,trim($_POST['CursoTit1']));
          $FKUsuario1    = mysqli_real_escape_string($conexion,trim($_POST['Profes1']));
          $FKGrado1      = mysqli_real_escape_string($conexion,trim($_POST['Grados1']));
          $Descripcion1  = mysqli_real_escape_string($conexion,trim($_POST['CursoDesc1']));

          /**
           * Se realiza la consulta para ingresar a
           * Base de Datos el nuevo curso.
           */
          $consulta1 = "INSERT INTO `cursos` 
                          (`idCurso`, `NombreCurso`, `Descripcion`, `FK_Catedratico`, `FK_Grado`)
                        VALUES 
                          (NULL, '$NombreCurso ', '$Descripcion1', '$FKUsuario1', '$FKGrado1');";
          $resultado1 = mysqli_query($conexion, $consulta1);

          mysqli_close($conexion);
          header('Location: ../menu');
      }
    }else{
      header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>