<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories view content">
            <h3><?= h($category->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($category->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($category->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Requisitions') ?></h4>
                <?php if (!empty($category->requisitions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Requisition Number') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Due Date') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Location') ?></th>
                            <th><?= __('Full Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Amount Requested') ?></th>
                            <th><?= __('Amount Authorized') ?></th>
                            <th><?= __('Archived') ?></th>
                            <th><?= __('Rate') ?></th>
                            <th><?= __('Status') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->requisitions as $requisitions) : ?>
                        <tr>
                            <td><?= h($requisitions->id) ?></td>
                            <td><?= h($requisitions->requisition_number) ?></td>
                            <td><?= h($requisitions->created) ?></td>
                            <td><?= h($requisitions->modified) ?></td>
                            <td><?= h($requisitions->due_date) ?></td>
                            <td><?= h($requisitions->category_id) ?></td>
                            <td><?= h($requisitions->title) ?></td>
                            <td><?= h($requisitions->location) ?></td>
                            <td><?= h($requisitions->full_name) ?></td>
                            <td><?= h($requisitions->description) ?></td>
                            <td><?= h($requisitions->amount_requested) ?></td>
                            <td><?= h($requisitions->amount_authorized) ?></td>
                            <td><?= h($requisitions->archived) ?></td>
                            <td><?= h($requisitions->rate) ?></td>
                            <td><?= h($requisitions->status) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Requisitions', 'action' => 'view', $requisitions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Requisitions', 'action' => 'edit', $requisitions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Requisitions', 'action' => 'delete', $requisitions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requisitions->id)]) ?>
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
