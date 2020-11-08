<?php
    require_once "controlador/conexion.php";
    $Q_EditActi = "SELECT
                        actividades.idActividad,
                        actividades.NombreActividad,
                        actividades.DescripcionActividad,
                        actividades.Fecha_Entrega,
                        cursos.idCurso,
                        cursos.NombreCurso,
                        grados.idGrado,
                        grados.Codigo_Grado,
                        grados.NombreGrado,
                        tipo_calificacion.idTipoCalificacion,
                        tipo_calificacion.Tipo_Calificacion,
                        tipo_calificacion.Tipo_Valor
                    FROM
                        actividades
                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                    INNER JOIN grados ON actividades.FK_Grado = grados.idGrado
                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                    WHERE
                        actividades.idActividad = $idActivity;";
    $ResEditAct = mysqli_query($conexion,$Q_EditActi); 
    $ActivRow   = mysqli_fetch_row($ResEditAct);
    $dateDay    = date_create($ActivRow['3']);
    $dateTime   = date_create($ActivRow['3']);
?>
<div id="Form_AddP">
    <form action="controlador/editar_actividad.php" method="POST" class="form login" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <center>
                    <p style="margin-top: -2px;">Fecha de Entrega</p>
                </center>
                <div class="form__field">
                    <label for="login__username" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M17 13h-5v5h5v-5zM16 2v2H8V2H6v2H3.01L3 22h18V4h-3V2h-2zm3 18H5V9h14v11z" /></svg>
                    </label>
                    <input value="<?php echo date_format($dateDay, 'm/d/Y'); ?>" name="ActFechaEnt1" data-provide="datepicker" id="datepicker" type="text" class="form__input" required readonly/>
                </div>
            </div>
            <div class="col-lg-4">
                <center>
                    <p style="margin-top: -2px;">Tipo de Actividad</p>
                </center>
                <div class="form__field">
                    <label for="exampleFormControlSelect1" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M4 6H2v16h16v-2H4V6zm18-4H6v16h16V2zm-2 10l-2.5-1.5L15 12V4h5v8z" /></svg>
                    </label>
                    <select name="ActTipoCal1" id="select__form" class="form__input" class="form-control" required>
                        <option value="<?php echo $ActivRow['9']; ?>"> (selected) <?php echo $ActivRow['10']; ?> - <?php echo $ActivRow['11']; ?>%</option>
                        <?php
                            $sqlX2 = 'SELECT DISTINCT * FROM Tipo_Calificacion WHERE idTipoCalificacion NOT LIKE '.$ActivRow['9'].';';
                            $query1 = mysqli_query($conexion,$sqlX2); 

                            while ($columna = mysqli_fetch_array($query1)){
                                echo '<option value="'.$columna['0'].'">'.$columna['1'].' - '.$columna['2'].'%</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <center>
                    <p style="margin-top: -2px;">Hora de Entrega</p>
                </center>
                <div class="form__field">
                    <label for="login__username" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    </label>
                    <input value="<?php echo date_format($dateDay, 'H:i:s'); ?>" name="ActTimeEnt1" type="time" class="form__input" required/>
                </div>
            </div>
        </div>
        <div class="form__field">
            <label for="login__username" class="blue-gradient">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><g><rect fill="none" height="24" width="24" /></g><g><g/><g><path d="M12,3c-0.42,0-0.85,0.04-1.28,0.11c-2.81,0.5-5.08,2.75-5.6,5.55c-0.48,2.61,0.48,5.01,2.22,6.56 C7.77,15.6,8,16.13,8,16.69C8,18.21,8,21,8,21h2.28c0.35,0.6,0.98,1,1.72,1s1.38-0.4,1.72-1H16v-4.31c0-0.55,0.22-1.09,0.64-1.46 C18.09,13.95,19,12.08,19,10C19,6.13,15.87,3,12,3z M14,19h-4v-1h4V19z M14,17h-4v-1h4V17z M12.5,11.41V14h-1v-2.59L9.67,9.59 l0.71-0.71L12,10.5l1.62-1.62l0.71,0.71L12.5,11.41z" /></g></g></svg>
            </label>
            <input value="<?php echo $ActivRow['1']; ?>" name="ActTitle1" id="login__username" type="text" class="form__input" placeholder="Titulo de la actividad" required />
        </div>
        <section>
            <div class="form__field">
                <label for="exampleFormControlSelect1" class="blue-gradient">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M4 6H2v16h16v-2H4V6zm18-4H6v16h16V2zm-2 10l-2.5-1.5L15 12V4h5v8z" /></svg>
                </label>
                <select name="Curso1" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
                    <?php
                                            /**
                                             * Se decidio hacer esta consulta para indicar a cual
                                             * de los cursos de su respectivo grado es al que se
                                             * debe seleccionar.
                                             */
                        $sql2 = "SELECT 
                                    cursos.idCurso,
                                    cursos.NombreCurso,
                                    grados.NombreGrado,
                                    grados.Codigo_Grado
                                FROM 
                                    cursos
                                INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                                WHERE cursos.idCurso = ".$ActivRow['4'];
                        $query1 = mysqli_query($conexion,$sql2); 

                        while ($columna = mysqli_fetch_array($query1)){
                            echo '<option selected value="'.$columna['0'].'">'.$columna['1'].'</option>';
                        }
                    ?>
                </select>
            </div>
        </section>
        <section>
            <div class="form__field">
                <label for="exampleFormControlSelect1" class="blue-gradient">
                    <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M20 2H4v20h16V2zM6 4h5v8l-2.5-1.5L6 12V4z" /></svg>          
                </label>
                <select name="Grado1" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
                    <?php
                        /**
                         * Se decidio sacar el grado desde cursos,
                         * por que de esta manera solo se obtienen 
                         * los grados en los cuales este catedratico
                         * imparte esos cursos.
                         */
                        $sql2 = "SELECT DISTINCT
                                    grados.idGrado,
                                    grados.NombreGrado,
                                    grados.Codigo_Grado,
                                    secciones.NombreSeccion
                                FROM
                                    `cursos`
                                INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                                INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                                WHERE
                                    cursos.idCurso = ".$ActivRow['4']."
                                AND NOT grados.idGrado = 100;";
                                            
                        $query1 = mysqli_query($conexion,$sql2); 

                        while ($columna = mysqli_fetch_array($query1)){
                            echo '<option selected value="'.$columna['0'].'">'.$columna['2'].' / '.$columna['1'].'</option>';
                        }
                        mysqli_close($conexion);
                    ?>
                </select>
            </div>
        </section>
        <div class="form__field">
            <label for="login__username" class="blue-gradient">
                <svg style="margin-top: 250%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M15 15H3v2h12v-2zm0-8H3v2h12V7zM3 13h18v-2H3v2zm0 8h18v-2H3v2zM3 3v2h18V3H3z" /></svg>
            </label>
            <textarea name="ActDescrip1" onKeyDown="count_it()" id="text__area" maxlength="1024" class="form__input" id="login__username exampleFormControlTextarea1" rows="8" placeholder="Describe brevemente sobre que trata la actividad" required><?php echo $ActivRow['2']; ?></textarea>
            <div class="wrap2">
                <span id="count" class="counter blue-gradient"></span>
            </div>
        </div>
        <br>
        <center>
            <div class="row justify-content-center">
                <button type="submit" name="Actividad" value="<?php echo $idActivity; ?>" class="btn btn-info purple-gradient">Guardar Cambios!</button>
            </div>
        </center>
        <br>
    </form>
</div>