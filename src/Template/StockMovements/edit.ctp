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
            echo $this->Form->control('posting_date');
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
    <td><?php echo $this->Form->control('quantity',  array('name'=>'qty[]','default'=>$stockMovementItem->qty)); ?></td>
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
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var row = table.insertRow(0).innerHTML ='<tr>\
    <td><?php echo $this->Form->input('checkbox', array('type'=>'checkbox','name'=>'chk[]','id'=>'chk[]')); ?></td>\
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'default'=>$stockMovementItem->item_id, 'name'=>'items[]','onchange'=>'change()')); ?></td>\
    <td><?php echo $this->Form->control('quantity',  array('name'=>'qty[]'));; ?></td>\
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units,'default'=>$stockMovementItem->item_id, 'name'=>'units[]')); ?></td>\
    </tr>';
    }
    
    function deleteRow(row)
{
console.log(document.getElementByName('chk'));
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById("stockMovementsTable").deleteRow(i);
    var rowCount = table.rows.length;
            for(var i=0; i<rowCount; i++) 
            {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked)
                {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
}

   
    function change(){
            var item_select_box = document.getElementById("item-id");
            var unit_select_box=$('#unit-id');                       
          	unit_select_box.empty();
          
	
	$.ajax({
		type: 'get',
		url: '/stock-movements/getunits',
		  data: { 
		    itemid: item_select_box.value
		  },
		   dataType: 'json',
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success: function(response) 
			 {
			if (response.error) {
				alert(response.error);
				console.log(response.error);
			}
 			if (response) {			
				for (var k in response) {
	              $("#unit-id").append("<option value='" +k+ "'>" +response[k]+ "</option>");             
	             
	            }
			}
			}
			
	});	

  } 
  
  function changeCheck(){
          
          
	
	$.ajax({
                type:"POST",
                async: true,
                cache: false,
                url: '/stock-movements/getitems',
                data: { 
		    id: 5
		  },
                
                beforeSend: function(xhr) {
                    //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                
               success: function(response) {					
				//success
				console.log(response);                
			},
			error: function(response) {					
				console.log(response);
			},
                   
            });

  } 
  
  
 </script>