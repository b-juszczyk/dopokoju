<div class="flex-grow-1 text-center" style="color:#ceaa63">
	<?php
	if ($this->session->has_userdata('success_msg')) {
		echo '<p>' . $this->session->userdata('success_msg') . '</p>';
		$this->session->unset_userdata('success_msg');
	} elseif ($this->session->has_userdata('error_msg')) {
		echo '<p>' . $this->session->userdata('error_msg') . '</p>';
		$this->session->unset_userdata('error_msg');
	}
	?>
</div>
<div class="container-fluid">
	<div class="card mt-2 border-0">
		<div class="card-header" style="color:#ceaa63; background-color: #231f20">
			<i class="fas fa-shopping-cart" aria-hidden="true"></i>
			Koszyk
			<div class="clearfix"></div>
		</div>
		<div class="card-body" style="background-color: #231f20">

			<?php
			if (empty($items)) {
				echo '<div class="row" style="backgroud-color: #231f20; color:#ceaa63">
				<h2 class="text-center">Koszyk jest pusty</h2>
				</div>';
			}
			if ($this->session->has_userdata('cart')) {
				foreach ($items as $item) { ?>
					<div class="row" style="color: #ceaa63">
						<div class="col-12 col-sm-12 col-md-2 text-center">
							<img class="img-fluid"
								 src="../../../user_guide/_images/oferta/<?php echo $item['zdjecie']; ?>" alt="preview"
								 width="120" height="80">
						</div>
						<div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
							<h4><strong><?php echo $item['nazwa']; ?></strong></h4>
						</div>
						<div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
							<div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
								<h6><strong><?php echo $item['cena'] . ' zł'; ?> <span
											class="text-muted">x </span><?php echo $item['ilosc']; ?></strong></h6>
							</div>
							<div class="col-4 col-sm-4 col-md-4">
								<h6><?php echo $item['ilosc'] * (int)$item['cena'] . ' zł'; ?></h6>
							</div>
							<div class="col-2 col-sm-2 col-md-2 text-right">
								<a href="<?php echo site_url('cart/remove') . '/' . $item['id']; ?>">
									<button type="button" class="btn btn-outline-danger btn-sm">
										<i class="fas fa-trash"></i>
									</button>
								</a>
							</div>
						</div>
					</div>
					<hr>
				<?php }
				if (!empty($items)) {
					echo '
			<div class="text-right pr-5" style="color:#ceaa63">Cena końcowa: <b>' . $total . ' zł</b></div>';
				}
			} ?>
		</div>
		<div class="card-footer" style="background-color: #231f20">
			<div class="row">
				<div class="col-6 text-left">
					<a href="<?php echo site_url('oferta/index'); ?>">
						<button class="btn btn-info">Kontynuuj zakupy</button>
					</a>
				</div>

				<div class="col-6 text-right">
					<a href="<?php echo site_url('cart/checkout'); ?>" class="btn btn-success <?php if (empty($items)) {
						echo 'disabled" aria-disabled="true';
					} ?>">Zamów</a>
				</div>
			</div>

		</div>
	</div>
</div>
