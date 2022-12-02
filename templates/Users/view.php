<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$languages = array("fr" => __("Français"), "es" => __("Espagnol"), "en" => __("Anglais"));
?>

<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/policies/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active"><?= __("Profil") ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    <?= __("Profil") ?>
                </div>
            <div class="panel-body articles-container">
                            <table class="table table-striped">
                        <tr>
                            <th><?= __('Nom') ?></th>
                            <td class="text-right"><?= h($user->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Nom d\'Utilisateur') ?></th>
                            <td class="text-right"><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Statut') ?></th>
                            <?php if($user->status == 1) : ?>
                                <td class="text-right">  <span class="label label-success"> <?= $status[$user->status] ?></span></td>
                            <?php else : ?>
                                <td class="text-right">  <span class="label label-danger"> <?= $status[$user->status] ?></span></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <th><?= __('Langue') ?></th>
                            <?= $this->Form->create() ?>
                            <td class="text-right"><?= $this->Form->button(__('Sauvegarder'), array('class'=>'btn btn-success', "style"=>"margin-left:5px;float:right;height:45px")) ?><?= $this->Form->control('language', array('class' => 'form-control', "value" => $user->language,  "empty" => "-- ".__("Langue")." --", "style" => "width : 150px;float:right", "label" => false, 'options' => $languages)); ?></td>
                            <?= $this->Form->end() ?>
                        </tr>
                    </table>
                </div>
                
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default articles">
                <div class="panel-heading">
                    <?= __("Renouvellez votre Mot de Passe") ?>
                </div>
                <div class="panel-body articles-container">
                    <?= $this->Form->create() ?>
                        <div class="row">
                        <div class="col-md-12"><?= $this->Form->control('old_password', array('class' => 'form-control', "label" => __("Ancien Mot de Passe")." *", "required" => true, "placeholder" => __("Ancien Mot de Passe"), 'type' => "password")); ?></div>
                            
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-md-12"><?= $this->Form->control('new_password', array('class' => 'form-control', "label" => __("Nouveau Mot de Passe")." *", "required" => true, "placeholder" => __("Nouveau Mot de Passe"), 'type' => "password")); ?></div>
                            
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-md-12"><?= $this->Form->control('confirm_new_password', array('class' => 'form-control', "label" => __("Confirmez Nouveau Mot de Passe")." *", "required" => true, "placeholder" => __("Confirmez Nouveau Mot de Passe"), 'type' => "password")); ?></div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12"><?= $this->Form->button(__('Sauvegarder'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right")) ?></div>
                        </div>  


                    <?= $this->Form->end() ?>
                </div>
                
            </div>
        </div>
    </div>
    
</div><!--End .articles-->