<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html" ; charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Aplikacja do zamawiania jedzenia na terenie Politechniki Rzeszowskiej">
	<title>Do Pokoju</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../user_guide/_static/css/bootstrap.min.css"/>
	<link rel="icon" type="image/gif" href="<?php echo base_url(); ?>/favicon.gif"/>
</head>
<body style="background-color: #231f20">
<div id="page">
	<nav class="navbar navbar-expand-lg navbar-light"
		 style="background-color: #231f20; border-bottom-style: solid; border-bottom-color: #ceaa63;">
		<div class="d-flex flex-grow-1">
			<span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
			<a class="navbar-brand d-none d-lg-inline-block pl-5" href="<?php echo base_url();?>" style="color:#ceaa63">
				<h2>Do Pokoju</h2>
			</a>
			<a class="navbar-brand-two mx-auto d-lg-none d-inline-block" href="<?php echo base_url();?>" style="color:#ceaa63">
				<h2>Do&nbsp;Pokoju</h2>
			</a>
			<div class="w-100 text-right">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</div>
		<div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
			<ul class="navbar-nav ml-auto flex-nowrap">
				<li class="nav-item">
					<a href="<?php echo base_url('oferta/'); ?>" class="nav-link m-2 menu-item nav-active">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"
								aria-pressed="true"><i class="fas fa-utensils pr-1"></i> Oferta
						</button>
					</a>
				</li>
				<?php
				if ($logged) {
					echo '<li class="nav-item">
					<a href="' . base_url('user/account') . '" class="nav-link m-2 menu-item">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"><i class="fas fa-user pr-1"></i>Moje konto</button>
					</a>
				</li>';
				} elseif ($loggedAdmin) {
					echo '<li class="nav-item">
					<a href="#" class="nav-link m-2 menu-item">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"><i class="fas fa-tools pr-1"></i>Panel admina</button>
					</a>
				</li>';
				} else {
					echo '<li class="nav-item">
					<a href="' . base_url('user/login') . '" class="nav-link m-2 menu-item">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"><i class="fas fa-user pr-1"></i>Logowanie</button>
					</a>
				</li>
				<li class="nav-item">
					<a href="' . base_url('user/registration') . '"class="nav-link m-2 menu-item">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"><i class="fas fa-user-plus pr-1"></i>Rejestracja</button>
					</a>
				</li>';
				}
				?>

				<li class="nav-item">
					<a href="<?php echo base_url('info');?>" class="nav-link m-2 menu-item">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"><i class="fas fa-info pr-1"></i>Informacje</button>
					</a>
				</li>
			</ul>
		</div>
	</nav>

