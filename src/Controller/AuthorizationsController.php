<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Authorizations Controller
 *
 * @property \App\Model\Table\AuthorizationsTable $Authorizations
 * @method \App\Model\Entity\Authorization[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuthorizationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($id = false)
    {
        $this->loadModel("AuthorizationsRoles"); $this->loadModel("Roles");
        $authorizations = $this->Authorizations->find("all", array("order" => array("type ASC")));
        $roles_authorizations = [];
        $roles = $this->AuthorizationsRoles->Roles->find("all", array("order" => array("name ASC")));
        if($id){
            
            $roles_authorizations = $this->AuthorizationsRoles->find("all", array("conditions" => array("role_id" => $id)));
        }
        $role_id = $id;
        $this->set(compact('authorizations', 'roles', 'roles_authorizations', 'role_id'));
    }

    public function update(){
        if($this->request->is(['ajax'])){
            $this->loadModel("AuthorizationsRoles");
            $ua = $this->AuthorizationsRoles->find("all", array("conditions" => array("role_id" => $this->request->getData()['role_id'], "authorization_id" => $this->request->getData()['authorization_id'])));
            if($this->request->getData()['checked'] == 'true'){
                if($ua->count() == 0){
                    $new_ua = $this->AuthorizationsRoles->newEmptyEntity();
                    $new_ua->authorization_id = $this->request->getData()['authorization_id'];
                    $new_ua->role_id =$this->request->getData()['role_id'];
                    $this->AuthorizationsRoles->save($new_ua);
                }
            }else{
               if($ua->count() > 0){
                foreach($ua as $usra){
                    $this->AuthorizationsRoles->delete($usra);
                }
               } 
            }
            echo json_encode($this->request->getData());
        }
        die();
    }
}
