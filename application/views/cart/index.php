<script>
	function updateCartItem(obj, rowId) {
		$.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowId:rowId, qty:obj.value}, function(rest){
			if(resp='ok')
			{
				location.reload();
			}
			else
			{
				alert('Wystapil blad!');
			}
		});

	}
	</script>
<div class="container-fluid">
	<div class="row">
		<table class="table">
			<thead>
			<tr>
				<th>Produkt</th>
				<th>Cena</th>
				<th>Ilość</th>
				<th>Do zapłaty</th>
			</tr>
			</thead>
			<tbody>
			<?php if($this->cart->total_items() >0){foreach ($cartItems as $item){ ?>
			<tr>
				<td>
					<?php echo $item['nazwa']; ?>
				</td>
				<td>
				<?php echo $item['cena'].' zł'; ?>
				</td>
				<td>
					<input type="number" class="form-control text-center" value="<?php echo $item['qty']; ?>" onchange="updateCartItem(this, '<?php echo $item["rowId"]; ?>')">
				</td>
				<td>
					<?php echo $item['subtotal'].' zł'; ?>
				</td>
				<td>
					<a href="<?php echo base_url('cart/removeItem'.$item["rowId"]); ?>" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunac produkt?')"></a>
				</td>
			</tr>
			<?php } }
			else{ ?>
			<tr><td colspan="6"><p>Koszyk jest pusty</p></td></tr>
			<?php } ?>
			</tbody>
			<tfoot>
			<tr>
				<td>
					<a href="<?php echo base_url('oferta/'); ?>" class="btn btn-warning">Kontynuuj zakupy</a>
				</td>
				<td colspan="3"></td>
				<?php if($this->cart->total_items() >0){ ?>
				<td class="text-left">Do zapłaty: <b><?php echo $this->cart->total().' zł'; ?></b></td>
				<td><a href="<?php echo base_url('zamowienie/');?>" class="btn btn-success">Zamów</a> </td>
				<?php } ?>
			</tr>
			</tfoot>
		</table>
	</div>
</div>
