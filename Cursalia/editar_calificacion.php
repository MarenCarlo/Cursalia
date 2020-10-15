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
        if($Rol1 == 1 || $Rol1 == 2){
            require_once "controlador/conexion.php";
            $idAlumno    = mysqli_real_escape_string($conexion,$_POST['idAlumno']);
            $idActividad = mysqli_real_escape_string($conexion,$_POST['idCalifi']);
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
                    require 'vistas/calificar_form_edit.php';
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
    </body>
</html>
<?php
        }else{
            header('location: menu');
        }
    }else{
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }

?>