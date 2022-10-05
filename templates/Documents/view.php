<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document $document
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Document'), ['action' => 'edit', $document->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Document'), ['action' => 'delete', $document->id], ['confirm' => __('Are you sure you want to delete # {0}?', $document->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Documents'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Document'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documents view content">
            <h3><?= h($document->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Requisition') ?></th>
                    <td><?= $document->has('requisition') ? $this->Html->link($document->requisition->title, ['controller' => 'Requisitions', 'action' => 'view', $document->requisition->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($document->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= h($document->location) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $document->has('user') ? $this->Html->link($document->user->name, ['controller' => 'Users', 'action' => 'view', $document->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($document->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($document->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($document->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
