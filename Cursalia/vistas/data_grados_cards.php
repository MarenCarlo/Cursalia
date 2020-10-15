<?php
if ($_SESSION['active'] == true) {
    if ($Rol1 == 1) {
        require_once 'controlador/conexion.php';
        $SQL2 = 'SELECT
                    grados.idGrado,
                    grados.Codigo_Grado,
                    grados.NombreGrado,
                    grados.Descripcion,
                    secciones.NombreSeccion,
                    jornada.Jornada,
                    nivel_estudiantil.Nivel_Estudiantil
                FROM
                    grados
                INNER JOIN nivel_estudiantil ON grados.FK_Nivel_Estudiantil = nivel_estudiantil.idNivelEstudiantil
                INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                WHERE
                    grados.idGrado = ' . $idGrado . ';';

        $resultado1 = mysqli_query($conexion, $SQL2);
        while ($columna1 = mysqli_fetch_array($resultado1)) {
?>
                <div id="cards_ver_curso" class="card">
                    <div class="card-header blue-gradient" style="color: #888;">
                    </div>
                        <div class="card-header" style="color: #888;">
                            <div class="row">
                                <div class="col text--center" style="margin-top: 1em;">
                                    <label>Grado</label>
                                    <h2 class="curso-cards"><?php echo $columna1['2']; ?></h2>
                                    <hr>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <center>
                                        <label>Codigo</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['1']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Nivel Educativo</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['6']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Grupo o Seccion</label>
                                        <h5><a class="curso-cards" href="#!">"<?php echo $columna1['4']; ?>"</a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Jornada</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['5']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <?php
                                        require_once 'controlador/promediador_grado.php';
                                    ?>
                                    <center>
                                        <label>Promedio de tareas comunes del Grado</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotTarC; ?> / 100</a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Promedio de Investigaciones del Grado</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotTarI; ?> / 100</a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Promedio de Pruebas Parciales del Grado</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotParc; ?> / 100</a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Promedio de Evaluaciones Cognitivas del Grado</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotEval; ?> / 100</a></h5>
                                        <hr>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <center>
                                        <label>Promedio Total del Grado</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $PromedioTotal; ?> / 100</a></h5>
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
                                        <h5><a class="curso-cards" href="#!">Opciones</a></h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <br>
                                        <div id="cards" class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />
                                                    </svg>
                                                    Agregar Alumno
                                                </h5>
                                                <p class="card-text">En este menu puedes agregar mas Alumnos a este grado (<?php echo $columna1['1']; ?>).</p>
                                                <form action="registro_alumno.php" method="POST" class="grid text--center">
                                                    <button name="idGrado" value="<?php echo $idGrado; ?>" type="submit" class="btn btn-info purple-gradient col-3-sm-12">Agregar Alumno</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <br>
                                        <div id="cards " class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path d="M4 6H2v16h16v-2H4V6zm18-4H6v16h16V2zm-2 10l-2.5-1.5L15 12V4h5v8z" />
                                                    </svg>
                                                    Agregar Curso
                                                </h5>
                                                <p class="card-text">En este menu puedes agregar mas Cursos a este grado (<?php echo $columna1['1']; ?>).</p>
                                                <form action="agregar_curso.php" method="POST" class="grid text--center">
                                                    <button name="idGrado" value="<?php echo $idGrado; ?>" type="submit" class="btn btn-info purple-gradient col-3-sm-12">Agregar Curso</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text--center">
                                        <hr>
                                        <h5><a class="curso-cards" href="#!">Cursos del Grado</a></h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                        <?php
                                            require_once 'vistas/cursos_cards_grados.php';
                                        ?>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <div class="card-header blue-gradient" style="color: #888;">
                    </div>
                        <div id="data_curso_card" class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 text--center">
                                        <hr>
                                        <h5><a class="curso-cards" href="#!">Promedios de Grado</a></h5>
                                        <hr>
                                    </div>                                           
                                </div>
                                <div class="row">
                                    <?php
                                        require_once 'vistas/datatable_promedio_grados.php';
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
<?php
        }
        mysqli_close($conexion);
    }
    if ($Rol1 == 2) {
        require_once 'controlador/conexion.php';
        $SQL2 = 'SELECT
                    grados.idGrado,
                    grados.Codigo_Grado,
                    grados.NombreGrado,
                    grados.Descripcion,
                    secciones.NombreSeccion,
                    jornada.Jornada,
                    nivel_estudiantil.Nivel_Estudiantil
                FROM
                    grados
                INNER JOIN nivel_estudiantil ON grados.FK_Nivel_Estudiantil = nivel_estudiantil.idNivelEstudiantil
                INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                WHERE
                    grados.idGrado = ' . $idGrado . ';';

        $resultado1 = mysqli_query($conexion, $SQL2);
        while ($columna1 = mysqli_fetch_row($resultado1)) {
                $columna1['3'] = "Ti";
?>
                <div id="cards_ver_curso" class="card">
                    <div class="card-header blue-gradient" style="color: #888;">
                    </div>
                        <div class="card-header" style="color: #888;">
                            <div class="row">
                                <div class="col text--center" style="margin-top: 1em;">
                                    <label>Grado</label>
                                    <h2 class="curso-cards"><?php echo $columna1['2']; ?></h2>
                                    <hr>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <center>
                                        <label>Codigo</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['1']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Nivel Educativo</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['6']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Grupo o Seccion</label>
                                        <h5><a class="curso-cards" href="#!">"<?php echo $columna1['4']; ?>"</a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Jornada</label>
                                        <h5><a class="curso-cards" href="#!"><?php echo $columna1['5']; ?></a></h5>
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
                                        <h5><a class="curso-cards" href="#!">Tus Cursos</a></h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                        <?php
                                            require_once 'vistas/cursos_cards_grados.php';
                                        ?>
                                        <hr>
                                    </div>
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
<?php
        }
        mysqli_close($conexion);
    }
    if ($Rol1 == 3) {

        require_once 'controlador/conexion.php';
        $SQL2 = 'SELECT
                    cursos.idCurso,
                    cursos.NombreCurso,
                    cursos.Descripcion,
                    usuarios.FName_User,
                    usuarios.LName_User,
                    grados.NombreGrado,
                    grados.Seccion,
                    jornada.Jornada
                 FROM
                    cursos
                 INNER JOIN usuarios ON cursos.FK_Catedratico = usuarios.idUsuario
                 INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                 INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                 WHERE
                    cursos.idCurso = ' . $idCurso . ';';

        $resultado1 = mysqli_query($conexion, $SQL2);
        while ($columna1 = mysqli_fetch_array($resultado1)) {
?>
                        <div id="cards_ver_curso" class="card">
                            <div class="card-header blue-gradient" style="color: #888;">
                            </div>
                            <div class="card-header" style="color: #888;">
                                <div class="row">
                                    <div class="col text--center" style="margin-top: 1em;">
                                        <label>Curso</label>
                                        <h2 class="curso-cards"><?php echo $columna1['1']; ?></h2>
                                        <hr>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                        <div class="col-lg-3">
                                            <center>
                                                <label>Impartido por</label>
                                                <h5><a class="curso-cards" href="#"><?php echo $columna1['3']; ?> <?php echo $columna1['4']; ?></a></h5>
                                                <hr>
                                            </center>
                                        </div>
                                        <div class="col-lg-3">
                                            <center>
                                                <label>Grado</label>
                                                <h5><a class="curso-cards" href="#"><?php echo $columna1['5']; ?></a></h5>
                                                <hr>
                                            </center>
                                        </div>
                                        <div class="col-lg-3">
                                            <center>
                                                <label>Grupo o Seccion</label>
                                                <h5><a class="curso-cards" href="#!">"<?php echo $columna1['6']; ?>"</a></h5>
                                                <hr>
                                            </center>
                                        </div>
                                        <div class="col-lg-3">
                                            <center>
                                                <label>Jornada</label>
                                                <h5><a class="curso-cards" href="#!"><?php echo $columna1['7']; ?></a></h5>
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
                                                <div class="col-lg-6">
                                                    <hr>
                                                        <h6><a class="curso-cards" href="#!">Descripcion del Curso</a></h6>
                                                        <p class="text-justify"><?php echo $columna1['2']; ?></p>
                                                </div>
                                                <div class="col-lg-6 text--center">
                                                    <hr>
                                                    <!-- BOTON QUE PERMITE AL ALUMNO VER SU PROMEDIO DE ESE CURSO !-->
                                                    <?php $idUsuario1 = $IdUser1; ?>
                                                    <form action="promedio_curso.php" method="POST">
                                                        <input name="idUsuarioProm" value="<?php echo $idUsuario1;?>" type="text" hidden>
                                                        <button name="idCurso" value="<?php echo $idCurso; ?>" class="btn btn-info purple-gradient col-3-sm-12" style="margin-top: 5px;">Mi Promedio</button> 
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <div class="card-header blue-gradient" style="color: #888;">
                                    </div>
                                    <div id="data_curso_card" class="card-body">
                                    <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 text--center">
                                        <hr>
                                        <h5><a class="curso-cards" href="#!">Contenido del Curso</a></h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
<?php
                $SQLX       = 'SELECT * FROM `archivos_contenidos` WHERE archivos_contenidos.FK_Curso = ' . $idCurso . ';';
                $resultadoX = mysqli_query($conexion, $SQLX);
                while ($columnaX = mysqli_fetch_array($resultadoX)) {
?>
                                    <div class="col-lg-12" id="card-tarea">
                                        <hr>
                                        <div class="col-lg-12 text--center">
                                            <h6><a class="curso-cards" href="#!" ><?php echo $columnaX['5']; ?></a></h6>
                                            <p class="text-justify"><?php echo $columnaX['6']; ?></p>
                                        </div>
                                        <div class="row justify-content-center" style="margin-top: 30px;">
                                            <div class="col-lg-2" style="margin-top: 30px;">
                                                <a href="controlador/ver_archivo.php?Nom=<?php echo $columnaX['1'];?>&Rut=<?php echo $columnaX['2'];?>" target="_blank" class="btn btn-info blue-gradient">Revisar</a>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                
<?php
                }
?>
                            </div>
                        </div>
                                    </div>
        
                                    <div class="card-header blue-gradient" style="color: #888;">
                                    </div>
                                    <div id="data_curso_card" class="card-body">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-lg-12 text--center">
                                                    <hr>
                                                    <h5><a class="curso-cards" href="#!">Actividades Pendientes Del Curso</a></h5>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
<?php
            /**
             * El siguiente fragmento de codigo Lineas de la 555 a la 555,
             * nos da una sentencia SQL que nos sirve para mostrarle al alumno
             * los detalles que tiene conforme a esa actividad!
             */
            $SQL3 = 'SELECT
                        actividades.idActividad,
                        actividades.NombreActividad,
                        actividades.DescripcionActividad,
                        cursos.idCurso,
                        cursos.NombreCurso,
                        grados.idGrado,
                        detalle_actividades.idDetalleActividad,
                        detalle_actividades.Estado_Entrega,
                        actividades.Fecha_Entrega,
                        detalle_actividades.Estado_Calificacion
                    FROM
                        detalle_actividades
                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                    INNER JOIN grados ON actividades.FK_Grado = grados.idGrado
                    INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                    WHERE actividades.FK_Curso = ' . $idCurso . '
                    AND detalle_actividades.Estado_Calificacion = "Sin Calificar"
                    AND detalle_actividades.FK_Usuario = ' . $IdUser1 . '
                    AND NOT detalle_actividades.Estado_Entrega = "Entregado"
                    ORDER BY actividades.Fecha_Entrega ASC';

            $resultado3 = mysqli_query($conexion, $SQL3);
            while ($columna3 = mysqli_fetch_array($resultado3)) {
                $date  = date_create($columna3['8']);
                $fecha = date_format($date, 'd/m/Y -- H:i:s');
                $columna3['9'] = "Aun no ha sido calificada"
?>
                                                <div class="col-lg-12" id="card-tarea">
                                                    <hr>
                                                    <div class="col-lg-12 text--center">
                                                        <h6><a class="curso-cards" href="#!" ><?php echo $columna3['1']; ?></a></h6>
                                                        <p class="text-justify"><?php echo $columna3['2']; ?></p>
<?php
                if ($columna3['7'] == "No Entregado") {
?>
                                                        <div class="row">
                                                            <div class="col-lg-4" style="margin-top: -1rem;">
                                                                <p class="float-center">Estado Calificación: <a class="text-danger" href="#!"><?php echo $columna3['9']; ?></a></p>
                                                            </div>
                                                            <div class="col-lg-4" style="margin-top: -1rem;">
                                                                <p class="float-center">Estado: <a class="text-danger" href="#!"><?php echo $columna3['7']; ?></a></p>
                                                            </div>
                                                            <div class="col-lg-4" style="margin-top: -1rem;".>
                                                                <p class="float-center">Fecha de Entrega: <a class="text-info" href="#!"><?php echo $fecha; ?></a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="col-lg-12 text--center" style="margin-top: 30px;">
                                                    <form action="Agregar_Entrega" method="POST">
                                                    <button href="#" type="submit" name="agregar" value="<?php echo $columna3['0']; ?>" class="btn btn-info blue-gradient">Agregar Entrega...</button>
                                                </form>
                                            </div>
                                           <hr>
                                        </div>
<?php
                }
            }
?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header blue-gradient" style="color: #888;">
                            </div>
                            <div class="card-footer text--center" style="color: #888;">
                                <cite>"<?php echo $columna1['1']; ?>"</cite>
                            </div>
                            <div class="card-footer blue-gradient" style="color: #888;">
                            </div>
                        </div>
<?php
        }
        mysqli_close($conexion);
    }
}
?>