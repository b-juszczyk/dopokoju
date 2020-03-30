<?php foreach ($oferta as $item) { ?>
	<div class="d-inline-block m-5" style="color:#ceaa63">

		<h4 class="mr-2"><?php echo $item['nazwa']; ?></h4>
		<p><?php echo $item['cena']; ?></p>
		<a href="#">
			<button class="btn btn-dark" type="button" role="button">Dodaj do koszyka</button>
		</a>
	</div>
<?php } ?>
