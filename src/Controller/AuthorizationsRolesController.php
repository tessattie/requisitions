<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AuthorizationsRoles Controller
 *
 * @property \App\Model\Table\AuthorizationsRolesTable $AuthorizationsRoles
 * @method \App\Model\Entity\AuthorizationsRole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuthorizationsRolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Authorizations', 'Roles'],
        ];
        $authorizationsRoles = $this->paginate($this->AuthorizationsRoles);

        $this->set(compact('authorizationsRoles'));
    }

    /**
     * View method
     *
     * @param string|null $id Authorizations Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $authorizationsRole = $this->AuthorizationsRoles->get($id, [
            'contain' => ['Authorizations', 'Roles'],
        ]);

        $this->set(compact('authorizationsRole'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $authorizationsRole = $this->AuthorizationsRoles->newEmptyEntity();
        if ($this->request->is('post')) {
            $authorizationsRole = $this->AuthorizationsRoles->patchEntity($authorizationsRole, $this->request->getData());
            if ($this->AuthorizationsRoles->save($authorizationsRole)) {
                $this->Flash->success(__('The authorizations role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The authorizations role could not be saved. Please, try again.'));
        }
        $authorizations = $this->AuthorizationsRoles->Authorizations->find('list', ['limit' => 200])->all();
        $roles = $this->AuthorizationsRoles->Roles->find('list', ['limit' => 200])->all();
        $this->set(compact('authorizationsRole', 'authorizations', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Authorizations Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $authorizationsRole = $this->AuthorizationsRoles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $authorizationsRole = $this->AuthorizationsRoles->patchEntity($authorizationsRole, $this->request->getData());
            if ($this->AuthorizationsRoles->save($authorizationsRole)) {
                $this->Flash->success(__('The authorizations role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The authorizations role could not be saved. Please, try again.'));
        }
        $authorizations = $this->AuthorizationsRoles->Authorizations->find('list', ['limit' => 200])->all();
        $roles = $this->AuthorizationsRoles->Roles->find('list', ['limit' => 200])->all();
        $this->set(compact('authorizationsRole', 'authorizations', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Authorizations Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $authorizationsRole = $this->AuthorizationsRoles->get($id);
        if ($this->AuthorizationsRoles->delete($authorizationsRole)) {
            $this->Flash->success(__('The authorizations role has been deleted.'));
        } else {
            $this->Flash->error(__('The authorizations role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
