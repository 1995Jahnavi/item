<?php
/**
 * @var \App\View\AppView $this 
 * @var \App\Model\Entity\StockMovement $stockMovement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stock Movements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stock Movement Items'), ['controller' => 'StockMovementItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock Movement Item'), ['controller' => 'StockMovementItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockMovements form large-9 medium-8 columns content">
    <?= $this->Form->create($stockMovement) ?>
    <fieldset>
        <legend><?= __('Add Stock Movement') ?></legend>
        <?php
            echo $this->Form->control('from_warehouse_id', ['options' => $warehouses]);
            echo $this->Form->control('to_warehouse_id', ['options' => $warehouses]);
        ?>
    </fieldset>

	<table>
	<tr>
	<td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items)); ?></td>
	<td><?php echo $this->Form->control('quantity');; ?></td>		
	<td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units)); ?></td>
	</tr>
	</table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
$.ajax({
		type: 'get',
		url: '/recipes/getunits',
		  data: { 
		    itemid: item_select_box.value
		  },
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success: function(response) {
			if (response.error) {
				alert(response.error);
				console.log(response.error);
			}
			if (response.content) {
				$('#target').html(response.content);
			}
		},
		error: function(e) {
			//alert("An error occurred: " + e.responseText.message);
			console.log(e);
		}
	});	
	
