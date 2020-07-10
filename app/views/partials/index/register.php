
<?php
	$comp_model = new SharedController;
	$current_page = get_current_url();
	$csrf_token = Csrf :: $token;
	
	$show_header = $this->show_header;
	$view_title = $this->view_title;
	$redirect_to = $this->redirect_to;

?>

	<section class="page">
		
<?php
	if( $show_header == true ){
?>

		<div  class="bg-light p-3 mb-3">
			<div class="container">
				
				<div class="row ">
					
		<div class="col-sm-6 ">
			<h3 class="record-title">Registro de usuario</h3>

		</div>

		<div class="col-sm-6 comp-grid">
			<div class="">
	<div class="text-center">
		¿Ya tienes una cuenta?  <a class="btn btn-primary" href="<?php print_link('') ?>"> Iniciar sesión</a>
	</div>
</div>
		</div>

				</div>
			</div>
		</div>

<?php
	}
?>

		<div  class="">
			<div class="container">
				
				<div class="row ">
					
		<div class="col-md-7 comp-grid">
			
	<?php $this :: display_page_errors(); ?>
	
	<div  class=" animated fadeIn">
		<form id="usuario-userregister-form" role="form" novalidate enctype="multipart/form-data" class="form form-horizontal needs-validation" action="<?php print_link("index/register?csrf_token=$csrf_token") ?>" method="post">
		<div>
		
								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="nombre">Nombre <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-nombre"  value="<?php  echo $this->set_field_value('nombre',''); ?>" type="text" placeholder="Escribir  Nombre"  required="" name="nombre"  class="form-control " />
									 
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="usuario">Usuario <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-usuario"  value="<?php  echo $this->set_field_value('usuario',''); ?>" type="text" placeholder="Escribir  Usuario"  required="" name="usuario"  data-url="api/json/usuario_usuario_value_exist/" data-loading-msg="Comprobando disponibilidad ..." data-available-msg="Disponible" data-unavailable-msg="No disponible" class="form-control  ctrl-check-duplicate" />
									 
<div class="check-status"></div> 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="contra">Contra <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-contra"  value="<?php  echo $this->set_field_value('contra',''); ?>" type="password" placeholder="Escribir  Contra"  required="" name="contra"  class="form-control " />
									 
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				
								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
<input id="-confirm"  class="form-control " type="password" name="confirm_password" required placeholder="Confirm Password" />
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="correo">Correo <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-correo"  value="<?php  echo $this->set_field_value('correo',''); ?>" type="email" placeholder="Escribir  Correo"  required="" name="correo"  data-url="api/json/usuario_correo_value_exist/" data-loading-msg="Comprobando disponibilidad ..." data-available-msg="Disponible" data-unavailable-msg="No disponible" class="form-control  ctrl-check-duplicate" />
									 
<div class="check-status"></div> 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="telefono">Telefono <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-telefono"  value="<?php  echo $this->set_field_value('telefono',''); ?>" type="text" placeholder="Escribir  Telefono"  required="" name="telefono"  class="form-control " />
									 
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="contacto">Contacto <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												
<textarea placeholder="Escribir  Contacto" id="ctrl-contacto"  required="" rows="" name="contacto" class=" form-control"><?php  echo $this->set_field_value('contacto',''); ?></textarea>
<!--<div class="invalid-feedback animated bounceIn text-center">Por favor ingrese el texto</div>-->
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				

								
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="rol">Rol <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-rol"  value="<?php  echo $this->set_field_value('rol',''); ?>" type="text" placeholder="Escribir  Rol"  required="" name="rol"  class="form-control " />
									 
 
												
											</div>
											 
											
										</div>
									</div>
								</div>
				
				


		</div>
		<div class="form-group form-submit-btn-holder text-center">
			<button class="btn btn-primary" type="submit">
				Enviar
				<i class="fa fa-send"></i>
			</button>
		</div>
	</form>
	</div>

		</div>

				</div>
			</div>
		</div>

	</section>
