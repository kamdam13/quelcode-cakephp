<h2>取引連絡を行ってください</h2>
<?php if (in_array(NULL,[$bidinfo->reciever_name,$bidinfo->reciever_address,$bidinfo->reciever_phone_number])): ?>
	<?php if($authuser['id'] === $reciever_id): ?>
		<fieldset>
			<legend>発送先情報を入力してください</legend>
			<?= $this->Form->create($bidinfo); ?>
			<?= $this->Form->control('reciever_name',['label' => '宛名']); ?>
			<?= $this->Form->control('reciever_address',['label' => '住所']); ?>
			<?= $this->Form->control('reciever_phone_number',['label' => '電話番号']); ?>
			<?= $this->Form->button(__('Submit')); ?>
			<?= $this->Form->end(); ?>
		</fieldset>
	<?php elseif($authuser['id'] === $shipper_id): ?>
		<fieldset>
			<legend>取引相手からの発送先情報の連絡をお待ち下さい</legend>
		</fieldset>
	<?php endif; ?>
<?php elseif(!$bidinfo->is_shipped) :?>
	<?php if($authuser['id'] === $reciever_id): ?>
		<fieldset>
			<legend>商品の発送をお待ち下さい</legend>
		</fieldset>
	<?php elseif($authuser['id'] === $shipper_id): ?>
		<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th scope="col">宛名</th>
				<th scope="col">住所</th>
				<th scope="col">電話番号(ハイフン抜きで入力してください)</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?= h($bidinfo->reciever_name) ?></td>
				<td><?= h($bidinfo->reciever_address) ?></td>
				<td><?= h($bidinfo->reciever_phone_number) ?></td>
			</tr>
		</tbody>
		</table>
		<fieldset>
			<legend>発送先情報が入力されました。商品を発送しましたら、発送連絡をしてください。</legend>
			<?= $this->Form->create($bidinfo); ?>
			<?= $this->Form->hidden('is_shipped',['value' => 1]); ?>
			<?= $this->Form->button(__('発送連絡')); ?>
			<?= $this->Form->end(); ?>
		</fieldset>
	<?php endif; ?>
<?php elseif(!$bidinfo->is_recieved): ?>
	<?php if($authuser['id'] === $reciever_id): ?>
		<fieldset>
			<legend>商品が発送されました。受け取りましたら、受取連絡をしてください。</legend>
			<?= $this->Form->create($bidinfo); ?>
			<?= $this->Form->hidden('is_recieved',['value' => 1]); ?>
			<?= $this->Form->button(__('受け取り連絡')); ?>
			<?= $this->Form->end(); ?>
		</fieldset>
	<?php elseif($authuser['id'] === $shipper_id): ?>
		<fieldset>
			<legend>商品の受け取りをお待ち下さい</legend>
		</fieldset>
	<?php endif; ?>
<?php else: ?>
	<?php if($authuser['id'] === $reciever_id && !$bidinfo->is_rated_by_reciever): ?>
		<fieldset>
			<legend>出品者の評価をよろしくおねがいします。</legend>
			<?= $this->Form->create(null,[
				'url' => ['controller' => 'ratings','action' => 'add',$bidinfo->id]
			]); ?>
			<?= $this->Form->control('point',['type' => 'number','label' => '評価点数','min' => 1,'max' => 5]); ?>
			<?= $this->Form->control('comment',['type' => 'text','label' => 'コメント']); ?>
			<?= $this->Form->hidden('rated_user_id',['value' => $shipper_id]) ?>
			<?= $this->Form->hidden('rated_by_user_id',['value' => $reciever_id]) ?>
			<?= $this->Form->button(__('Submit')); ?>
			<?= $this->Form->end(); ?>
		</fieldset>
	<?php elseif($authuser['id'] === $shipper_id && !$bidinfo->is_rated_by_shipper): ?>
		<fieldset>
			<legend>商品が受け取られました。落札者の評価をよろしくおねがいします。</legend>
			<?= $this->Form->create(null,[
				'url' => ['controller' => 'ratings','action' => 'add',$bidinfo->id]
			]); ?>
			<?= $this->Form->control('point',['type' => 'number','label' => '評価点数','min' => 1,'max' => 5]); ?>
			<?= $this->Form->control('comment',['type' => 'text','label' => 'コメント']); ?>
			<?= $this->Form->hidden('rated_user_id',['value' => $reciever_id]) ?>
			<?= $this->Form->hidden('rated_by_user_id',['value' => $shipper_id]) ?>
			<?= $this->Form->button(__('Submit')); ?>
			<?= $this->Form->end(); ?>
		</fieldset>
	<?php else:?>
		<fieldset>
			<legend>取引が終了しました。ご利用ありがとうございました。</legend>
		</fieldset>
	<?php endif; ?>
<?php endif;?>
