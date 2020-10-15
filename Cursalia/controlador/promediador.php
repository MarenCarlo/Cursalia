<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA PROMEDIAR LAS ACTIVIDADES
     */
        /**
         * PROMEDIO DE TAREAS COMUNES
         */
        $Q_Suma1 = 'SELECT
                        AVG(calificacion)
                    FROM
                        detalle_actividades
                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                    WHERE
                        actividades.FK_Curso = '. $idCurso . '
                    AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                    AND tipo_calificacion.idTipoCalificacion = 1';       
        $resultadoS1 = mysqli_query($conexion, $Q_Suma1);
        $CountSum1   = mysqli_fetch_row($resultadoS1);
        $SumaTotCal1 = $CountSum1['0'];
        $PromedioTotTar1 = 0;
        if($SumaTotCal1 > 0){
            $Q_TipoCal1  = 'SELECT * FROM tipo_calificacion 
                            WHERE idTipoCalificacion = 1;';
            $resTipCal1  = mysqli_query($conexion, $Q_TipoCal1);
            $CountTipo1  = mysqli_fetch_row($resTipCal1);
            $TipoCalif1  = $CountTipo1['2'];
            $PromedioTotTar1 = $SumaTotCal1 * $TipoCalif1;
       }
       $PromedioTotTar1;
    
       /**
         * PROMEDIO DE INVESTIGACIONES
         */
       $Q_Suma2 = 'SELECT
                        AVG(calificacion)
                    FROM
                        detalle_actividades
                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                    WHERE
                        actividades.FK_Curso = '. $idCurso . '
                    AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                    AND tipo_calificacion.idTipoCalificacion = 2';       
        $resultadoS2 = mysqli_query($conexion, $Q_Suma2);
        $CountSum2   = mysqli_fetch_row($resultadoS2);
        $SumaTotCal2 = $CountSum2['0'];
        $PromedioTotIn2 = 0;
        if($SumaTotCal2 > 0){
            $Q_TipoCal2  =  'SELECT * FROM tipo_calificacion 
                            WHERE idTipoCalificacion = 2;';
            $resTipCal2  = mysqli_query($conexion, $Q_TipoCal2);
            $CountTipo2  = mysqli_fetch_row($resTipCal2);
            $TipoCalif2  = $CountTipo2['2'];
            $PromedioTotIn2 = $SumaTotCal2 * $TipoCalif2;
        }
        $PromedioTotIn2;

        /**
         * PROMEDIO DE PARCIALES
         */
        $Q_Suma3 = 'SELECT
                        AVG(calificacion)
                    FROM
                        detalle_actividades
                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                    WHERE
                        actividades.FK_Curso = '. $idCurso . '
                    AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                    AND tipo_calificacion.idTipoCalificacion = 3';       
        $resultadoS3 = mysqli_query($conexion, $Q_Suma3);
        $CountSum3   = mysqli_fetch_row($resultadoS3);
        $SumaTotCal3 = $CountSum3['0'];                    
        $PromedioTotPar3 = 0;
        if($SumaTotCal3 > 0){
            $Q_TipoCal3  ='SELECT * FROM tipo_calificacion 
                            WHERE idTipoCalificacion = 3;';
            $resTipCal3  = mysqli_query($conexion, $Q_TipoCal3);
            $CountTipo3  = mysqli_fetch_row($resTipCal3);
            $TipoCalif3  = $CountTipo3['2'];
            $PromedioTotPar3 = $SumaTotCal3 * $TipoCalif3;
        }
        $PromedioTotPar3;

        /**
         * PROMEDIO DE EVALUACIONES
         */
        $Q_Suma4 = 'SELECT
                        AVG(calificacion)
                    FROM
                        detalle_actividades
                    INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                    INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
                    INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion.idTipoCalificacion
                    WHERE
                        actividades.FK_Curso = '. $idCurso . '
                    AND detalle_actividades.FK_Usuario = ' . $idAlumno . '
                    AND tipo_calificacion.idTipoCalificacion = 4';       
        $resultadoS4 = mysqli_query($conexion, $Q_Suma4);
        $CountSum4   = mysqli_fetch_row($resultadoS4);
        $SumaTotCal4 = $CountSum4['0'];
        $PromedioTotEv4 = 0;
        if($SumaTotCal4 > 0){
            $Q_TipoCal4  ='SELECT * FROM tipo_calificacion 
                            WHERE idTipoCalificacion = 4;';
            $resTipCal4  = mysqli_query($conexion, $Q_TipoCal4);
            $CountTipo4  = mysqli_fetch_row($resTipCal4);
            $TipoCalif4  = $CountTipo4['2'];
            $PromedioTotEv4 = $SumaTotCal4 * $TipoCalif4;
        }
        $PromedioTotEv4;

        $SumaPromedioTotal = $PromedioTotTar1 + $PromedioTotIn2 + $PromedioTotPar3 + $PromedioTotEv4;
?>