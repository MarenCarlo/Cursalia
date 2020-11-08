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
            if($Rol1 == 1 || $Rol1 == 2 || $Rol1 == 3){
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
                    require 'vistas/cursos_cards.php';
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
                header('location: menu.php?alert_permissions=<p class="msg_error_permissions">Usted no tiene permiso para ver este recurso.</p>');
            }
        } else {
            mysqli_close($conexion);
            header('location: controlador/cierre_sesion.php');
        }
    }else{
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }

?>