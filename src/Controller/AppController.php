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
use Cake\I18n\I18n;


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

    public $status = array();

    public $requisition_status = array();

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

        define('ROOT_DIREC', '/requisitions2');

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

        I18n::setLocale('fr');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event){

        $this->requisition_status = array(1 => __("En Révision"), 2 => __("En attente"), 3 => __("Validé"), 4 => __("Décaissé"), 5 => __("Refusé"));
        

        $this->status = array(0 => __("Inactif"), 1 => __("Actif"));

        $this->session = $this->getRequest()->getSession();
        
        if (!$this->Auth->user()) {
            $this->Auth->setConfig('authError', false);
            return null;
        }
        if($this->Auth->user()){
            $this->loadModel("Users");
            $user = $this->Users->get($this->Auth->user()['id']);
            I18n::setLocale($user->language);
            $this->setbudjets();
            $this->initializeSessionVariables();
            $this->set("budjet_progress", $this->getBudjetProgress());
            $this->from = $this->session->read("from")." 00:00:00";
            $this->to = $this->session->read("to")." 23:59:59";
            
            $this->set('rates', array(1 => __("HTG"), 2 => __("USD")));
            $this->set("periode_year", $this->session->read("periode_year"));
            $this->set("periode_month", $this->session->read("periode_month"));
            $this->set('user_connected', $this->Auth->user());
            $this->set('status', $this->status);
            $this->set('requisition_status', $this->requisition_status);
            $this->set("auths", $this->getAuthorizations());
            // debug($this->Auth->user()); die();
        }
    }

    private function setbudjets(){
        $periods = []; 
        $today = date("Y-m-d"); 

        $this->loadModel("Departments"); $this->loadModel("Budjets");

        $periods[0] = array("year" => date('Y', strtotime($today)), 'month' => date("m", strtotime($today)));
        $periods[1] = array("year" => date('Y', strtotime("+1 month ".$today)), 'month' => date("m", strtotime("+1 month ". $today)));
        $periods[2] = array("year" => date('Y', strtotime("+2 month ".$today)), 'month' => date("m", strtotime("+2 month ". $today)));

        $departments = $this->Departments->find("all"); 

        foreach($periods as $key => $period){
            foreach($departments as $department){
                $exists = $this->Budjets->find("all", array("conditions" => array("department_id" => $department->id, 'year' => $period['year'], 'month' => $period['month'])));
                if($exists->count() == 0){
                    $budjet = $this->Budjets->newEmptyEntity(); 
                    $budjet->department_id = $department->id; 
                    $budjet->year = $period['year']; 
                    $budjet->month = $period['month']; 
                    $budjet->htg_amount = 1; 
                    $budjet->usd_amount = 1; 
                    $this->Budjets->save($budjet); 
                }
            }
        }
    }

    private function getBudjetProgress(){
        $this->loadModel("Departments"); 
        $departments =  $this->Departments->find("all", array("order" => array("name ASC")));
        $year = $this->session->read("periode_year");
        $month = $this->session->read("periode_month");
        foreach($departments as $department){
            $department->budjet = $this->Departments->Budjets->find("all", array("conditions" => array("department_id" => $department->id, "year" => $year, "month" => $month)))->first();

            $requisitions = $this->Departments->Requisitions->find("all", array("conditions" => array("department_id" => $department->id, 'due_date >=' => date($year."-".$month."-01"), 'due_date <=' => date($year."-".$month."-t"))))->contain(['Categories']);

            $htg = 0; 

            foreach($requisitions as $requisition){
                if($requisition->rate == 1 && $requisition->status == 4){
                    $htg = $htg + $requisition->amount_authorized; 
                }

                if($requisition->rate == 2 && $requisition->status == 4){
                    $htg = $htg + $requisition->amount_authorized*$requisition->daily_rate; 
                }
            }

            $department->total_htg = $htg; 
            if(!empty($department->budjet)){
                $department->percent_htg = $department->total_htg*100/$department->budjet->htg_amount; 
           }else{
                $department->percent_htg = 0;
           }
            
        }

        // debug($departments->toArray()); die();

        return $departments;
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
        if(empty($this->session->read("periode_month"))){
            $this->session->write("periode_month", date("m"));
        }

        if(empty($this->session->read("periode_year"))){
            $this->session->write("periode_year", date("Y"));
        }
    }

    public function updateSessionVariables(){
        if ($this->request->is(['put', 'patch', 'post'])){
            if(!empty($this->request->getData()["periode_month"])){
                $this->session->write("periode_month", $this->request->getData()["periode_month"]);
            }

            if(!empty($this->request->getData()["periode_year"])){
                $this->session->write("periode_year", $this->request->getData()["periode_year"]);
            }

        }

        return $this->redirect($this->referer());
    }

}
