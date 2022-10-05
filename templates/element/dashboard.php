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


                    <li style="float:right"><a href="<?= ROOT_DIREC ?>/requisitions" style="padding:5px;background:#f2f2f2;border:none;margin-top:17px;border-radius:3px;color:black">Retour</a></li>

                </ul>
   
            </div>
        </div><!-- /.container-fluid -->
    </nav>

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