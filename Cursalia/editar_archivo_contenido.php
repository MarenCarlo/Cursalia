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
                $idContent = mysqli_real_escape_string($conexion, $_POST['edit_content']);
                $idCurso   = mysqli_real_escape_string($conexion, $_POST['FK_Curso']);

                $Q_EditContent = "SELECT * FROM archivos_contenidos 
                                  WHERE idContenido = $idContent 
                                  AND FK_Curso = $idCurso";
                $ResultEditCon = mysqli_query($conexion, $Q_EditContent);
                $ContentData   = mysqli_fetch_array($ResultEditCon);
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
                <div id="Form_AddP">
                    <form action="controlador/editar_contenido.php" method="POST" enctype="multipart/form-data" class="form login">
                        <center>
                            <h6>Titulo del Contenido</h6>
                        </center>
                        <div class="form__field">                               
                            <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><path d="M12,3c-0.42,0-0.85,0.04-1.28,0.11c-2.81,0.5-5.08,2.75-5.6,5.55c-0.48,2.61,0.48,5.01,2.22,6.56 C7.77,15.6,8,16.13,8,16.69C8,18.21,8,21,8,21h2.28c0.35,0.6,0.98,1,1.72,1s1.38-0.4,1.72-1H16v-4.31c0-0.55,0.22-1.09,0.64-1.46 C18.09,13.95,19,12.08,19,10C19,6.13,15.87,3,12,3z M14,19h-4v-1h4V19z M14,17h-4v-1h4V17z M12.5,11.41V14h-1v-2.59L9.67,9.59 l0.71-0.71L12,10.5l1.62-1.62l0.71,0.71L12.5,11.41z"/></g></g></svg></label>
                            <input value="<?php echo $ContentData['5']; ?>" name="ContentTitUp" id="login__username" type="text" class="form__input" placeholder="Titulo del Contenido" required/>    
                        </div>    
                        <center>
                            <h6>Descripcion del Contenido</h6>
                        </center>
                        <div class="form__field">
                            <label for="login__username" class="blue-gradient">
                                <svg style="margin-top: 250%;"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                                    <path d="M15 15H3v2h12v-2zm0-8H3v2h12V7zM3 13h18v-2H3v2zm0 8h18v-2H3v2zM3 3v2h18V3H3z" />
                                </svg>
                            </label>
                            <textarea name="ContentDesUp" onKeyDown="count_it()" id="text__area" maxlength="1024" class="form__input" id="login__username exampleFormControlTextarea1" rows="8" placeholder="Describe brevemente sobre que habla este contenido" required><?php echo $ContentData['6']; ?></textarea>
                            <div class="wrap2">
                                <span id="count" class="counter blue-gradient"></span>
                            </div>
                        </div>
                        <br>
                        <center>
                            <h6>Archivo del Contenido</h6>
                        </center>
                        <div class="form__field">
                            <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                                    <path d="M0 0h24v24H0V0z" fill="none" /><path d="M10 4H2v16h20V6H12l-2-2z" /></svg>
                            </label>
                            <input value="<?php echo $ContentData['1']; ?>" id="file__input" class="form__input" type="text" style="padding-left: 20px;" required disabled>
                        </div>
                        <center>
                            <button name="IdContent" value="<?php echo $ContentData['0'];?>" type="submit" class="btn btn-info purple-gradient col-3-sm-12">Guardar Datos!</button> 
                        </center>
                        <br>
                    </form>
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