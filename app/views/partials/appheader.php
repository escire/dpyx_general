<?php 
			if(user_login_status() == true ){ 
		?>
<div class="navbar navbar-expand-md fixed-left flex-column navbar-light bg-light">
		
	<a class="navbar-brand" href="<?php print_link(HOME_PAGE) ?>">
		<img class="img-responsive" src="<?php print_link(SITE_LOGO); ?>" /> <?php echo SITE_NAME ?>
	</a>

	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="navbar-collapse flex-column collapse navbar-responsive-collapse">
		
		<ul class="nav navbar-nav w-100 flex-column align-self-start">
			<li class="menu-profile nav-item">
				<a class="avatar" href="<?php print_link('account') ?>">
					<span class="avatar-icon"><i class="fa fa-user"></i></span>
				</a>
				<h5 class="user-name">Hola <?php echo ucwords(USER_NAME); ?></h5>
				<?php 
					if(defined('USER_ROLE')){
					?>
					<?php
					}
				?>
				
				<div class="dropdown menu-dropdown">
					<button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fa fa-user"></i>
					</button>
					<ul class="dropdown-menu">
						<a class="dropdown-item" href="<?php print_link('account') ?>"><i class="fa fa-user"></i> Mi cuenta</a>
						<a class="dropdown-item" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
					</ul>
				</div>
			</li>
		</ul>

		<?php Html :: render_menu(Menu :: $navbarsideleft  , 'nav navbar-nav w-100 flex-column align-self-start'); ?>
	</div>
</div>
<?php 
		} 
	?>

		<?php 
			if(user_login_status() == false ){
		?>
		<div id="topbar" class="navbar navbar-expand-md fixed-top navbar-light bg-light">
			<div class="container-fluid">
					
	<a class="navbar-brand" href="<?php print_link(HOME_PAGE) ?>">
	</a>

			</div>
		</div>
		<?php
			}
		?>
