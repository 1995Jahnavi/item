<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * StockMovements Controller
 *
 * @property \App\Model\Table\StockMovementsTable $StockMovements
 *
 * @method \App\Model\Entity\StockMovement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockMovementsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Warehouses']
        ];
        $stockMovements = $this->paginate($this->StockMovements);
        
        
   foreach($stockMovements as $stockMovement){
		$warehouses = TableRegistry::get('Warehouses');
		
		$fw = $warehouses->get($stockMovement->from_warehouse_id);
		//debug($fw);die();
		$stockMovement->fw_name = $fw->name;
		
		$tw = $warehouses->get($stockMovement->to_warehouse_id);
		//debug($fw);die();
		$stockMovement->tw_name = $tw->name;
		
		
		
		}
		
         $this->set(compact('stockMovements'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock Movement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockMovement = $this->StockMovements->get($id, [
            'contain' => ['Warehouses', 'StockMovementItems']
        ]);
      
            $warehouses = TableRegistry::get('Warehouses');
            
            $fw = $warehouses->get($stockMovement->from_warehouse_id);
            $stockMovement->fw_name = $fw->name;
            
            foreach ($stockMovement->stock_movement_items as $stockMovementItems){
                
                 $items = TableRegistry::get('Items');
                 $stockMovementItems->stockMovement_id=$stockMovement->id;
                 $stockMovementItems->item_name=$items->get($stockMovementItems->item_id)->item_name;
                
                 $units = TableRegistry::get('Units');
                 $stockMovementItems->stockMovement_id=$stockMovement->id;
                 $stockMovementItems->unit_name=$units->get($stockMovementItems->unit_id)->unit_name;
                 
            }
           $this->set('stockMovement', $stockMovement);
            
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {     $data = $this->request->getData();
	//debug($this->request->getData());die();	  
        $stockMovement = $this->StockMovements->newEntity();
        
        if ($this->request->is('post')) {
            $stockMovement = $this->StockMovements->patchEntity($stockMovement, $this->request->getData());
            if ($this->StockMovements->save($stockMovement)) {
		$smi = TableRegistry::get('StockMovementItems');
		$i = 0;
		foreach($data['items'] as $item)
		{
		$stockMovementiitem = $smi->newEntity();
		$stockMovementiitem->stock_movement_id= $stockMovement->id;
		$stockMovementiitem->item_id= $item;
		$stockMovementiitem->unit_id= $data['units'][$i];
		$stockMovementiitem->quantity= $data['qty'][$i];
		$smi->save($stockMovementiitem);
		} $i++;

                $this->Flash->success(__('The stock movement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
                $units = TableRegistry::get('Units');
                $this->set('units',$units->find('list'));
                
                $items = TableRegistry::get('Items');
                $this->set('items',$items->find('list'));
           
                $this->Flash->error(__('The stock movement could not be saved. Please, try again.'));
        }else if($this->request->is('get')){
		$units = TableRegistry::get('Units');
		$this->set('units',$units->find('list'));	
			
		$items = TableRegistry::get('Items');
		$this->set('items',$items->find('list'));
		foreach($items as $item){
		    $item->units = $units->find('list', ['id IN' => [$item->purchase_unit, $item->sell_unit, $item->usage_unit]]);
		}	
	}
        $warehouses = $this->StockMovements->Warehouses->find('list', ['limit' => 200]);
        $this->set(compact('stockMovement', 'warehouses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Movement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {    
        $data = $this->request->getData();
        
        $stockMovement = $this->StockMovements->newEntity();
        $stockMovement = $this->StockMovements->get($id, [
            'contain' => ['StockMovementItems']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
           
            $stockMovement = $this->StockMovements->patchEntity($stockMovement, $this->request->getData());
            if ($this->StockMovements->save($stockMovement)) {
            $smi = TableRegistry::get('StockMovementItems');
            $i = 0;
            foreach($data['items'] as $item)
            {
                $stockMovementiitem = $smi->newEntity();
                $stockMovementiitem->stock_movement_id= $stockMovement->id;
                $stockMovementiitem->item_id= $item;
                $stockMovementiitem->unit_id= $data['units'][$i];
                $stockMovementiitem->quantity= $data['qty'][$i];
                $smi->save($stockMovementiitem);
                
            } $i++;
            
            
                $this->Flash->success(__('The stock movement has been saved.'));

                return $this->redirect(['action' => 'index']);
                
            }
            $units = TableRegistry::get('Units');
            $this->set('units',$units->find('list'));
            
            $items = TableRegistry::get('Items');
            $this->set('items',$items->find('list'));
            
            $this->Flash->error(__('The stock movement could not be saved. Please, try again.'));
        }
        else if($this->request->is('get')){
            $units_table = TableRegistry::get('Units');
            $this->set('units',$units_table->find('list'));
            
            $items_table = TableRegistry::get('Items');
            
           // $items = $items_table->find('all');
            
           // $this->set('items',$items);
           
           $this->set('items',$items_table->find('list')); 
            foreach($items_table as $item){
                $item->units = $units_table->find('list')->where(['id IN' => [$item->purchase_unit, $item->sell_unit, $item->usage_unit]]);
            }
            
    }
    $warehouses = $this->StockMovements->Warehouses->find('list', ['limit' => 200]);
    $this->set(compact('stockMovement', 'warehouses'));
}
        

    /**
     * Delete method
     *
     * @param string|null $id Stock Movement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockMovement = $this->StockMovements->get($id);
        if ($this->StockMovements->delete($stockMovement)) {
            $this->Flash->success(__('The stock movement has been deleted.'));
        } else {
            $this->Flash->error(__('The stock movement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

  

    public function getunits()
    {
        $this->RequestHandler->respondAs('json');
        $this->response->type('application/json');  
        $this->autoRender = false ;
      //  debug($itemid);die();
        $itemid = $this->request->query();
        
        $items_table = TableRegistry::get('Items');
        $item = $items_table->get($itemid['itemid']);
        $units_table = TableRegistry::get('Units');
        
//         $units = $units_table->find('all',['id IN'=>[$item->purchase_unit, $item->sell_unit, $item->usage_unit]]);
        $units = $units_table->find('list')->where(['id IN' => [$item->purchase_unit, $item->sell_unit, $item->usage_unit]]);
//         debug($units->count());
//         foreach($units as $unit){
//             debug($unit);
//         }
//         die();
        // $units=$units->find('list',array('fields'=>array('id','units_field')))->distinct('units_field');;
        //debug($item->purchase_unit.$item->sell_unit.$item->usage_unit); die();
       // $units = $units->find('all', array(
           // 'fields' => array('$item->purchase_unit', '$item->sell_unit'),
          //  'group' => array('$item->purchase_unit')
       // ));
        
        //debug($units);die();
        
        //this gives template error, google "cakephp function response without template"
        //     $this->set(compact('units'));
        //return json repsonse, something like json.encode();
//         $this->set([
//             'my_response' => $units,
//             '_serialize' => 'my_response',
//         ]);
        $this->RequestHandler->renderAs($this, 'json');
        
        $resultJ = json_encode($units);
        $this->response->type('json');
        $this->response->body($resultJ);
        return $this->response;
        
  //    return json_encode($units);
      
    }
    


public function getitems()
{
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');
    $this->autoRender = false ;
    $array = $this->request->data();
 // debug($array);die();
    $id=$array['id'];
    
    $stockMovementItems_table = TableRegistry::get('StockMovementItems');
   // $item = $stockMovements_table->get($itemid['itemid']);
    
    //$items =  $stockMovementItems_table->find('list')->where(['stock_movement_id'=>$id]);
    $status = $stockMovementItems_table->deleteAll(['stock_movement_id'=>$id]);
    
    $this->RequestHandler->renderAs($this, 'json');
    
    $resultJ = json_encode($status);
    $this->response->type('json');
    $this->response->body($resultJ);
    return $this->response;
}
    
}