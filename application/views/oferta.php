
	<!---<div id="content" class="container-fluid" style="background-color: #231f20; color: #ceaa63;">-->
			<?php foreach($oferta as $item){?>
				<div class="d-inline-block m-5" style="color:#ceaa63">

					<h4 class="mr-2"><?php echo $item->nazwa; ?></h4>
					<p><?php echo $item->cena; ?></p>
					<button class="btn btn-dark" type="button" role="button">Zamów</button>

				</div>
			<?php } ?>
