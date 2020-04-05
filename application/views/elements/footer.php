<footer class=" p-3" style="border-top-style: solid; border-top-color: #ceaa63;color:#ceaa63;">
	<p class="text-center">Do Pokoju &copy; 2020 Copyright</p>
</footer>
</div>
<!-- asd -->
<!-- Bootstrap, jQuery, Popper, FontAwesome JS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/70ad159df0.js" crossorigin="anonymous"></script>
<script>
	$('[data-toggle="popover"]').popover();
	$('#dostawa').click(function () {
		if ($(this).is(':checked')) {
			$("#adres").show();
		} else {
			$("#adres").hide();
		}
	});
	$('#wszystkieBut').click(function () {
		$('#wszystkie').show();
		$('#kebab').hide();
		$('#frytki').hide();
		$('#zapiekanki').hide();
	});
	$('#kebabBut').click(function () {
		$('#wszystkie').hide();
		$('#kebab').show();
		$('#frytki').hide();
		$('#zapiekanki').hide();
	});
	$('#zapiekankiBut').click(function () {
		$('#wszystkie').hide();
		$('#kebab').hide();
		$('#frytki').hide();
		$('#zapiekanki').show();
	});
	$('#frytkiBut').click(function () {
		$('#wszystkie').hide();
		$('#kebab').hide();
		$('#frytki').show();
		$('#zapiekanki').hide();
	});

</script>
</body>
</html>
