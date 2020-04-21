<div class="container-fluid mb-5">
	<div class="navbar text-center ">
		<div class="row mt-2">
			<ul class="d-flex flex-row nav ml-auto flex-nowrap d-inline-block">
				<li class="nav-item">
					<a href="#" class="nav-link m-2 menu-item nav-active">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"
								aria-pressed="true" id="kebabBut">Kebab
						</button>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link m-2 menu-item nav-active">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"
								aria-pressed="true" id="frytkiBut">Frytki
						</button>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link m-2 menu-item nav-active">
						<button type="button" class="btn btn-dark" role="button" style="color:#ceaa63"
								aria-pressed="true" id="zapiekankiBut">Zapiekanki
						</button>
					</a>
				</li>
			</ul>

		</div>
	</div>
	<div class="container-fluid mt-2 text-center" id="kebab">
		<?php foreach ($oferta as $item) {
			if ($item['kategoria'] == 'kebab') { ?>

				<div class="d-inline-block col-3 mb-2 pl-5 pr-5" style="color:#ceaa63; ">
					<form action="<?php echo site_url('cart/buy/' . $item['id_oferta']); ?>" method="post">
						<img src="<?php echo base_url('user_guide/_images/oferta' . '/' . $item['zdjecie']); ?>"
							 style="height: 200px">
						<h4 class="mr-2"><?php echo $item['nazwa']; ?></h4>
						<p><?php echo $item['cena'] . ' zł'; ?></p>
						<div class="container-sm">
							<p>Wybierz rozmiar:</p>
							<select id="rozmiar" name="rozmiar" class="form-control mb-2">
								<option value="m">Średni</option>
								<option value="l">Duży</option>
							</select>
						<p>Wybierz mięso:</p>
							<select id="mieso" name="mieso" class="form-control mb-2">
								<option value="w">Wołowina</option>
								<option value="k">Kurczak</option>
							</select>
							<p>Wybierz sos:</p>
							<select id="sosy" name="sosy" class="form-control mb-2">
								<option value="l">Łagodny</option>
								<option value="o">Ostry</option>
								<option value="m">Mieszany</option>
							</select>
							<a href="<?php echo site_url('cart/buy/' . $item['id_oferta']); ?>">
								<input class="btn btn-dark" type="submit" name="addToCart" value="Dodaj do koszyka">
							</a>
						</div>
					</form>
				</div>
			<?php }
		} ?>
	</div>
	<div class="container-fluid mt-2 text-center" id="frytki" style="display:none">
		<?php foreach ($oferta as $item) {
			if ($item['kategoria'] == 'frytki') { ?>

				<div class="d-inline-block mb-2 pl-5 pr-5 col-3" style="color:#ceaa63; ">
					<form action="<?php echo site_url('cart/buy/' . $item['id_oferta']); ?>" method="post">
						<img src="<?php echo base_url('user_guide/_images/oferta' . '/' . $item['zdjecie']); ?>"
							 style="height: 200px">
						<h4 class="mr-2"><?php echo $item['nazwa']; ?></h4>
						<p><?php echo $item['cena'] . ' zł'; ?></p>
						<div class="container-sm">
							<p>Wybierz rozmiar:</p>
							<select id="rozmiar" name="rozmiar" class="form-control mb-2">
								<option value="s">Małe</option>
								<option value="l">Duże</option>
							</select>
							<a href="<?php echo site_url('cart/buy/' . $item['id_oferta']); ?>">
								<input class="btn btn-dark" type="submit" name="addToCart" value="Dodaj do koszyka">
							</a>
						</div>
					</form>
				</div>
			<?php }
		} ?>
	</div>
	<div class="container-fluid mt-2 text-center" id="zapiekanki" style="display:none">
		<?php foreach ($oferta as $item) {
			if ($item['kategoria'] == 'zapiekanki') { ?>

				<div class="d-inline-block mb-2 pl-5 pr-5 col-3" style="color:#ceaa63; ">
					<form action="<?php echo site_url('cart/buy/' . $item['id_oferta']); ?>" method="post">
						<img src="<?php echo base_url('user_guide/_images/oferta' . '/' . $item['zdjecie']); ?>"
							 style="height: 200px">
						<h4 class="mr-2"><?php echo $item['nazwa']; ?></h4>
						<p><?php echo $item['cena'] . ' zł'; ?></p>
						<div class="container-sm">
							<a href="<?php echo site_url('cart/buy/' . $item['id_oferta']); ?>">
								<input class="btn btn-dark" type="submit" name="addToCart" value="Dodaj do koszyka">
							</a>
						</div>
					</form>
				</div>
			<?php }
		} ?>
	</div>
</div>
