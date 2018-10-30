<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockMovement $stockMovement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock Movement'), ['action' => 'edit', $stockMovement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock Movement'), ['action' => 'delete', $stockMovement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stock Movements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Movement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stock Movement Items'), ['controller' => 'StockMovementItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Movement Item'), ['controller' => 'StockMovementItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockMovements view large-9 medium-8 columns content">
    <h3><?= h($stockMovement->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Warehouse') ?></th>
            <td><?= $stockMovement->has('warehouse') ? $this->Html->link($stockMovement->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $stockMovement->warehouse->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stockMovement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From Warehouse Id') ?></th>
            <td><?= $this->Number->format($stockMovement->from_warehouse_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Stock Movement Items') ?></h4>
        <?php if (!empty($stockMovement->stock_movement_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Stock Movement Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Unit Id') ?></th>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($stockMovement->stock_movement_items as $stockMovementItems): ?>
            <tr>
                <td><?= h($stockMovementItems->item_id) ?></td>
                <td><?= h($stockMovementItems->stock_movement_id) ?></td>
                <td><?= h($stockMovementItems->quantity) ?></td>
                <td><?= h($stockMovementItems->unit_id) ?></td>
                <td><?= h($stockMovementItems->id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StockMovementItems', 'action' => 'view', $stockMovementItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StockMovementItems', 'action' => 'edit', $stockMovementItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StockMovementItems', 'action' => 'delete', $stockMovementItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovementItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
