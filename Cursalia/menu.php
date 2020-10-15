<?php
//Se inicia la sesion Guardada desde el login
session_start();
    /**
     *  Se traen los datos de la sesion al menu,
     *  ya que se utilizaran en los includes y 
     *  para no estarlos llamando en cada documento
     *  incluido en el cual se utilizara.
    */
if ($_SESSION['active'] == true) {
    $UserId1    = $_SESSION['idUsuario1'];
    $UserNick1  = $_SESSION['User1'];
    $UserFName1 = $_SESSION['FName1'];
    $UserLName1 = $_SESSION['LName1'];
    $UserEmail1 = $_SESSION['Email1'];
    $UserRol1   = $_SESSION['Rol1'];
    $UserGrado1 = $_SESSION['Grado1'];
    $UserGender = $_SESSION['Genero'];
    $UserFecNac = $_SESSION['FechaNac'];
    $UserPhone  = $_SESSION['Telefono1'];
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
                /**
                 * Alertas de permisos o errores null pointer...
                 */
                if (isset($_GET['alert_permissions'])) {
                    $alert1 = $_GET['alert_permissions'];
?>  
                    <div id="alertX1" class="alert1 container"><?php echo isset($alert1) ? $alert1 : ''; ?></div>
                    <br>
                    <br>
<?php 
                }
                if (isset($_GET['alert_null_pointer'])) {
                    $alert2 = $_GET['alert_null_pointer'];
?>
                    <div id="alertX2" class="alert2 container"><?php echo isset($alert2) ? $alert2 : ''; ?></div>
                    <br>
                    <br>
<?php
                }
                if (isset($_GET['alert_success'])) {
                    $alert3 = $_GET['alert_success'];
?>  
                    <div id="alertX3" class="alert3 container"><?php echo isset($alert3) ? $alert3 : ''; ?></div>
                    <br>
                    <br>
<?php
                }
?>
            <?php
                require 'vistas/cards_usuarios.php';
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
    <script type="text/javascript" src="../js/alertas.js"></script>
</body>
</html>
<?php
} else {
    header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
}
?>