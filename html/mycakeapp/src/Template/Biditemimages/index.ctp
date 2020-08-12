<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Biditemimage[]|\Cake\Collection\CollectionInterface $biditemimages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Biditemimage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="biditemimages index large-9 medium-8 columns content">
    <h3><?= __('Biditemimages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('biditem_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('biditem_image_file_name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($biditemimages as $biditemimage): ?>
            <tr>
                <td><?= $this->Number->format($biditemimage->id) ?></td>
                <td><?= $biditemimage->has('biditem') ? $this->Html->link($biditemimage->biditem->name, ['controller' => 'Biditems', 'action' => 'view', $biditemimage->biditem->id]) : '' ?></td>
                <td><?= h($biditemimage->biditem_image_file_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $biditemimage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $biditemimage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $biditemimage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $biditemimage->id)]) ?>
                </td>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
