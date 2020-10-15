<?php
    include 'controlador/conexion.php';
    
    /**
     * Consulta que nos regresa los datos del curso,
     * Catedratico que lo imparte y su grado 
     * correspndiente.
     */

    $SQL1 = 'SELECT
                actividades.idActividad,
                actividades.NombreActividad,
                actividades.DescripcionActividad,
                cursos.idCurso,
                cursos.NombreCurso,
                grados.idGrado,
                detalle_actividades.idDetalleActividad,
                detalle_actividades.Estado_Entrega,
                actividades.Fecha_Entrega,
                usuarios.FName_User,
                usuarios.LName_User,
                grados.NombreGrado,
                cursos.FK_Catedratico,
                detalle_actividades.Calificacion,
                usuarios.idUsuario
            FROM
                detalle_actividades
            INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
            INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
            INNER JOIN grados ON actividades.FK_Grado = grados.idGrado
            INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
            WHERE detalle_actividades.Estado_Entrega = "Entregado"
            AND detalle_actividades.Estado_Calificacion = "Sin Calificar"
            AND cursos.FK_Catedratico = '.$IdUser1.'
            ORDER BY actividades.Fecha_Entrega ASC';

    $resultado2 = mysqli_query($conexion, $SQL1);
    
    while ($columna = mysqli_fetch_array($resultado2)){
    /**
     * Variable que nos sirve para darle formato
     * a nuestra fecha de entrega
     */
    $date = date_create($columna['8']);
    if($columna['7'] == "Entregado"){
        echo   '<div class="row">
                <div class="col-lg-12">
                    <div class="card text-center">
                        <div class="card-header">
                            '.$columna['4'].'
                            
                        </div>
                        <div class="card-body">
                            
                            <h5 class="card-title">'. $columna['1'] .'</h5>
                            <p class="card-text">'. $columna['2'] .'</p>
                            <form action="calificar" method="POST">
                                <input id="login__username" name="idAlumno" type="text" class="form__input" value="'. $columna['14'] .'" readonly hidden required/>
                                <button type="submit" name="idCalifi" value="'. $columna['0'] .'" class="btn btn-info">Calificar...</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            <p style="margin-top: 10px; margin-bottom: -20px;">Calificacion: <a class="text-info" href="#">'.$columna['13'].' / 100</a></p>
                            <br>
                            <p style="margin-top: 10px; margin-bottom: -20px;">Alumno: <a class="text-info" href="#">'.$columna['9'].'</a></p>
                            <br>
                            <p style="margin-top: 10px; margin-bottom: -10px;">Grado: <a class="text-info" href="#">'.$columna['10'].' '.$columna['11'].'</a></p>
                            <br>
                            Estado: <a class="text-success" href="#">'. $columna['7'] .'</a>
                            <br>
                            <p style="margin-top: 10px; margin-bottom: 5px;">Fecha de Entrega: <a class="text-info" href="#">'. date_format($date, 'd/m/Y -- H:i:s') .'</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>';
    }else{
        echo   '<div class="row">
                <div class="col-lg-12">
                    <div class="card text-center">
                        <div class="card-header">
                            '.$columna['4'].'
                            
                        </div>
                        <div class="card-body">
                            
                            <h5 class="card-title">'. $columna['1'] .'</h5>
                            <p class="card-text">'. $columna['2'] .'</p>
                            <form action="calificar.php" method="POST">
                                <input id="login__username" name="idAlumno" type="text" class="form__input" value="'. $columna['14'] .'" readonly hidden required/>
                                <button type="submit" name="calif1" value="'. $columna['6'] .'" class="btn btn-warning">Calificar...</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            <p style="margin-top: 10px; margin-bottom: -10px;">Calificacion: <a class="text-info" href="#">'.$columna['13'].' / 100</a></p>
                            <br>
                            <p style="margin-top: 10px; margin-bottom: -10px;">Alumno: <a class="text-info" href="#">'.$columna['10'].' '.$columna['11'].'</a></p>
                            <br>
                            Estado: <a class="text-danger" href="#">'. $columna['7'] .'</a>
                            <br>
                            <p style="margin-top: 10px; margin-bottom: 5px;">Fecha de Entrega: <a class="text-info" href="#">'. date_format($date, 'd/m/Y -- H:i:s') .'</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>';
    }
    
    }
?>