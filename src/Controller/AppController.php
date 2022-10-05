<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $status = array(0 => "Inactive", 1 => "Active");

    public $requisition_status = array(1 => "En Révision", 2 => "En attente", 3 => "Validé", 4 => "Décaissé", 5 => "Refusé");

    protected $authorizations = [];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        define('ROOT_DIREC', '/loto');

        date_default_timezone_set("America/New_York");

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Requisitions',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login']
        ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event){

        $this->session = $this->getRequest()->getSession();
        
        if (!$this->Auth->user()) {
            $this->Auth->setConfig('authError', false);
            return null;
        }
        if($this->Auth->user()){
            $this->from = $this->session->read("from")." 00:00:00";
            $this->to = $this->session->read("to")." 23:59:59";
            $this->initializeSessionVariables();
            $this->set('rates', array(1 => "HTG", 2 => "USD"));
            $this->set("filterfrom", $this->session->read("from"));
            $this->set("filterto", $this->session->read("to"));
            $this->set('user_connected', $this->Auth->user());
            $this->set('status', $this->status);
            $this->set('requisition_status', $this->requisition_status);
            $this->set("auths", $this->getAuthorizations());
            // debug($this->Auth->user()); die();
        }
    }

    private function getAuthorizations(){
        $role_id = $this->Auth->user()['role_id'];
        $result = [];
        $this->loadModel("Authorizations"); $this->loadModel("AuthorizationsRoles");
        $authorizations = $this->Authorizations->find("all");
        $roles_authorizations = $this->Authorizations->find("all")->contain(['AuthorizationsRoles'])->matching('AuthorizationsRoles', function(\Cake\ORM\Query $q){
            return $q->where(['AuthorizationsRoles.role_id' => $this->Auth->user()['role_id']]);
        });

        foreach($authorizations as $auth){
            $result[$auth->id] = false;
            foreach($roles_authorizations as $ua){
                if($ua->id == $auth->id){
                    $result[$auth->id] = true;
                }
            }
        }
        $this->authorizations = $result;

        return $result;
    }


    private function initializeSessionVariables(){
        if(empty($this->session->read("from"))){
            $this->session->write("from", date("Y-m-d"));
        }

        if(empty($this->session->read("to"))){
            $this->session->write("to", date("Y-m-d"));
        }

        if(empty($this->session->read("filter_country"))){
            $this->session->write("filter_country", '');
        }
    }

    public function updateSessionVariables(){
        if ($this->request->is(['put', 'patch', 'post'])){
            if(!empty($this->request->getData()["from"])){
                $this->session->write("from", $this->request->getData()["from"]);
            }

            if(!empty($this->request->getData()["to"])){
                $this->session->write("to", $this->request->getData()["to"]);
            }

            $this->session->write("filter_country", $this->request->getData()["filter_country"]);
        }

        return $this->redirect($this->referer());
    }
}
