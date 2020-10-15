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
                INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion';
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
                WHERE cursos.FK_Catedratico = '.$IdUser1.';';
    }
    if($Rol1 == 3){
        /**
         * Si el rol es igual a Alumno muestra esto: 
         */
        $SQL2 = 'SELECT
                    grados.idGrado
                 FROM
                    usuarios
                 INNER JOIN grados ON usuarios.FK_Grado = grados.idGrado
                 WHERE usuarios.idUsuario = '.$IdUser1.';';


        $resultado1 = mysqli_query($conexion, $SQL2);
        $columna1   = mysqli_fetch_array($resultado1);
        $Grado1     = $columna1['0'];

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
                WHERE grados.idGrado = '.$GradoUser1.';';
    }

    $resultado2 = mysqli_query($conexion, $SQL1);
    
    while ($columna = mysqli_fetch_array($resultado2)){
        if($columna['3'] == $UserFName1 && $columna['4'] == $UserLName1){
            $columna['3'] = "Tu";
?>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="cards_menu_direccion" class="card text-center">
                            <div class="row card-header">
                                <div class="col-lg-2">
                                    Codigo Grado:    <a href="#!" style="font-size: 10pt;"><?php echo $columna['8']; ?></a>
                                </div>
                                <div class="col-lg-8">
                                    Grado:    <a href="#!" style="font-size: 10pt;"><?php echo $columna['5']; ?></a>
                                </div>
                                <div class="col-lg-2">
                                    Jornada:  <a href="#!" style="font-size: 10pt;"><?php echo $columna['7']; ?></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title curso-cards-blue"><?php echo $columna['1']; ?></h5>
                                <p class="card-text text-truncate d-inline-block col-12" style="max-width: 50%;"><?php echo $columna['2']; ?></p>
                                <br>
                                <a href="ver_curso.php?curso=<?php echo $columna['0']; ?>" class="btn btn-info blue-gradient col-3-sm-12">Ver Curso...</a>
                            </div>
                            <div class="card-footer text-muted">
                                Catedratico:  <a href="#"><?php echo $columna['3']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
<?php
        }else{
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div id="cards_menu_direccion" class="card text-center">
                        <div class="row card-header">
                            <div class="col-lg-2">
                                Codigo Grado:    <a href="#!" style="font-size: 10pt;"><?php echo $columna['8']; ?></a>
                            </div>
                            <div class="col-lg-8">
                                Grado:   <a href="#!" style="font-size: 10pt;"><?php echo $columna['5']; ?></a>
                            </div>
                            <div class="col-lg-2">
                                Jornada:  <a href="#!" style="font-size: 10pt;"><?php echo $columna['7']; ?></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title curso-cards-blue"><?php echo $columna['1']; ?></h5>
                            <p class="card-text text-truncate d-inline-block col-12" style="max-width: 50%;"><?php echo $columna['2']; ?></p>
                            <br>
                            <a href="ver_curso.php?curso=<?php echo $columna['0']; ?>" class="btn btn-info blue-gradient col-3-sm-12">Ver Curso...</a>
                        </div>
                        <div class="card-footer text-muted">
                            Catedratico:  <a href="#"><?php echo $columna['3']; ?> <?php echo $columna['4']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
<?php
        }
    
    }
?>