<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisition $requisition
 * @var string[]|\Cake\Collection\CollectionInterface $categories
 */
$statuses = array(3 => "Validé", 4 => "Décaissé");
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/policies/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li><a href="<?= ROOT_DIREC ?>/requisitions">
            Réquisitions
        </a></li>
        <li>Editer</li>
        <li><?= $requisition->requisition_number ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid"> 
            <?= $this->Form->create($requisition) ?>
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    Editer la Réquisition : <?= $requisition->requisition_number ?>
                    <a class="btn btn-info" style="float:right" href="<?= ROOT_DIREC ?>/requisitions"><em class="fa fa-arrow-left"></em></a>
                </div>
            <div class="panel-body articles-container">  
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
                    
                    <div class="col-md-4"><?= $this->Form->control('due_date', array('class' => 'form-control', "label" => "Date Cible de Décaissement *", "type" => "date")); ?>
                    </div>                  
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3"><?= $this->Form->control('amount_requested', array('class' => 'form-control', "label" => "Montant Demandé *", "placeholder" => "Montant Demandé")); ?>
                    </div>
                    <div class="col-md-3"><?= $this->Form->control('amount_authorized', array('class' => 'form-control', "label" => "Montant Autorisé *", "placeholder" => "Montant Autorisé")); ?>
                    </div>
                    <div class="col-md-1"><?= $this->Form->control('rate', array('class' => 'form-control',  "label" => ' ', 'options' => $rates, "style" => "margin-top:4px")); ?>
                    </div>
                    <?php if($auths[72]) : ?> 
                    <div class="col-md-4"><?= $this->Form->control('status', array('class' => 'form-control', "empty" => "-- Statut --", "label" => "Statut *", 'options' => $requisition_status)); ?>
                    </div> 
                <?php  endif; ?>
                                     
                </div>
                
                <hr>
                <div class="row">
                    <div class="col-md-12"><?= $this->Form->button(__('Sauvegarder'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right")) ?></div>
                </div> 
                </div>
                
            </div>
            <?= $this->Form->end() ?>
                <?php if($auths[70]) : ?>  
            <?= $this->Form->create($document, array('type' => 'file', 'url' => "/requisitions/document")) ?>
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    Pièces Jointes
                </div>
                <div class="panel-body articles-container">       
                    <div class="row">

                        <div class="col-md-4">
                            <?= $this->Form->control('requisition_id', array('type' => 'hidden', "value" => $requisition->id)); ?>
                          <div class="form-group">
                            <label for="exampleInputFile">Pièce Jointe</label>
                            <input type="file" id="requisition_document" name="attachment">
                            <p class="help-block">Ajoutez une pièce jointe ici</p>
                          </div>
                        </div>

                        <div class="col-md-8">
                            <?php foreach($requisition->documents as $document) : ?>
                                <?php 

                                $extension = explode(".", $document->location)[1]; 

                                ?>
                                <?php if($extension != 'jpg' && $extension != 'jpeg' && $extension != "png") : ?>
                                    <a class="btn btn-default" href="<?= ROOT_DIREC ?>/img/documents/<?= $document->location ?>" download><?= $document->location ?></a>
                                <?php else : ?>
                                    <a href="<?= ROOT_DIREC ?>/img/documents/<?= $document->location ?>" download>
                                <?= 
                                $this->Html->image('documents/'.$document->location, array('height' => '150', 'width' => 'auto', "style"=>"margin-right:10px")); ?></a>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-md-12"><?= $this->Form->button(__('Sauvegarder'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right")) ?></div>
                    </div> 
                </div>
                
            </div>
        <?= $this->Form->end() ?>
    <?php   endif; ?>
        </div><!--End .articles-->

    </div>

</div>

