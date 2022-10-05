<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Authorization $authorization
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Authorization'), ['action' => 'edit', $authorization->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Authorization'), ['action' => 'delete', $authorization->id], ['confirm' => __('Are you sure you want to delete # {0}?', $authorization->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Authorizations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Authorization'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="authorizations view content">
            <h3><?= h($authorization->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($authorization->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($authorization->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= $this->Number->format($authorization->type) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Roles') ?></h4>
                <?php if (!empty($authorization->roles)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Description') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($authorization->roles as $roles) : ?>
                        <tr>
                            <td><?= h($roles->id) ?></td>
                            <td><?= h($roles->name) ?></td>
                            <td><?= h($roles->created) ?></td>
                            <td><?= h($roles->modified) ?></td>
                            <td><?= h($roles->description) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
