<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisition/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li><a href="<?= ROOT_DIREC ?>/departments">
            <?= __("Départements") ?>
        </a></li>
        <li class="active"><?= __("Ajouter") ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="panel panel-default articles">
        <div class="panel-heading">
            <?= __("Nouveau Département") ?>
            <a class="btn btn-info" style="float:right" href="<?= ROOT_DIREC ?>/departments"><em class="fa fa-arrow-left"></em></a>
        </div>
    <div class="panel-body articles-container">       
            <?= $this->Form->create($department) ?>
                <div class="row">
                <div class="col-md-12"><?= $this->Form->control('name', array('class' => 'form-control', "label" => __("Nom")." *", "placeholder" => __("Nom"))); ?></div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12"><?= $this->Form->button(__('Ajouter'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right")) ?></div>
                </div>  


            <?= $this->Form->end() ?>
        </div>
        
    </div>
    </div>
    
</div><!--End .articles-->

