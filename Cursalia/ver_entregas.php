<?php 
    //Se inicia la sesion Guardada desde el login
    session_start();
    /*
        Se traen los datos de la sesion al menu,
        ya que se utilizaran en los includes y 
        para no estarlos llamando en cada documento
        incluido en el cual se utilizara.
    */
    if($_SESSION['active'] == true){
        $UserId1    = $_SESSION['idUsuario1'];
        $UserNick1  = $_SESSION['User1'];
        $UserFName1 = $_SESSION['FName1'];
        $UserLName1 = $_SESSION['LName1'];
        $UserEmail1 = $_SESSION['Email1'];
        $Rol1       = $_SESSION['Rol1'];
        $UserGrado1 = $_SESSION['Grado1'];

        require_once "controlador/conexion.php";
        $Q_State        = "SELECT (Estado_Plataforma) FROM configuraciones_varias;";
        $Q_Send         = mysqli_query($conexion,$Q_State);           
        $State_Platform = mysqli_fetch_array($Q_Send);
        if($State_Platform['0'] == "Activo" || $Rol1 == 1){
            if($Rol1 == 1 || $Rol1 == 2){
                if(isset($_POST) && !empty($_POST)){
                    include 'controlador/conexion.php';
                    $idActividad = mysqli_real_escape_string($conexion, $_POST['entregas']);
                    
                    $SQL    = 'SELECT 
                                    actividades.idActividad,
                                    actividades.NombreActividad,
                                    actividades.DescripcionActividad,
                                    actividades.Fecha_Entrega,
                                    detalle_actividades.idDetalleActividad,
                                    detalle_actividades.Estado_Entrega,
                                    detalle_actividades.Estado_Calificacion,
                                    detalle_actividades.Calificacion
                                FROM 
                                    detalle_actividades
                                INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                WHERE 
                                    idActividad = '.$idActividad;
                    $resultado = mysqli_query($conexion, $SQL);
                    $columna1  = mysqli_fetch_row($resultado);                    
?>
<!DOCTYPE html>
<html lang="es">
    <?php
        require 'vistas/head.php';
    ?>
<body>
        <?php
            require 'vistas/nav1.php';            
        ?>
        <section id="Centro" class="SectionCen col-lg-10">
            <div class="SectionCenInt">
            <div id="cards_ver_curso" class="card">
                    <div class="card-header blue-gradient" style="color: #888;">
                    </div>
                        <div class="card-header" style="color: #888;">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 text--center" style="margin-top: 1em;">
                                    <label>Actividad</label>
                                    <h2 class="curso-cards"><?php echo $columna1['1']; ?></h2>
                                    <hr>
                                </div>
                                
                                
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <center>
                                        <label>Fecha de Entrega</label>
                                        <?php
                                            $date = date_create($columna1['3']);
                                        ?>
                                        <h5><a class="curso-cards" href="#!"><?php echo date_format($date, 'd/m/Y || H:i:s'); ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                    <center>
                                        <label>Alumnos que Entregaron</label>
                                        <?php
                                            $Q_CountMax = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                detalle_actividades
                                                            WHERE 
                                                                Estado_Entrega = "Entregado"
                                                            AND
                                                                FK_Actividad = '.$idActividad;
                                            $resultadoM = mysqli_query($conexion, $Q_CountMax);
                                            $CountMax   = mysqli_fetch_array($resultadoM);

                                            $Q_CountMaxA = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                detalle_actividades
                                                            WHERE
                                                                FK_Actividad = '.$idActividad;
                                            $resultadoMA = mysqli_query($conexion, $Q_CountMaxA);
                                            $CountMaxA   = mysqli_fetch_array($resultadoMA);
                                        ?>
                                        <h5><a class="curso-cards" href="#!"><?php echo $CountMax['0']; ?> / <?php echo $CountMaxA['0']; ?></a></h5>
                                        <hr>
                                    </center>
                                </div>
                                <div class="col-lg-3">
                                        <center>
                                            <label>Actividades Calificadas</label>
                                            <?php
                                                $Q_CountMax = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                    detalle_actividades
                                                                WHERE 
                                                                    Estado_Calificacion = "Calificada"
                                                                AND
                                                                    FK_Actividad = '.$idActividad;
                                                $resultadoM = mysqli_query($conexion, $Q_CountMax);
                                                $CountMax   = mysqli_fetch_array($resultadoM);

                                                $Q_CountMaxA = 'SELECT COUNT(Estado_Entrega) FROM 
                                                                    detalle_actividades
                                                                WHERE
                                                                    FK_Actividad = '.$idActividad;
                                                $resultadoMA = mysqli_query($conexion, $Q_CountMaxA);
                                                $CountMaxA   = mysqli_fetch_array($resultadoMA);
                                            ?>
                                            <h5><a class="curso-cards" href="#!"><?php echo $CountMax['0']; ?> / <?php echo $CountMaxA['0']; ?></a></h5>
                                            <hr>
                                        </center>
                                </div>
                                <div class="col-lg-3">
                                        <center>
                                            <?php
                                                $Q_TCal ='SELECT
                                                                tipo_calificacion.Tipo_Calificacion
                                                          FROM 
                                                                detalle_actividades
                                                          INNER JOIN actividades ON detalle_actividades.FK_Actividad = actividades.idActividad
                                                          INNER JOIN tipo_calificacion ON actividades.FK_Tipo_Calificacion = tipo_calificacion .idTipoCalificacion
                                                          WHERE 
                                                                detalle_actividades.FK_Actividad = '.$idActividad;
                                                $resultadoTC  = mysqli_query($conexion, $Q_TCal);
                                                $CountTipCal  = mysqli_fetch_row($resultadoTC);
                                            ?>
                                            <label>Tipo de Actividad</label>
                                            <h5 class="curso-cards"><a class="curso-cards" href="#!"><?php echo $CountTipCal['0']; ?></a></h5>
                                            <hr>
                                        </center>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                
                                    <div class="col-lg-4">
                                    <center>
                                        <label>Puntaje Promedio de Actividad</label>
                                        <?php
                                            $Q_Suma = 'SELECT SUM(calificacion) FROM 
                                                                detalle_actividades
                                                            WHERE 
                                                                FK_Actividad = '.$idActividad;
                                            $resultadoS = mysqli_query($conexion, $Q_Suma);
                                            $CountSum   = mysqli_fetch_array($resultadoS);

                                            $Q_CountCal = 'SELECT COUNT(calificacion) FROM 
                                                                detalle_actividades
                                                            WHERE
                                                                FK_Actividad = '.$idActividad;
                                            $resultadoC = mysqli_query($conexion, $Q_CountCal);
                                            $CountCal   = mysqli_fetch_array($resultadoC);

                                            if($CountSum > 1 && $CountCal >= 1){
                                                $Promedio = $CountSum['0'] / $CountCal['0'];
                                        ?>
                                        <h5><a class="curso-cards" href="#!" title="Promedio de todas las entregas"><?php echo $Promedio; ?></a></h5>
                                        <?php
                                            } else {
                                                
                                        ?>
                                        <h5><a class="curso-cards" href="#!">Aun no se reciben puntajes</a></h5>
                                        <?php
                                            }
                                        ?>
                                        <hr>
                                    </center>
                                    </div>
                                    <div class="col-lg-4">
                                        <center>
                                            <?php
                                                $Q_Max = 'SELECT MAX(calificacion) FROM 
                                                                detalle_actividades
                                                            WHERE 
                                                                FK_Actividad = '.$idActividad;
                                                $resultadoMax = mysqli_query($conexion, $Q_Max);
                                                $CountMaxCal  = mysqli_fetch_row($resultadoMax);
                                                
                                                if($CountMaxCal['0'] > 0){
                                            ?>
                                            <label>Puntaje Maximo de Actividad</label>
                                            <h5 class="curso-cards"><a class="curso-cards" href="#!"><?php echo $CountMaxCal['0']; ?> / 100</a></h5>
                                            <hr>
                                            <?php
                                                } else {
                                            ?>
                                            <label>Puntaje Maximo de Actividad</label>
                                            <h5 class="curso-cards"><a class="curso-cards" href="#!">0 / 100</a></h5>
                                            <hr>
                                            <?php
                                                }
                                            ?>
                                        </center>
                                    </div>    
                                    <div class="col-lg-4">
                                        <center>
                                            <?php
                                                $Q_Min = 'SELECT MIN(calificacion) FROM 
                                                                detalle_actividades
                                                            WHERE 
                                                                FK_Actividad = '.$idActividad;
                                                $resultadoMin = mysqli_query($conexion, $Q_Min);
                                                $CountMinCal  = mysqli_fetch_row($resultadoMin);
                                                
                                                if($CountMinCal['0'] > 0){
                                            ?>
                                            <label>Puntaje Minimo de Actividad</label>
                                            <h5 class="curso-cards"><a class="curso-cards" href="#!"><?php echo $CountMinCal['0']; ?> / 100</a></h5>
                                            <hr>
                                            <?php
                                                } else {
                                            ?>
                                            <label>Puntaje Minimo de Actividad</label>
                                            <h5 class="curso-cards"><a class="curso-cards" href="#!">0 / 100</a></h5>
                                            <hr>
                                            <?php
                                                }
                                            ?>
                                        </center>
                                    </div>          
                            </div>
                            <br>
                        </div>
                        <div class="card-header blue-gradient" style="color: #888;">
                        </div>
                        <div id="data_curso_card" class="card-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <hr>
                                        <h6><a class="curso-cards" href="#!">Descripcion de la Actividad</a></h6>
                                        <p class="text-justify"><?php echo $columna1['2']; ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <center>
                                        
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header blue-gradient" style="color: #888;">
                        </div>
                            <div id="data_curso_card" class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 text--center">
                                        <hr>
                                        <h5><a class="curso-cards" href="#!">Entregas</a></h5>
                                        <hr>
                                    </div>                                           
                                </div>
                                <div class="row">
                                    <?php
                                        require 'vistas/datatable_entregas.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-header blue-gradient" style="color: #888;">
                        </div>    
                        <div class="card-footer text--center" style="color: #888;">
                            <cite><?php echo $columna1['1']; ?></cite>
                        </div> 
                        <div class="card-footer blue-gradient" style="color: #888;">
                        </div>
                    </div>
            </div>
        </section>
        <section id="SectionIzq">
            <div class="SectionIzqInt">
                <?php
                    require 'vistas/NavBar_SesIn.php';            
                ?>
            </div>
        </section>
        <script type="text/javascript" src="../js/sidebar.js"></script>
        
        <!--<script type="text/javascript" src="../js/Datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../js/Datatables/responsive.dataTables.js"></script>!-->
</body>
</html>
<?php
                } else {
                    header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Cursalia no recibio ningun identificador de entrega... :(</p>');
                }
            } else {
                header('location: menu.php?alert_permissions=<p class="msg_error_permissions">Usted no tiene permiso para ver este recurso.</p>');
            }
        } else {
            mysqli_close($conexion);
            header('location: controlador/cierre_sesion.php');
        }
    } else {
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>