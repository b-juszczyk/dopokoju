<?php foreach ($oferta as $item) { ?>
	<div class="d-inline-block m-5 p-3" style="color:#ceaa63; border-style: ridge; border-color: #ceaa63">

		<img src="<?php echo base_url('user_guide/_images/oferta' . '/' . $item['zdjecie']); ?>" style="height: 200px">
		<h4 class="mr-2"><?php echo $item['nazwa']; ?></h4>
		<p><?php echo $item['cena']; ?></p>
		<p>Wybierz mięso:</p>
		<select class="form-control mb-2">
			<option>Wołowina</option>
			<option>Kurczak</option>
		</select>
		<p>Wybierz sos:</p>
		<select class="form-control mb-2">
			<option>Bez sosu</option>
			<option>Łagodny</option>
			<option>Ostry</option>
			<option>Mieszany</option>
		</select>
		<a href="#">
			<button class="btn btn-dark" type="button" role="button">Dodaj do koszyka</button>
		</a>
	</div>
<?php } ?>
