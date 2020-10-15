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
    <br>
<?php
}
?>
</div>
<div id="Form_AddP">
    <form action="controlador/nuevo_grado.php" method="POST" class="form login" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <center>
                    <p style="margin-top: -2px;">Codigo de Grado</p>
                </center>
                <div class="form__field">
                    <?php
                        require_once "controlador/conexion.php";
                        $Q_CGrado = 'SELECT MAX(idGrado) FROM grados WHERE NombreGrado NOT LIKE "No Aplicable";';
                        $queryCG  = mysqli_query($conexion,$Q_CGrado); 
                        $CodeGRow = mysqli_fetch_row($queryCG);
                        $Q_CGrado2 = 'SELECT Codigo_Grado FROM grados WHERE idGrado = '.$CodeGRow['0'].' AND NombreGrado NOT LIKE "No Aplicable";';
                        $queryCG2  = mysqli_query($conexion,$Q_CGrado2); 
                        $CodeGRow2 = mysqli_fetch_row($queryCG2);
                        if($CodeGRow >= 1 && $CodeGRow2 >= 1){
                    ?>
                    <label for="login__username" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
                    </label>
                    <input name="GraCode" placeholder="Ultimo Agregado: <?php echo $CodeGRow2['0']; ?>" type="text" class="form__input" required/>
                    <?php
                        }
                        if($CodeGRow == 0 && $CodeGRow2 == 0){
                    ?>
                        <label for="login__username" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
                    </label>
                    <input name="GraCode" placeholder="Codigo del Grado" type="text" class="form__input" required/>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-4">
                <center>
                    <p style="margin-top: -2px;">Nivel Estudiantil</p>
                </center>
                <div class="form__field">
                    <label for="exampleFormControlSelect1" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                    </label>
                    <select name="GraNivel" id="select__form" class="form__input" class="form-control" required>
                        <option value="">- Nivel Estudiantil -</option>
                        <?php
                                                /**
                                                 * Se decidio hacer esta consulta para indicar a cual
                                                 * de los cursos de su respectivo grado es al que se
                                                 * debe seleccionar.
                                                 */
                            $sqlX2 = 'SELECT * FROM nivel_estudiantil WHERE Nivel_Estudiantil NOT LIKE "No Aplicable";';
                            $query1 = mysqli_query($conexion,$sqlX2);
                            while ($columna = mysqli_fetch_array($query1)){
                                echo '<option value="'.$columna['0'].'">'.$columna['1'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <center>
                    <p style="margin-top: -2px;">Jornada</p>
                </center>
                <div class="form__field">
                    <label for="exampleFormControlSelect1" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    </label>
                    <select name="GraJornada" id="select__form" class="form__input" class="form-control" required>
                        <option value="">- Jornada de Cursos-</option>
                        <?php
                                                /**
                                                 * Se decidio hacer esta consulta para indicar a cual
                                                 * de los cursos de su respectivo grado es al que se
                                                 * debe seleccionar.
                                                 */
                            $sqlX2 = 'SELECT * FROM jornada WHERE Jornada NOT LIKE "No Aplicable";';
                            $query1 = mysqli_query($conexion,$sqlX2);
                            while ($columna = mysqli_fetch_array($query1)){
                                echo '<option value="'.$columna['0'].'">'.$columna['1'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <center>
                    <p style="margin-top: -2px;">Secciones</p>
                </center>
                <div class="form__field">
                    <label for="exampleFormControlSelect1" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg>
                    </label>
                    <select name="GraSeccion" id="select__form" class="form__input" class="form-control" required>
                        <option value="">- Seccion -</option>
                        <?php
                                                /**
                                                 * Se decidio hacer esta consulta para indicar a cual
                                                 * de los cursos de su respectivo grado es al que se
                                                 * debe seleccionar.
                                                 */
                            $sqlX2 = 'SELECT * FROM secciones WHERE NombreSeccion NOT LIKE "N/A";';
                            $query1 = mysqli_query($conexion,$sqlX2);
                            while ($columna = mysqli_fetch_array($query1)){
                                echo '<option value="'.$columna['0'].'">'.$columna['1'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="dropdown-divider light"></div>
        <div class="row">
            <div class="col-lg-12">
                <center>
                    <p style="margin-top: 5px;">Titulo de Grado</p>
                </center>
                <div class="form__field">
                    <label for="login__username" class="blue-gradient">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>
                    </label>
                    <input name="GraNombre" id="login__username" type="text" class="form__input" placeholder="Nombre del Grado o Carrera" required />
                </div>
            </div>
            <div class="col-lg-12">
                <center>
                    <p style="margin-top: -2px;">Descripcion de Grado</p>
                </center>
                <div class="form__field">
                    <label for="login__username" class="blue-gradient">
                        <svg style="margin-top: 250%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M15 15H3v2h12v-2zm0-8H3v2h12V7zM3 13h18v-2H3v2zm0 8h18v-2H3v2zM3 3v2h18V3H3z" /></svg>
                    </label>
                    <textarea name="GraDescrip" onKeyDown="count_it()" id="text__area" maxlength="1024" class="form__input" id="login__username exampleFormControlTextarea1" rows="8" placeholder="Describe brevemente sobre que trata la actividad" required></textarea>
                    <div class="wrap2">
                        <span id="count" class="counter blue-gradient"></span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <center>
            <div class="form__field grid2">
                <input name="AgregarGrado" class="purple-gradient" type="submit" value="Ingresar Actividad!">
            </div>
        </center>
        <br>
    </form>
</div>