<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 * @method \App\Model\Entity\Note[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requisitions', 'Users'],
        ];
        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Requisitions', 'Users'],
        ]);

        $this->set(compact('note'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEmptyEntity();
        if ($this->request->is('post')) {
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            $note->user_id = $this->Auth->user()['id']; 
            if ($this->Notes->save($note)) {
                return $this->redirect($this->referer());
            }
        }

        return $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $requisitions = $this->Notes->Requisitions->find('list', ['limit' => 200])->all();
        $users = $this->Notes->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('note', 'requisitions', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
