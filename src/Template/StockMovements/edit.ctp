<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockMovement $stockMovement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $stockMovement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovement->id)]
            )
        ?></li>
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
        <legend><?= __('Edit Stock Movement') ?></legend>
        <?php
            echo $this->Form->control('from_warehouse_id', ['options' => $warehouses]);
            echo $this->Form->control('to_warehouse_id', ['options' => $warehouses]);
            $this->Form->templates(
              ['dateWidget' => '{{day}}{{month}}{{year}}']
            );
            echo $this->Form->input('posting_date', ['type'=>'date']);            
        ?>
    </fieldset>

	 <table id="stockMovementsTable">
    <?php
    foreach($stockMovement->stock_movement_items as $stockMovementItem)
    {
    ?>
    <tr> 
    <td><?php echo $this->Form->input('checkbox', array('type'=>'checkbox','name'=>'chk[]','id'=>$stockMovementItem->id)); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'default'=>$stockMovementItem->item_id, 'name'=>'items[]','onchange'=>'change()')); ?></td>
    <td><?php echo $this->Form->control('quantity',  array('name'=>'qty[]','default'=>$stockMovementItem->quantity)); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units,'default'=>$stockMovementItem->item_id, 'name'=>'units[]')); ?></td>
    </tr>
    <?php
    }
    ?>
    
    <input type="button" onclick="myFunction()" value="Add row" >
    <input type="button" id="delsmbutton" value="Delete" onclick="changeCheck()"> 
   
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
 <script>
 function myFunction() {
    var table = document.getElementById("stockMovementsTable");
    var smCount = $('#stockMovementsTable tr').length;
    var row = table.insertRow().innerHTML ='<tr> \
    <td><input type="checkbox" name="chk[]" id=chk'+(smCount+1)+'></td> \
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'default'=>'', 'name'=>'items[]','onchange'=>'change()')); ?></td> \
    <td><?php echo $this->Form->control('quantity',  array('name'=>'qty[]'));; ?></td> \
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units,'default'=>'', 'name'=>'units[]')); ?></td> \
    </tr>';
}
</script>
 <?php echo $this->Html->script('stock_movements.js'); ?>
 
