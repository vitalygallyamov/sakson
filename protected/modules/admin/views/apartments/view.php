<h1>Квартира #<?=$model->id?></h1>

<p>Причина удаления</p>
<table class="table">
	<thead>
		<tr>
			<th>Пользователь</th>
			<th>Комментарий</th>
		</tr>
	</thead>
	<tbody>
		<?foreach ($model->deleteAparts as $apart):?>
			<tr>
				<td><?=$apart->user ? $apart->user->fio : ''?></td>
				<td><?=$apart->comment?></td>
			</tr>
		<?endforeach;?>
		
	</tbody>
</table>