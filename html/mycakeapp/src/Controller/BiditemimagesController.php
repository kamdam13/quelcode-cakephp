<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Biditemimages Controller
 *
 * @property \App\Model\Table\BiditemimagesTable $Biditemimages
 *
 * @method \App\Model\Entity\Biditemimage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BiditemimagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Biditems'],
        ];
        $biditemimages = $this->paginate($this->Biditemimages);

        $this->set(compact('biditemimages'));
    }

    /**
     * View method
     *
     * @param string|null $id Biditemimage id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $biditemimage = $this->Biditemimages->get($id, [
            'contain' => ['Biditems'],
        ]);

        $this->set('biditemimage', $biditemimage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $biditemimage = $this->Biditemimages->newEntity();
        if ($this->request->is('post')) {
            $biditemimage = $this->Biditemimages->patchEntity($biditemimage, $this->request->getData());
            if ($this->Biditemimages->save($biditemimage)) {
                $this->Flash->success(__('The biditemimage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biditemimage could not be saved. Please, try again.'));
        }
        $biditems = $this->Biditemimages->Biditems->find('list', ['limit' => 200]);
        $this->set(compact('biditemimage', 'biditems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Biditemimage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $biditemimage = $this->Biditemimages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $biditemimage = $this->Biditemimages->patchEntity($biditemimage, $this->request->getData());
            if ($this->Biditemimages->save($biditemimage)) {
                $this->Flash->success(__('The biditemimage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biditemimage could not be saved. Please, try again.'));
        }
        $biditems = $this->Biditemimages->Biditems->find('list', ['limit' => 200]);
        $this->set(compact('biditemimage', 'biditems'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Biditemimage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $biditemimage = $this->Biditemimages->get($id);
        if ($this->Biditemimages->delete($biditemimage)) {
            $this->Flash->success(__('The biditemimage has been deleted.'));
        } else {
            $this->Flash->error(__('The biditemimage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
