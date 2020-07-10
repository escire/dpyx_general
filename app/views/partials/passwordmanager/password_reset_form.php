<div class="container">
	<h3>Administrador de restablecimiento de contraseña</h3>
	<hr />
	<div class="row">
		<div class="col-sm-6">
			<form method="post" action="<?php print_link(get_current_url()); ?>">
				<?php 
					$this :: display_page_errors();			
				?>
				<div class="form-group">
					<label>Nueva contraseña</label>
					<input placeholder="Your New Password" required value="" class="form-control default" name="password" id="txtpass" type="password" />
					<strong class="help-block">Sugerencias: no menos de 6 caracteres </strong>
				</div>
				<div class="form-group">
					<label>Confirmar nueva contraseña</label>
					<input placeholder="Confirm Password" required class="form-control default" name="cpassword" id="txtcpass" type="password" />
				</div>
				<div class="mt-2 "><button  class="btn btn-success" type="submit">Cambia la contraseña</button></div>
			</form>
		</div>
	</div>
</div>
