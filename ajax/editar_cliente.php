<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del cliente";
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			$_POST['mod_estado']!=""
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$cod=mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
		$identidad=mysqli_real_escape_string($con,(strip_tags($_POST["identidad"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$foto=mysqli_real_escape_string($con,(strip_tags($_POST["foto"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$puesto=mysqli_real_escape_string($con,(strip_tags($_POST["puesto"],ENT_QUOTES)));
		$ingreso=mysqli_real_escape_string($con,(strip_tags($_POST["ingreso"],ENT_QUOTES)));
		$jefe=mysqli_real_escape_string($con,(strip_tags($_POST["jefe"],ENT_QUOTES)));
		$estado=intval($_POST['estado']);
		$lla_atencion=mysqli_real_escape_string($con,(strip_tags($_POST["lla_atencion"],ENT_QUOTES)));
		$obsevaciones=mysqli_real_escape_string($con,(strip_tags($_POST["observaciones"],ENT_QUOTES)));
		$cursos=mysqli_real_escape_string($con,(strip_tags($_POST["cursos"],ENT_QUOTES)));
		$conduce=intval($_POST['conduce']);
		$licencia=mysqli_real_escape_string($con,(strip_tags($_POST["licencia"],ENT_QUOTES)));
		$ven_licencia=mysqli_real_escape_string($con,(strip_tags($_POST["venc_licencia"],ENT_QUOTES)));

		$cod=intval($_POST['mod_id']);
		$sql="UPDATE empleado SET codEmpleado='".$cod."', idEmpleado='".$identidad."', nomEmpleado='".$nombre."',
		fotoEmpleado='".$foto."', tel='".$telefono."', direccion='".$direccion."', puesto='".$puesto."', fechaIngreso='".$ingreso."',
		jefeInmediato='".$jefe."', estadoEmpleado='".$estado."', llamadasAtencion='".$lla_atencion."', observaciones='".$obsevaciones."',
		cursos='".$cursos."', conduce='".$conduce."', licencia='".$licencia."', venc_licencia='".$ven_licencia."'
		 WHERE codEmpleado='".$cod."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Cliente ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}

		if (isset($errors)){

			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong>
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){

				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>
