<?php
if (!empty($success_msg)) {
	echo '<p class="status-msg success">' . $success_msg . '</p>';
} elseif (!empty($error_msg)) {
	echo '<p class="status-msg error">' . $error_msg . '</p>';
}
?>

<div class="container-fluid text-center p-2" style="background-color: #231f20; color:#ceaa63">
	<div class="d-flex h-100">
		<div class="m-auto w-25">
			<h2>Podaj wymagane dane</h2>
			<form action="<?php echo site_url('cart/summary') ?>" method="post">
				<div class="form-group">
					<label for="name">Imię</label>
					<input type="text" class="form-control" name="name"
						   value="<?php if (isset($logged) || isset($loggedAdmin)) {
							   echo $user['first_name'];
						   } ?>">
					<?php echo form_error('name', '<p class="alert-warning mt-1">', '</p>'); ?>
				</div>
				<div class="form-group">
					<label for="mail">Adres e-mail</label>
					<input type="email" class="form-control" name="mail"
						   value="<?php if (isset($logged) || isset($loggedAdmin)) {
							   echo $user['email'];
						   } ?>">
					<?php echo form_error('mail', '<p class="alert-warning mt-1">', '</p>'); ?>
				</div>
				<div class="form-group">
					<label for="phone">Numer telefonu</label>
					<input type="tel" class="form-control" name="phone"
						   value="<?php if (isset($logged) || isset($loggedAdmin)) {
							   echo $user['phone'];
						   } ?>">
					<?php echo form_error('phone', '<p class="alert-warning mt-1">', '</p>'); ?>
				</div>
				<div class="form-group">
					Dostawa do pokoju?<br>
					<input type="checkbox" class="form-control-sm" id="dostawa">
				</div>
				<div class="form-group" id="adres" style="display: none">
					<div class="form-group">
						<label for="academic">Akademik</label>
						<input type="text" class="form-control" id="academic">
					</div>
					<div class="form-group">
						<label for="room">Numer pokoju</label>
						<input type="text" class="form-control" id="room">
					</div>
				</div>
				<div class="form-group">
					<a href="<?php echo site_url('cart/summary'); ?>">
						<input name="summarySubmit" type="submit" role="button" class="btn btn-success form-control"
							   value="Podsumowanie">
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

