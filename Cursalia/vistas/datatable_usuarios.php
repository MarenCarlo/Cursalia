<link href="../js/Datatables/datatables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../js/Datatables/responsive.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <div class="container">
        <div id="xd" style="margin-top: 15px;">
            <div class="row">
                <div class="col-lg-12 table-responsive" id="mydatatable-container">
                    <table id="datatable2" class="display table table-hover responsive nowrap" cellspacing="0" width="100%" style="color: #888;">                
                        <thead class="card-header">
                            <tr>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            
                            <?php
                                require_once 'controlador/conexion.php';
                                $SQL1 = 'SELECT
                                            usuarios.idUsuario,
                                            usuarios.User,
                                            usuarios.FName_User,
                                            usuarios.LName_User,
                                            usuarios.Genero,
                                            usuarios.Fecha_Nacimiento,
                                            usuarios.Email,
                                            usuarios.Estado,
                                            usuarios.Telefono,
                                            roles.Descripcion
                                        FROM
                                            Usuarios
                                        INNER JOIN roles ON usuarios.FK_Rol = roles.idRol';
                                $resultado1  = mysqli_query($conexion, $SQL1);

                                while($row = mysqli_fetch_array($resultado1)){
                                    $date = date_create($row['5']);
                                    
                            ?>
                                <tr>
                                    <td><?php echo $row['1']; ?></td>
                                    <td><?php echo $row['2']; ?></td>
                                    <td><?php echo $row['3']; ?></td>
                                    <td><?php echo $row['6']; ?></td>
                                    <td><?php echo $row['8']; ?></td>
                            <?php
                                /**
                                 * Si el usuario es activo se ejecuta la siguiente condicional
                                 */
                                if($row['7'] == "Activo"){
                            ?>
                                    <td><a style="background: #009100; color: #FFF; padding: 4%; border-radius: 10%; font-weight: 200;"><?php echo $row['7']; ?></a></td>
                            <?php
                                    if($row['9'] == "Administrador"){
                            ?>
                                    <td><a style="background: #986CBE; color: #FFF; padding: 4%; border-radius: 5%; font-width: 2pt;"><?php echo $row['9']; ?></a></td>
                            <?php
                                    }
                                    if($row['9'] == "Catedratico"){
                            ?>
                                    <td><a style="background: #E97E1A; color: #FFF; padding: 4%; border-radius: 5%; font-width: 2pt;"><?php echo $row['9']; ?></a></td>
                            <?php
                                    }
                                    if($row['9'] == "Estudiante"){
                            ?>
                                    <td><a style="background: #157EFB; color: #FFF; padding: 4%; border-radius: 5%; font-width: 2pt;"><?php echo $row['9']; ?></a></td>
                            <?php
                                    }
                                    if($row['9'] == "Catedratico" && $row['7'] == "Activo"){
                            ?>
                                    <td>
                                        <div class="row">
                                            <a id="boton_desactivar" href="controlador/desactivar_usuario.php?user=<?php echo $row['0']; ?>" title="Desactivar Usuario: <?php echo $row['1']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M11.99 2C6.47 2 2 6.47 2 12s4.47 10 9.99 10S22 17.53 22 12 17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm4.18-12.24l-1.06 1.06-1.06-1.06L13 8.82l1.06 1.06L13 10.94 14.06 12l1.06-1.06L16.18 12l1.06-1.06-1.06-1.06 1.06-1.06zM7.82 12l1.06-1.06L9.94 12 11 10.94 9.94 9.88 11 8.82 9.94 7.76 8.88 8.82 7.82 7.76 6.76 8.82l1.06 1.06-1.06 1.06zM12 14c-2.33 0-4.31 1.46-5.11 3.5h10.22c-.8-2.04-2.78-3.5-5.11-3.5z"/></svg>
                                            </a>
                                            <a id="boton_otorgar" href="controlador/convertir_administrador.php?user=<?php echo $row['0']; ?>" title="Otorgar permisos de Administracion a Usuario: <?php echo $row['1']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                                            </a>
                                        </div>
                                    </td>
                            <?php
                                    }
                                    if($row['9'] == "Estudiante" && $row['7'] == "Activo"){
                            ?>
                                    <td>
                                    <div class="row">
                                            <a id="boton_desactivar" href="controlador/desactivar_usuario.php?user=<?php echo $row['0']; ?>" title="Desactivar Usuario: <?php echo $row['1']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M11.99 2C6.47 2 2 6.47 2 12s4.47 10 9.99 10S22 17.53 22 12 17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm4.18-12.24l-1.06 1.06-1.06-1.06L13 8.82l1.06 1.06L13 10.94 14.06 12l1.06-1.06L16.18 12l1.06-1.06-1.06-1.06 1.06-1.06zM7.82 12l1.06-1.06L9.94 12 11 10.94 9.94 9.88 11 8.82 9.94 7.76 8.88 8.82 7.82 7.76 6.76 8.82l1.06 1.06-1.06 1.06zM12 14c-2.33 0-4.31 1.46-5.11 3.5h10.22c-.8-2.04-2.78-3.5-5.11-3.5z"/></svg>
                                            </a>
                                        </div>
                                    </td>
                            <?php
                                    }
                                    if($row['9'] == "Administrador" && $row['7'] == "Activo"){
                            ?>
                                    <td>
                                    <div class="row">
                                            <a id="boton_desactivar" href="controlador/desactivar_usuario.php?user=<?php echo $row['0']; ?>" title="Desactivar Usuario: <?php echo $row['1']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M11.99 2C6.47 2 2 6.47 2 12s4.47 10 9.99 10S22 17.53 22 12 17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm4.18-12.24l-1.06 1.06-1.06-1.06L13 8.82l1.06 1.06L13 10.94 14.06 12l1.06-1.06L16.18 12l1.06-1.06-1.06-1.06 1.06-1.06zM7.82 12l1.06-1.06L9.94 12 11 10.94 9.94 9.88 11 8.82 9.94 7.76 8.88 8.82 7.82 7.76 6.76 8.82l1.06 1.06-1.06 1.06zM12 14c-2.33 0-4.31 1.46-5.11 3.5h10.22c-.8-2.04-2.78-3.5-5.11-3.5z"/></svg>
                                            </a>
                                            <a id="boton_retirar" href="controlador/convertir_catedratico.php?user=<?php echo $row['0']; ?>" title="Convertir en Catedratico a Usuario: <?php echo $row['1']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                                            </a>
                                        </div>
                                    </td>
                            <?php
                                    }
                                }

                                /**
                                 * Si el usuario es inactivo se ejecuta la siguiente condicional
                                 */
                                if($row['7'] == "Inactivo"){
                            ?>
                                    <td><a style="background: #DD4F43; color: #FFF; padding: 4%; border-radius: 10%; font-width: 2pt;"><?php echo $row['7']; ?></a></td>
                                    <td><a style="background: #DD4F43; color: #FFF; padding: 4%; border-radius: 5%; font-width: 2pt;"><?php echo $row['9']; ?></a></td>
                                    <td>
                                        <div class="row">
                                            <a id="boton_activar" href="controlador/activar_usuario.php?user=<?php echo $row['0']; ?>" title="Activar Usuario: <?php echo $row['1']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                                            </a>
                                        </div>
                                    </td>
                            <?php
                                }
                            ?>
                                </tr>
                            
                            <?php
                                }
                                mysqli_close($conexion);
                            ?>
                        </tbody>
                        <tfoot class="card-header">
                            <tr>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/datatable_usuarios_conf.js"></script>
    <script type="text/javascript" src="../js/Datatables/datatables.js"></script>