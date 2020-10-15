
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
                <form action="controlador/nuevo_catedratico.php" method="POST" enctype="multipart/form-data" class="form login">
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
                                <select name="Genero_Cate" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
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
                                <input name="Telefono_Cate" id="login__username" type="text" class="form__input" placeholder="+502 0000-0000" required>    
                            </div>
                        </div>
                        <div class="col-lg-4 float-right">
                            <center>
                                    <h6>Fecha de Nacimiento</h6>
                            </center>    
                            <div class="form__field">      
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M17 13h-5v5h5v-5zM16 2v2H8V2H6v2H3.01L3 22h18V4h-3V2h-2zm3 18H5V9h14v11z"/></svg></label>
                                <input name="FechaNac_Cate" data-provide="datepicker" id="datepicker" type="date" class="form__input" required/>    
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
                                <input name="Nombres_Cate" id="login__username" type="text" class="form__input" placeholder="Nombres" required>    
                            </div>
                            <center>
                                <h6>Apellidos</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg><span class="hidden">Usuario</span></label>
                                <input name="Apellidos_Cate" id="login__username" type="text" class="form__input" placeholder="Apellidos" required>    
                            </div>
                            <center>
                                <h6>Nombre de Usuario</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9 17l3-2.94c-.39-.04-.68-.06-1-.06-2.67 0-8 1.34-8 4v2h9l-3-3zm2-5c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4"/><path d="M15.47 20.5L12 17l1.4-1.41 2.07 2.08 5.13-5.17 1.4 1.41-6.53 6.59z"/></svg></label>
                                <input name="Usuario_Cate" id="login__username" type="text" class="form__input" placeholder="Nombre de Usuario" required> 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <center>
                                <h6>Correo Electronico</h6>
                            </center>
                            <div class="form__field">
                                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M22 4H2v16h20V4zm-2 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></label>
                                <input name="Email_Cate" id="email__form" type="email" class="form__input" placeholder="Correo Electronico" required>
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
                                <input name="Pass_Cate" id="login__password" type="password" class="form__input" placeholder="Contraseña" required>
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
                        <button name="Catedratico" type="submit" class="btn btn-info purple-gradient col-3-sm-12">Agregar Catedratico!</button> 
                    </center>
                    <br>
                </form>