<?php
    include 'controlador/conexion.php';

    /**
     * Consulta que nos regresa los datos del curso,
     * Catedratico que lo imparte y su grado 
     * correspndiente.
     */
    if($Rol1 == 1){
        /**
         * Si el rol es igual a Administrador o Maestro muestra esto: 
         */
        $SQL1 = 'SELECT 
                    cursos.idCurso,
                    cursos.NombreCurso,
                    cursos.Descripcion,
                    usuarios.FName_User,
                    usuarios.LName_User,
                    grados.NombreGrado,
                    secciones.NombreSeccion,
                    jornada.Jornada,
                    grados.Codigo_Grado
                FROM 
                    cursos
                INNER JOIN usuarios ON cursos.FK_Catedratico = usuarios.idUsuario
                INNER JOIN grados ON cursos.FK_Grado = grados.idGrado 
                INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                WHERE
                    grados.idGrado = ' . $idGrado . ';';
    }
    if($Rol1 == 2){
        /**
         * Si el rol es igual a Administrador o Maestro muestra esto: 
         */
        $SQL1 = 'SELECT 
                    cursos.idCurso,
                    cursos.NombreCurso,
                    cursos.Descripcion,
                    usuarios.FName_User,
                    usuarios.LName_User,
                    grados.NombreGrado,
                    secciones.NombreSeccion,
                    jornada.Jornada,
                    grados.Codigo_Grado
                FROM 
                    cursos
                INNER JOIN usuarios ON cursos.FK_Catedratico = usuarios.idUsuario
                INNER JOIN grados ON cursos.FK_Grado = grados.idGrado 
                INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                WHERE 
                    cursos.FK_Catedratico = '.$IdUser1.'
                AND grados.idGrado = ' . $idGrado . ';';
    }
    if($Rol1 == 3){
        $SQL1 = 'SELECT 
                    cursos.idCurso,
                    cursos.NombreCurso,
                    cursos.Descripcion,
                    usuarios.FName_User,
                    usuarios.LName_User,
                    grados.NombreGrado,
                    secciones.NombreSeccion,
                    jornada.Jornada,
                    grados.Codigo_Grado
                FROM 
                    cursos
                INNER JOIN usuarios ON cursos.FK_Catedratico = usuarios.idUsuario
                INNER JOIN grados ON cursos.FK_Grado = grados.idGrado 
                INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                WHERE 
                    grados.idGrado = ' . $idGrado . ';';
    }

    $resultado2 = mysqli_query($conexion, $SQL1);
    
    while ($columna = mysqli_fetch_array($resultado2)){
        if($columna['3'] == $UserFName1 && $columna['4'] == $UserLName1){
            $columna['3'] = "Tu";
?>
                <div class="row">
                <div class="col-lg-12">
                    <div id="card_grado" class="card text-center z-depth-1">
                        <div class="card-header blue-gradient">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title curso-cards-blue"><?php echo $columna['1']; ?></h5>
                            <p class="card-text text-truncate d-inline-block col-12" style="max-width: 50%;"><?php echo $columna['2']; ?></p>
                            <br>
                            <a href="ver_curso.php?curso=<?php echo $columna['0']; ?>" class="btn btn-info blue-gradient col-3-sm-12">Ver Curso...</a>
                        </div>
                        <div class="card-footer blue-gradient" style="color: #aaa;">
                            Catedratico:  <a href="#!" style="color: white;"><?php echo $columna['3']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
<?php
        }else{
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div id="card_grado" class="card text-center z-depth-1">
                        <div class="card-header blue-gradient">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title curso-cards-blue"><?php echo $columna['1']; ?></h5>
                            <p class="card-text text-truncate d-inline-block col-12" style="max-width: 50%;"><?php echo $columna['2']; ?></p>
                            <br>
                            <a href="ver_curso.php?curso=<?php echo $columna['0']; ?>" class="btn btn-info blue-gradient col-3-sm-12">Ver Curso...</a>
                        </div>
                        <div class="card-footer blue-gradient" style="color: #aaa;">
                            Catedratico:  <a href="#!" style="color: white;"><?php echo $columna['3']; ?> <?php echo $columna['4']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
<?php
        }
    
    }
?>