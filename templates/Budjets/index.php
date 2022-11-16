<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */

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
        <li class="active">Budjets</li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Budjets
        </div>
    <div class="panel-body articles-container">
        <div class="table-responsive">
            <table class="table table-stripped datatable">
                <thead> 
                    <th>Département</th>
                    <th class="text-center">Période</th>
                    <th class="text-right">HTG</th>
                </thead>
            <tbody> 
            <?php foreach($budjets as $budjet) : ?>
                <tr>
                    <td><?= $budjet->department->name ?></td>
                    <td class="text-center"><?= $budjet->month."/".$budjet->year ?></td>
                    <td class="text-right"><input type="hidden" class="budjet_id" value="<?= $budjet->id ?>"><input type="text" class="htg_amount" value = '<?= $budjet->htg_amount ?>' style="width:100px;text-align:center"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
            <!--End .article-->
        </div>
        
    </div>
</div><!--End .articles-->


<?php 
echo '<script> var ROOT_DIREC = "'.ROOT_DIREC.'";</script>'
?>

<script type="text/javascript">$(document).ready( function () {
    $('.datatable').DataTable({

    } );

    $(".htg_amount").change(function(){
        var htg_amount = $(this).val();
        var budjet_id = $(this).parent().find(".budjet_id").val();

        var token =  $('input[name="_csrfToken"]').val();
        $.ajax({
            url : ROOT_DIREC+'/budjets/update',
            type : 'POST',
            data : {htg_amount : htg_amount, budjet_id: budjet_id},
            headers : {
                'X-CSRF-Token': token 
            },
            dataType : 'json',
            success : function(data, statut){
                console.log(data)
            },
            error : function(resultat, statut, erreur){
                console.log(erreur)
            }, 
            complete : function(resultat, statut){
                console.log(resultat)
            }
        });
    })
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