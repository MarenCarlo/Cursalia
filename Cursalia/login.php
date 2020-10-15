<div class="center d-flex loginx">
    <div class="grid2">

        <form action="Cursalia/controlador/inicio_sesion.php" method="POST" class="form login">

            <div class="form__field">
                <label class="blue-gradient" for="login__username"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="white" width="22px" height="22px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M9 17l3-2.94c-.39-.04-.68-.06-1-.06-2.67 0-8 1.34-8 4v2h9l-3-3zm2-5c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4" />
                        <path d="M15.47 20.5L12 17l1.4-1.41 2.07 2.08 5.13-5.17 1.4 1.41-6.53 6.59z" /></svg></label>
                <input id="login__username" type="text" name="user1" class="form__input" placeholder="Usuario" required>
            </div>

            <div class="form__field">
                <label class="blue-gradient" for="login__password"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="white" width="22px" height="22px">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                    </svg>
                </label>
                <input id="login__password" type="password" name="pass1" class="form__input" placeholder="Contraseña"
                    required>
            </div>

            <div class="form__field">
                <input class="purple-gradient" type="submit" value="Entrar!">
            </div>

        </form>

        <p class="text--center">¿Deseas revisar tus calificaciones rapidamente? <a href="#!" data-toggle="modal" data-target="#staticBackdrop">Revisar Ahora!</a></p>

        <!-- Modal -->
        <div style="background: #000000AA;" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background: #2D2D45;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ingrese su codigo estudiantil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="Cursalia/revisar_calificaciones.php" method="POST" class="form login">
                        <div class="modal-body">
                            <div class="form__field">
                                <label class="blue-gradient">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22px" height="22px"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M9 17l3-2.94c-.39-.04-.68-.06-1-.06-2.67 0-8 1.34-8 4v2h9l-3-3zm2-5c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4" /><path d="M15.47 20.5L12 17l1.4-1.41 2.07 2.08 5.13-5.17 1.4 1.41-6.53 6.59z" /></svg>
                                </label>
                                <input type="text" name="idAlumno" class="form__input" placeholder="Codigo de Alumno" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn purple-gradient" data-dismiss="modal">Cerrar</button>
                            <button class="btn blue-gradient" type="submit">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <div class="alert"><?php echo isset($alert1) ? $alert1 : ''; ?></div>
        <div class="alert"><?php echo isset($alert3) ? $alert3 : ''; ?></div>
    </div>
</div>