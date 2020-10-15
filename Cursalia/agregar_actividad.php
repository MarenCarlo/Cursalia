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
        if($Rol1 == 1 || $Rol1 == 2){
            if(isset($_POST)){
                include 'controlador/conexion.php';
                $idCurso = mysqli_real_escape_string($conexion, $_POST['add_activity']);
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
                <?php
                    require 'vistas/agregar_actividad_form.php';            
                ?>
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
        <script type="text/javascript" src="../js/charcounter.js"></script>
        <script type="text/javascript" src="../js/datepicker_conf_addactiv.js"></script>
</body>
</html>
<?php
            } else {
                header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Cursalia no recibio ningun identificador del curso... :(</p>');
            }
        } else {
            header('location: menu.php?alert_permissions=<p class="msg_error_permissions">Usted no tiene permiso para ver este recurso.</p>');
        }
    } else {
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>