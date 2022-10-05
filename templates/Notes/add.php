<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note $note
 * @var \Cake\Collection\CollectionInterface|string[] $requisitions
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Notes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="notes form content">
            <?= $this->Form->create($note) ?>
            <fieldset>
                <legend><?= __('Add Note') ?></legend>
                <?php
                    echo $this->Form->control('requisition_id', ['options' => $requisitions]);
                    echo $this->Form->control('description');
                    echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
