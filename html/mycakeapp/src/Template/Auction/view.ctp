<h2>「<?= $biditem->name ?>」の情報</h2>
<table class="vertical-table">
<tr>
	<th class="small" scope="row">出品者</th>
	<td><?= $biditem->has('user') ? $this->Html->link(__($biditem->user->username), ['controller' => 'users','action' => 'view', $biditem->user_id])  : '' ?></td>
</tr>
<tr>
	<th scope="row">商品名</th>
	<td><?= h($biditem->name) ?></td>
</tr>
<tr>
	<th scope="row">商品説明</th>
	<th><?= h($biditem->description) ?></th>
</tr>
<tr>
	<th scope="row">商品画像</th>
	<th><?= $this->Html->image('biditemImages/'.$biditem->id.'/'.$biditem->biditemimage->biditem_image_file_name,['alt' => $biditem->name]) ?></th>
</tr>
<tr>
	<th scope="row">商品ID</th>
	<td><?= $this->Number->format($biditem->id) ?></td>
</tr>
<tr>
	<th scope="row">終了時間</th>
	<td><?= h($biditem->endtime) ?></td>
</tr>
<tr>
	<th scope="row">投稿時間</th>
	<td><?= h($biditem->created) ?></td>
</tr>
<tr>
	<th scope="row"><?= __('終了した？') ?></th>
	<td><?= $biditem->finished ? __('Yes') : __('No'); ?></td>
</tr>
<tr>
	<th scope="row">残り時間</th>
	<td id="countdown"></td>
</tr>
</table>
<div class="related">
	<h4><?= __('落札情報') ?></h4>
	<?php if (!empty($biditem->bidinfo)): ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th scope="col">落札者</th>
		<th scope="col">落札金額</th>
		<th scope="col">落札日時</th>
	</tr>
	<tr>
		<td><?= $this->Html->link(__($biditem->bidinfo->user->username), ['controller' => 'users','action' => 'view', $biditem->bidinfo->user->id]) ?></td>
		<td><?= h($biditem->bidinfo->price) ?>円</td>
		<td><?= h($biditem->endtime) ?></td>
	</tr>
	</table>
	<?php else: ?>
	<p><?='※落札情報は、ありません。' ?></p>
	<?php endif; ?>
</div>
<div class="related">
	<h4><?= __('入札情報') ?></h4>
	<?php if (!$biditem->finished): ?>
	<h6><a href="<?=$this->Url->build(['action'=>'bid', $biditem->id]) ?>">《入札する！》</a></h6>
	<?php if (!empty($bidrequests)): ?>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		<th scope="col">入札者</th>
		<th scope="col">金額</th>
		<th scope="col">入札日時</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($bidrequests as $bidrequest): ?>
	<tr>
		<td><?= $this->Html->link(__($bidrequest->user->username), ['controller' => 'users','action' => 'view', $bidrequest->user->id]) ?></td>
		<td><?= h($bidrequest->price) ?>円</td>
		<td><?=$bidrequest->created ?></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<?php else: ?>
	<p><?='※入札は、まだありません。' ?></p>
	<?php endif; ?>
	<?php else: ?>
	<p><?='※入札は、終了しました。' ?></p>
	<?php endif; ?>
</div>
<?= $this->Html->scriptBlock('let endtime ='."'".$biditem->endtime."'"); ?>
<?= $this->Html->script('countdowntimer') ?>
