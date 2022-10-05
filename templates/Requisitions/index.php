<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisition[]|\Cake\Collection\CollectionInterface $requisitions
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Réquisitions</li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Réquisitions
            <?php if($auths[63]) : ?>
            <a href="<?= ROOT_DIREC ?>/requisitions/add" style="float:right"><button class="btn btn-warning">Ajouter</button></a>
        <?php endif; ?>
        </div>
    <div class="panel-body articles-container">
        <div class="table-responsive">
            <table class="table table-stripped datatable">
                <thead> 
                    <th>#</th>
                    <th class="text-center">Catégorie</th>
                    <th class="text-center">Créé par</th>
                    <th class="text-center">Titre</th>
                    <th class="text-center">Demandé Par</th>
                    <th class="text-center">Date Cible</th>
                    <th class="text-center">Montant Demandé</th>
                    <th class="text-center">Statut</th>
                    <?php if($auths[64]) : ?>
                    <th class="text-right"></th>
                        <?php   endif; ?>
                </thead>
            <tbody> 
        <?php foreach($requisitions as $requisition) : ?>
                <tr>
                    <td><a href="<?= ROOT_DIREC ?>/requisitions/view/<?= $requisition->id ?>"><?= $requisition->requisition_number ?></a></td>
                    <td class="text-center"><?= $requisition->category->name ?></td>
                    <td class="text-center"><?= $requisition->user->name ?></td>
                    <td class="text-center"><?= $requisition->title ?></td>
                    <td class="text-center"><?= $requisition->full_name ?></td>
                    <td class="text-center"><?= $requisition->due_date ?></td>
                    <td class="text-center"><?= number_format($requisition->amount_requested) . " ". $rates[$requisition->rate] ?></td>
                    <?php if($requisition->status == 1) : ?>
                        <td class="text-center"><span class="label label-info"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 2) : ?>
                        <td class="text-center"><span class="label label-danger"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 3) : ?>
                        <td class="text-center"><span class="label label-primary"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 4) : ?>
                        <td class="text-center"><span class="label label-success"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php else : ?>
                        <td class="text-center"><span class="label label-warning"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php endif; ?>
                    <?php if($auths[64]) : ?>

                    <td class="text-right"><?php if( $auths[73] || $requisition->status < 3 ) : ?><a href="<?= ROOT_DIREC ?>/requisitions/edit/<?= $requisition->id ?>" style="font-size:1.3em!important;"><span class="fa fa-xl fa-pencil color-blue"></span> <?php  endif; ?></a>
                    </td>
                <?php   endif; ?>
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
