    <link href="../js/Datatables/datatables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../js/Datatables/responsive.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <div class="container">
        <div id="xd" style="margin-top: 15px;">
            <div class="row">
                <div class="col-lg-12 table-responsive" id="mydatatable-container">
                    <table id="datatable2" class="display table table-hover responsive nowrap" cellspacing="0" width="100%" style="color: #888;">                
                        <thead class="card-header">
                            <tr>
                                <th scope="col">Fecha Entrega</th>
                                <th scope="col">Tipo de Actividad</th>
                                <th scope="col">Actividad</th>
                                <th scope="col">Entrega</th>
                                <th scope="col">Calificacion</th>
                                <th scope="col">Puntaje</th>
                                <th scope="col">Opciones</th>
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
                                        WHERE
                                            detalle_actividades.FK_Usuario = '.$idAlumno.' 
                                        AND actividades.FK_Curso = '.$idCurso;
                                $resultado1  = mysqli_query($conexion, $SQL1);

                                while($row = mysqli_fetch_array($resultado1)){
                                    $date = date_create($row['7']);
                                    
                            ?>
                                <tr>
                                    <td><?php echo date_format($date, 'd/m/Y--H:i:s');?></td>
                                    <td><?php echo $row['0']; ?></td>
                                    <td><?php echo $row['1']; ?></td>
                                    <td><?php echo $row['2']; ?></td>
                                    <td><?php echo $row['3']; ?></td>
                                    <td><?php echo $row['4']; ?></td>
                            <?php
                                    if($row['6'] != "#!" && $row['3'] == "Calificada"){
                            ?>
                                    <td>
                                        <a href="controlador/ver_archivo.php?Nom=<?php echo $row['5'];?>&Rut=<?php echo $row['6'];?>" target="_blank" style="color: #157EFB;" title="Felicidades sigue realizando tus actividades!!">ver archivo</a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                    if($row['6'] != "#!" && $row['3'] == "Sin Calificar"){
                            ?>
                                    <td>
                                        <a href="#!" style="color: #8895B3;" title="Tu maestro aun no ha calificado esto">Sin Calificar</a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                    if($row['6'] == "#!" && $row['3'] == "Sin Calificar"){
                            ?>
                                    <td>
                                        <form action="agregar_entrega.php" method="POST">
                                            <button name="agregar" value="<?php echo $row['9']; ?>" type="submit" style="color: #00BB00; background: none; border: none;" title="Deberias entregar esto lo antes posible">
                                                Entregar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                            
                        </tbody>
                        <tfoot class="card-header">
                            <tr>
                                <th scope="col">Fecha Entrega</th>
                                <th scope="col">Tipo de Actividad</th>
                                <th scope="col">Actividad</th>
                                <th scope="col">Entrega</th>
                                <th scope="col">Calificacion</th>
                                <th scope="col">Puntaje</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/datatable_promedio_conf.js"></script>
    <script type="text/javascript" src="../js/Datatables/datatables.js"></script>