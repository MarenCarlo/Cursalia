<?php 
	/**
     * CONTROLADOR QUE NOS SIRVE PARA DESTRUIR SESIONES (CERRAR SESION).
    */
	session_start();
	if($_SESSION['active'] == true){
		$idUser2 = $_SESSION['idUsuario1'];

		include 'conexion.php';
		//Se selecciona la Zona horaria obtenida en la conexion
		$ZonaHoraria1 = date_default_timezone_get($ZonHor1);
		//Se le da el formato de fecha a esta.
		$FecIni = date('Y') ."-". date('m') ."-". date('d') . " " . date('G') . ":". date('i'). ":" . date('s');
		
		/*
			Se obtiene el numero maximo de esa sesion existente 
			donde el FK_Usuario de la tabla Detalle, sea el mismo
			que el Numero del idUsuario Registrado al momento de iniciar la
			sesion
		*/
		$NumSession1 = "SELECT MAX(idSesion) FROM `detalle_sesiones` WHERE `FK_Usuario` = $idUser2;";
		$query2    = mysqli_query($conexion, $NumSession1);
		$columna2 = mysqli_fetch_array($query2);

		//Ultimo numero de sesion obtenido con esos datos
		$NoSession1 = $columna2['0'];

		//Se ejecuta el Update con la fecha de cierre de sesion nueva y cambia el estado de Activa a Inactiva
		$sql1 = "UPDATE `detalle_sesiones` SET `Cierre_Sesion` = '$FecIni', `Estado_Ses` = 'Inactiva' WHERE `detalle_sesiones`.`idSesion` = $NoSession1;";
		$query1 = mysqli_query($conexion,$sql1);           
		$result1 = mysqli_num_rows($query1);

		//Se destruye la sesion, se cierra la conexion y se redirige al Index
		$_SESSION['active']     = false;
        $_SESSION['idUsuario1'] = '';
        $_SESSION['User1']      = '';
        $_SESSION['Name1']      = '';
        $_SESSION['Email1']     = '';
        $_SESSION['Rol1']       = '';
		$_SESSION['Grado1']     = '';
		
		session_destroy();
		mysqli_close($conexion);
		header('location: ../../');
	}else{
		header('location: ../../index.php?alert_InSes=<p class="msg_error">Inicie Sesion para ver este recurso.</p>');
	}
?>