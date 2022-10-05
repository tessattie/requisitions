<div class="row" style="margin-bottom:15px;margin-left:0px;margin-right:0px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/requisitions/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Dashboard</li>
    </ol>
</div>
<div class="container-fluid">

<!-- End of masthead -->


<!-- End of board info bar -->

<!-- Lists container -->
<section class="lists-container">

	<?php foreach($requisition_status as $key => $status) : ?>
			<div class="list">

		<h3 class="list-title" style="padding:0px 1rem;margin-top:10px"><?= $status ?></h3>

		<ul class="list-items">
			<?php foreach($requisitions as $requisition) : ?>
				<?php if($requisition->status == $key) : ?>
					<li data-toggle="modal" data-target="#open_<?= $requisition->id ?>"><strong><?= $requisition->requisition_number ?></strong> - <?= $requisition->title ?></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>


	</div>
			
		<?php endforeach; ?>


</section>
<!-- End of lists container -->
	<div class="row">
		
	</div>
	
</div>


<?php foreach($requisitions as $requisition) : ?>
	<div class="modal fade" id="open_<?= $requisition->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<?= $this->Form->create(null, array("url" => '/requisitions/update', 'type' => 'file')) ?>
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><?= $requisition->title ?>
        	
        </h3>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-9">
      			<table class="table table-striped">
                <tr>
                    <th><?= __('#') ?></th>
                    <td class="text-right"><?= h($requisition->requisition_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Catégorie') ?></th>
                    <td class="text-right"><?= $requisition->category->name ?></td>
                </tr>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td class="text-right"><?= h($requisition->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td class="text-right"><?= h($requisition->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td class="text-right"><?= h($requisition->location) ?></td>
                </tr>
                <tr>
                    <th><?= __('Demandé Par') ?></th>
                    <td class="text-right"><?= h($requisition->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Demandé') ?></th>
                    <td class="text-right"><?= $requisition->amount_requested === null ? '' : number_format($requisition->amount_requested, 2, ".", ",") ." ". $rates[$requisition->rate] ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Autorisé') ?></th>
                    <td class="text-right"><?= $requisition->amount_authorized === null ? '' : number_format($requisition->amount_requested, 2, ".", ",") ." ". $rates[$requisition->rate]  ?></td>
                </tr>
                <tr>
                    <th><?= __('Statut') ?></th>
                    <?php if($requisition->status == 1) : ?>
                        <td class="text-right"><span class="label label-info"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 2) : ?>
                        <td class="text-right"><span class="label label-danger"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 3) : ?>
                        <td class="text-right"><span class="label label-primary"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php elseif($requisition->status == 4) : ?>
                        <td class="text-right"><span class="label label-success"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php else : ?>
                        <td class="text-right"><span class="label label-warning"> <?= $requisition_status[$requisition->status] ?></span></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <th><?= __('Créé le') ?></th>
                    <td class="text-right"><?= h($requisition->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Cible de Décaissement') ?></th>
                    <td class="text-right"><?= h($requisition->due_date) ?></td>
                </tr>
            </table>
            <hr>
                    <div class="row">
                        
                            <?php foreach($requisition->documents as $document) : ?>
                                <?php 

                                $extension = explode(".", $document->location)[1]; 

                                ?>
                                <div class="col-md-3" style="margin-top:15px">
                                <?php if($extension != 'jpg' && $extension != 'jpeg' && $extension != "png") : ?>
                                    <a class="btn btn-default" href="<?= ROOT_DIREC ?>/img/documents/<?= $document->location ?>" download><?= $document->location ?></a>
                                <?php else : ?>
                                	<a href="<?= ROOT_DIREC ?>/img/documents/<?= $document->location ?>" download>
                                <?= 
                                $this->Html->image('documents/'.$document->location, array('height' => 'auto', 'width' => '100%', "style"=>"margin-right:10px")); ?>
                                </a>
                            <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        
                    </div>
      		</div>
      		<div class="col-md-3">
      			<?php if($auths[72]) : ?> 
      			<div class="row">
      				<div class="col-md-12">
      					<?= $this->Form->control('status', array('class' => 'form-control', "empty" => "-- Statut --",  "label" => 'Statut', 'options' => $requisition_status, 'value' => $requisition->status)); ?>
      				</div>
      			</div>
      			<hr>
      		<?php 	endif; ?>
      		<?php if($auths[64]) : ?> 
      			<div class="row">
      				<div class="col-md-12">
      					<?= $this->Form->control('amount_authorized', array('class' => 'form-control', "label" => "Montant Autorisé", "placeholder" => "Montant Autorisé", 'value' => $requisition->amount_authorized)); ?>
      				</div>
      			</div>
      		
      			<hr>
				<?php 	endif; ?>
      			<?php if($auths[70]) : ?> 
      			<div class="row">
      				<div class="col-md-12">
      					 <?= $this->Form->control('requisition_id', array('type' => 'hidden', "value" => $requisition->id)); ?>
                          <div class="form-group">
                            <label for="exampleInputFile">Pièce Jointe</label>
                            <input type="file" id="requisition_document" name="attachment">
                            <p class="help-block">Ajoutez une pièce jointe ici</p>
                          </div>
      				</div>
      			</div>
      			<hr>
      		<?php endif; ?>
      			<h4>Notes</h4>
				<?php if($auths[69]) : ?> 
      			<div class="row">
      				<div class="col-md-12">
      					<input type="text" name="comment" placeholder="Ajouter une note..." class="form-control" style="margin-bottom:10px">
      				</div>
      			</div>
      			<?php 	endif; ?>
      			<div class="row">
      					<div class="col-md-12" style="max-height:400px;overflow-y:auto">
      			<?php foreach($requisition->notes as $n) : ?>
      				
      						<p class="bg-info" style="padding:10px">
                            <label>Créé Par :</label> <?= $n->user->name ?><br>
                            <label >Date :</label> <?= date("M d Y H:i", strtotime($n->created)) ?><br>
                            <?= $n->description ?>
                        </p>
      					
      			<?php endforeach; ?>
      			</div>
      				</div>

      		</div>
      	</div>
      	
      </div>
      <div class="modal-footer">
      	<?php if($auths[64] || $auths[70] || $auths[72] || $auths[69]) : ?> 
      	<button type="submit" class="btn btn-secondary" style="float: right;
    padding: 5px;
    background: green;
    color: white;margin-left:5px">Valider</button>
<?php 	endif; ?>
        <button type="button" class="btn btn-secondary" style="float: right;
    padding: 5px;
    background: orange;
    color: white;" data-dismiss="modal">Fermer</button>

    
      </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>
<?php endforeach; ?>


<style type="text/css">
	/*

All grid code is placed in a 'supports' rule (feature query) at the bottom of the CSS (Line 320). 
            
The 'supports' rule will only run if your browser supports CSS grid.

Flexbox is used as a fallback so that browsers which don't support grid will still recieve an identical layout.

*/

/* Base styles */

:root {
    font-size: 10px;
}

*,
*::before,
*::after {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
}

.btn {
    display: flex;
    justify-content: center;
    align-items: center;
    font: inherit;
    background: none;
    border: none;
    color: inherit;
    padding: 0;
    cursor: pointer;
}

:focus {
    outline-color: #fa0;
}

/* Masthead */

.masthead {
    flex-basis: 4rem;
    display: flex;
    align-items: center;
    padding: 0 0.8rem;
    background-color: #0067a3;
    box-shadow: 0 0.1rem 0.1rem rgba(0, 0, 0, 0.1);
}

.masthead .btn {
    background-color: #4c94be;
    border-radius: 0.3rem;
    transition: background-color 150ms;
}

.masthead .btn:hover {
    background-color: #3385b5;
}

.boards-menu {
    display: flex;
    flex-shrink: 0;
}

.boards-btn {
    flex-basis: 9rem;
    font-size: 1.4rem;
    font-weight: 700;
    color: #fff;
    margin-right: 0.8rem;
    padding: 0.6rem 0.8rem;
}

.boards-btn-icon {
    font-size: 1.7rem;
    padding-right: 1.2rem;
}

.board-search {
    flex-basis: 18rem;
    position: relative;
}

.board-search-input {
    height: 3rem;
    border: none;
    border-radius: 0.3rem;
    background-color: #4c94be;
    width: 100%;
    padding: 0 3rem 0 1rem;
    color: #fff;
}

.board-search-input:hover {
    background-color: #66a4c8;
}

.search-icon {
    font-size: 1.5rem;
    position: absolute;
    top: 50%;
    right: 0.8rem;
    transform: translateY(-50%) rotate(90deg);
    color: #fff;
}

.logo {
    flex: 1;
    font-family: "Courgette", cursive;
    font-size: 2.2rem;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.5);
    margin: 0 2rem;
    transition: color 150ms;
    text-align: center;
    white-space: nowrap;
    cursor: pointer;
}

.logo:hover {
    color: rgba(255, 255, 255, 0.8);
}

.logo-icon {
    padding-right: 0.4rem;
}

.user-settings {
    display: flex;
    height: 3rem;
    color: #fff;
}

.user-settings-btn {
    font-size: 1.5rem;
    width: 3rem;
    margin-right: 0.8rem;
}

.user-settings-btn:last-of-type {
    margin-right: 0;
}

/* Board info bar */

.board-info-bar {
    flex-basis: 3rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 0.8rem 0;
    padding: 0 1rem;
    color: #f6f6f6;
}

.board-controls {
    display: flex;
}

.board-controls .btn {
    margin-right: 1rem;
}

.board-controls .btn:last-of-type {
    margin-right: 0;
}

.board-info-bar .btn {
    font-size: 1.4rem;
    font-weight: 400;
    transition: background-color 150ms;
    padding: 0 0.6rem;
    border-radius: 0.3rem;
    height: 3rem;
}

.board-info-bar .btn:hover {
    background-color: #006aa8;
}

.private-btn-icon,
.menu-btn-icon {
    padding-right: 0.6rem;
    white-space: nowrap;
}

.board-title h2 {
    font-size: 1.8rem;
    font-weight: 700;
    white-space: nowrap;
}

/* Lists */

.lists-container::-webkit-scrollbar {
    height: 2.4rem;
}

.lists-container::-webkit-scrollbar-thumb {
    background-color: #66a3c7;
    border: 0.8rem solid #0079bf;
    border-top-width: 0;
}

.lists-container {
    display: flex;
    align-items: start;
    padding: 0 0.8rem 0.8rem;
    overflow-x: auto;
    height: calc(100vh - 8.6rem);
}

.list {
    flex: 0 0 27rem;
    display: flex;
    flex-direction: column;
    background-color: #e2e4e6;
    max-height: calc(100vh - 11.8rem);
    border-radius: 0.3rem;
    margin-right: 1rem;
}

.list:last-of-type {
    margin-right: 0;
}

.list-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #333;
    padding: 1rem;
}

.list-items {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-content: start;
    padding: 0 0.6rem 0.5rem;
    overflow-y: auto;
}

.list-items::-webkit-scrollbar {
    width: 1.6rem;
}

.list-items::-webkit-scrollbar-thumb {
    background-color: #c4c9cc;
    border-right: 0.6rem solid #e2e4e6;
}

.list-items li {
    font-size: 1.4rem;
    font-weight: 400;
    line-height: 1.3;
    background-color: #fff;
    padding: 0.65rem 0.6rem;
    color: #4d4d4d;
    border-bottom: 0.1rem solid #ccc;
    border-radius: 0.3rem;
    margin-bottom: 0.6rem;
    word-wrap: break-word;
    cursor: pointer;
}

.list-items li:last-of-type {
    margin-bottom: 0;
}

.list-items li:hover {
    background-color: #eee;
}

.add-card-btn {
    display: block;
    font-size: 1.4rem;
    font-weight: 400;
    color: #838c91;
    padding: 1rem;
    text-align: left;
    cursor: pointer;
}

.add-card-btn:hover {
    background-color: #cdd2d4;
    color: #4d4d4d;
    text-decoration: underline;
}

.add-list-btn {
    flex: 0 0 27rem;
    display: block;
    font-size: 1.4rem;
    font-weight: 400;
    background-color: #006aa7;
    color: #a5cae0;
    padding: 1rem;
    border-radius: 0.3rem;
    cursor: pointer;
    transition: background-color 150ms;
    text-align: left;
}

.add-list-btn:hover {
    background-color: #005485;
}

.add-card-btn::after,
.add-list-btn::after {
    content: '...';
}

/*

The following rule will only run if your browser supports CSS grid.

Remove or comment-out the code block below to see how the browser will fall-back to flexbox styling. 

*/

@supports (display: grid) {
    body {
        display: grid;
        grid-template-rows: 4rem 3rem auto;
        grid-row-gap: 0.8rem;
    }

    .masthead {
        display: grid;
        grid-template-columns: auto 1fr auto;
        grid-column-gap: 2rem;
    }

    .boards-menu {
        display: grid;
        grid-template-columns: 9rem 18rem;
        grid-column-gap: 0.8rem;
    }

    .user-settings {
        display: grid;
        grid-template-columns: repeat(4, auto);
        grid-column-gap: 0.8rem;
    }

    .board-controls {
        display: grid;
        grid-auto-flow: column;
        grid-column-gap: 1rem;
    }

    .lists-container {
        display: grid;
        grid-auto-columns: 27rem;
        grid-auto-flow: column;
        grid-column-gap: 1rem;
    }

    .list {
        display: grid;
        grid-template-rows: auto minmax(auto, 1fr) auto;
    }

    .list-items {
        display: grid;
        grid-row-gap: 0.6rem;
    }

    .logo,
    .list,
    .list-items li,
    .boards-btn,
    .board-info-bar,
    .board-controls .btn,
    .user-settings-btn {
        margin: 0;
    }
}

</style>