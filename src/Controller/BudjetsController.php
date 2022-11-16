<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Budjets Controller
 *
 * @property \App\Model\Table\BudjetsTable $Budjets
 * @method \App\Model\Entity\budjet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BudjetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $year = $this->session->read("periode_year");
        $month = $this->session->read("periode_month");

        $budjets = $this->Budjets->find("all", array("conditions" => array("year" => $year, "month" => $month)))->contain("Departments");

        $this->set(compact('budjets', 'year', 'month'));
    }


    public function report(){
        $year = $this->session->read("periode_year");
        $month = $this->session->read("periode_month");
        $from = $year."-".$month."-01";
        $to = date("Y-m-t", strtotime($from));

        $budjets = $this->Budjets->find("all", array("conditions" => array("year" => $year, "month" => $month)))->contain("Departments");

        foreach($budjets as $budjet){
            $requisitions = $this->Budjets->Departments->Requisitions->find("all", array("conditions" => array("department_id" => $budjet->department_id, 'due_date >=' => $from, 'due_date <=' => $to)))->contain(['Categories']);

            $categories = array();

            $htg = 0; $usd = 0; 

            foreach($requisitions as $requisition){
                if($requisition->rate == 1 && $requisition->status == 4){
                    $htg = $htg + $requisition->amount_authorized; 
                    if(!empty($categories[$requisition->category_id])){
                        $categories[$requisition->category_id] = array("name" => $requisition->category->name, "total_htg" => ($categories[$requisition->category_id]["total_htg"] + $requisition->amount_authorized), 'total_usd' => $categories[$requisition->category_id]["total_usd"]); 
                    }else{
                        $categories[$requisition->category_id] = array("name" => $requisition->category->name, "total_htg" => $requisition->amount_authorized, 'total_usd' => 0); 
                    }
                    
                }

                if($requisition->rate == 2 && $requisition->status == 4){
                    $usd = $usd + $requisition->amount_authorized; 

                    if(!empty($categories[$requisition->category_id])){
                        $categories[$requisition->category_id] = array("name" => $requisition->category->name, "total_htg" => $categories[$requisition->category_id]["total_htg"], 'total_usd' => ($categories[$requisition->category_id]["total_usd"] + $requisition->amount_authorized)); 
                    }else{
                        $categories[$requisition->category_id] = array("name" => $requisition->category->name, "total_htg" => 0, 'total_usd' => $requisition->amount_authorized); 
                    }
                }
            }

            $budjet->total_htg = $htg; 
            $budjet->total_usd = $usd;
            $budjet->categories = $categories;
        }

        $this->set(compact('budjets', 'year', 'month'));
    }


    public function update(){
        if($this->request->is(['ajax'])){
            $this->loadModel("Budjets"); 
            $budjet = $this->Budjets->get($this->request->getData()['budjet_id']); 
            if(!empty($this->request->getData()['htg_amount'])){
                $budjet->htg_amount = $this->request->getData()['htg_amount'];
            }

            if(!empty($this->request->getData()['usd_amount'])){
                $budjet->usd_amount = $this->request->getData()['usd_amount'];
            }

            $this->Budjets->save($budjet); 

            echo json_encode("saved");
        }
        die();
    }
}
