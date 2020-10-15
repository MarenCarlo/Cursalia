<link href="../js/Datatables/datatables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../js/Datatables/responsive.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <div class="container" id="ContainerX">
        <div id="xd" style="margin-top: 15px;">
            <div class="row">
                <div class="col-lg-12 table-responsive" id="mydatatable-container">
                    <table id="datatable" class="display table table-hover responsive nowrap" cellspacing="0" width="100%" style="color: #888;">                
                        <thead class="card-header">
                            <tr>
                                <th id="th-row" scope="col">Fecha Entrega</th>
                                <th id="th-row" scope="col">Tipo de Actividad</th>
                                <th id="th-row" scope="col">Actividad</th>
                                <th id="th-row" scope="col">Entrega</th>
                                <th id="th-row" scope="col">Calificacion</th>
                                <th id="th-row" scope="col">Puntaje</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            
                            <?php
                                $SQL1 = 'SELECT
                                            tipo_calificacion.Tipo_Calificacion,
                                            actividades.NombreActividad,
                                            detalle_actividades.Estado_Entrega,
                                            detalle_actividades.Estado_Calificacion,
                                            detalle_actividades.Calificacion,
                                            archivos_tareas.NombreArchivo,
                                            archivos_tareas.RutaArchivo,
                                            actividades.Fecha_Entrega,
                                            detalle_actividades.FK_Usuario,
                                            detalle_actividades.FK_Actividad
                                        FROM
                                            detalle_actividades
                                        INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                                        INNER JOIN actividades ON detalle_actividades.FK_Actividad = Actividades.idActividad
                                        INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                                        INNER JOIN archivos_tareas ON detalle_actividades.FK_Archivos = archivos_tareas.idArchivo
                                        INNER JOIN detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                        WHERE
                                            detalle_alumno.Codigo_Estudiantil = "'.$cAlumno.'"
                                        AND actividades.FK_Curso = '. $idCurso;
                                $resultado1  = mysqli_query($conexion, $SQL1);

                                while($row = mysqli_fetch_array($resultado1)){
                                    $date = date_create($row['7']);
                            ?>
                                <tr>
                                    <td id="th-row"><?php echo date_format($date, 'd/m/Y--H:i:s');?></td>
                                    <td id="th-row"><?php echo $row['0']; ?></td>
                                    <td id="th-row"><?php echo $row['1']; ?></td>
                            <?php
                                    if($row['2'] == "Entregado"){
                            ?>
                                    <td id="th-row" style="color: #009100;"><?php echo $row['2']; ?></td>
                            <?php
                                    } else {
                            ?>
                                    <td id="th-row" style="color: #DD4F43;"><?php echo $row['2']; ?></td>
                            <?php
                                    }

                                    if($row['3'] == "Sin Calificar" && $row['2'] == "Entregado"){
                            ?>
                                    <td id="th-row" style="color: #FF9C00;" title="Esta actividad fue entregada pero el catedratico aun no la ha calificado..."><?php echo $row['3']; ?></td>
                            <?php
                                    } 

                                    if($row['3'] == "Sin Calificar" && $row['2'] == "No Entregado"){
                            ?>
                                    <td id="th-row" style="color: #DD4F43;"><?php echo $row['3']; ?></td>
                            <?php
                                    }
                                    if($row['3'] == "Calificada" && $row['2'] == "Entregado"){
                            ?>
                                    <td id="th-row" style="color: #009100;"><?php echo $row['3']; ?></td>
                            <?php
                                    }
                                    if($row['4'] > 60){
                            ?>
                                    <td id="th-row" style="color: #009100;"><?php echo $row['4']; ?></td>
                            <?php
                                    }
                                    if($row['4'] < 60 && $row['4'] > 10){
                            ?>
                                    <td id="th-row" style="color: #FF9C00;"><?php echo $row['4']; ?></td>
                            <?php
                                    }
                                    if($row['4'] <=10){
                            ?>
                                    <td id="th-row" style="color: #DD4F43;"><?php echo $row['4']; ?></td>
                            <?php
                                    }
                            ?>
                            <?php
                                }
                            ?>
                        </tbody>
                        <tfoot class="card-header">
                            <tr>
                                <th id="th-row" scope="col">Fecha Entrega</th>
                                <th id="th-row" scope="col">Tipo de Actividad</th>
                                <th id="th-row" scope="col">Actividad</th>
                                <th id="th-row" scope="col">Entrega</th>
                                <th id="th-row" scope="col">Calificacion</th>
                                <th id="th-row" scope="col">Puntaje</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/datatable_detalle_promedio_conf.js"></script>
    <script type="text/javascript" src="../js/Datatables/datatables.js"></script>