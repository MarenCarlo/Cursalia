    <link href="../js/Datatables/datatables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../js/Datatables/responsive.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <div class="container">
        <div id="xd" style="margin-top: 15px;">
            <div class="row">
                <div class="col-lg-12 table-responsive" id="mydatatable-container">
                    <table id="datatable" class="display table table-hover responsive nowrap" cellspacing="0" width="100%" style="color: #888;">                
                        <thead class="card-header">
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Entrega</th>
                                <th scope="col">Calificacion</th>
                                <th scope="col">Puntaje</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            
                            <?php
                                $SQL1 = 'SELECT DISTINCT
                                            detalle_actividades.idDetalleActividad,
                                            detalle_alumno.Codigo_Estudiantil,
                                            usuarios.User,
                                            usuarios.FName_User,
                                            usuarios.LName_User,
                                            detalle_actividades.Estado_Entrega,
                                            detalle_actividades.Estado_Calificacion,
                                            detalle_actividades.Calificacion,
                                            archivos_tareas.NombreArchivo,
                                            archivos_tareas.RutaArchivo,
                                            detalle_actividades.FK_Usuario,
                                            detalle_actividades.FK_Actividad
                                        FROM
                                            detalle_actividades
                                        INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                                        INNER JOIN actividades ON detalle_actividades.FK_Actividad = Actividades.idActividad
                                        INNER JOIN Detalle_alumno ON detalle_actividades.FK_DetalleAlumno = detalle_alumno.idDetalle_Alumno
                                        INNER JOIN archivos_tareas ON detalle_actividades.FK_Archivos = archivos_tareas.idArchivo
                                        WHERE
                                            detalle_actividades.FK_Actividad = '.$idActividad;
                                $resultado1  = mysqli_query($conexion, $SQL1);

                                while($row = mysqli_fetch_array($resultado1)){
                                    
                            ?>
                                <tr>
                                    <td><?php echo $row['1']; ?></td>
                                    <td><?php echo $row['2']; ?></td>
                                    <td><?php echo $row['3']; ?></td>
                                    <td><?php echo $row['4']; ?></td>
                            <?php
                                    /**
                                     * Condicionales del color del estado de Entrega de la
                                     * Actividad en Distintas Situaciones
                                     */
                                    if($row['5'] == "Entregado"){
                            ?>
                                    <td style="color: #00BB00"><?php echo $row['5']; ?></td>
                            <?php
                                    }
                            ?>
                            <?php
                                    if($row['5'] == "No Entregado"){
                            ?>
                                    <td style="color: #DD5044"><?php echo $row['5']; ?></td>
                            <?php
                                    }
                            ?>
                            
                            <?php
                                    /**
                                     * Condicionales del color del estado de Calificacion de la
                                     * Actividad en Distintas Situaciones
                                     */
                                    if($row['6'] == "Sin Calificar" && $row['5'] == "Entregado"){
                            ?>
                                    <td style="color: #FFB400;"><?php echo $row['6']; ?></td>
                            <?php
                                    }
                                    if($row['6'] == "Sin Calificar" && $row['5'] == "No Entregado"){
                            ?>
                                    <td style="color: #DD5044"><?php echo $row['6']; ?></td>
                            <?php
                                    }
                                    if($row['6'] == "Calificada" && $row['5'] == "Entregado"){
                            ?>
                                    <td style="color: #00BB00"><?php echo $row['6']; ?></td>
                            <?php
                                    }
                            ?>

                            <?php
                                    /**
                                     * Condicionales del color del Puntaje de la
                                     * Actividad en Distintas Situaciones
                                     */
                                    if($row['7'] >= 60){
                            ?>
                                    <td style="color: #00BB00;"><?php echo $row['7']; ?></td>
                            <?php
                                    }
                                    if($row['7'] < 60 && $row['7'] > 10){
                            ?>
                                    <td style="color: #FFB400"><?php echo $row['7']; ?></td>
                            <?php
                                    }
                                    if($row['7'] <= 10){
                            ?>
                                    <td style="color: #DD5044;"><?php echo $row['7']; ?></td>
                            <?php
                                    }
                            ?>

                            <?php
                                    /**
                                     * Condicionales del color del Anchor de Archivo en
                                     * Distintas Situaciones
                                     */
                                    if($row['9'] != "#!" && $row['6'] == "Calificada"){
                            ?>
                                    <td>
                                        <div class="row">
                                                <a id="boton_ver_entrega" href="controlador/ver_archivo.php?Nom=<?php echo $row['8'];?>&Rut=<?php echo $row['9'];?>" title="Descargar Archivo de Tarea">
							                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg>
												</a>
                                                <form action="editar_calificacion.php" method="POST">
                                                <input name="idCalifi" value="<?php echo $row['11']; ?>" type="text" hidden>
												<button id="boton_editar" name="idAlumno" value="<?php echo $row['10']; ?>" type="submit" title="Editar Nota de Actividad">
													<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
												</button>
												</form>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                    }
                                    if($row['9'] != "#!" && $row['6'] == "Sin Calificar"){
                            ?>
                                    <td>
                                        <form action="calificar.php" method="POST">
                                            <input  name="idCalifi" value="<?php echo $row['11']; ?>" type="text" hidden>
											<button id="boton_editar" name="idAlumno" value="<?php echo $row['10']; ?>" type="submit" title="Calificar Actividad">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px">
													<path d="M0 0h24v24H0V0z" fill="none" />
													<path d="M21 3h-6.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H3v18h18V3zm-9 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-2 14l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
												</svg>
											</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                    }
                                    if($row['9'] == "#!" && $row['5'] == "No Entregado"){
                            ?>
                                    <td>
                                        <a href="#!" style="color: #808080;">Sin Archivos</a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                            
                        </tbody>
                        <tfoot class="card-header">
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
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
    <script type="text/javascript" src="../js/datatable_entregas_conf.js"></script>
    <script type="text/javascript" src="../js/Datatables/datatables.js"></script>