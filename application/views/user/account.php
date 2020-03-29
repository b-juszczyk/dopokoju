<div class="container-fluid text-center" style="color:#ceaa63">
	<h2>Witaj, <?php echo $user['first_name']; ?>!</h2>
	<a href="<?php echo base_url('user/logout'); ?>">Wyloguj się</a>
	<p><b>Name: <?php echo $user['first_name']; ?></b></p>
	<p><b>E-mail: <?php echo $user['email']; ?></b></p>
</div>
