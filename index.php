<?php
    session_start();
    if(isset($_GET['alert_InSes'])){
        $alert = '';
        $alert= $_GET['alert_InSes'];
    }

    //Condicional que indica si la sesion es diferente de Activa
    if(!empty($_SESSION['active'])){
        /**
         * Si hay una sesion iniciada en ese dispositivo, quiere decir
         * que lo regresara de nuevo al menu.
         */
        header('location: Cursalia/menu?alert_null_pointer=<p class="msg_error_permissions">Cierre Sesion para poder logearse de nuevo</p>');
    } else {
?>
<!DOCTYPE html>
<style>
    body{
        overflow-y: hidden;
	    overflow-x: hidden;
    }
</style>
<html lang="es">
    <?php
        require_once 'Cursalia/vistas/headUI.php';
    ?>
    <body>
        <?php
            require_once 'Cursalia/vistas/navUIL.php';
            require_once 'Cursalia/login.php';
        ?> 
    </body>
</html>
<?php
    }
?>