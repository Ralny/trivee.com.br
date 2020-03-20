<?php 
//So ira exibir se estiver em modo de edição
if (isset($form_editar)){  ?>

<ul class="list-inline">
	<li>Criação:</li>
	<li><i class="fa fa-calendar"></i> <?= data_hora($show->dth_criacao) ?></li>
	
	<li><i class="fa fa-user"></i><?= $usuario_criacao ?></li>
</ul>
<ul class="list-inline">
	<li>Alteração:</li>
	<li><i class="fa fa-calendar"></i> <?= data_hora($show->dth_atualizacao) ?></li>
	
	<li><i class="fa fa-user"></i> <?= $usuario_atualizacao ?></li>
</ul>

<?php } ?>
