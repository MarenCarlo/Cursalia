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
        $UserId1    = $_SESSION['idUsuario1'];
        $UserNick1  = $_SESSION['User1'];
        $UserFName1 = $_SESSION['FName1'];
        $UserLName1 = $_SESSION['LName1'];
        $UserEmail1 = $_SESSION['Email1'];
        $Rol1       = $_SESSION['Rol1'];
        $UserGrado1 = $_SESSION['Grado1'];

        require_once "controlador/conexion.php";
        $Q_State        = "SELECT (Estado_Plataforma) FROM configuraciones_varias;";
        $Q_Send         = mysqli_query($conexion,$Q_State);           
        $State_Platform = mysqli_fetch_array($Q_Send);
        if($State_Platform['0'] == "Activo" || $Rol1 == 1){
            if($Rol1 == 3){
                if(isset($_POST) && !empty($_POST)){
                    require_once "controlador/conexion.php";
                    $idCurso = mysqli_real_escape_string($conexion, $_POST['idCurso']);
                    $idAlumno = mysqli_real_escape_string($conexion, $_POST['idUsuarioProm']);

                    $SQL1 = 'SELECT
                                cursos.idCurso,
                                cursos.NombreCurso,
                                usuarios.idUsuario,
                                usuarios.FName_User,
                                usuarios.LName_User,
                                detalle_alumno.Codigo_Estudiantil,
                                grados.Codigo_Grado,
                                grados.NombreGrado,
                                jornada.Jornada,
                                cursos.FK_Catedratico
                            FROM
                                detalle_actividades
                            INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                            INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                            INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                            INNER JOIN Detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                            INNER JOIN grados ON actividades.FK_Grado = grados.idGrado
                            INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                            WHERE actividades.FK_Curso = ' . $idCurso . '
                            AND usuarios.idUsuario = ' . $idAlumno;
        
                    $resultado1 = mysqli_query($conexion, $SQL1);
                    $columna1 = mysqli_fetch_array($resultado1);     
                    if($columna1 >= 1){      
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
            <div id="cards_ver_curso" class="card">
                    <div class="card-header blue-gradient" style="color: #888;">
                    </div>
                        <div class="card-header" style="color: #888;">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 text--center" style="margin-top: 1em;">
                                    <label>Curso</label>
                                    <h2 class="curso-cards"><?php echo $columna1['1']; ?></h2>
                                    <hr>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Codigo</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['5']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Nombres</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['3']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Apellidos</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['4']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <center>
                                        <label>Entregas Totales</label>
                                        <?php
                                            $Q_CountMax = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                detalle_actividades
                                                            INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                            INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                            WHERE 
                                                                detalle_actividades.Estado_Entrega = "Entregado"
                                                            AND actividades.FK_Curso = '. $idCurso . '
                                                            AND detalle_actividades.FK_Usuario = ' . $idAlumno;
                                            $resultadoM = mysqli_query($conexion, $Q_CountMax);
                                            $CountMax   = mysqli_fetch_array($resultadoM);

                                            $Q_CountMaxA = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                detalle_actividades
                                                            INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                            INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                            WHERE actividades.FK_Curso = '. $idCurso . '
                                                            AND detalle_actividades.FK_Usuario = ' . $idAlumno;
                                            $resultadoMA = mysqli_query($conexion, $Q_CountMaxA);
                                            $CountMaxA   = mysqli_fetch_array($resultadoMA);
                                        ?>
                                        <h5><a class="curso-cards" href="#!"><?php echo $CountMax['0']; ?> / <?php echo $CountMaxA['0']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                        <center>
                                            <label>Entregas Calificadas</label>
                                            <?php
                                                $Q_CountMax = 'SELECT COUNT(Estado_Calificacion) FROM 
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                WHERE 
                                                                    Estado_Calificacion = "Calificada"
                                                                AND actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno;
                                                $resultadoM = mysqli_query($conexion, $Q_CountMax);
                                                $CountMax   = mysqli_fetch_array($resultadoM);

                                                $Q_CountMaxA = 'SELECT COUNT(Estado_Calificacion) FROM 
                                                                    detalle_actividades
                                                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                                WHERE actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno;
                                                $resultadoMA = mysqli_query($conexion, $Q_CountMaxA);
                                                $CountMaxA   = mysqli_fetch_array($resultadoMA);
                                            ?>
                                            <h5><a class="curso-cards" href="#!"><?php echo $CountMax['0']; ?> / <?php echo $CountMaxA['0']; ?></a></h5>
                                            <hr>
                                        </center>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                        <center>
                                            <label>Promedio de Tareas Comunes</label>
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                                                                AND tipo_calificacion.idTipoCalificacion = 1;';    
                                                    $resultadoC = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount = mysqli_fetch_row($resultadoC);
                                                    $SumaTotCan = $CountCount['0'];

                                                    if($SumaTotCan > 0){
                                                        $Promedio = $SumaTotCal / $SumaTotCan;
                                                        $PromedioTotTar1 = $Promedio * $TipoCalif;
                                                ?>
                                            <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotTar1; ?> / 100</a></h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5><a class="curso-cards" href="#!">0 / 100</a></h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr>
                                        </center>
                                    </div>
                                    <div class="col-lg-3">
                                        <center>
                                            <label>Promedio de Investigaciones</label>
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                                                                AND tipo_calificacion.idTipoCalificacion = 2;';    
                                                    $resultadoC = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount = mysqli_fetch_row($resultadoC);
                                                    $SumaTotCan = $CountCount['0'];
                                                    
                                                    if($SumaTotCan > 0){
                                                        $Promedio = $SumaTotCal / $SumaTotCan;
                                                        $PromedioTotIn1 = $Promedio * $TipoCalif;
                                                ?>
                                            <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotIn1; ?> / 100</a></h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5><a class="curso-cards" href="#!">0 / 100</a></h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr>
                                        </center>
                                    </div>  
                                    <div class="col-lg-3">
                                        <center>
                                            <label>Promedio de Parciales</label>
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                                                                AND tipo_calificacion.idTipoCalificacion = 3;';    
                                                    $resultadoC = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount3 = mysqli_fetch_row($resultadoC);
                                                    $SumaTotCan = $CountCount3['0'];
                                                    
                                                    if($SumaTotCan > 0){
                                                        $Promedio = $SumaTotCal / $SumaTotCan;
                                                        $PromedioTotEv1 = $Promedio * $TipoCalif;
                                                ?>
                                            <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotEv1; ?> / 100</a></h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5><a class="curso-cards" href="#!">0 / 100</a></h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr>
                                        </center>
                                    </div>     
                                    <div class="col-lg-3">
                                        <center>
                                            <label>Promedio de Evaluaciones</label>
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
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
                                                                WHERE
                                                                    actividades.FK_Curso = '. $idCurso . '
                                                                AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                                                                AND tipo_calificacion.idTipoCalificacion = 4';    
                                                    $resultadoC1 = mysqli_query($conexion, $Q_Canti);
                                                    $CountCount1 = mysqli_fetch_row($resultadoC1);
                                                    $SumaTotCan1 = $CountCount1['0'];

                                                    if($SumaTotCan > 0){
                                                        $Promedio1 = $SumaTotCal0 / $SumaTotCan1;
                                                        $PromedioTotEvas1 = $Promedio1 * $TipoCalif1;
                                                ?>
                                            <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotEvas1; ?> / 100</a></h5>
                                                <?php
                                                    } else {
                                                ?>
                                            <h5><a class="curso-cards" href="#!">0 / 100</a></h5>
                                                <?php
                                                    }
                                                ?>
                                            <hr>
                                        </center>
                                    </div>   
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3">
                                        <center>
                                            <label>Promedio Total del Curso</label>
                                            <?php
                                                require_once 'controlador/promediador.php';    
                                                if($SumaPromedioTotal > 0){
                                            ?>
                                            <h5><a class="curso-cards" href="#!"><?php echo $SumaPromedioTotal; ?> / 100</a></h5>
                                            <?php
                                                } else {
                                            ?>
                                            <h5><a class="curso-cards" href="#!">0 / 100</a></h5>
                                            <?php
                                                }
                                            ?>
                                            <hr>
                                        </center>
                                    </div>
                                </div>
                            <br>
                        </div>
                        <div class="card-header blue-gradient" style="color: #888;">
                        </div>
                            <div id="data_curso_card" class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 text--center">
                                        <hr>
                                        <h5><a class="curso-cards" href="#!">Actividades</a></h5>
                                        <hr>
                                    </div>                                           
                                </div>
                                <div class="row">
                                    <?php
                                        require 'vistas/datatable_promedio.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-header blue-gradient" style="color: #888;">
                        </div>    
                        <div class="card-footer text--center" style="color: #888;">
                            <cite><?php echo $columna1['1']; ?></cite>
                        </div> 
                        <div class="card-footer blue-gradient" style="color: #888;">
                        </div>
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
                    } else {
                        header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Aun no existen actividades a promediar en este curso... :(</p>');
                    }
                } else {
                    header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Cursalia no recibio ningun identificador de entrega... :(</p>');
                }
            } else {
                header('location: menu.php?alert_permissions=<p class="msg_error_permissions">Usted no tiene permiso para ver este recurso.</p>');
            }
        } else {
            mysqli_close($conexion);
            header('location: controlador/cierre_sesion.php');
        }
    } else {
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>