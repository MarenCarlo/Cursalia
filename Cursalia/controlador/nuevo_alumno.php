<?php
    /**
     * CONTROLADOR QUE NOS SIRVE PARA AGREGAR A UN NUEVO ALUMNO.
    */
    session_start();
    if($_SESSION['active'] == true){
        if(isset($_POST['Alumno'])){
            $alert='';
            
            //Si los POST estan vacios muestra la alerta de abajo.
            if(empty($_POST['Codigo_Alumno'])  || empty($_POST['Usuario_Alumno']) || 
               empty($_POST['Nombres_Alumno']) || empty($_POST['Pass_Alumno'])    ||
               empty($_POST['Email_Alumno'])   || empty($_POST['Nivel_Alumno'])   ||
               empty($_POST['Grado_Alumno'])   || empty($_POST['Genero_Alumno'])  ||
               empty($_POST['FechaNac_Alumno'])|| empty($_POST['Apellidos_Alumno'])){ 
                $alert='';
                header('Location: ../registro_alumno.php?alert_null_pointer=<p class="msg_error_permissions">Todos los campos son obligatorios.</p>');
            } else {
                //se abre la conexion adentro del else, ya que nunca se requirio afuera de este.
                require_once 'conexion.php';
                
                //Obtenemos los datos del POST enviados en el form
                $code_alumno       = mysqli_real_escape_string($conexion,$_POST['Codigo_Alumno']);
                $grado_alumno      = mysqli_real_escape_string($conexion,$_POST['Grado_Alumno']);
                $nivel_estudiantil = mysqli_real_escape_string($conexion,$_POST['Nivel_Alumno']);
                $genero_alumno     = mysqli_real_escape_string($conexion,$_POST['Genero_Alumno']);
                $telefono_alumno   = mysqli_real_escape_string($conexion,$_POST['Telefono_Alumno']);
                $fechanac_alumno   = mysqli_real_escape_string($conexion,$_POST['FechaNac_Alumno']);    
                $user_alumno       = mysqli_real_escape_string($conexion,$_POST['Usuario_Alumno']);
                $fname_alumno      = mysqli_real_escape_string($conexion,$_POST['Nombres_Alumno']);
                $lname_alumno      = mysqli_real_escape_string($conexion,$_POST['Apellidos_Alumno']);
                $email_alumno      = mysqli_real_escape_string($conexion,$_POST['Email_Alumno']);
                $pass_alumno       = hash("sha512", mysqli_real_escape_string($conexion,$_POST['Pass_Alumno']));
                
                //Formateador de la fecha para coincidir con el formato de la BD
                //$fechanac_alumnof = date_format($fechanac_alumno, 'Y/m/d');
                /**
                 * Linea que guardara automaticamente al Usuario como Activo
                 * y el Rol como su respectiva llave Foranea 3 = Estudiante.
                 */
                $rol_alumno        = "3";
                $status_alumno     = "Activo";

                /**
                 * Consulta que nos ayudara a validar si ese Usuario
                 * no ha sido registrado en Cursalia.
                 */
                $query1 = mysqli_query($conexion,"SELECT    
                                                    `User`
                                                  FROM 
                                                    `usuarios` 
                                                  WHERE 
                                                    `User` = '$user_alumno';");
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
                                                    `Email`= '$email_alumno';");
                $result2 = mysqli_fetch_array($query2);

                /**
                 * Consulta que nos ayudara a validar si ese 
                 * Codigo Estudiantil no ha sido registrado en Cursalia.
                 */
                $query3 = mysqli_query($conexion, "SELECT 
                                                    `Codigo_Estudiantil` 
                                                   FROM 
                                                    `detalle_alumno`
                                                   WHERE
                                                    `Codigo_Estudiantil` = '$code_alumno';");
                $result3 = mysqli_fetch_array($query3);
                
                /**
                 * Si cualquiera de las consultas a BD anteriores da un resultado
                 * mayor que 0 (quiere decir que si existe ese registro), por ende
                 * ese codigo, usuario o email ya fue registrado y tirara la alerta
                 * para decirle
                 */
                if($result1 > 0){
                    header('Location: ../registro_alumno?alert_null_pointer1=<p class="msg_error_permissions">El Nombre de Usuario ya ha sido registrado con anterioridad.</p>');
                }
                if($result2 > 0){
                    header('Location: ../registro_alumno?alert_null_pointer2=<p class="msg_error_permissions">La direccion de Correo Electronico ya ha sido registrada con anterioridad.</p>');
                }
                if($result3 > 0){
                    header('Location: ../registro_alumno?alert_null_pointer3=<p class="msg_error_permissions">Este codigo Estudiantil, ya ha sido registrado con anterioridad.</p>');
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
                                                        (NULL,'$user_alumno','$pass_alumno','$fname_alumno', '$lname_alumno', '$genero_alumno', '$fechanac_alumno', '$email_alumno','$status_alumno', '$telefono_alumno', '$rol_alumno', '$grado_alumno')");

                    /**
                     * Consulta que nos sirve para obtener el id del usuario añadido con el
                     * nombre de usuario obtenido del POST.
                     */
                    $query5        = mysqli_query($conexion,"SELECT (idUsuario) FROM usuarios WHERE User = '$user_alumno' AND Email = '$email_alumno';");           
                    $columnax      = mysqli_fetch_array($query5);
                    $iduser_alumno = $columnax['0'];

                    /**
                     * Ingresamos los datos de la tabla Detalle_Alumno colocando en las
                     * llaves foraneas lo que corresponde.
                     */
                    $query6   = mysqli_query($conexion,"INSERT INTO 
                                                            detalle_alumno
                                                            (idDetalle_Alumno, Codigo_Estudiantil, FK_Usuario, FK_Grado, FK_Nivel_Estudiantil)
                                                        VALUES
                                                            (NULL,'$code_alumno', '$iduser_alumno', '$grado_alumno', '$nivel_estudiantil')");

                    //Si se cumple la condicion, cierra la conexion y redirige al index
                    mysqli_close($conexion);
                    header('location: ../menu.php?alert_success=<p class="msg_success">Alumno Agregado con Exito... :)</p>');
                }
                mysqli_close($conexion);
            }
        }
    } else {
        header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
    }
?>