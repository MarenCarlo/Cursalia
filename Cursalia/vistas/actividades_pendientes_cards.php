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
                 actividades.Fecha_Entrega
            FROM
                 detalle_actividades
            INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
            INNER JOIN cursos ON actividades.FK_Curso = cursos.idCurso
            INNER JOIN grados ON actividades.FK_Grado = grados.idGrado
            INNER JOIN usuarios ON detalle_actividades.FK_Usuario = usuarios.idUsuario
            WHERE grados.idGrado = ' . $GradoUser1 . '
            AND detalle_actividades.Estado_Entrega = "No Entregado"
            AND detalle_actividades.FK_Usuario = ' . $IdUser1 . '
            ORDER BY actividades.Fecha_Entrega ASC';

$resultado2 = mysqli_query($conexion, $SQL1);

while ($columna = mysqli_fetch_array($resultado2)) {
    /**
     * Variable que nos sirve para darle formato
     * a nuestra fecha de entrega
     */
    $date = date_create($columna['8']);
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card text-center">
                        <div class="card-header">
                            <?php echo $columna['4']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $columna['1']; ?></h5>
                            <p class="card-text text-truncate d-inline-block col-12" style="max-width: 50%;"><?php echo $columna['2']; ?></p>
                            <form action="Agregar_Entrega" method="POST">
                                <button href="#" type="submit" name="agregar" value="<?php echo $columna['0']; ?>" class="btn btn-info purple-gradient">Agregar Entrega...</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            Estado: <a class="text-danger" href="#"><?php echo $columna['7']; ?></a>
                            <br>
                            <p style="margin-top: 10px; margin-bottom: 5px;">Fecha de Entrega: <a class="text-info" href="#"><?php echo date_format($date, 'd/m/Y -- H:i:s'); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
<?php
}
?>