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
                    <div class="col-md-2"><?= $this->Form->control('daily_rate', array('class' => 'form-control', "label" => "Taux du Jour *", "placeholder" => "Taux du Jour")); ?>
                    </div>
                    <?php if($auths[72]) : ?> 
                    <div class="col-md-3"><?= $this->Form->control('status', array('class' => 'form-control', "empty" => "-- Statut --", "label" => "Statut *", 'options' => $requisition_status)); ?>
                    </div> 
                <?php  endif; ?>
                                     
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <?php  if($auths[76]) : ?>
                        <label id="department_name"> Department</label> <small style="color:#30a5ff;font-weight:bold;float:right"><span id="percent_htg">0</span>%</small><br>
                        <div class="progress" style="height:20px">
                          <div class="progress-bar" style="width: 0%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progressbar_htg"><small id="bvalues_htg"></small></div>
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="col-md-8"><?= $this->Form->button(__('Sauvegarder'), array('class'=>'btn btn-success', "style"=>"margin-top:29px;float:right")) ?></div>
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
<?php  if($auths[76]) : ?>
<script type="text/javascript">
    var department_id = <?= $requisition->department_id ?>
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#department-id").change(function(){
            var department_id = $(this).val()
            var budjet = budjet_values[department_id]; 

            $("#department_name").text(budjet.name)
            $("#percent_htg").text(budjet.percent_htg)

            $("#bvalues_htg").text(budjet.total_htg+"/"+budjet.budjet.htg_amount)

            $("#progressbar_htg").css("width", budjet.percent_htg+"%")


        })


        var budjet = budjet_values[department_id]; 

            $("#department_name").text(budjet.name)
            $("#percent_htg").text(budjet.percent_htg)

            $("#bvalues_htg").text(budjet.total_htg+"/"+budjet.budjet.htg_amount)

            $("#progressbar_htg").css("width", budjet.percent_htg+"%")
    })
</script>
<?php   endif; ?>