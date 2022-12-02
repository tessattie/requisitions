<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 * @var string[]|\Cake\Collection\CollectionInterface $authorizations
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li><a href="<?= ROOT_DIREC ?>/roles">
            <?= __("Rôles") ?>
        </a></li>
        <li><?= __("Editer") ?></li>
        <li><?= $role->name ?>...</li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="container-fluid"> 
            <?= $this->Form->create($role) ?>
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    <?= __("Editer le Rôle") ?> : <?= $role->name ?>
                    <a class="btn btn-info" style="float:right" href="<?= ROOT_DIREC ?>/roles"><em class="fa fa-arrow-left"></em></a>
                </div>
            <div class="panel-body articles-container">       
                    <div class="row">
                        <div class="col-md-12"><?= $this->Form->control('name', array('class' => 'form-control', "label" => __("Nom")." *", "placeholder" => __("Nom"))); ?></div>
                    </div>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-12"><?= $this->Form->button(__('Sauvegarder'), array('class'=>'btn btn-success', "style"=>"float:right")) ?></div>
                    </div> 
                </div>
                
            </div>
            <?= $this->Form->end() ?>
        </div><!--End .articles-->
    </div>
</div>

<style type="text/css">
    @media only screen and (max-width: 600px) {
      

      
    }
</style>