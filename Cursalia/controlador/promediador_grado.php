<?php
/**
 * CONTROLADOR QUE NOS AYUDA A MOSTRAR LOS PROMEDIOS EN LOS DOCUMENTOS
 * DE GRADOS
 */

//---------------------------------------------------------------//

/**
 * Promedio de todas las tareas Comunes del Grado
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
                    grados.idGrado = '.$idGrado.' AND idTipoCalificacion = 1;';
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
 * Promedio de todas las Investigaciones del grado
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
                    grados.idGrado = '.$idGrado.' AND Tipo_Calificacion = "Investigacion";';
$ResSumaTarCom = mysqli_query($conexion, $Q_SumaTarCom);
$RowSumaTarCom = mysqli_fetch_row($ResSumaTarCom);
$SumaTotalTarI = $RowSumaTarCom['0'];
$PromedioTotTarI = 0;
if($SumaTotalTarI > 0){
    $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                    WHERE Tipo_Calificacion = "Investigacion";';
    $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
    $CountTipo1  = mysqli_fetch_row($resTipCal1);
    $TipoCalif1  = $CountTipo1['2'];
    $PromedioTotTarI = $SumaTotalTarI * $TipoCalif1;
}
$PromedioTotTarI;


/**
 * Promedio de todos los Parciales del grado
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
                    grados.idGrado = '.$idGrado.' AND Tipo_Calificacion = "Parcial";';
$ResSumaTarCom = mysqli_query($conexion, $Q_SumaTarCom);
$RowSumaTarCom = mysqli_fetch_row($ResSumaTarCom);
$SumaTotalParc = $RowSumaTarCom['0'];

$PromedioTotParc = 0;
if($SumaTotalParc > 0){
    $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                    WHERE Tipo_Calificacion = "Parcial";';
    $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
    $CountTipo1  = mysqli_fetch_row($resTipCal1);
    $TipoCalif1  = $CountTipo1['2'];
    $PromedioTotParc = $SumaTotalParc * $TipoCalif1;
}
$PromedioTotParc;


/**
 * Promedio de todas las Evaluaciones del Grado
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
                    grados.idGrado = '.$idGrado.' AND Tipo_Calificacion = "Evaluacion";';
$ResSumaTarCom = mysqli_query($conexion, $Q_SumaTarCom);
$RowSumaTarCom = mysqli_fetch_row($ResSumaTarCom);
$SumaTotalEval = $RowSumaTarCom['0'];
$PromedioTotEval = 0;
if($SumaTotalEval > 0){
    $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                    WHERE Tipo_Calificacion = "Evaluacion";';
    $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
    $CountTipo1  = mysqli_fetch_row($resTipCal1);
    $TipoCalif1  = $CountTipo1['2'];
    $PromedioTotEval = $SumaTotalEval * $TipoCalif1;
}
$PromedioTotEval;

/**
 * Suma de todos los promedios
 */
$PromedioTotal = $PromedioTotTarC + $PromedioTotTarI + $PromedioTotParc + $PromedioTotEval;
?>