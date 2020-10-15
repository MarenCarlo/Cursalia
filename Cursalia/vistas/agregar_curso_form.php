<?php 
    /*
        Se traen los datos de la sesion al menu,
        ya que se utilizaran en los includes y 
        para no estarlos llamando en cada documento
        incluido en el cual se utilizara.
        header('location: ../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    */
    if($Rol1 == 1){
?>
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
    <div id="Form_AddP">
        <form action="controlador/nuevo_curso.php" method="POST" class="form login" enctype="multipart/form-data">
            
            <div class="form__field">                               
                <label for="login__username" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><g><rect fill="none" height="24" width="24"/></g><g><g/><g><path d="M12,3c-0.42,0-0.85,0.04-1.28,0.11c-2.81,0.5-5.08,2.75-5.6,5.55c-0.48,2.61,0.48,5.01,2.22,6.56 C7.77,15.6,8,16.13,8,16.69C8,18.21,8,21,8,21h2.28c0.35,0.6,0.98,1,1.72,1s1.38-0.4,1.72-1H16v-4.31c0-0.55,0.22-1.09,0.64-1.46 C18.09,13.95,19,12.08,19,10C19,6.13,15.87,3,12,3z M14,19h-4v-1h4V19z M14,17h-4v-1h4V17z M12.5,11.41V14h-1v-2.59L9.67,9.59 l0.71-0.71L12,10.5l1.62-1.62l0.71,0.71L12.5,11.41z"/></g></g></svg></label>
                <input name="CursoTit1" id="login__username" type="text" class="form__input" placeholder="Titulo del Curso" required/>    
            </div>         

            <section>

                <div class="form__field">
                    <label for="exampleFormControlSelect1" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 6H2v16h16v-2H4V6zm18-4H6v16h16V2zm-2 10l-2.5-1.5L15 12V4h5v8z"/></svg></label>
                    <select name="Profes1" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
                        <option selected>-- Profesores --</option>
                            <?php
                                require_once "controlador/conexion.php";
                                /**
                                 * Se decidio hacer esta consulta para indicar a cual
                                 * de los cursos de su respectivo grado es al que se
                                 * debe seleccionar.
                                 */
                                $sql2 = "SELECT * FROM
                                        `usuarios`
                                        WHERE FK_Rol = 2;";

                                $query1 = mysqli_query($conexion,$sql2); 

                                while ($columna = mysqli_fetch_array($query1)){
                                    echo '<option value="'.$columna['0'].'">'.$columna['3'].' '.$columna['4'].'</option>';
                                }
                            ?>
                    </select>
                </div>
                            
            </section>
            <section>

                <div class="form__field">
                    <label for="exampleFormControlSelect1" class="blue-gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 2H4v20h16V2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg></label>
                    <select name="Grados1" id="select__form" class="form__input" class="form-control" id="exampleFormControlSelect1" required>
                            <?php
                                /**
                                 * Se decidio sacar el grado desde cursos,
                                 * por que de esta manera solo se obtienen 
                                 * los grados en los cuales este catedratico
                                 * imparte esos cursos.
                                 */
                                $sql2 = "SELECT
                                            grados.idGrado,
                                            grados.Codigo_Grado,
                                            grados.NombreGrado
                                        FROM
                                            grados
                                        WHERE grados.idGrado = $idGrado;";
                                
                                $query1 = mysqli_query($conexion,$sql2); 

                                while ($columna = mysqli_fetch_array($query1)){
                                    echo '<option selected value="'.$columna['0'].'">'.$columna['1'].' / '.$columna['2'].'</option>';
                                }
                            ?>
                    </select>
                </div>
                            
            </section>
            <center>
                <h6>Descripcion del Curso</h6>
            </center>
            <div class="form__field">
                <label for="login__username" class="blue-gradient"><svg style="margin-top: 220%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px"><path d="M15 15H3v2h12v-2zm0-8H3v2h12V7zM3 13h18v-2H3v2zm0 8h18v-2H3v2zM3 3v2h18V3H3z"/></svg></label> 
                <textarea name="CursoDesc1" onKeyUp="count_it()" id="text__area" maxlength="1024" class="form__input" id="login__username exampleFormControlTextarea1" rows="8" placeholder="Describe el nuevo curso!" required></textarea>
                <div class="wrap2">
                    <span id="count" class="counter blue-gradient"></span>
                </div>
            </div>
            <br>
            <center>
                <div class="form__field grid2">
                    <input class="purple-gradient" type="submit" value="Ingresar Curso!">
                </div>
            </center>
            <br>
            <script type="text/javascript" src="../js/charcounter.js"></script>
        </form>
    </div>
<?php
    }else{
        header('location: ../menu.php?alert_permissions=<p class="msg_error_permissions">Usted no tiene permiso para ver este recurso.</p>');
    }
?>