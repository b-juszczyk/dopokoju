<div class="container-fluid">
	<h2>Zamówienie</h2>
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
					<?php echo $item['qty']; ?>
				</td>
				<td>
					<?php echo $item['subtotal'].' zł'; ?>
				</td>

			</tr>
		<?php } }
		else{ ?>
			<tr><td colspan="5"><p>Koszyk jest pusty</p></td></tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="4"></td>
			<?php if($this->cart->total_items() > 0){ ?>
				<td class="text-center">
					<strong>Total <?php echo $this->cart->total().' zł'; ?></strong>
				</td>
			<?php } ?>
		</tr>
		</tfoot>
	</table>

	<form method="post">
		<h4>Adres dostawy</h4>
		<div class="form-group">
			<label>Imię:</label>
			<input type="text" class="form-control" name="name" value="<?php echo !empty($custData['name'])?$custData['name']:''; ?>" placeholder="Wprowadź imię">
			<?php echo form_error('name', '<p class="alert-warning">','</p>');?>
		</div>
		<div class="form-group">
            <label ">Email:</label>

                <input type="email" class="form-control" name="email" value="<?php echo !empty($custData['email'])?$custData['email']:''; ?>" placeholder="Enter email">
                <?php echo form_error('email','<p class="alert-warning">','</p>'); ?>

</div>
<div class="form-group">
	<label>Phone:</label>

		<input type="text" class="form-control" name="phone" value="<?php echo !empty($custData['phone'])?$custData['phone']:''; ?>" placeholder="Enter contact no">
		<?php echo form_error('phone','<p class="alert-warning">','</p>'); ?>

</div>
<div class="form-group">
	<label>Address:</label>

		<input type="text" class="form-control" name="address" value="<?php echo !empty($custData['address'])?$custData['address']:''; ?>" placeholder="Enter address">
		<?php echo form_error('address','<p class="alert-warning">','</p>'); ?>

</div>
<div>
	<a href="<?php echo base_url('cart/'); ?>" class="btn btn-warning"> Back to Cart</a>
	<button type="submit" name="placeOrder" class="btn btn-success">Place Order</button>
	</form>
</div>

