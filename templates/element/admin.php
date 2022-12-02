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

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#" style="color:white"><span style="color:white"><?= 'Loto Lakay S.A.' ?></span></a>
                
                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown" style="float:right"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <span class="fa fa-user" style="font-size: 28px;margin-top: -5px;margin-left: 1px;"></span>
                    </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="<?= ROOT_DIREC ?>/users/view"><span class="fa fa-user">&nbsp;</span> <?= __('Profil') ?></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= ROOT_DIREC ?>/users/logout"><span class="fa fa-power-off">&nbsp;</span> <?= __('Déconnexion') ?> </a>
                            </li>
                        </ul>
                    </li>
                       
                    <li class="dropdown" style="float:right;margin-right:-5px"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <span class="fa fa-filter" style="font-size: 28px;margin-top: -5px;margin-left: 1px;"></span>
                    </a>
                    
                        <ul class="dropdown-menu dropdown-messages">
                             <?= $this->Form->create(null, array("url" => "/app/update_session_variables")) ?>
                            <li style="padding-right:10px;padding-left:10px;padding-top:10px"><strong><?= __("Filtrer par Période") ?></strong></li>
                            <li class="divider"></li>
                            <li style="padding-right:10px;padding-left:10px">
                                <?= $this->Form->control('periode_month', array('class' => 'form-control', 'options' => $months, "label" => false, 'style' => "", 'empty' => "-- Mois --", "value" => $periode_month)); ?>
                            </li>
                            <li class="divider"></li>
                            <li style="padding-right:10px;padding-left:10px">
                                <?= $this->Form->control('periode_year', array('class' => 'form-control', 'options' => $years, "label" => false,'style' => "", 'empty' => "-- Année --", 'value' => $periode_year)); ?>
                            </li>
                            <li class="divider"></li>
                            <li style="padding-right:10px;padding-left:10px">
                                <button class="btn btn-success" style="padding: 9px 12px!important;"><span class="glyphicon glyphicon-ok" ></span></button>
                            </li>
                            <?= $this->Form->end() ?>
                        </ul>
                    </li>
                    <?php  if($auths[76]) : ?>
                    <li class="dropdown" style="float:right;margin-right:-5px"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <span class="fa fa-dollar" style="font-size: 28px;margin-top: -5px;margin-left: 1px;"></span>
                    </a>
                    
                        <ul class="dropdown-menu dropdown-messages">
                            <li style="padding-right:10px;padding-left:10px;padding-top:10px">
                                <?php foreach($budjet_progress as $bp) : ?>
                                    <label> <?= $bp->name ?></label> <small style="color:#30a5ff;font-weight:bold;float:right"><?= $bp->percent_htg ?>%</small><br>
                                    <div class="progress">
                                      <div class="progress-bar" style="width: <?= $bp->percent_htg ?>%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <?php endforeach; ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                </ul>
   
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar" style="text-align:center">
            <div class="profile-usertitle" style="margin:auto;width:100%">
                <div class="profile-usertitle-name text-center" style="margin-top:12px;margin-bottom:10px"><?= $user_connected['name'] ?></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>

        <ul class="nav menu" style="margin-top:0px">
            <?php  if($auths[66]) : ?>
                <li class="<?= ($this->request->getParam('controller') == 'Requisitions' && ($this->request->getParam('action') == 'dashboard')) ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/requisitions/dashboard"><em class="fa fa-dashboard">&nbsp;</em><?= __('Dashboard') ?> </a></li>
            <?php endif; ?>

            <?php  if($auths[63] || $auths[64] || $auths[65] || $auths[69] || $auths[70] || $auths[72] || $auths[73]) : ?>
                <li class="<?= ($this->request->getParam('controller') == 'Requisitions'&& ($this->request->getParam('action') != 'dashboard')) ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/requisitions"><em class="fa fa-file">&nbsp;</em> <?= __('Réquisitions') ?></a></li>
            <?php endif; ?>

            <?php  if($auths[67] || $auths[68]) : ?>
            <li class="<?= ($this->request->getParam('controller') == 'Categories') ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/categories"><em class="fa fa-bars">&nbsp;</em> <?= __('Catégories') ?></a></li>
            <?php endif; ?>

            <?php  if($auths[74] || $auths[75]) : ?>
            <li class="<?= ($this->request->getParam('controller') == 'Departments') ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/departments"><em class="fa fa-list">&nbsp;</em><?= __('Départements') ?> </a></li>
            <?php endif; ?>

            <?php if($auths[76]) : ?>
            <li class="parent <?= ($this->request->getParam('controller') == 'Budjets' ) ? 'active' : '' ?>"><a data-toggle="collapse" href="#sub-item-2222">
                <em class="fa fa-dollar">&nbsp;</em><?= __('Budgets') ?>  <span data-toggle="collapse" href="#sub-item-2222" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2222">

                        <li class="<?= ($this->request->getParam('controller') == 'Budjets' && $this->request->getParam('action') == 'index') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/budjets">
                            <span class="fa fa-arrow-right">&nbsp;</span><?= __('Edition') ?> 
                        </a></li>
                        <li class="<?= ($this->request->getParam('controller') == 'Budjets' && $this->request->getParam('action') == 'report') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/budjets/report">
                            <span class="fa fa-arrow-right">&nbsp;</span><?= __('Rapport') ?> 
                        </a></li>

                </ul>
            </li>
        <?php   endif; ?>

            <?php if($auths[71]) : ?>
            <li class="parent <?= ($this->request->getParam('controller') == 'Riders' ||$this->request->getParam('controller') == 'Authorizations' || $this->request->getParam('controller') == 'Users' || $this->request->getParam('controller') == 'Roles' || $this->request->getParam('controller') == 'Cards') ? 'active' : '' ?>"><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-gear">&nbsp;</em><?= __('Paramètres') ?>  <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2">

                        <li class="<?= ($this->request->getParam('controller') == 'Users' && $this->request->getParam('action') == 'index') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/users">
                            <span class="fa fa-arrow-right">&nbsp;</span><?= __('Utilisateurs') ?> 
                        </a></li>
                        <li class="<?= ($this->request->getParam('controller') == 'Authorizations') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/authorizations">
                            <span class="fa fa-arrow-right">&nbsp;</span><?= __('Autorisations') ?> 
                        </a></li>

                        <li class="<?= ($this->request->getParam('controller') == 'Roles') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/roles">
                            <span class="fa fa-arrow-right">&nbsp;</span><?= __('Rôles') ?> 
                        </a></li>

                </ul>
            </li>
        <?php   endif; ?>
            <li><a  href="<?= ROOT_DIREC ?>/users/logout" style="color:red"><em class="fa fa-power-off">&nbsp;</em> <?= __('Déconnexion') ?></a></li>
        </ul>

    </div><!--/.sidebar-->

<script type="text/javascript">
    $(document).ready(function(){
        $("li.parent").click(function(){
            var children = $(this).find(".children");
            if(children.hasClass("collapse")){
                children.removeClass("collapse");
            }else{
                children.addClass("collapse");
            }
        })


    })
</script>





<style type="text/css">
    @media only screen and (max-width: 600px) {
      .panel-heading{
        font-weight: bold;
        font-size: 18px;
      }

      .table-responsive{
        border-color: white;
      }

      .panel-heading{
        font-size:15px;
      }

      .btn{
        height: auto!important;
      }
    }
</style>