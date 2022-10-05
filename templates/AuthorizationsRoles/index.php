<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuthorizationsRole[]|\Cake\Collection\CollectionInterface $authorizationsRoles
 */
?>
<div class="authorizationsRoles index content">
    <?= $this->Html->link(__('New Authorizations Role'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Authorizations Roles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('authorization_id') ?></th>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authorizationsRoles as $authorizationsRole): ?>
                <tr>
                    <td><?= $this->Number->format($authorizationsRole->id) ?></td>
                    <td><?= $authorizationsRole->has('authorization') ? $this->Html->link($authorizationsRole->authorization->name, ['controller' => 'Authorizations', 'action' => 'view', $authorizationsRole->authorization->id]) : '' ?></td>
                    <td><?= $authorizationsRole->has('role') ? $this->Html->link($authorizationsRole->role->name, ['controller' => 'Roles', 'action' => 'view', $authorizationsRole->role->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $authorizationsRole->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $authorizationsRole->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $authorizationsRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $authorizationsRole->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
