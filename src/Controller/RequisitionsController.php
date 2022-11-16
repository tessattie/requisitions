<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Requisitions Controller
 *
 * @property \App\Model\Table\RequisitionsTable $Requisitions
 * @method \App\Model\Entity\Requisition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequisitionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $from = $this->session->read("periode_year")."-".$this->session->read("periode_month")."-01"; 
        $to = date("Y-m-t", strtotime($from));
        $requisitions = $this->Requisitions->find("all", array("conditions" => array("due_date >=" => $from, "due_date <=" => $to), "order" => array("due_date ASC")))->contain(['Users', 'Categories', 'Departments']);

        if(!empty($this->Auth->user()['department_id'])){
          $requisitions->where(['Requisitions.department_id' => $this->Auth->user()['department_id']]);
        }

        $this->set(compact('requisitions'));
    }

    /**
     * View method
     *
     * @param string|null $id Requisition id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requisition = $this->Requisitions->get($id, [
            'contain' => ['Categories', 'Documents', 'Notes' => ['Users'], 'Users', 'Departments'],
        ]);

        if(!empty($this->Auth->user()['department_id'])){
            if($this->Auth->user()['department_id'] != $requisition->department_id){
                return $this->redirect($this->referer());
            }
        }

        $this->loadModel("Notes"); 
        $note = $this->Notes->newEmptyEntity();
        $this->loadModel("Documents");
        $document = $this->Documents->newEmptyEntity();

        $this->set(compact('requisition', 'note', 'document'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requisition = $this->Requisitions->newEmptyEntity();
        if ($this->request->is('post')) {
            $requisition = $this->Requisitions->patchEntity($requisition, $this->request->getData());
            $requisition->user_id = $this->Auth->user()['id'];

            if(!empty($this->Auth->user()['department_id'])){
                $requisition->department_id = $this->Auth->user()['department_id'];
            }
            if ($this->Requisitions->save($requisition)) {
                $this->Flash->success(__('The requisition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisition could not be saved. Please, try again.'));
        }
        $categories = $this->Requisitions->Categories->find('list', ['limit' => 200])->all();
        $departments = $this->Requisitions->Departments->find('list');
        $this->set(compact('requisition', 'categories', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Requisition id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requisition = $this->Requisitions->get($id, [
            'contain' => ['Documents'],
        ]);

        if(!empty($this->Auth->user()['department_id'])){
            if($this->Auth->user()['department_id'] != $requisition->department_id){
                return $this->redirect($this->referer());
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requisition = $this->Requisitions->patchEntity($requisition, $this->request->getData());
            if ($this->Requisitions->save($requisition)) {
                $this->Flash->success(__('The requisition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requisition could not be saved. Please, try again.'));
        }
        $categories = $this->Requisitions->Categories->find('list', ['order' => array("name ASC")])->all();
        $this->loadModel("Documents");
        $document = $this->Documents->newEmptyEntity();
        $departments = $this->Requisitions->Departments->find('list');
        $this->set(compact('requisition', 'categories', 'document', 'departments'));
    }

    public function document(){
        $this->loadModel("Documents");
        $document = $this->Documents->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $attachment = $this->request->getData('attachment');
            $name = $attachment->getClientFilename();
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $document_name = rand(1000,500000)."_".$data['requisition_id'].".".$extension;
            $type = $attachment->getClientMediaType();
            $targetPath = WWW_ROOT. 'img'. DS . 'documents'. DS. $document_name;
            if (!empty($name)) {
                if ($attachment->getSize() > 0 && $attachment->getError() == 0) {
                    $attachment->moveTo($targetPath); 
                    $data['location'] = $document_name;
                    $document = $this->Documents->patchEntity($document, $data);
                    $document->user_id = $this->Auth->user()['id'];
                    $this->Documents->save($document); 
                }
            }
            
            return $this->redirect($this->referer());
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Requisition id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requisition = $this->Requisitions->get($id);
        if ($this->Requisitions->delete($requisition)) {
            $this->Flash->success(__('The requisition has been deleted.'));
        } else {
            $this->Flash->error(__('The requisition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function dashboard(){
        $this->viewBuilder()->setLayout('dashboard');

        $from = $this->session->read("periode_year")."-".$this->session->read("periode_month")."-01"; 
        $to = date("Y-m-t", strtotime($from));

        $requisitions = $this->Requisitions->find("all", array("conditions" => array("due_date >=" => $from, "due_date <=" => $to)))->contain(['Categories', 'Users', 'Notes' => ['Users'], 'Documents', 'Departments']); 

        if(!empty($this->Auth->user()['department_id'])){
            $requisitions->where(['Requisitions.department_id' => $this->Auth->user()['department_id']]);
        }

        $this->set(compact('requisitions'));

    }

    public function update(){
        if($this->request->is(['patch', 'put', 'post'])){
            $requisition = $this->Requisitions->get($this->request->getData()['requisition_id']);
            $requisition->status = $this->request->getData()['status']; 
            $requisition->amount_authorized = $this->request->getData()['amount_authorized'];
            $this->Requisitions->save($requisition); 

            if(!empty($this->request->getData()['comment'])){
                $this->loadModel("Notes"); 
                $note = $this->Notes->newEmptyEntity();
                $note->description = $this->request->getData()['comment']; 
                $note->requisition_id = $requisition->id; 
                $note->user_id = $this->Auth->user()['id'];
                $this->Notes->save($note);
            }


            $data = $this->request->getData();
            $attachment = $this->request->getData('attachment');
            $name = $attachment->getClientFilename();

            $data = $this->request->getData();
            $attachment = $this->request->getData('attachment');
            $name = $attachment->getClientFilename();
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $document_name = rand(1000,500000)."_".$data['requisition_id'].".".$extension;
            $type = $attachment->getClientMediaType();
            $targetPath = WWW_ROOT. 'img'. DS . 'documents'. DS. $document_name;
            if (!empty($name)) {

                $this->loadModel('Documents');
                $document = $this->Documents->newEmptyEntity();
                if ($attachment->getSize() > 0 && $attachment->getError() == 0) {
                    $attachment->moveTo($targetPath); 
                    $data['location'] = $document_name;
                    $document = $this->Documents->patchEntity($document, $data);
                    $document->user_id = $this->Auth->user()['id'];
                    $this->Documents->save($document); 
                }
            }



        }

        return $this->redirect(['action' => 'dashboard']);
    }
}
