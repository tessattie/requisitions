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
            <?= __("Réquisitions") ?>
        </a></li>
        <li class="active"><?= __("Ajouter") ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            <?= __("Nouvelle Réquisition") ?>
            <a class="btn btn-info" style="float:right" href="<?= ROOT_DIREC ?>/requisitions"><em class="fa fa-arrow-left"></em></a>
        </div>
    <div class="panel-body articles-container">       
            <?= $this->Form->create($requisition) ?>
                <div class="row">
                    <div class="col-md-3"><?= $this->Form->control('requisition_number', array('class' => 'form-control', "label" => __("Numéro de Réquisition")." *", "placeholder" => __("Numéro de Réquisition"))); ?>
                    </div>
                    <div class="col-md-3"><?= $this->Form->control('category_id', array('class' => 'form-control', "empty" => "-- ".__("Catégorie")." --", "label" => __("Catégorie")." *", 'options' => $categories)); ?>
                    </div> 
                    <div class="col-md-3"><?= $this->Form->control('department_id', array('class' => 'form-control', "empty" => "-- ".__("Département")." --", 'options' => $departments, "label" => __("Département")." *", "multiple" => false, 'required' => true, 'style' => "height:46px")); ?></div>
                    <div class="col-md-3"><?= $this->Form->control('title', array('class' => 'form-control', "label" => __("Titre")." *", "placeholder" => __("Titre"))); ?>
                    </div>
                                     
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12"><?= $this->Form->control('description', array('class' => 'form-control', "label" => __("Description")." *", "placeholder" => __("Description"))); ?>
                    </div>
                                     
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><?= $this->Form->control('location', array('class' => 'form-control', "label" => __("Point de Vente"), "placeholder" => __("Point de Vente"))); ?>
                    </div>
                    <div class="col-md-4"><?= $this->Form->control('full_name', array('class' => 'form-control', "placeholder" => __("Demandé Par"), "label" => __("Demandé Par")." *")); ?>
                    </div> 
                    <div class="col-md-3"><?= $this->Form->control('amount_requested', array('class' => 'form-control', "label" => __("Montant Demandé")." *", "placeholder" => __("Montant Demandé"))); ?>
                    </div>
                    <div class="col-md-1"><?= $this->Form->control('rate', array('class' => 'form-control',  "label" => ' ', 'options' => $rates, "style" => "margin-top:4px")); ?>
                    </div>                  
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><?= $this->Form->control('due_date', array('class' => 'form-control', "label" => __("Date Cible de Décaissement")." *", "type" => "date")); ?></div>
                    <div class="col-md-3"><?= $this->Form->control('daily_rate', array('class' => 'form-control', "label" => __("Taux du Jour")." *", "placeholder" => __("Taux du Jour"))); ?>
                    </div>
                                     
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <?php  if($auths[76]) : ?>
                        <label id="department_name"> <?= __("Département") ?></label> <small style="color:#30a5ff;font-weight:bold;float:right"><?= __("HTG") ?> : <span id="percent_htg">0</span>%</small><br>
                        <div class="progress" style="height:20px">
                          <div class="progress-bar" style="width: 0%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progressbar_htg"><small id="bvalues_htg"></small></div>
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="col-md-8"><?= $this->Form->button(__('Ajouter'), array('class'=>'btn btn-success', "style"=>"margin-top:29px;float:right")) ?></div>
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
<?php  if($auths[76]) : ?>
<script type="text/javascript">
    console.log(budjet_values)
    $(document).ready(function(){
        $("#department-id").change(function(){
            var department_id = $(this).val()
            var budjet = budjet_values[department_id]; 

            $("#department_name").text(budjet.name)
            $("#percent_htg").text(budjet.percent_htg)

            $("#bvalues_htg").text(budjet.total_htg+"/"+budjet.budjet.htg_amount)

            $("#progressbar_htg").css("width", budjet.percent_htg+"%")
        })
    })
</script>
<?php endif; ?>