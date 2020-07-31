<h2><?= h($viewed_user->username) ?>さんの評価一覧</h2>
<h3>評価平均は<?= $this->Number->precision($viewed_user->average,1) ?>点です</h3>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th class="main" scope="col"><?= $this->Paginator->sort('id') ?></th>
		<th scope="col" class="action"><?= $this->Paginator->sort('rated_by_user_id') ?></th>
		<th scope="col"><?= $this->Paginator->sort('point') ?></th>
		<th scope="col"><?= __('comment') ?></th>
		<th scope="col"><?= $this->Paginator->sort('created') ?></th>
	</tr>
</thead>
<tbody>
	<?php foreach ($ratings as $rating): ?>
	<tr>
		<td><?= h($rating->id) ?></td>
		<td class="action"><?= $this->Html->link(__($rating->user->username), ['action' => 'view', $rating->rated_by_user_id]) ?></td>
		<td><?= h($rating->point) ?></td>
		<td><?= h($rating->comment) ?></td>
		<td scope="col"><?= $rating->created ?></td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>

<div class="paginator">
	<ul class="pagination">
		<?= $this->Paginator->first('<< ' . __('first')) ?>
		<?= $this->Paginator->prev('< ' . __('previous')) ?>
		<?= $this->Paginator->numbers() ?>
		<?= $this->Paginator->next(__('next') . ' >') ?>
		<?= $this->Paginator->last(__('last') . ' >>') ?>
	</ul>
</div>
