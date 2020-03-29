

<div class="container-fluid text-center p-2" style="color:#ceaa63">
	<?php
	if(!empty($success_msg))
	{
		echo '<p>'.$success_msg.'</p>';
	}elseif(!empty($error_msg))
	{
		echo '<p>'.$error_msg.'</p>';
	}
	?>
	<div class="d-flex h-100">

	<div class="m-auto">
	<h2>Login</h2>
		<form action="" method="post" class="align-items-center  justify-content-center">
			<div class="form-group w-100">
				<input type="text" name="email" placeholder="Email" required="" class="form-control">

			</div>
			<div class="form-group">
				<input type="password" name="password" placeholder="Password" required="" class="form-control">
				<?php echo form_error('password','<p class="alert-warning">','</p>'); ?>
			</div>
			<input type="submit" name="loginSubmit" value="Zaloguj się" class="btn btn-dark mb-3">
		</form>
		<p>Nie masz konta? <a href="<?php echo base_url('user/registration'); ?>">Zarejestruj się!</a></p>
	</div>
	</div>
</div>
