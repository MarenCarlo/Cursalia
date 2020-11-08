<?php
    if($UserRol1 == 1 || $UserRol1 == 3){
?>
<div class="row">
    <div class="col-lg-6">
        <div id="cards_usuario" class="card text-center">
            <div class="card-header" id="head_users">
                <figure id="Profile">
                    <div class="cuadros">
                        <div class="foto">
                            <center>
                            <?php
                                /**
                                 * Fragmento que nos permite obtener la primera
                                 * letra del nombre de usuario
                                 * explode () es una función incorporada en PHP que 
                                 * se utiliza para dividir un String en diferentes Strings.
                                */
                                $strs = explode(" ", strtoupper($UserNick1));

                                foreach($strs as $str){
                                    echo $str[0];
                                }
                            ?>
                                </center>
                            </div>
                        </div>
                    <div class="cuadros">
                        <h3 class="curso-cards"><?php echo $UserNick1; ?></h3>
                    </div>
                    <h6 class="curso-cards"><?php echo $UserFName1.' '.$UserLName1; ?></h6>
                    <?php 
                    require_once 'controlador/conexion.php';
                    $Q_Rol  = "SELECT * FROM roles WHERE idRol = $UserRol1;";
                    $QueryX = mysqli_query($conexion, $Q_Rol);
                    $RolDes = mysqli_fetch_row($QueryX);
                    echo '<h6 class="text-muted">'.$RolDes['1'].'</h6>';
                    
                    ?>
                </figure>
            </div>
            <div class="card-body">
                <h5 class="card-title curso-cards-blue">Informacion de Contacto</h5>
                <p class="card-text text-truncate d-inline-block col-12 text-left" style="max-width: 100%; margin-top: 1%;"><b>Email:</b> <?php echo $UserEmail1; ?></p>
                <p class="card-text text-truncate d-inline-block col-12 text-left" style="max-width: 100%; margin-top: -10%;"><b>Telefono:</b> <?php echo $UserPhone; ?></p>
            </div>
            <div class="card-footer text-muted">
                
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div id="cards_usuario" class="card text-center">
            <div class="card-header">
                <?php
                    $sql = "SELECT COUNT(detalle_sesiones.Estado_Ses) FROM detalle_sesiones
                            INNER JOIN usuarios ON detalle_sesiones.FK_Usuario = usuarios.idUsuario
                            WHERE detalle_sesiones.Estado_Ses = 'Activa';";
                    $query = mysqli_query($conexion,$sql);
                    $columna = mysqli_fetch_array($query);
                ?>
                Usuarios En Linea: <?php echo $columna['0']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title curso-cards-blue"></h5>
                <div>
                    <ul class="list-group" style="background: #EEEEEE;">
                        <?php
                            $sql1 = "SELECT * FROM detalle_sesiones
                                    INNER JOIN usuarios ON detalle_sesiones.FK_Usuario = usuarios.idUsuario
                                    WHERE detalle_sesiones.Estado_Ses = 'Activa';";
                            $query1 = mysqli_query($conexion,$sql1);
                            while ($columna1 = mysqli_fetch_array($query1)){
                        ?>
                        <li class="list-group-item" style="background: #EEEEEE; padding-top: 0.5%; padding-bottom: 0%;">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>
                                <?php echo $columna1['6']; ?>
                            </label>
                        </li>
                        <?php
                            }
                            mysqli_close($conexion);
                        ?>
                    </ul>
                </div>
                <br>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>
</div>
<?php
    }
    if($UserRol1 == 2){
?>
<div class="row">
    <div class="col-lg-6">
        <div id="cards_usuario" class="card text-center">
            <div class="card-header" id="head_users">
                <figure id="Profile">
                    <div class="cuadros">
                        <div class="foto">
                            <center>
                            <?php
                                /**
                                 * Fragmento que nos permite obtener la primera
                                 * letra del nombre de usuario
                                 * explode () es una función incorporada en PHP que 
                                 * se utiliza para dividir un String en diferentes Strings.
                                */
                                $strs = explode(" ", strtoupper($UserNick1));

                                foreach($strs as $str){
                                    echo $str[0];
                                }
                            ?>
                                </center>
                            </div>
                        </div>
                    <div class="cuadros">
                        <h3 class="curso-cards"><?php echo $UserNick1; ?></h3>
                    </div>
                    <h6 class="curso-cards"><?php echo $UserFName1.' '.$UserLName1; ?></h6>
                    <?php 
                    require_once 'controlador/conexion.php';
                    $Q_Rol  = "SELECT * FROM roles WHERE idRol = $UserRol1;";
                    $QueryX = mysqli_query($conexion, $Q_Rol);
                    $RolDes = mysqli_fetch_row($QueryX);
                    echo '<h6 class="text-muted">'.$RolDes['1'].'</h6>';
                    
                    ?>
                </figure>
            </div>
            <div class="card-body">
                <h5 class="card-title curso-cards-blue">Informacion de Contacto</h5>
                <p class="card-text text-truncate d-inline-block col-12 text-left" style="max-width: 100%; margin-top: 1%;"><b>Email:</b> <?php echo $UserEmail1; ?></p>
                <p class="card-text text-truncate d-inline-block col-12 text-left" style="max-width: 100%; margin-top: -10%;"><b>Telefono:</b> <?php echo $UserPhone; ?></p>
            </div>
            <div class="card-footer text-muted">
                
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div id="cards_usuario" class="card text-center">
            <div class="card-header">
                Mis Grados
            </div>
            <div class="card-body">
                <h5 class="card-title curso-cards-blue"></h5>
                <div>
                    <ul class="list-group" style="background: #EEEEEE;">
                        <?php
                            $sql1 = "SELECT DISTINCT
                                        grados.idGrado,
                                        grados.NombreGrado
                                    FROM
                                        `cursos`
                                    INNER JOIN grados ON cursos.FK_Grado = grados.idGrado
                                    WHERE
                                        cursos.FK_Catedratico = $UserId1;";
                            $query1 = mysqli_query($conexion,$sql1);
                            while ($columna1 = mysqli_fetch_array($query1)){
                        ?>
                        <a href="ver_grado.php?grado=<?php echo $columna1['0']; ?>">
                        <li id="list_item" class="list-group-item">
                            <label>
                                <center>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20px" height="20px">
                                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                    </svg>
                                </center>
                                <?php echo $columna1['1']; ?>
                            </label>
                        </li>
                        </a> 
                        <?php
                            }
                            mysqli_close($conexion);
                        ?>
                    </ul>
                </div>
                <br>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>
</div>
<?php
    }
?>