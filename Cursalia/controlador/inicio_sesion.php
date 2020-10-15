<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA EL INICIO DE SESION DE LOS USUARIOS
     */
    if(!empty($_POST)){
        session_start();
        require_once "conexion.php";
        /*
            La consulta de abajo sirve para obtener el estado de ese usuario desde la BD.

            $user2: Sirve para consultar a la base de datos el usuario que ingresaron en el POST,
            que lo utilizaremos para ejecutar la consulta de $sql para obtener el estado de $user2,
            el cual sera utilizado en la condicional para validar si el usuario esta 'Activo, o en
            dado caso 'Inactivo'.
        */
        $user2 = mysqli_real_escape_string($conexion, $_POST['user1']);
        $sql = "SELECT (Estado) FROM usuarios WHERE User = '$user2';";
        $query = mysqli_query($conexion,$sql);           
        $columna = mysqli_fetch_array($query);

        /**
         * Linea de codigo que nos ayuda a que no tire un error final
         * si la consulta anterior es errada
         */
        if($columna > 0){
            //La consulta da como resultado una sola columna, por ende el indice de el Estado sera 0.
            $State = $columna['0'];
        } else {
            $State = '';
        }

        //Condicional que valida si el usuario esta Activo.
        if($State != 'Inactivo'){
                
            /*
                mysqli_real_escape_string():

                llama a la función mysql_real_escape_string 
                de la biblioteca de MySQL, la cual antepone 
                barras invertidas a los siguientes caracteres: 
                \x00, \n, \r, \, ', " y \x1a.

                Esta función siempre debe usarse (con pocas excepciones)
                para hacer seguros los datos antes de enviar una consulta a MySQL.

                IMPORTANTE:
                ESTO EVITA LA INYECCION SQL, IMPORTANTE COLOCAR EN POSTS DE REGISTROS
                DE USUARIOS
            */
            $user = mysqli_real_escape_string($conexion,$_POST['user1']);
            $pass = hash("sha512", mysqli_real_escape_string($conexion,$_POST['pass1']));;

            $sql1 = "SELECT * FROM usuarios WHERE user = '$user' AND pass= '$pass';";
            $query1 = mysqli_query($conexion,$sql1);           
            $result1 = mysqli_num_rows($query1);

            if($result1 > 0){
                /*
                    Se inicializan los datos a manejarse durante la sesion,
                    dejando afuera el password o Contraseña para mayor seguridad.
                */
                $data = mysqli_fetch_array($query1);
                /*
                    Se coloca la sesion como activa (true) 
                    IMPORTANTE PARA QUE LA SESION SE MANTENGA INICIADA.
                */
                $_SESSION['active']     = true;
                $_SESSION['idUsuario1'] = $data['idUsuario'];
                $_SESSION['User1']      = $data['User'];
                $_SESSION['FName1']     = $data['FName_User'];
                $_SESSION['LName1']     = $data['LName_User'];
                $_SESSION['Genero']     = $data['Genero'];
                $_SESSION['FechaNac']   = $data['Fecha_Nacimiento'];
                $_SESSION['Email1']     = $data['Email'];
                $_SESSION['Telefono1']  = $data['Telefono'];
                $_SESSION['Rol1']       = $data['FK_Rol'];
                $_SESSION['Grado1']     = $data['FK_Grado'];
                
                $User1 = $_SESSION['idUsuario1'];
                //Seteador de Fecha de Inicio de Sesion
                $ZonaHoraria1 = date_default_timezone_get($ZonHor1);
                $FecIni = date('Y') ."-". date('m') ."-". date('d') . " " . date('G') . ":". date('i'). ":" . date('s');
                    
                //Consulta a ejecutar en la BD
                $sql2 = "   INSERT INTO `detalle_sesiones` (`idSesion`, `Inicio_Sesion`, `Cierre_Sesion`, `Estado_Ses`, `FK_Usuario`) 
                            VALUES (NULL, '$FecIni', NULL, 'Activa', '$User1')";

                //INSERT INTO `detalle_sesiones` (`idSesion`, `Inicio_Sesion`, `Cierre_Sesion`, `Estado_Ses`, `FK_Usuario`) 
                //VALUES (NULL, '2020-04-22 05:14:20', '2020-04-22 12:00:00', 'Inactiva', '2');

                $query3 = mysqli_query($conexion,$sql2);

                /*
                    IMPORTANTE: 
                        SIEMPRE CERRAR CONEXIONES CUANDO SE VUELVAN INUTILES,
                        EL MOTIVO ES PARA NO ROBARLE VELOCIDAD AL HOST, CON
                        CONEXIONES ABIERTAS PARA NADA.
                */
                mysqli_close($conexion);

                //Esto nos redirige al menu, ya con la sesion principal.
                header('location: ../menu.php?alert_success=<p class="msg_success">Bienvenido a Cursalia '.$_SESSION['User1'].'... :)</p>');
            
            }else{
                /*
                    Si el usuario o la clave no es correcto, la sesion se destruye y 
                    se cierra la conexion, ya que el mysqli_close de arriba, no se ejecuto,
                    porque la condicional no se cumplio.
                */
                $alert='';
                session_destroy();
                mysqli_close($conexion);
                header('location: ../../index.php?alert_InSes=<p class="msg_error">El usuario o la clave son incorrectos.</p>');
            }
        }else{
            /*
                Si la validacion del estado del usuario, no es diferente a Inactivo,
                muestra la alerta de que el usuario ha sido desactivado y se cierra la
                sesion, ya que las condicionales de arriba no se cumplieron y la primera
                conexion, sigue abierta.
            */
            mysqli_close($conexion);
            header('location: ../../index.php?alert_InSes=<p class="msg_error">El usuario ha sido desactivado, contacte con el Administrador.</p>');
        }
    }
?>