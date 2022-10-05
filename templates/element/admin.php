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
                                <a href="<?= ROOT_DIREC ?>/users/view"><span class="fa fa-user">&nbsp;</span> Profil</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= ROOT_DIREC ?>/users/logout"><span class="fa fa-power-off">&nbsp;</span> Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                       
                    <li class="dropdown" style="float:right;margin-right:-5px"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <span class="fa fa-filter" style="font-size: 28px;margin-top: -5px;margin-left: 1px;"></span>
                    </a>
                    
                        <ul class="dropdown-menu dropdown-messages">
                             <?= $this->Form->create(null, array("url" => "/app/update_session_variables")) ?>
                            <li style="padding-right:10px;padding-left:10px;padding-top:10px"><strong>Filtrer par Date</strong></li>
                            <li class="divider"></li>
                            <li style="padding-right:10px;padding-left:10px">
                                <input value="<?= $filterfrom  ?>" type="date" name="from" style="border: 1px solid #ddd;height: 39px;width: 100%;background: #f2f2f2;color: black;border-radius: 3px;margin-right: 5px;">
                            </li>
                            <li class="divider"></li>
                            <li style="padding-right:10px;padding-left:10px">
                                <input value="<?= $filterto  ?>" type="date" name="to" style="border: 1px solid #ddd;height: 39px;width: 100%;background: #f2f2f2;color: black;border-radius: 3px;margin-right: 5px;">
                            </li>
                            <li class="divider"></li>
                            <li style="padding-right:10px;padding-left:10px">
                                <button class="btn btn-success" style="padding: 9px 12px!important;"><span class="glyphicon glyphicon-ok" ></span></button>
                            </li>
                            <?= $this->Form->end() ?>
                        </ul>
                    </li>

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
                <li class="<?= ($this->request->getParam('controller') == 'Requisitions' && ($this->request->getParam('action') == 'dashboard')) ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/requisitions/dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <?php endif; ?>

            <?php  if($auths[63] || $auths[64] || $auths[65] || $auths[69] || $auths[70] || $auths[72] || $auths[73]) : ?>
                <li class="<?= ($this->request->getParam('controller') == 'Requisitions'&& ($this->request->getParam('action') != 'dashboard')) ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/requisitions"><em class="fa fa-file">&nbsp;</em> Réquisitions</a></li>
            <?php endif; ?>

            <?php  if($auths[67] || $auths[68]) : ?>
            <li class="<?= ($this->request->getParam('controller') == 'Categories') ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/categories"><em class="fa fa-bars">&nbsp;</em> Catégories</a></li>
            <?php endif; ?>
            <?php if($auths[71]) : ?>
            <li class="parent <?= ($this->request->getParam('controller') == 'Riders' ||$this->request->getParam('controller') == 'Authorizations' || $this->request->getParam('controller') == 'Users' || $this->request->getParam('controller') == 'Roles' || $this->request->getParam('controller') == 'Cards') ? 'active' : '' ?>"><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-gear">&nbsp;</em> Paramètres <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2">

                        <li class="<?= ($this->request->getParam('controller') == 'Users' && $this->request->getParam('action') == 'index') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/users">
                            <span class="fa fa-arrow-right">&nbsp;</span> Utilisateurs
                        </a></li>
                        <li class="<?= ($this->request->getParam('controller') == 'Authorizations') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/authorizations">
                            <span class="fa fa-arrow-right">&nbsp;</span> Autorisations
                        </a></li>

                        <li class="<?= ($this->request->getParam('controller') == 'Roles') ? 'active' : '' ?>"><a class=""  href="<?= ROOT_DIREC ?>/roles">
                            <span class="fa fa-arrow-right">&nbsp;</span> Rôles
                        </a></li>

                </ul>
            </li>
        <?php   endif; ?>
            <li><a  href="<?= ROOT_DIREC ?>/users/logout" style="color:red"><em class="fa fa-power-off">&nbsp;</em> Log Out</a></li>
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