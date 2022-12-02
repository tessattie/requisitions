<?php
$years = array("2022" => "2022", 
    "2023" => "2023", 
    "2024" => '2024', 
    '2025' => '2025');
$months = array("01" => "JAN", 
    "02" => "FEV", 
    "03" => "MAR", 
    "04" => 'AVR', 
    "05" => "MAI", 
    "06" => "JUI", 
    "07" => "JUIL", 
    "08" => 'AOU', 
    "09" => "SEPT", 
    "10" => "OCT", 
    "11" => "NOV", 
    "12" => 'DEC');
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active"><?= __("Budgets") ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            <?= __("Rapport des Budgets") ?>
        </div>
    <div class="panel-body articles-container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable">
                <thead> 
                    <tr>
                        <th colspan="2"></th>
                        <th class="text-center"><?= __("Budgets") ?></th>
                        <th class="text-center"><?= __("Décaissements") ?></th>
                    </tr>
                    <tr>
                        <th><?= __("Département") ?></th>
                        <th class="text-center"><?= __("Période") ?></th>
                        <th class="text-center"><?= __("HTG") ?></th>
                        <th class="text-center"><?= __("HTG") ?></th>
                    </tr>
                    
                </thead>
            <tbody> 
            <?php $budjet_htg = 0; $budjet_usd = 0; $total_htg = 0; $total_usd = 0; foreach($budjets as $budjet) : ?>
                <tr style="cursor:pointer" data-target="#categories_<?= $budjet->id ?>" data-toggle="modal"> 
                    <td><?= $budjet->department->name ?></td>
                    <td class="text-center"><?= $budjet->month."/".$budjet->year ?></td>
                    <td class="text-center"><?= number_format($budjet->htg_amount, 2, ".", ",") ?></td>
                    <td class="text-center"><?= number_format($budjet->total_htg, 2, ".", ",") ?></td>
                </tr>

                <?php 
                    $budjet_htg = $budjet_htg + $budjet->htg_amount; 
                    $total_htg = $total_htg + $budjet->total_htg; 
                ?>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th class="text-center"><?= number_format($budjet_htg, 2, ".", ",") ?></th>
                    <th class="text-center"><?= number_format($total_htg, 2, ".", ",") ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
            <!--End .article-->
        </div>
        
    </div>
</div><!--End .articles-->


<?php 
echo '<script> var ROOT_DIREC = "'.ROOT_DIREC.'";</script>'
?>

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


<?php foreach($budjets as $budjet) : ?>
    <div class="modal fade" id="categories_<?= $budjet->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><?= __("Répartition décaissements par Catégorie") ?> : <?= $budjet->department->name ?> - <?= $budjet->month."/".$budjet->year ?>
            
        </h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover datatable">
                    <thead> 
                        <tr>
                            <th><?= __("Catégorie") ?></th>
                            <th class="text-center"><?= __("HTG") ?></th>
                        </tr>
                        
                    </thead>
                <tbody> 
                <?php foreach($budjet->categories as $key => $data) : ?>
                    <tr> 
                        <td><?= $data['name'] ?></td>
                        <td class="text-center"><?= number_format($data['total_htg'], 2, ".", ",") ?></td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" style="float: right;
    padding: 5px;
    background: orange;
    color: white;" data-dismiss="modal"><?= __("Fermer") ?></button>

    
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>