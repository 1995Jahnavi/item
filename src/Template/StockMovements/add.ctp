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
    <?= $this->Form->create($stockMovement,array('id' => 'myForm')) ?>
    <fieldset>
        <legend><?= __('Add Stock Movement') ?></legend>
        <?php
            echo $this->Form->control('from_warehouse_id', ['options' => $warehouses]);
            echo $this->Form->control('to_warehouse_id', ['options' => $warehouses]);
            echo $this->Form->control('posting_date');
            
        ?>
    </fieldset>

	<table>
	<tr>
	<td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items,'onchange'=>'change()')); ?></td>
	<td><?php echo $this->Form->control('quantity');; ?></td>		
	<td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units)); ?></td>
	
	</tr>
	
	</table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>

      function change(){
            var item_select_box = document.getElementById("item-id");
            var unit_select_box=$('#unit-id');                       
          	unit_select_box.empty();
            var myobject = {
                ValueA : 'carton',
                ValueB : 'box',
                ValueC : 'bottle'
            };
            
            for(index in myobject) {              
             $("#unit-id").append("<option value='" +index+ "'>" +myobject[index]+ "</option>");             
             
            }
        }
  
  </script>
