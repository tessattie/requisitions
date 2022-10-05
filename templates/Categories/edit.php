<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/policies/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li><a href="<?= ROOT_DIREC ?>/categories">
            Catégories
        </a></li>
        <li>Editer</li>
        <li><?= $category->name ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="container-fluid"> 
            <?= $this->Form->create($category) ?>
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    Editer la Catégorie : <?= $category->name ?>
                    <a class="btn btn-info" style="float:right" href="<?= ROOT_DIREC ?>/categories"><em class="fa fa-arrow-left"></em></a>
                </div>
            <div class="panel-body articles-container">       
                    <div class="row">
                        <div class="col-md-12"><?= $this->Form->control('name', array('class' => 'form-control', "label" => "Nom *", "placeholder" => "Nom")); ?></div>
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
