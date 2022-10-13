<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisition $requisition
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li><a href="<?= ROOT_DIREC ?>/requisitions">
            Réquisitions
        </a></li>
        <li class="active">Ajouter</li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Nouvelle Réquisition
            <a class="btn btn-info" style="float:right" href="<?= ROOT_DIREC ?>/requisitions"><em class="fa fa-arrow-left"></em></a>
        </div>
    <div class="panel-body articles-container">       
            <?= $this->Form->create($requisition) ?>
                <div class="row">
                    <div class="col-md-3"><?= $this->Form->control('requisition_number', array('class' => 'form-control', "label" => "Numéro de Réquisition *", "placeholder" => "Numéro de Réquisition")); ?>
                    </div>
                    <div class="col-md-3"><?= $this->Form->control('category_id', array('class' => 'form-control', "empty" => "-- Catégorie --", "label" => "Catégorie *", 'options' => $categories)); ?>
                    </div> 
                    <div class="col-md-3"><?= $this->Form->control('department_id', array('class' => 'form-control', "empty" => "-- Tous --", 'options' => $departments, "label" => "Département *", "multiple" => false, 'required' => true, 'style' => "height:46px")); ?></div>
                    <div class="col-md-3"><?= $this->Form->control('title', array('class' => 'form-control', "label" => "Titre *", "placeholder" => "Titre")); ?>
                    </div>
                                     
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12"><?= $this->Form->control('description', array('class' => 'form-control', "label" => "Description *", "placeholder" => "Description")); ?>
                    </div>
                                     
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><?= $this->Form->control('location', array('class' => 'form-control', "label" => "Point de Vente", "placeholder" => "Point de Vente")); ?>
                    </div>
                    <div class="col-md-4"><?= $this->Form->control('full_name', array('class' => 'form-control', "placeholder" => "Demandé Par", "label" => "Demandé Par *")); ?>
                    </div> 
                    <div class="col-md-3"><?= $this->Form->control('amount_requested', array('class' => 'form-control', "label" => "Montant Demandé *", "placeholder" => "Montant Demandé")); ?>
                    </div>
                    <div class="col-md-1"><?= $this->Form->control('rate', array('class' => 'form-control',  "label" => ' ', 'options' => $rates, "style" => "margin-top:4px")); ?>
                    </div>                  
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><?= $this->Form->control('due_date', array('class' => 'form-control', "label" => "Date Cible de Décaissement *", "type" => "date")); ?>
                    </div>
                                     
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12"><?= $this->Form->button(__('Ajouter'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right")) ?></div>
                </div>  


            <?= $this->Form->end() ?>
        </div>
        
    </div>
</div><!--End .articles-->

<style type="text/css">
    @media only screen and (max-width: 600px) {
      .input label, #cell-phone, #home-phone, #other-phone, .col-md-4 label{
        margin-top: 15px;
      }

      
    }
</style>