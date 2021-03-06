<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemGroups Controller
 *
 * @property \App\Model\Table\ItemGroupsTable $ItemGroups
 *
 * @method \App\Model\Entity\ItemGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $itemGroups = $this->paginate($this->ItemGroups);

        $this->set(compact('itemGroups'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemGroup = $this->ItemGroups->get($id, [
            'contain' => ['Items']
        ]);

        $this->set('itemGroup', $itemGroup);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemGroup = $this->ItemGroups->newEntity();
        if ($this->request->is('post')) {
            $itemGroup = $this->ItemGroups->patchEntity($itemGroup, $this->request->getData());
            if ($this->ItemGroups->save($itemGroup)) {
                $this->Flash->success(__('The item group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item group could not be saved. Please, try again.'));
        }
        $this->set(compact('itemGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemGroup = $this->ItemGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemGroup = $this->ItemGroups->patchEntity($itemGroup, $this->request->getData());
            if ($this->ItemGroups->save($itemGroup)) {
                $this->Flash->success(__('The item group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item group could not be saved. Please, try again.'));
        }
        $this->set(compact('itemGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemGroup = $this->ItemGroups->get($id);
        if ($this->ItemGroups->delete($itemGroup)) {
            $this->Flash->success(__('The item group has been deleted.'));
        } else {
            $this->Flash->error(__('The item group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
