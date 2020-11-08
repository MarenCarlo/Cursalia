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
    $IdUser1    = $_SESSION['idUsuario1'];
    $UserNick1  = $_SESSION['User1'];
    $UserFName1 = $_SESSION['FName1'];
    $UserLName1 = $_SESSION['LName1'];
    $GradoUser1 = $_SESSION['Grado1'];
    $Rol1       = $_SESSION['Rol1'];

    require_once "controlador/conexion.php";
    $Q_State        = "SELECT (Estado_Plataforma) FROM configuraciones_varias;";
    $Q_Send         = mysqli_query($conexion,$Q_State);           
    $State_Platform = mysqli_fetch_array($Q_Send);
    if($State_Platform['0'] == "Activo" || $Rol1 == 1){

        if(isset($_POST['idCurso']) && isset($_POST['codeAlumno']) && !empty($_POST)){
                require_once 'controlador/conexion.php';
                $idCurso = mysqli_real_escape_string($conexion, $_POST['idCurso']);
                $cAlumno = mysqli_real_escape_string($conexion, $_POST['codeAlumno']);
                
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
                                detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'";';
                $Res_Detail = mysqli_query($conexion, $Q_Detail);
                $Row_Detail = mysqli_fetch_row($Res_Detail);  
                if($Row_Detail >= 1){      
                    $Q_Curso      = 'SELECT  
                                        cursos.NombreCurso,
                                        usuarios.FName_User,
                                        usuarios.LName_User
                                    FROM 
                                        cursos
                                    INNER JOIN usuarios ON cursos.FK_Catedratico = usuarios.idUsuario
                                    WHERE
                                        cursos.idCurso = '. $idCurso .';';
                    $Curse_Detail = mysqli_query($conexion, $Q_Curso);
                    $Curso_Detail = mysqli_fetch_row($Curse_Detail);  
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
        <link rel="stylesheet" href="../css/impresion.css">
        <section id="Centro" class="SectionCen col-lg-10">
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
                                        <label>Impartido Por</label>
                                        <h5><?php echo $Curso_Detail['1']; ?> <?php echo $Curso_Detail['2']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Curso</label>
                                        <h5><?php echo $Curso_Detail['0']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
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
                            <hr id="hrx">
                            
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Entregas Totales del Alumno</label>
                                        <?php
                                            $Q_CountMax = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                detalle_actividades
                                                            INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                            INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                            INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                            WHERE 
                                                                detalle_actividades.Estado_Entrega = "Entregado"
                                                            AND
                                                                detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                            AND actividades.FK_Curso = '. $idCurso;
                                            $resultadoM = mysqli_query($conexion, $Q_CountMax);
                                            $CountMax   = mysqli_fetch_array($resultadoM);

                                            $Q_CountMaxA = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                detalle_actividades
                                                            INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                            INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                            INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                            WHERE
                                                                detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                            AND actividades.FK_Curso = '. $idCurso;
                                            $resultadoMA = mysqli_query($conexion, $Q_CountMaxA);
                                            $CountMaxA   = mysqli_fetch_array($resultadoMA);
                                        ?>
                                        <h5><?php echo $CountMax['0']; ?> / <?php echo $CountMaxA['0']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                        <center>
                                            <label>Entregas Calificadas</label>
                                            <?php
                                                $Q_CountMax = 'SELECT COUNT(Estado_Calificacion) FROM 
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE 
                                                                    Estado_Calificacion = "Calificada"
                                                                AND
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso;
                                                $resultadoM = mysqli_query($conexion, $Q_CountMax);
                                                $CountMax   = mysqli_fetch_array($resultadoM);

                                                $Q_CountMaxA = 'SELECT COUNT(Estado_Calificacion) FROM 
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso;
                                                $resultadoMA = mysqli_query($conexion, $Q_CountMaxA);
                                                $CountMaxA   = mysqli_fetch_array($resultadoMA);
                                            ?>
                                            <h5><?php echo $CountMax['0']; ?> / <?php echo $CountMaxA['0']; ?></h5>
                                            <hr id="hrx2">
                                        </center>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                        <center>
                                            <label>Prom. de Tareas Comunes</label>
                                            <?php
                                                $Q_TipoCal  =  'SELECT * FROM tipo_calificacion 
                                                                WHERE idTipoCalificacion = 1;';
                                                $resTipCal  = mysqli_query($conexion, $Q_TipoCal);
                                                $CountTipo  = mysqli_fetch_row($resTipCal);
                                                $TipoCalif  = $CountTipo['2'];

                                                    $Q_Suma = 'SELECT
                                                                    SUM(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 1
                                                                AND NOT detalle_actividades.Calificacion = 0';       
                                                    $resultadoS = mysqli_query($conexion, $Q_Suma);
                                                    $CountSum   = mysqli_fetch_row($resultadoS);
                                                    $SumaTotCal = $CountSum['0'];

                                                    $Q_Canti= 'SELECT
                                                                    COUNT(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 1;';    
                                                    $resultadoC = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount = mysqli_fetch_row($resultadoC);
                                                    $SumaTotCan = $CountCount['0'];

                                                    $PromedioTotTar1 = 0;
                                                    if($SumaTotCan > 0){
                                                        $Promedio = $SumaTotCal / $SumaTotCan;
                                                        $PromedioTotTar1 = $Promedio * $TipoCalif;
                                                ?>
                                            <h5><?php echo $PromedioTotTar1; ?> / 100</h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5>0 / 100</h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr id="hrx2">
                                        </center>
                                    </div>
                                    <div class="col-lg-3">
                                        <center>
                                            <label>Prom. de Investigaciones</label>
                                            <?php
                                                    $Q_TipoCal  =  'SELECT * FROM tipo_calificacion 
                                                                    WHERE idTipoCalificacion = 2;';
                                                    $resTipCal  = mysqli_query($conexion, $Q_TipoCal);
                                                    $CountTipo  = mysqli_fetch_row($resTipCal);
                                                    $TipoCalif  = $CountTipo['2'];

                                                    $Q_Suma = 'SELECT
                                                                    SUM(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 2
                                                                AND NOT detalle_actividades.Calificacion = 0';       
                                                    $resultadoS = mysqli_query($conexion, $Q_Suma);
                                                    $CountSum   = mysqli_fetch_row($resultadoS);
                                                    $SumaTotCal = $CountSum['0'];

                                                    $Q_Canti= 'SELECT
                                                                    COUNT(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 2;';    
                                                    $resultadoC = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount = mysqli_fetch_row($resultadoC);
                                                    $SumaTotCan = $CountCount['0'];
                                                    
                                                    $PromedioTotIn1 = 0;
                                                    if($SumaTotCan > 0){
                                                        $Promedio = $SumaTotCal / $SumaTotCan;
                                                        $PromedioTotIn1 = $Promedio * $TipoCalif;
                                                ?>
                                            <h5><?php echo $PromedioTotIn1; ?> / 100</h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5>0 / 100</h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr id="hrx2">
                                        </center>
                                    </div>  
                                    <div class="col-lg-3">
                                        <center>
                                            <label>Prom. de Parciales</label>
                                            <?php
                                                $Q_TipoCal  =  'SELECT * FROM tipo_calificacion 
                                                                WHERE idTipoCalificacion = 3;';
                                                $resTipCal  = mysqli_query($conexion, $Q_TipoCal);
                                                $CountTipo  = mysqli_fetch_row($resTipCal);
                                                $TipoCalif  = $CountTipo['2'];

                                                    $Q_Suma = 'SELECT
                                                                    SUM(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 3
                                                                AND NOT detalle_actividades.Calificacion = 0';       
                                                    $resultadoS = mysqli_query($conexion, $Q_Suma);
                                                    $CountSum   = mysqli_fetch_row($resultadoS);
                                                    $SumaTotCal = $CountSum['0'];

                                                    $Q_Canti= 'SELECT
                                                                    COUNT(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 3';    
                                                    $resultadoC = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount3 = mysqli_fetch_row($resultadoC);
                                                    $SumaTotCan = $CountCount3['0'];
                                                    
                                                    $PromedioTotEv1 = 0;
                                                    if($SumaTotCan > 0){
                                                        $Promedio = $SumaTotCal / $SumaTotCan;
                                                        $PromedioTotEv1 = $Promedio * $TipoCalif;
                                                ?>
                                            <h5><?php echo $PromedioTotEv1; ?> / 100</h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5>0 / 100</h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr id="hrx2">
                                        </center>
                                    </div>     
                                    <div class="col-lg-3">
                                        <center>
                                            <label>Prom. de Evaluaciones</label>
                                            <?php
                                                $Q_TipoCal  =  'SELECT * FROM tipo_calificacion 
                                                                WHERE idTipoCalificacion = 4;';
                                                $resTipCal  = mysqli_query($conexion, $Q_TipoCal);
                                                $CountTipo  = mysqli_fetch_row($resTipCal);
                                                $TipoCalif1  = $CountTipo['2'];

                                                    $Q_Suma = 'SELECT
                                                                    SUM(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 4
                                                                AND NOT detalle_actividades.Calificacion = 0';       
                                                    $resultadoS0 = mysqli_query($conexion, $Q_Suma);
                                                    $CountSum0   = mysqli_fetch_row($resultadoS0);
                                                    $SumaTotCal0 = $CountSum0['0'];

                                                    $Q_Canti= 'SELECT
                                                                    COUNT(calificacion)
                                                                FROM
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                                INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                                WHERE
                                                                    detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND tipo_calificacion.idTipoCalificacion = 4';    
                                                    $resultadoC1 = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount1 = mysqli_fetch_row($resultadoC1);
                                                    $SumaTotCan1 = $CountCount1['0'];

                                                    $PromedioTotEvas1 = 0;
                                                    if($SumaTotCan > 0){
                                                        $Promedio1 = $SumaTotCal0 / $SumaTotCan1;
                                                        $PromedioTotEvas1 = $Promedio1 * $TipoCalif1;
                                                ?>
                                            <h5><?php echo $PromedioTotEvas1; ?> / 100</h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5>0 / 100</h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr id="hrx2">
                                        </center>
                                    </div>   
                                    <br>
                                </div>
                                <div class="row justify-content-center">
                                        <div class="col-lg-4">
                                            <center>
                                                <label>Promedio Total del Curso</label>
                                                <?php   
                                                    $SumaPromedioTotal = $PromedioTotTar1 + $PromedioTotIn1 + $PromedioTotEv1 + $PromedioTotEvas1;
                                                    if($SumaPromedioTotal > 0){
                                                        if($SumaPromedioTotal >= 60){
                                                ?>
                                                <h5 style="color: #009100"><?php echo $SumaPromedioTotal; ?> / 100</h5>
                                                <?php
                                                        } else {
                                                ?>
                                                <h5 style="color: #DD4F43"><?php echo $SumaPromedioTotal; ?> / 100</h5>
                                                <?php            
                                                        }
                                                    } else {
                                                ?>
                                                <h5 style="color: #DD4F43">0 / 100</h5>
                                                <?php
                                                    }
                                                ?>
                                                <hr id="hrx2">
                                            </center>
                                        </div>
                                        <div class="col-lg-4">
                                            <center>
                                                <label>Estado del Curso</label>
                                                <?php   
                                                    if($SumaPromedioTotal >= 60){
                                                ?>
                                                <h5 style="color: #009100">Aprobado</h5>
                                                <?php
                                                    } else {
                                                ?>
                                                <h5 style="color: #DD4F43">Reprobado</h5>
                                                <?php
                                                    }
                                                ?>
                                                <hr id="hrx2">
                                            </center>
                                        </div>
                                    </div>

                            <hr id="hrx1">
                            <div id="ContainerX">
                                <div class="row justify-content-center">
                                    
                                        <center>
                                            <h3 id="H5X" class="curso-cards">Detalle del promedio del curso de: <?php echo $Curso_Detail['0']; ?></h3>
                                        </center>
                                        <?php require_once 'vistas/datatable_detalle_promedio.php' ?>
                                    
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <a id="printBut" onclick="print()" href="#!" class="btn btn-info purple-gradient col-3-sm-12">Imprimir</a>
                                    </center>
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
            } else {
                header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Aun no existen actividades a promediar en este curso... :(</p>');
            }
        } else {
            header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Cursalia no recibio ningun identificador de Alumno... :(</p>');
        }
    } else {
        mysqli_close($conexion);
        header('location: controlador/cierre_sesion.php');
    }
} else {
    header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
}
?>