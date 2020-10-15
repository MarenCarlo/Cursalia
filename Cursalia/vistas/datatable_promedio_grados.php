<link href="../js/Datatables/datatables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../js/Datatables/responsive.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <div class="container">
        <div id="xd" style="margin-top: 15px;">
            <div class="row">
                <div class="col-lg-12 table-responsive" id="mydatatable-container">
                    <table id="datatable" class="display table table-hover responsive nowrap" cellspacing="0" width="100%" style="color: #888;">                
                        <thead class="card-header">
                            <tr >
                                <th id="th-row" scope="col">Codigo</th>
                                <th id="th-row" scope="col">Usuario</th>
                                <th id="th-row" scope="col">Nombres</th>
                                <th id="th-row" scope="col">Apellidos</th>
                                <th id="th-row" scope="col">Promedio <br>Tarea <br>Comun</th>
                                <th id="th-row" scope="col">Promedio <br>Investigacion</th>
                                <th id="th-row" scope="col">Promedio <br>Parcial</th>
                                <th id="th-row" scope="col">Promedio <br>Evaluacion</th>
                                <th id="th-row" scope="col">Promedio <br>Total</th>
                                <th id="th-row" scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <?php
                                $Q_PromedioAlu = 'SELECT
                                                    usuarios.idUsuario,
                                                    detalle_alumno.Codigo_Estudiantil,
                                                    usuarios.User,
                                                    usuarios.FName_User,
                                                    usuarios.LName_User
                                                FROM
                                                    detalle_alumno
                                                INNER JOIN usuarios ON detalle_alumno.FK_Usuario = usuarios.idUsuario
                                                INNER JOIN grados ON detalle_alumno.FK_Grado = grados.idGrado
                                                WHERE
                                                    grados.idGrado = ' . $idGrado . ';';
                                $resultAlu1 = mysqli_query($conexion, $Q_PromedioAlu);

                                while($rowAlu1 = mysqli_fetch_array($resultAlu1)){
                                    /**
                                     * Promedio de todas las tareas Comunes del Alumno
                                     */
                                    $Q_SumaTarCom  = 'SELECT
                                                        AVG(
                                                            detalle_actividades.Calificacion
                                                        )
                                                    FROM
                                                        detalle_actividades
                                                    INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                                                    INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                    INNER JOIN archivos_tareas ON detalle_actividades.FK_Archivos = archivos_tareas.idArchivo
                                                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                    INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                                                    WHERE
                                                        grados.idGrado = '.$idGrado.' 
                                                    AND
                                                        usuarios.idUsuario = '.$rowAlu1['0'].' 
                                                    AND 
                                                        idTipoCalificacion = 1;';
                                    $ResSumaTarCom = mysqli_query($conexion, $Q_SumaTarCom);
                                    $RowSumaTarCom = mysqli_fetch_row($ResSumaTarCom);
                                    $SumaTotalTarC = $RowSumaTarCom['0'];
                                    $PromedioTotTarC = 0;
                                    if($SumaTotalTarC> 0){
                                        $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                                                        WHERE idTipoCalificacion = 1;';
                                        $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
                                        $CountTipo1  = mysqli_fetch_row($resTipCal1);
                                        $TipoCalif1  = $CountTipo1['2'];
                                        $PromedioTotTarC = $SumaTotalTarC * $TipoCalif1;
                                    }
                                    $PromedioTotTarC;
                                    /**
                                     * Promedio de todas las Investigaciones del Alumno
                                     */
                                    $Q_SumaTarCom  = 'SELECT
                                                        AVG(
                                                            detalle_actividades.Calificacion
                                                        )
                                                    FROM
                                                        detalle_actividades
                                                    INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                                                    INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                    INNER JOIN archivos_tareas ON detalle_actividades.FK_Archivos = archivos_tareas.idArchivo
                                                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                    INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                                                    WHERE
                                                        grados.idGrado = '.$idGrado.' 
                                                    AND
                                                        usuarios.idUsuario = '.$rowAlu1['0'].' 
                                                    AND 
                                                        idTipoCalificacion = 2;';
                                    $ResSumaTarCom = mysqli_query($conexion, $Q_SumaTarCom);
                                    $RowSumaTarCom = mysqli_fetch_row($ResSumaTarCom);
                                    $SumaTotalTarC = $RowSumaTarCom['0'];
                                    $PromedioTotInv = 0;
                                    if($SumaTotalTarC> 0){
                                        $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                                                        WHERE idTipoCalificacion = 2;';
                                        $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
                                        $CountTipo1  = mysqli_fetch_row($resTipCal1);
                                        $TipoCalif1  = $CountTipo1['2'];
                                        $PromedioTotInv = $SumaTotalTarC * $TipoCalif1;
                                    }
                                    $PromedioTotInv;
                                    /**
                                     * Promedio de todas los parciales del Alumno
                                     */
                                    $Q_SumaTarCom  = 'SELECT
                                                        AVG(
                                                            detalle_actividades.Calificacion
                                                        )
                                                    FROM
                                                        detalle_actividades
                                                    INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                                                    INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                    INNER JOIN archivos_tareas ON detalle_actividades.FK_Archivos = archivos_tareas.idArchivo
                                                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                    INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                                                    WHERE
                                                        grados.idGrado = '.$idGrado.' 
                                                    AND
                                                        usuarios.idUsuario = '.$rowAlu1['0'].' 
                                                    AND 
                                                        idTipoCalificacion = 3;';
                                    $ResSumaTarCom = mysqli_query($conexion, $Q_SumaTarCom);
                                    $RowSumaTarCom = mysqli_fetch_row($ResSumaTarCom);
                                    $SumaTotalTarC = $RowSumaTarCom['0'];
                                    $PromedioTotPar = 0;
                                    if($SumaTotalTarC> 0){
                                        $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                                                        WHERE idTipoCalificacion = 3;';
                                        $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
                                        $CountTipo1  = mysqli_fetch_row($resTipCal1);
                                        $TipoCalif1  = $CountTipo1['2'];
                                        $PromedioTotPar = $SumaTotalTarC * $TipoCalif1;
                                    }
                                    $PromedioTotPar;
                                    /**
                                     * Promedio de todas las Evaluaciones del Alumno
                                     */
                                    $Q_SumaTarCom  = 'SELECT
                                                        AVG(
                                                            detalle_actividades.Calificacion
                                                        )
                                                    FROM
                                                        detalle_actividades
                                                    INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                                                    INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                                    INNER JOIN archivos_tareas ON detalle_actividades.FK_Archivos = archivos_tareas.idArchivo
                                                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                                                    INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                                                    WHERE
                                                        grados.idGrado = '.$idGrado.' 
                                                    AND
                                                        usuarios.idUsuario = '.$rowAlu1['0'].' 
                                                    AND 
                                                        idTipoCalificacion = 4;';
                                    $ResSumaTarCom = mysqli_query($conexion, $Q_SumaTarCom);
                                    $RowSumaTarCom = mysqli_fetch_row($ResSumaTarCom);
                                    $SumaTotalTarC = $RowSumaTarCom['0'];
                                    $PromedioTotEva = 0;
                                    if($SumaTotalTarC> 0){
                                        $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                                                        WHERE idTipoCalificacion = 4;';
                                        $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
                                        $CountTipo1  = mysqli_fetch_row($resTipCal1);
                                        $TipoCalif1  = $CountTipo1['2'];
                                        $PromedioTotEva = $SumaTotalTarC * $TipoCalif1;
                                    }
                                    $PromedioTotEva;
                                    $PromedioTotalX = $PromedioTotTarC + $PromedioTotInv + $PromedioTotPar + $PromedioTotEva; 
                            ?>
                            <tr>
                                <td><?php echo $rowAlu1['1']; ?></td>
                                <td><?php echo $rowAlu1['2']; ?></td>
                                <td><?php echo $rowAlu1['3']; ?></td>
                                <td><?php echo $rowAlu1['4']; ?></td>
                                <td><?php echo $PromedioTotTarC; ?></td>
                                <td><?php echo $PromedioTotInv; ?></td>
                                <td><?php echo $PromedioTotPar; ?></td>
                                <td><?php echo $PromedioTotEva; ?></td>
                                <td><?php echo $PromedioTotalX; ?></td>
                                <td>
                                    <form target="_blank" action="../Cursalia/promedio_alumo.php" method="POST">
                                        <button class="Promedio" value="<?php echo $rowAlu1['1']; ?>" name="idAlumno" type="submit" style="color: #157EFB; background: none; border: none;">
                                            Imprimir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        <tfoot class="card-header">
                            <tr>
                                <th id="th-row" scope="col">Codigo</th>
                                <th id="th-row" scope="col">Usuario</th>
                                <th id="th-row" scope="col">Nombres</th>
                                <th id="th-row" scope="col">Apellidos</th>
                                <th id="th-row" scope="col">Promedio <br>tarea <br>Comun</th>
                                <th id="th-row" scope="col">Promedio <br>Investigacion</th>
                                <th id="th-row" scope="col">Promedio <br>Parcial</th>
                                <th id="th-row" scope="col">Promedio <br>Evaluacion</th>
                                <th id="th-row" scope="col">Promedio <br>Total</th>
                                <th id="th-row" scope="col">Opciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/datatable_promedio_grado_conf.js"></script>
    <script type="text/javascript" src="../js/Datatables/datatables.js"></script>