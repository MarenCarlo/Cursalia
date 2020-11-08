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
    $User1 = $_SESSION['User1'];
    $Rol1 = $_SESSION['Rol1'];

    require_once "controlador/conexion.php";
    $Q_State        = "SELECT (Estado_Plataforma) FROM configuraciones_varias;";
    $Q_Send         = mysqli_query($conexion,$Q_State);           
    $State_Platform = mysqli_fetch_array($Q_Send);
    if($State_Platform['0'] == "Activo" || $Rol1 == 1){
        if($Rol1 == 1){
            if(isset($_POST['idGrado'])){
                include 'controlador/conexion.php';
                $idGrado = mysqli_real_escape_string($conexion, $_POST['idGrado']);
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
                <div class="container">
<?php
                /**
                 * Alertas de permisos o errores null pointer...
                 */
                if (isset($_GET['alert_null_pointer'])) {
                    $alert0 = $_GET['alert_null_pointer'];
?>
                    <div id="alertX0" class="alert0 container"><?php echo isset($alert0) ? $alert0 : ''; ?></div>
                    <br>
<?php
                }
                if (isset($_GET['alert_null_pointer1'])) {
                    $alert1 = $_GET['alert_null_pointer1'];
?>
                    <div id="alertX1" class="alert1 container"><?php echo isset($alert1) ? $alert1 : ''; ?></div>
                    <br>
                    <br>
<?php
                }
                if (isset($_GET['alert_null_pointer2'])) {
                    $alert2 = $_GET['alert_null_pointer2'];
?>
                    <div id="alertX2" class="alert2 container"><?php echo isset($alert2) ? $alert2 : ''; ?></div>
                    <br>
                    <br>
<?php
                }
                if (isset($_GET['alert_null_pointer3'])) {
                    $alert3 = $_GET['alert_null_pointer3'];
?>
                    <div id="alertX3" class="alert3 container"><?php echo isset($alert3) ? $alert3 : ''; ?></div>
                    <br>
                    <br>
<?php
                }
?>
            </div>
                <form action="controlador/nuevo_alumno.php" method="POST" enctype="multipart/form-data" class="form login">
                    <div class="row">
                        <div class="col-lg-4">
                            <center>
                                <h6>Codigo Educativo</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z"/></svg></label>
                                <input name="Codigo_Alumno" id="login__username" type="text" class="form__input" placeholder="Codigo Estudiantil" required> 
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <center>
                                <h6>Grado</h6>
                            </center>
                            <div class="form__field">
                                <label for="exampleFormControlSelect1" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 2H4v20h16V2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg></label>
                                <select name="Grado_Alumno" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
                                    <?php
                                        require_once 'controlador/conexion.php';
                                        $sql2 = "SELECT DISTINCT * FROM `grados` WHERE `NombreGrado` NOT LIKE 'No Aplicable' AND idGrado = $idGrado;";
                                        $query1 = mysqli_query($conexion,$sql2); 
                                        while ($columna = mysqli_fetch_array($query1)){
                                    ?>
                                    <option selected value="<?php echo $columna['0']; ?>">(<?php echo $columna['1']; ?>) <?php echo $columna['2']; ?></option>
                                    <?php        
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <center>
                                <h6>Nivel Estudiantil</h6>
                            </center>
                            <div class="form__field">
                                <label for="exampleFormControlSelect1" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 2H4v20h16V2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg></label>
                                <select name="Nivel_Alumno" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
                                    <?php
                                            $sql2 = "SELECT
                                                        nivel_estudiantil.idNivelEstudiantil,
                                                        nivel_estudiantil.Nivel_Estudiantil
                                                    FROM 
                                                        grados
                                                    INNER JOIN nivel_estudiantil ON grados.FK_Nivel_Estudiantil = nivel_estudiantil.idNivelEstudiantil
                                                    WHERE grados.idGrado = $idGrado;";
                                
                                            $query2 = mysqli_query($conexion,$sql2); 
                                            $row    = mysqli_fetch_row($query2);
                                    ?>
                                    <option selected value="<?php echo $row['0']; ?>"><?php echo $row['1']; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 float-left">
                            <center>
                                <h6>Genero</h6>
                            </center>
                            <div class="form__field">
                                <label for="exampleFormControlSelect1" class="blue-gradient">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />
                                    </svg>
                                </label>
                                <select name="Genero_Alumno" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
                                    <option selected>-- Genero --</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="No Binario">No Binario</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <center>
                                <h6>Numero Telefonico</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>    
                                </label>
                                <input name="Telefono_Alumno" id="login__username" type="text" class="form__input" placeholder="+502 0000-0000" required>    
                            </div>
                        </div>
                        <div class="col-lg-4 float-right">
                            <center>
                                    <h6>Fecha de Nacimiento</h6>
                            </center>    
                            <div class="form__field">      
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M17 13h-5v5h5v-5zM16 2v2H8V2H6v2H3.01L3 22h18V4h-3V2h-2zm3 18H5V9h14v11z"/></svg></label>
                                <input name="FechaNac_Alumno" data-provide="datepicker" id="datepicker" type="date" class="form__input" required/>    
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-row">  
                        <div class="col-lg-6">
                            <center>
                                <h6>Nombres</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg><span class="hidden">Usuario</span></label>
                                <input name="Nombres_Alumno" id="login__username" type="text" class="form__input" placeholder="Nombres" required>    
                            </div>
                            <center>
                                <h6>Apellidos</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg><span class="hidden">Usuario</span></label>
                                <input name="Apellidos_Alumno" id="login__username" type="text" class="form__input" placeholder="Apellidos" required>    
                            </div>
                            <center>
                                <h6>Nombre de Usuario</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9 17l3-2.94c-.39-.04-.68-.06-1-.06-2.67 0-8 1.34-8 4v2h9l-3-3zm2-5c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4"/><path d="M15.47 20.5L12 17l1.4-1.41 2.07 2.08 5.13-5.17 1.4 1.41-6.53 6.59z"/></svg></label>
                                <input name="Usuario_Alumno" id="login__username" type="text" class="form__input" placeholder="Nombre de Usuario" required> 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <center>
                                <h6>Correo Electronico</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M22 4H2v16h20V4zm-2 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></label>
                                <input name="Email_Alumno" id="email__form" type="email" class="form__input" placeholder="Correo Electronico" required>
                            </div>
                            <center>
                                <h6>Confirme su Correo Electronico</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M22 4H2v16h20V4zm-2 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></label>
                                <input id="email__form" type="email" class="form__input" placeholder="Confirme su correo electonico." required>
                            </div>
                        </div>
                    </div>
                        
                    <hr/>
                    
                    <div class="form-row">
                        <div class="col-lg">
                            <center>
                                <h6>Contraseña</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__password" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg></label>
                                <input name="Pass_Alumno" id="login__password" type="password" class="form__input" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div class="col-lg">
                            <center>
                                <h6>Confirme su Contraseña</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__password" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg></label>
                                <input id="login__password" type="password"  class="form__input" placeholder="Confirme la Contraseña" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <center>
                        <button name="Alumno" type="submit" class="btn btn-info purple-gradient col-3-sm-12">Agregar Alumno!</button> 
                    </center>
                    <br>
                </form>
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
                }else{
                    header('location: menu.php?alert_null_pointer=<p class="msg_error_permissions">Cursalia no recibio ningun identificador de grado... :(</p>');
                }
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