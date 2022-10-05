<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Catégories</li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Catégories
            <?php if($auths[68]) : ?>
            <a class="btn btn-warning" style="float:right" href="<?= ROOT_DIREC ?>/categories/add">Ajouter</a>
            <?php endif; ?>
        </div>
    <div class="panel-body articles-container">
        <div class="table-responsive">
            <table class="table table-stripped datatable">
                <thead> 
                    <th>Nom</th>
                    <?php if($auths[68]) : ?>
                    <th></th>
                <?php   endif; ?>
                </thead>
            <tbody> 
            <?php foreach($categories as $category) : ?>
                <tr>
                    <td><?= $category->name ?></td>
                    <?php if($auths[68]) : ?>
                    <td class="text-right"><a href="<?= ROOT_DIREC ?>/categories/edit/<?= $category->id ?>" style="font-size:1.3em!important;"><span class="fa fa-xl fa-pencil color-blue"></span></a>
                    </td>
                <?php endif; ?>
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