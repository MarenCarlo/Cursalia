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
    $IdUser1    = $_SESSION['idUsuario1'];
    $UserNick1  = $_SESSION['User1'];
    $UserFName1 = $_SESSION['FName1'];
    $UserLName1 = $_SESSION['LName1'];
    $GradoUser1 = $_SESSION['Grado1'];
    $Rol1       = $_SESSION['Rol1'];

    require_once "controlador/conexion.php";
    $Q_State        = "SELECT (Estado_Plataforma) FROM configuraciones_varias;";
    $Q_Send         = mysqli_query($conexion,$Q_State);           
    $State_Platform = mysqli_fetch_array($Q_Send);
    if($State_Platform['0'] == "Activo" || $Rol1 == 1){
        if(isset($_POST['idAlumno'])){
                require_once 'controlador/conexion.php';
                $idAlumno = mysqli_real_escape_string($conexion, $_POST['idAlumno']);
                
                $Q_Detail = 'SELECT
                                detalle_alumno.idDetalle_Alumno,
                                detalle_alumno.Codigo_Estudiantil,
                                usuarios.idUsuario,
                                usuarios.User,
                                usuarios.FName_User,
                                usuarios.LName_User,
                                grados.idGrado,
                                grados.Codigo_Grado,
                                grados.NombreGrado,
                                secciones.NombreSeccion,
                                jornada.Jornada,
                                nivel_estudiantil.idNivelEstudiantil,
                                nivel_estudiantil.Nivel_Estudiantil
                            FROM
                                detalle_alumno
                            INNER JOIN usuarios ON detalle_alumno.FK_Usuario = usuarios.idUsuario
                            INNER JOIN grados ON detalle_alumno.FK_Grado = grados.idGrado
                            INNER JOIN nivel_estudiantil ON detalle_alumno.FK_Nivel_Estudiantil = nivel_estudiantil.idNivelEstudiantil
                            INNER JOIN jornada ON grados.FK_Jornada = jornada.idJornada
                            INNER JOIN secciones ON grados.FK_Seccion = secciones.idSeccion
                            WHERE
                                detalle_alumno.Codigo_Estudiantil = "'.$idAlumno.'";';
                $Res_Detail = mysqli_query($conexion, $Q_Detail);
                $Row_Detail = mysqli_fetch_row($Res_Detail);    
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
        <link rel="stylesheet" href="../css/impresion.css">
        <section id="Centro" class="SectionCen col-lg-10">
            <div class="SectionCenInt">
                <div class="container">
                    <div id="cards_ver_curso" class="card">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <h1 id="LogoX_Impress" class="mx-auto">Cursalia</h1>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Codigo de Estudiante</label>
                                        <h5><?php echo $Row_Detail['1']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Nivel Estudiantil</label>
                                        <h5><?php echo $Row_Detail['12']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Codigo de Grado</label>
                                        <h5><?php echo $Row_Detail['7']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Grado</label>
                                        <h5><?php echo $Row_Detail['8']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Seccion</label>
                                        <h5>"<?php echo $Row_Detail['9']; ?>"</h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Jornada</label>
                                        <h5><?php echo $Row_Detail['10']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                            </div>
                            <hr id="hrx">
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <label>Usuario</label>
                                        <h5><?php echo $Row_Detail['3']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Nombres</label>
                                        <h5><?php echo $Row_Detail['4']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                                <div class="col-lg-4">
                                    <center>
                                        <label>Apellidos</label>
                                        <h5><?php echo $Row_Detail['5']; ?></h5>
                                        <hr id="hrx2">
                                    </center>
                                </div>
                            </div>
                            <hr id="hrx1">
                            <div id="ContainerX">
                                <div class="row justify-content-center">
                                    <div>
                                        <center>
                                            <h3 id="H5X" class="curso-cards">Promedio de Cursos</h3>
                                        </center>
                                        <?php require_once 'vistas/datatable_promedio_unalumno.php' ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <center>
                                        <a id="printBut" onclick="print()" href="#!" class="btn btn-info purple-gradient col-3-sm-12">Imprimir</a>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <br>
                <br>
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
    </body>
</html>
<?php
            } else {
                header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Cursalia no recibio ningun identificador de Alumno... :(</p>');
            }
        } else {
            mysqli_close($conexion);
            header('location: controlador/cierre_sesion.php');
        }
    } else {
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>