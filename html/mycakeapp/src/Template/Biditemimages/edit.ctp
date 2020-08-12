<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Biditemimage $biditemimage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $biditemimage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $biditemimage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Biditemimages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="biditemimages form large-9 medium-8 columns content">
    <?= $this->Form->create($biditemimage) ?>
    <fieldset>
        <legend><?= __('Edit Biditemimage') ?></legend>
        <?php
            echo $this->Form->control('biditem_id', ['options' => $biditems]);
            echo $this->Form->control('biditem_image_file_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
