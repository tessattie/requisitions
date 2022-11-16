<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Mailer;
use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event){
        parent::beforeFilter($event);
        $this->Auth->allow(
            ['reset', 'resetpassword']
          );
    }

    public function authorize(){
        if($this->Auth->user()['role_id'] == 2){
            if($this->request->getParam('action') == 'reset' || $this->request->getParam('action') == 'resetpassword' || $this->request->getParam('action') == 'logout' || $this->request->getParam('action') == 'login' || $this->request->getParam('action') == 'view'){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->Users->find("all", array())->contain(['Roles', 'Departments']);
        $this->set(compact('users'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // if(!$this->authorize()){
        //     return $this->redirect(['action' => 'authorization']);
        // }
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $username_check = $this->Users->find("all", array("conditions" => array("username" => $this->request->getData()['username'])))->count();
            if($username_check  > 0){
                $this->Flash->error(__('Please choose a different username and try again.'));
            }else{
               if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }else{
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.')); 
            }
            
        }
        $roles = $this->Users->Roles->find('list');
        $departments = $this->Users->Departments->find('list');
        
        $this->set(compact('user', 'roles', 'departments'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // if(!$this->authorize()){
        //     return $this->redirect(['action' => 'authorization']);
        // }
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $old_data = json_encode($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list');
        $departments = $this->Users->Departments->find('list');
        $this->set(compact('user', 'roles', 'departments'));
    }


    /**
     * View method
     *
     * @param string|null $id Tenant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        // if(!$this->authorize()){
        //     return $this->redirect(['action' => 'authorization']);
        // }
        $user = $this->Users->get($this->Auth->user()['id'], ['contain' => ['Tenants']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])){
            if($this->request->getData()['confirm_new_password'] == $this->request->getData()['new_password']){
                if((new DefaultPasswordHasher)->check($this->request->getData()['old_password'], $user->password)){
                    $user->password = $this->request->getData()['confirm_new_password'];
                    $this->Users->save($user); 
                    $this->Flash->success(__('Your password has been reset. Please log in with your new password to continue.'));
                    return $this->redirect($this->Auth->logout());
                }else{
                    $this->Flash->error(__('Current password is incorrect'));
                }
            }else{
                $this->Flash->error(__('Both the new password and password confirmation must be the same.'));
            }
        }

        $this->set(compact('user'));
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // if(!$this->authorize()){
        //     return $this->redirect(['action' => 'authorization']);
        // }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function login(){
        $this->viewBuilder()->setLayout('login');
        if($this->request->is('post')){
            $user = $this->Auth->identify();

            if ($user) {
                if($user['status'] == 0){
                    $this->Flash->error(__('Compte bloqué'));
                }else{
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        }
    }

    

    public function logout(){
        return $this->redirect($this->Auth->logout());
    }

    public function reset(){
        $this->viewBuilder()->setLayout('login');
        $user = false;
        $message = ["success" => false];
        if($this->request->is(['patch', 'put', 'post'])){
            $user = $this->Users->find("all", array("conditions" => array('role_id <>' => 3, "OR" => array("username" => $this->request->getData()['username'], "email" => $this->request->getData()['email']))));

            if($user->count() == 1){
                $user = $user->first();
                $token = date("Ymd").$user->id.$user->password;
                $token_expiry = date("Y-m-d H:i:s", strtotime('+1 hours'));
                $user->token = sha1($token);
                $user->token_expiry = $token_expiry;
                if($this->Users->save($user)){
                    $user = $this->Users->get($user->id);
                    $email = new Mailer('default');
                    $email->setEmailFormat('html');
                    $email->setFrom(['info@agencyreportsystem.com' => 'AR System'])
                        ->setTo($user->email)
                        ->setSubject('Reset your password');
                        $email->setAttachments([
                            'photo.png' => [
                                'file' => EMAIL_UPLOAD_DIR.'/img/logo.png',
                                'mimetype' => 'image/png',
                                'contentId' => 'f3453452dse4e453'
                            ]
                        ]);
                        $email->viewBuilder()
                        ->setTemplate('reset')
                        ->setLayout('default');

                    $email->setViewVars(['user' => $user]);
                        
                    if($email->deliver()){
                        $message = array("success" => true, "message" => "You will find instructions to reset your password in your inbox. Contact us via Live Chat if you do not find this email and we'll help you out!");
                    }else{
                        $message = array("success" => true, "message" => "We could not send the email. Please contact our team to reset your password.");
                    }
                }
            }else{
                $message = array("success" => false, "message" => "We did not find an account related to the information you provided. Please make sure you entered the right information.");
            }
        }

        $this->set("message", $message);
    }

    public function resetpassword($hash = false){
        $this->viewBuilder()->setLayout('login');
        $message = ["success" => false];
        if($hash != false){
            $user = $this->Users->find("all", array("conditions" => array("token" => $hash))); 
            // debug($user->count()); die();
            if($user->count() > 0){
                $user = $user->first();
                $token_expiry = $user->token_expiry;
                if(date("Y-m-d H:i:s") <= $token_expiry->i18nFormat('yyyy-MM-dd H:i:s')){
                    $message = ["success" => true];
                }else{
                    $action = false;
                    $message = array("success" => false, "message" => "Link Expired");
                }
            }else{
                $message = array("success" => false, "message" => "Invalid token");
            }


            if ($this->request->is(['patch', 'post', 'put'])){
                if($this->request->getData()['confirm_password'] == $this->request->getData()['password']){
                        $user->password = $this->request->getData()['confirm_password'];
                        $this->Users->save($user); 
                        $this->Flash->success(__('Your password has been reset. Please log in with your new password to continue.'));
                        return $this->redirect($this->Auth->logout());
                }else{
                    $this->Flash->error(__('Both the new password and password confirmation must be the same.'));
                }
            }
        }
        $this->set("message", $message);
    }


    public function authorization(){
        
    }
}
