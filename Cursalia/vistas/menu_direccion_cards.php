<?php
    /*
        Se traen los datos de la sesion al menu,
        ya que se utilizaran en los includes y 
        para no estarlos llamando en cada documento
        incluido en el cual se utilizara.
    */
    $User1 = $_SESSION['User1'];
    $Rol1 = $_SESSION['Rol1'];

    if($Rol1 == 1){
?>
<style>
    #card1:hover{
        background: #323233;
    }
</style>
<div class="row" style="margin-top: -20px;">    
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M8 10H5V7H3v3H0v2h3v3h2v-3h3v-2zm10 1c1.66 0 2.99-1.34 2.99-3S19.66 5 18 5c-.32 0-.63.05-.91.14.57.81.9 1.79.9 2.86s-.34 2.04-.9 2.86c.28.09.59.14.91.14zm-5 0c1.66 0 2.99-1.34 2.99-3S14.66 5 13 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm6.62 2.16c.83.73 1.38 1.66 1.38 2.84v2h3v-2c0-1.54-2.37-2.49-4.38-2.84zM13 13c-2 0-6 1-6 3v2h12v-2c0-2-4-3-6-3z"/></svg>
                    Agregar Grado
                </h5>
                <p class="card-text">En este menu puedes agregar mas Grados a Cursalia.</p>
                <div class="row justify-content-center">
                    <a href="agregar_grado.php" class="btn btn-info blue-gradient col-lg-6">Agregar</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />
                </svg>
                    Agregar Catedratico
                </h5>
                <p class="card-text">En este menu puedes agregar mas Catedraticos a Cursalia.</p>
                <div class="row justify-content-center">
                    <a href="registro_catedratico.php" class="btn btn-info blue-gradient col-lg-6">Agregar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row" style="margin-top: -4rem;">    
    <div class="col-lg-12">
        <div id="cards_usuario" class="card">
            <div class="card-body text--center">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px">
                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                </svg>
                    Panel de Control de Usuarios.
                </h5>
                <p class="card-text">
                    En este menu dispones del control de todos los usuarios registrados en Cursalia.<br>
                </p>
                <div class="row justify-content-center">
                    <?php
                        require_once 'vistas/datatable_usuarios.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
<br>
<?php
if($Key == 1){
?>
<div class="row" style="margin-top: -4rem;">    
    <div class="col-lg-12">
        <div id="cards_usuario" class="card">
            <div class="card-body text--center">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px">
                    <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                </svg>
                    Panel de Configuracion.
                </h5>
                <p class="card-text">
                    En este menu dispones del control de todas las configuraciones del sistema que Cursalia te provee.<br>
                </p>
                <form action="controlador/configuration.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-lg-2" title="Con estas opciones seleccionas si quieres que la plataforma este Activada o en Mantenimiento, esta segunda opcion es ideal para realizar cambios del sistema en Cursalia o bien al momento de realizar cambios de Ciclo o Año...">
                            <svg class="icons-direccion-conf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="48px" height="48px"><path d="M4.5 11h-2V9H1v6h1.5v-2.5h2V15H6V9H4.5v2zm2.5-.5h1.5V15H10v-4.5h1.5V9H7v1.5zm5.5 0H14V15h1.5v-4.5H17V9h-4.5v1.5zm9-1.5H18v6h1.5v-2h2c.8 0 1.5-.7 1.5-1.5v-1c0-.8-.7-1.5-1.5-1.5zm0 2.5h-2v-1h2v1z"/></svg>
                            <br>
                            <?php
                                if($State_Platform['0'] == "Activo"){
                            ?>
                            <div style="text-align:left; margin-left: 10%; position: sticky;">
                                <div class="custom-control custom-radio custom-control-inline" style="margin-top: 4px;">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="0" checked>
                                    <label class="custom-control-label" for="customRadioInline2">Activo</label>
                                </div>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline" style="margin-bottom: 4px;">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customRadioInline1">Mantenimiento</label>
                                </div>
                            </div>
                            
                            <?php
                                }
                                if($State_Platform['0'] == "Mantenimiento"){
                            ?>
                            <div style="text-align:left; margin-left: 10%; position: sticky;">
                                <div class="custom-control custom-radio custom-control-inline" style="margin-top: 4px;">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="customRadioInline2">Activo</label>
                                </div>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline" style="margin-bottom: 4px;">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="1" checked>
                                    <label class="custom-control-label" for="customRadioInline1">Mantenimiento</label>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <p id="label2">Estado<br>Plataforma</p>
                        </div>
                        <div class="col-lg-2">
                            <svg class="icons-direccion-conf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="48px" height="48px"><path d="M4.5 11h-2V9H1v6h1.5v-2.5h2V15H6V9H4.5v2zm2.5-.5h1.5V15H10v-4.5h1.5V9H7v1.5zm5.5 0H14V15h1.5v-4.5H17V9h-4.5v1.5zm9-1.5H18v6h1.5v-2h2c.8 0 1.5-.7 1.5-1.5v-1c0-.8-.7-1.5-1.5-1.5zm0 2.5h-2v-1h2v1z"/></svg>
                            <br>
                            <label id="label2">Estado<br>de la<br>Plataforma</label>
                        </div>
                        <div class="col-lg-2">
                            <svg class="icons-direccion-conf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="48px" height="48px"><path d="M4.5 11h-2V9H1v6h1.5v-2.5h2V15H6V9H4.5v2zm2.5-.5h1.5V15H10v-4.5h1.5V9H7v1.5zm5.5 0H14V15h1.5v-4.5H17V9h-4.5v1.5zm9-1.5H18v6h1.5v-2h2c.8 0 1.5-.7 1.5-1.5v-1c0-.8-.7-1.5-1.5-1.5zm0 2.5h-2v-1h2v1z"/></svg>
                            <br>
                            <label id="label2">Estado<br>de la<br>Plataforma</label>
                        </div>
                        <div class="col-lg-2">
                            <svg class="icons-direccion-conf" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="48px" height="48px"><path d="M4.5 11h-2V9H1v6h1.5v-2.5h2V15H6V9H4.5v2zm2.5-.5h1.5V15H10v-4.5h1.5V9H7v1.5zm5.5 0H14V15h1.5v-4.5H17V9h-4.5v1.5zm9-1.5H18v6h1.5v-2h2c.8 0 1.5-.7 1.5-1.5v-1c0-.8-.7-1.5-1.5-1.5zm0 2.5h-2v-1h2v1z"/></svg>
                            <br>
                            <label id="label2">Estado<br>de la<br>Plataforma</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <input type="submit" id="Admin_Submit" class="btn btn-info purple-gradient col-lg-6" value="Actualizar" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
</div>
<br>
<?php
}
?>
<!--
<div class="row" style="margin-top: -20px;">
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                    Agregar Nivel Educativo
                </h5>
                <p class="card-text">En este menu puedes agregar distintos niveles estudiantiles a Cursalia.</p>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-info blue-gradient col-lg-6">Agregar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    Agregar Jornadas
                </h5>
                <p class="card-text">En este menu puedes agregar mas Jornadas de tiempo a Cursalia</p>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-info blue-gradient col-lg-6">Agregar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row" style="margin-top: -20px;">
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                    Agregar Seccion
                </h5>
                <p class="card-text">En este menu puedes agregar secciones a Cursalia.</p>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-info blue-gradient col-lg-6">Agregar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    Editar Seccion
                </h5>
                <p class="card-text">En este menu puedes editar las secciones agregadas en Cursalia.</p>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-info purple-gradient col-lg-6">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row" style="margin-top: -20px;">
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
                    Editar Porcentaje de Calificacion
                </h5>
                <p class="card-text">En este menu puedes editar los porcentajes de calificacion de todos los tipos de actividades de Cursalia.</p>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-info purple-gradient col-lg-6">Editar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                    Editar Nivel Educativo
                </h5>
                <p class="card-text">En este menu puedes editar los distintos niveles estudiantiles agregados anteriormente en Cursalia.</p>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-info purple-gradient col-lg-6">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row" style="margin-top: -20px;">
    <div class="col-lg-6">
        <br>
        <div id="cards_menu_direccion" class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <svg class="icons-direccion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="32px" height="32px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    Editar Jornadas
                </h5>
                <p class="card-text">En este menu puedes editar las Jornadas de tiempo de Cursalia</p>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-info purple-gradient col-lg-6">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
!-->
<?php
    }else{
        header('location: menu.php');
    }
?>