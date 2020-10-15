<?php
    if(isset($_POST['idAlumno'])){
        require_once 'controlador/conexion.php';
        $idAlumno = mysqli_real_escape_string($conexion, $_POST['idAlumno']);

        $Q_Detail = 'SELECT
                        detalle_alumno.idDetalle_Alumno,
                        detalle_alumno.Codigo_Estudiantil,
                        usuarios.idUsuario,
                        usuarios.User,
                        usuarios.FName_User,
                        usuarios.LName_User,
                        grados.idGrado,
                        grados.Codigo_Grado,
                        grados.NombreGrado,
                        secciones.NombreSeccion,
                        jornada.Jornada,
                        nivel_estudiantil.idNivelEstudiantil,
                        nivel_estudiantil.Nivel_Estudiantil
                    FROM
                        detalle_alumno
                    INNER JOIN usuarios ON detalle_alumno.FK_Usuario = usuarios.idUsuario
                    INNER JOIN grados ON detalle_alumno.FK_Grado = grados.idGrado
                    INNER JOIN nivel_estudiantil ON detalle_alumno.FK_Nivel_Estudiantil = nivel_estudiantil.idNivelEstudiantil
                    INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                    INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                    WHERE
                        detalle_alumno.Codigo_Estudiantil = "'.$idAlumno.'";';
        $Res_Detail = mysqli_query($conexion, $Q_Detail);
        if($Row_Detail = mysqli_fetch_row($Res_Detail)){    
?>
<!DOCTYPE html>
<html lang="es">
<?php
        require 'vistas/head.php';
    ?>
    <body>
        <?php
            require 'vistas/nav2.php';            
        ?>
        <link rel="stylesheet" href="../css/impresion.css">
        <section id="Centro" class="SectionCen col-lg-12">
            <div class="SectionCenInt">
                <div>
                    <div id="cards_ver_curso" class="card">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <h1 id="LogoX_Impress" class="mx-auto">Cursalia</h1>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Codigo de Estudiante</label>
                                        <h5><?php echo $Row_Detail['1']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Nivel Estudiantil</label>
                                        <h5><?php echo $Row_Detail['12']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Codigo de Grado</label>
                                        <h5><?php echo $Row_Detail['7']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Grado</label>
                                        <h5><?php echo $Row_Detail['8']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Seccion</label>
                                        <h5>"<?php echo $Row_Detail['9']; ?>"</h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Jornada</label>
                                        <h5><?php echo $Row_Detail['10']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                            </div>
                            <hr id="hrx">
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Usuario</label>
                                        <h5><?php echo $Row_Detail['3']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Nombres</label>
                                        <h5><?php echo $Row_Detail['4']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Apellidos</label>
                                        <h5><?php echo $Row_Detail['5']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                            </div>
                            <hr id="hrx1">
                            <div id="ContainerX">
                                <div class="row justify-content-center">
                                    <h3 id="H5X" class="curso-cards">Promedio de Cursos</h3>
                                    <?php require_once 'vistas/datatable_promedio_uninited.php' ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </section>
    </body>
</html>
<?php
            }  else {
                header('location: ../index.php?alert_InSes=<p class="msg_error">Ese codigo de alumno no esta registrado en Cursalia, pero probablemente sea un error de sintaxis, vuelve a intentarlo... :(</p>');
            }
        } else {
            header('location: ../index.php?alert_InSes=<p class="msg_error">Cursalia no recibio ningun identificador de Alumno... :(</p>');
        }
?>