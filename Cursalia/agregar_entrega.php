<?php 
    //Se inicia la sesion Guardada desde el login
    session_start();

    /*
        Se traen los datos de la sesion al menu,
        ya que se utilizaran en los includes y 
        para no estarlos llamando en cada documento
        incluido en el cual se utilizara.
    */
    if($_SESSION['active'] == true){
        $idUser1 = $_SESSION['idUsuario1'];
        $Rol1    = $_SESSION['Rol1'];
        if($Rol1 == 3){
?>
<!DOCTYPE html>
<html lang="es">
<?php
            require 'vistas/head.php';
?>
    <body>
        <?php
            require 'vistas/nav1.php';            
        ?>
        <section id="Centro" class="SectionCen col-lg-10">
            <div class="SectionCenInt">
<?php
            require_once "controlador/conexion.php";
            $idActividad = mysqli_real_escape_string($conexion,$_POST['agregar']);
            $SQL1 = 'SELECT
                        actividades.idActividad,
                        actividades.NombreActividad,
                        actividades.DescripcionActividad,
                        cursos.idCurso,
                        cursos.NombreCurso,
                        grados.NombreGrado,
                        detalle_actividades.idDetalleActividad,
                        detalle_actividades.Estado_Entrega,
                        actividades.Fecha_Entrega,
                        secciones.NombreSeccion,
                        jornada.Jornada
                    FROM
                        detalle_actividades
                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                    INNER JOIN grados ON actividades.FK_Grado = grados.idGrado
                    INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                    INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                    WHERE actividades.idActividad = ' . $idActividad . '';

            $resultado2 = mysqli_query($conexion, $SQL1);
            $columna = mysqli_fetch_array($resultado2);
?>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="" class="card text-center">
                            <div class="card-header blue-gradient text-white">
                                <?php echo $columna['4'];?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title curso-cards-blue"><?php echo $columna['1'];?></h5>
                                <p class="card-text text-justify"><?php echo $columna['2'];?></p>
                            </div>
                            <div class="card-footer blue-gradient">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="Form_AddP">
                    <form action="controlador/archivo_tarea.php" method="POST" enctype="multipart/form-data" class="form login">
<?php
            $SQL2 = 'SELECT 
                        * 
                    FROM 
                        Usuarios 
                    WHERE usuarios.idUsuario = '.$idUser1.'';
            $resultado3 = mysqli_query($conexion, $SQL2);
            $columna1 = mysqli_fetch_array($resultado3);
?> 
                        <center>
                            <h6>Archivo del Contenido</h6>
                        </center>
                        <div class="form__field">
                            <label for="login__username" class="blue-gradient">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M10 4H2v16h20V6H12l-2-2z" /></svg>
                            </label>
                            <input id="file__input" class="form__input" type="file" name="BFile1" style="padding-left: 20px;" required>
                        </div>
                        <center>
                            <button name="Activity" value="<?php echo $idActividad;?>" type="submit" class="btn btn-info purple-gradient col-3-sm-12">Enviar Datos!</button> 
                        </center>
                        <br>
                    </form>
                </div>
            </div>
        </section>
        <section id="SectionIzq">
            <div class="SectionIzqInt">
<?php
            require 'vistas/NavBar_SesIn.php';            
?>
            </div>
        </section>
        <script type="text/javascript" src="../js/sidebar.js"></script>        
    </body>
</html>
<?php
            mysqli_close($conexion);
        }else{
            header('location: menu?alert_permissions=<p class="msg_error_permissions">Usted no tiene permiso para ver este recurso.</p>');
        }
    }else{
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>