<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$types = array(1 => "Dashboard", 2 => "Réquisitions", 3 => "Catégories", 4 => "Utilisateurs");
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/policies/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Authorizations</li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="row">
        <div class="col-md-3">
            <table class="table table-bordered">
            <tbody> 
            <?php foreach($roles as $role) : ?>
                    <?php if($role_id == $role->id) : ?>
                        <tr style="background:#f2f2f2">
                        <?php else : ?>
                            <tr>
                        <?php endif; ?>
                    <td><a style="color:black" href="<?= ROOT_DIREC ?>/authorizations/index/<?= $role->id ?>"><?= $role->name ?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default articles">
        <div class="panel-heading">
            Authorizations
        </div>
    <div class="panel-body articles-container"  style="height:450px;overflow-y:scroll">
        <?php if(!empty($role_id)) : ?>
        <?= $this->Form->create() ?>
        <?= $this->Form->control('role_id', array('type' => 'hidden', 'value' => $role_id, "id" => "role_id")); ?> 
        
            <table class="table table-bordered">
            <tbody> 
            <?php $type =0; foreach($authorizations as $authorization) : ?>
                <?php if($type != $authorization->type) : ?>
                    <tr style="background:#f2f2f2"><td colspan="2"><?= $types[$authorization->type] ?></td></tr>
                    <?php $type = $authorization->type; ?>
                <?php endif; ?>
                <tr>
                    <td><?= $authorization->name ?> - <?= $authorization->id ?></td>
                    <td class="text-center">
                        <?php $condition = false; if(!empty($roles_authorizations)) : ?>
                            <?php  
                                foreach($roles_authorizations as $ua){
                                    if($ua->authorization_id == $authorization->id){
                                        $condition = true;
                                    }
                                }
                            ?>
                        <?php endif; ?>
                        <?php if($condition) : ?>
                            <input type="checkbox" name="authorization_id" class="edit_auth" checked value="<?= $authorization->id ?>">
                        <?php else : ?>
                            <input type="checkbox" name="authorization_id" class="edit_auth" value="<?= $authorization->id ?>">
                        <?php endif; ?>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this->Form->end() ?>
        <?php else: ?>
            <p class="bg-info" style="padding:10px;text-align:center">Choisissez un rôle pour voir les autorisations</p>
        <?php endif; ?>
            <!--End .article-->
        </div>
        
    </div>
        </div>
    </div>
    
</div><!--End .articles-->

<?php 
echo '<script> var ROOT_DIREC = "'.ROOT_DIREC.'";</script>'
?>

<script type="text/javascript">$(document).ready( function () {
    $('.datatable').DataTable({
        "ordering":false
    } );

    $(".edit_auth").change(function(){
        var authorization_id = $(this).val()
        var checked = $(this).is(":checked")
        var role_id = $("#role_id").val();
        var token =  $('input[name="_csrfToken"]').val();
        $.ajax({
             url : ROOT_DIREC+'/authorizations/update',
             type : 'POST',
             data : {authorization_id : authorization_id, checked: checked, role_id: role_id},
             headers : {
                'X-CSRF-Token': token 
             },
             dataType : 'json',
             success : function(data, statut){
                  console.log('updated');
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