<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active"><?= __("Utilisateurs") ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            <?= __("Utilisateurs") ?>
            <a href="<?= ROOT_DIREC ?>/users/add" style="float:right"><button class="btn btn-warning"><?= __("Ajouter") ?></button></a>
        </div>
    <div class="panel-body articles-container">
        <div class="table-responsive">
            <table class="table table-stripped datatable">
                <thead> 
                    <th><?= __("Nom") ?></th>
                    <th class="text-center"><?= __("Nom d'Utilisateur") ?></th>
                    <th class="text-center"><?= __("Rôle") ?></th>
                    <th class="text-center"><?= __("Département") ?></th>
                    <th class="text-center"><?= __("Statut") ?></th>
                    <th class="text-center"></th>
                </thead>
            <tbody> 
        <?php foreach($users as $user) : ?>
                <tr>
                    <td><?= $user->name ?></td>
                    <td class="text-center"><?= $user->username ?></td>
                    <td class="text-center"><?= $user->role->name ?></td>
                    <?php if(!empty($user->department_id)) : ?>
                        <td class="text-center"><?= $user->department->name ?></td>
                    <?php else : ?>
                        <td class="text-center"><?= __("Tous") ?></td>
                    <?php endif; ?>
                    <?php if($user->status == 1) : ?>
                        <td class="text-center">  <span class="label label-success"> <?= __($status[$user->status]) ?></span></td>
                    <?php else : ?>
                        <td class="text-center">  <span class="label label-danger"> <?= __($status[$user->status]) ?></span></td>
                    <?php endif; ?>
                    <td class="text-right"><a href="<?= ROOT_DIREC ?>/users/edit/<?= $user->id ?>" style="font-size:1.3em!important;"><span class="fa fa-xl fa-pencil color-blue"></span></a>
                    <a href="<?= ROOT_DIREC ?>/users/delete/<?= $user->id ?>" style="font-size:1.3em!important;margin-left:5px"><span class="fa fa-xl fa-trash color-red"></span></a>
                    </td>
                </tr>
        <?php endforeach; ?>
        </tbody>
        </table></div>
            <!--End .article-->
        </div>
        
    </div>
</div><!--End .articles-->

<script type="text/javascript">$(document).ready( function () {
    $('.datatable').DataTable({
    } );
} );</script>

<style>
    .dt-button{
        padding:5px;
        background:black;
        border:2px solid black;
        border-radius:2px;;
        color:white;
        margin-bottom:-10px;
    }
    .dt-buttons{
        margin-bottom:-25px;
    }
</style>