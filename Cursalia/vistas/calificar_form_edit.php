<?php 
    if($Rol1 == 1 || $Rol1 == 2){
        $SQL1 = "SELECT
                    actividades.idActividad,
                    actividades.NombreActividad,
                    actividades.DescripcionActividad,
                    cursos.NombreCurso,
                    grados.NombreGrado,
                    detalle_actividades.idDetalleActividad,
                    detalle_actividades.Estado_Entrega,
                    actividades.Fecha_Entrega,
                    usuarios.FName_User,
                    usuarios.LName_User,
                    grados.NombreGrado,
                    cursos.FK_Catedratico,
                    detalle_actividades.Calificacion,
                    archivos_tareas.NombreArchivo,
                    archivos_tareas.RutaArchivo
                FROM
                    detalle_actividades
                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                INNER JOIN grados ON actividades.FK_Grado = grados.idGrado
                INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
                INNER JOIN archivos_tareas ON detalle_actividades.FK_Archivos = archivos_tareas.idArchivo
                WHERE detalle_actividades.FK_Actividad = '$idActividad'
                AND detalle_actividades.FK_Usuario = '$idAlumno'";

        $resultado1 = mysqli_query($conexion, $SQL1);
        $columna = mysqli_fetch_array($resultado1);
?>
    <div id="Form_AddP" class="">
        <form action="controlador/editar_calificacion.php" method="POST" class="form login" enctype="multipart/form-data">
            
            <h6>Titulo de Entrega</h6>   
            <div class="form__field">                            
                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><path d="M12,3c-0.42,0-0.85,0.04-1.28,0.11c-2.81,0.5-5.08,2.75-5.6,5.55c-0.48,2.61,0.48,5.01,2.22,6.56 C7.77,15.6,8,16.13,8,16.69C8,18.21,8,21,8,21h2.28c0.35,0.6,0.98,1,1.72,1s1.38-0.4,1.72-1H16v-4.31c0-0.55,0.22-1.09,0.64-1.46 C18.09,13.95,19,12.08,19,10C19,6.13,15.87,3,12,3z M14,19h-4v-1h4V19z M14,17h-4v-1h4V17z M12.5,11.41V14h-1v-2.59L9.67,9.59 l0.71-0.71L12,10.5l1.62-1.62l0.71,0.71L12.5,11.41z"/></g></g></svg></label>
                <input id="login__username" type="text" class="form__input" placeholder="<?php echo $columna['1']; ?>" readonly required/>    
            </div>         

            <section>
                <h6>Curso</h6>
                <div class="form__field">                          
                    <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 6H2v16h16v-2H4V6zm18-4H6v16h16V2zm-2 10l-2.5-1.5L15 12V4h5v8z"/></svg></label>
                    <input id="login__username" type="text" class="form__input" placeholder="<?php echo $columna['3']; ?>" readonly required/>    
                </div>                          
            </section>
            <section>
                <h6>Grado</h6>
                <div class="form__field">                          
                    <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 2H4v20h16V2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg></label>
                    <input id="login__username" type="text" class="form__input" placeholder="<?php echo $columna['4']; ?>" readonly required/>    
                </div>         
            </section>
            <section>
                <h6>Alumno</h6>
                <div class="form__field">                          
                    <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg></label>
                    <input id="login__username" type="text" class="form__input" placeholder="<?php echo $columna['8']; ?> <?php echo $columna['9']; ?>" readonly required/>    
                </div>                          
            </section>
            
            <h6>Descipcion</h6>
            <div class="form__field">
                <label for="login__username" class="blue-gradient"><svg style="margin-top: 220%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M15 15H3v2h12v-2zm0-8H3v2h12V7zM3 13h18v-2H3v2zm0 8h18v-2H3v2zM3 3v2h18V3H3z"/></svg></label> 
                <textarea onClick="count_it()" id="text__area" maxlength="1024" class="form__input" id="login__username exampleFormControlTextarea1" rows="8" placeholder="<?php echo $columna['2']; ?>" readonly required></textarea>
                <div class="wrap2">
                    <span id="count" class="counter"></span>
                </div>
            </div>
            <hr>
            <section>
                <h6>entrega</h6>
                <div class="form__field">                          
                    <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 4H2v16h20V6H12l-2-2z"/></svg></label>
                    <input id="login__username" type="text" class="form__input" placeholder="<?php echo $columna['13']; ?>" readonly required/>    
                </div>      
                <center>
                    <a id="boton_ver_entrega1" href="controlador/ver_archivo.php?Nom=<?php echo $columna['13'];?>&Rut=<?php echo $columna['14'];?>" style="color: #157EFB; font-size: 12pt;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="26px" height="26px"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg></a>
                    <p id="label1">ver entrega</p>
                </center>
                <h6>puntaje Nuevo</h6>
                <div class="form__field">                          
                    <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg></label>
                    <input id="login__username" name="calificacion1" type="number" class="form__input" placeholder="actual: <?php echo $columna['12']; ?> / 100" required/>    
                </div>                          
            </section>                      
            <input id="login__username" name="idDetalleAct1" type="text" class="form__input" value="<?php echo $columna['5']; ?>" readonly hidden required/>
            <br>
            <center>
                <div class="form__field grid2">
                    <input class="purple-gradient" type="submit" value="Calificar!">
                </div>
            </center>
            <script type="text/javascript" src="../js/charcounter.js"></script>
        </form>
    </div>
<?php
    } else {
        header('location: menu.php?alert_permissions=<p class="msg_error_permissions">Usted no tiene permiso para ver este recurso.</p>');
    }
?>