<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA AGREGAR A UN NUEVO CATEDRATICO.
    */
    session_start();
    if($_SESSION['active'] == true){
        if(isset($_POST['Catedratico'])){
            $alert='';
            //Si los POST estan vacios muestra la alerta de abajo.
            if(empty($_POST['Nombres_Cate']) || empty($_POST['Pass_Cate'])    ||
               empty($_POST['Email_Cate'])   || empty($_POST['Genero_Cate'])  || 
               empty($_POST['FechaNac_Cate'])|| empty($_POST['Apellidos_Cate'])){ 
                $alert='';
                header('Location: ../registro_catedratico.php?alert_null_pointer=<p class="msg_error_permissions">Todos los campos son obligatorios.</p>');
            } else {
                //se abre la conexion adentro del else, ya que nunca se requirio afuera de este.
                require_once 'conexion.php';
                
                //Obtenemos los datos del POST enviados en el form
                $genero_Catedratico   = mysqli_real_escape_string($conexion,$_POST['Genero_Cate']);
                $telefono_Catedratico = mysqli_real_escape_string($conexion,$_POST['Telefono_Cate']);
                $fechanac_Catedratico = mysqli_real_escape_string($conexion,$_POST['FechaNac_Cate']);    
                $user_Catedratico     = mysqli_real_escape_string($conexion,$_POST['Usuario_Cate']);
                $fname_Catedratico    = mysqli_real_escape_string($conexion,$_POST['Nombres_Cate']);
                $lname_Catedratico    = mysqli_real_escape_string($conexion,$_POST['Apellidos_Cate']);
                $email_Catedratico    = mysqli_real_escape_string($conexion,$_POST['Email_Cate']);
                $pass_Catedratico     = hash("sha512", mysqli_real_escape_string($conexion,$_POST['Pass_Cate']));
 
                /**
                 * Linea que guardara automaticamente al Usuario como Activo
                 * y el Rol como su respectiva llave Foranea 3 = Estudiante.
                 */
                $rol_Catedratico      = "2";
                $status_Catedratico   = "Activo";
                $grado_Catedratico    = "1";

                /**
                 * Consulta que nos ayudara a validar si ese Usuario
                 * no ha sido registrado en Cursalia.
                 */
                $query1 = mysqli_query($conexion,"SELECT    
                                                    `User`
                                                  FROM 
                                                    `usuarios` 
                                                  WHERE 
                                                    `User` = '$user_Catedratico';");
                $result1 = mysqli_fetch_array($query1);

                /**
                 * Consulta que nos ayudara a validar si ese Email
                 * no ha sido registrado en Cursalia.
                 */
                $query2 = mysqli_query($conexion,"SELECT 
                                                    `Email` 
                                                  FROM 
                                                    `usuarios` 
                                                  WHERE 
                                                    `Email`= '$email_Catedratico';");
                $result2 = mysqli_fetch_array($query2);
                
                /**
                 * Si cualquiera de las consultas a BD anteriores da un resultado
                 * mayor que 0 (quiere decir que si existe ese registro), por ende
                 * ese codigo, usuario o email ya fue registrado y tirara la alerta
                 * para decirle
                 */
                if($result1 > 0){
                    header('Location: ../registro_catedratico.php?alert_null_pointer1=<p class="msg_error_permissions">El Nombre de Usuario ya ha sido registrado con anterioridad.</p>');
                }
                if($result2 > 0){
                    header('Location: ../registro_catedratico.php?alert_null_pointer2=<p class="msg_error_permissions">La direccion de Correo Electronico ya ha sido registrada con anterioridad.</p>');
                }

                /*
                    Pero si $Result1 y $Result2 son iguales a 0,
                    quiere decir que no hay resultados que sean iguales
                    al Email y al Username que ingresaron en el POST, entonces
                    hace lo siguiente.
                */
                if($result1 == 0 && $result2 == 0 && $result3 == 0){
                    /**
                     * Ingresa los datos del nuevo alumno a la tabla usuarios
                     * en este punto el detalle del alumno aun no es ingresado
                     * a la tabla detalle_alumno
                     */
                    $query4 = mysqli_query($conexion, "INSERT INTO 
                                                            usuarios
                                                            (idUsuario, User, Pass, FName_User, LName_User, Genero, Fecha_Nacimiento, Email, Estado, Telefono, FK_Rol, FK_Grado)
                                                        VALUES
                                                        (NULL,'$user_Catedratico','$pass_Catedratico','$fname_Catedratico', '$lname_Catedratico', '$genero_Catedratico', '$fechanac_Catedratico', '$email_Catedratico','$status_Catedratico', '$telefono_Catedratico', '$rol_Catedratico', '$grado_Catedratico')");

                    //Si se cumple la condicion, cierra la conexion y redirige al index
                    mysqli_close($conexion);
                    header('location: ../menu.php?alert_success=<p class="msg_success">Catedratico Agregado con Exito... :)</p>');
                }
                mysqli_close($conexion);
            }
        }
    } else {
        header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>