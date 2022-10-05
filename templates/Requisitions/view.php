<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisition $requisition
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
        <li><?= $requisition->requisition_number ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="row">
    <div class="col-md-9">
        <div class="container-fluid"> 
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    Profil Réquisition : <?= $requisition->requisition_number ?>
                    <a class="btn btn-info" style="float:right" href="<?= ROOT_DIREC ?>/requisitions"><em class="fa fa-arrow-left"></em></a>
                    <?php if($auths[64]) : ?>
                    <a class="btn btn-warning" style="float:right;margin-right:10px" href="<?= ROOT_DIREC ?>/requisitions/edit/<?= $requisition->id ?>"><em class="fa fa-pencil"></em></a>
                <?php   endif; ?>
                </div>
            <div class="panel-body articles-container">       
                   <table class="table table-striped">
                <tr>
                    <th><?= __('#') ?></th>
                    <td class="text-right"><?= h($requisition->requisition_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Catégorie') ?></th>
                    <td class="text-right"><?= $requisition->category->name ?></td>
                </tr>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td class="text-right"><?= h($requisition->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td class="text-right"><?= h($requisition->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td class="text-right"><?= h($requisition->location) ?></td>
                </tr>
                <tr>
                    <th><?= __('Demandé Par') ?></th>
                    <td class="text-right"><?= h($requisition->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Demandé') ?></th>
                    <td class="text-right"><?= $requisition->amount_requested === null ? '' : number_format($requisition->amount_requested, 2, ".", ",") ." ". $rates[$requisition->rate] ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Autorisé') ?></th>
                    <td class="text-right"><?= $requisition->amount_authorized === null ? '' : number_format($requisition->amount_requested, 2, ".", ",") ." ". $rates[$requisition->rate]  ?></td>
                </tr>
                <tr>
                    <th><?= __('Statut') ?></th>
                    <?php if($requisition->status == 1) : ?>
                        <td class="text-right"><span class="label label-info"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 2) : ?>
                        <td class="text-right"><span class="label label-danger"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 3) : ?>
                        <td class="text-right"><span class="label label-primary"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 4) : ?>
                        <td class="text-right"><span class="label label-success"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php else : ?>
                        <td class="text-right"><span class="label label-warning"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th><?= __('Créé le') ?></th>
                    <td class="text-right"><?= h($requisition->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Cible de Décaissement') ?></th>
                    <td class="text-right"><?= h($requisition->due_date) ?></td>
                </tr>
            </table>
                </div>
                
            </div>
            <?= $this->Form->end() ?>

            <?= $this->Form->create($document, array('type' => 'file', 'url' => "/requisitions/document")) ?>
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    Pièces Jointes
                </div>
                <div class="panel-body articles-container">     
                <?php if($auths[70]) : ?>  
                    <div class="row">

                        <div class="col-md-12">
                            <?= $this->Form->control('requisition_id', array('type' => 'hidden', "value" => $requisition->id)); ?>
                          <div class="form-group">
                            <label for="exampleInputFile">Pièce Jointe</label>
                            <input type="file" id="requisition_document" name="attachment">
                            <p class="help-block">Ajoutez une pièce jointe ici</p>
                          </div>
                        </div>

                        

                    </div>

                    
                    <div class="row">
                        <div class="col-md-12"><?= $this->Form->button(__('Ajouter'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right")) ?></div>
                    </div> 
                    <hr>
                    <?php   endif; ?>
                    <div class="row">
                        
                            <?php foreach($requisition->documents as $document) : ?>
                                <?php 

                                $extension = explode(".", $document->location)[1]; 

                                ?>
                                <div class="col-md-2" style="margin-top:15px">
                                <?php if($extension != 'jpg' && $extension != 'jpeg' && $extension != "png") : ?>
                                    <a class="btn btn-default" href="<?= ROOT_DIREC ?>/img/documents/<?= $document->location ?>" download><?= $document->location ?></a>
                                <?php else : ?>
                                    <a href="<?= ROOT_DIREC ?>/img/documents/<?= $document->location ?>" download>
                                <?= 
                                $this->Html->image('documents/'.$document->location, array('height' => '150', 'width' => 'auto', "style"=>"margin-right:10px")); ?></a>
                            <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        
                    </div>
                </div>
                
            </div>
        <?= $this->Form->end() ?>
        </div><!--End .articles-->
    </div>

    <div class="col-md-3">
        <div class="panel panel-warning articles">
                <div class="panel-heading">
                    Commentaires
                    <?php if($auths[69]) : ?>
                    <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-default" style="float:right;padding:1px 10px 5px"><span class="fa fa-plus"></span></button>
                        <?php   endif; ?>
                </div>
                <div class="panel-body articles-container" style="height: 384px; overflow-y:scroll">       
                    <?php foreach($requisition->notes as $n) : ?>
                        <p class="bg-info" style="padding:10px">
                            <label>Créé Par :</label> <?= $n->user->name ?><br>
                            <label>Date :</label> <?= date("M d Y H:i", strtotime($n->created)) ?><br><br>
                            <?= $n->description ?>
                        </p>
                    <?php endforeach; ?>
                </div>
                
            </div>
    </div>
</div>

<style type="text/css">
    @media only screen and (max-width: 600px) {
      

      
    }
</style>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <?= $this->Form->create($note, array("url" => "/notes/add")) ?>
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Nouveau Commentaire</h3>
      </div>
      <div class="modal-body">
        <?= $this->Form->control('requisition_id', array('type' => 'hidden', "value" => $requisition->id)); ?>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->control('description', array('class' => 'form-control', "label" => false, "placeholder" => "Ecrivez votre commentaire ici...")); ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Ajouter</button>
      </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>