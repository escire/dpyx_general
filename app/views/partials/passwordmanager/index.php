<div class="container">
	<div>
		<h3>Administrador de restablecimiento de contraseña</h3>
		<small class="text-muted">
			Proporcione la dirección de correo electrónico válida que utilizó para registrarse
		</small>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-8">
			<?php 
				$this :: display_page_errors(); 
			?>
			<form method="post" action="<?php print_link("passwordmanager/postresetlink"); ?>">
				<div class="row">
					<div class="col-9">
						<input value="<?php echo get_form_field_value('email'); ?>" placeholder="Enter Your Email Address" required="required" class="form-control default" name="email" type="email" />
					</div>
					<div class="col-3">
						<button class="btn btn-success" type="submit"> Enviar <i class="fa fa-envelope"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br />
	<div class="text-info">
		Se enviará un enlace a su correo electrónico que contiene la información que necesita para su contraseña
	</div>
</div>




