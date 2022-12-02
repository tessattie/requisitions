<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Authorization $authorization
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active"><?= __("Rôles") ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            <?= __("Rôles") ?>
            <a class="btn btn-warning" style="float:right" href="<?= ROOT_DIREC ?>/roles/add"><?= __("Ajouter") ?></a>
        </div>
    <div class="panel-body articles-container">
        <div class="table-responsive">
            <table class="table table-stripped datatable">
                <thead> 
                    <th><?= __("Nom") ?></th>
                    <th></th>
                </thead>
            <tbody> 
            <?php foreach($roles as $role) : ?>
                <tr>
                    <td><?= $role->name ?></td>
                    <td class="text-right"><a href="<?= ROOT_DIREC ?>/roles/edit/<?= $role->id ?>" style="font-size:1.3em!important;"><span class="fa fa-xl fa-pencil color-blue"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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