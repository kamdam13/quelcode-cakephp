<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Biditemimage $biditemimage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Biditemimage'), ['action' => 'edit', $biditemimage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Biditemimage'), ['action' => 'delete', $biditemimage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $biditemimage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Biditemimages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biditemimage'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="biditemimages view large-9 medium-8 columns content">
    <h3><?= h($biditemimage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Biditem') ?></th>
            <td><?= $biditemimage->has('biditem') ? $this->Html->link($biditemimage->biditem->name, ['controller' => 'Biditems', 'action' => 'view', $biditemimage->biditem->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Biditem Image File Name') ?></th>
            <td><?= h($biditemimage->biditem_image_file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($biditemimage->id) ?></td>
        </tr>
    </table>
</div>
