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
            
          
           $this->set('stockMovement', $stockMovement);
    
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
	//debug($this->request->getData());die();	  
        $stockMovement = $this->StockMovements->newEntity();
        
        if ($this->request->is('post')) {
            $stockMovement = $this->StockMovements->patchEntity($stockMovement, $this->request->getData());
            if ($this->StockMovements->save($stockMovement)) {
		$smi = TableRegistry::get('StockMovementItems');
		$stockMovementiitem = $smi->newEntity();
		$stockMovementiitem->stock_movement_id= $stockMovement->id;
		$stockMovementiitem->item_id= $this->request->getData()["item_id"];
		$stockMovementiitem->unit_id= $this->request->getData()["unit_id"];
		$stockMovementiitem->quantity= $this->request->getData()["quantity"];
		$smi->save($stockMovementiitem);

                $this->Flash->success(__('The stock movement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
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
        $stockMovement = $this->StockMovements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockMovement = $this->StockMovements->patchEntity($stockMovement, $this->request->getData());
            if ($this->StockMovements->save($stockMovement)) {
                $this->Flash->success(__('The stock movement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
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

  
}