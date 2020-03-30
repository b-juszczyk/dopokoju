<div class="d-inline-flex p-3" style="color:#ceaa63">
	<h1>Użytkownicy</h1>
	<div class="table-active ml-5">
		<table class="table" style="color:#ceaa63">
			<thead>
			<tr>
				<td><b>ID użytkownika</b></td>
				<td><b>Imię</b></td>
				<td><b>Nazwa użytkownika</b></td>
				<td><b>Email</b></td>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($userRows as $user) { ?>
				<tr>
					<td><?php echo $user['id']; ?></td>
					<td><?php echo $user['first_name']; ?></td>
					<td><?php echo $user['login']; ?></td>
					<td><?php echo $user['email']; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
