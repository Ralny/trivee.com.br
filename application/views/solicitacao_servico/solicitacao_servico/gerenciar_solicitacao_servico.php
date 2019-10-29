<?php 
//Carregando configurações de conteiner
include ('application/views/tpl/config_container.php');

// --------------------------------------------------------
// Aux para desabilidar elementos do formulario que nao podem mais ser editados
if (isset($form_editar))
{
	$disabled = 'disabled';
}
else
{
	$disabled = '';
}
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<div class="tabbable-custom tabbable-noborder">
			<ul class="nav nav-tabs">
				<li><a href="#tab_1_1" data-toggle="tab">Timeline</a></li>
				<li class="active"><a href="#tab_1_2" data-toggle="tab">Gerenciar</a></li>
				<li><a href="#tab_1_3" data-toggle="tab">Tarefas</a></li>
				<li><a href="#tab_1_4" data-toggle="tab">Anexos</a></li> 
				<li><a href="#tab_1_5" data-toggle="tab">Orcamentos</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane" id="tab_1_1">
					<?php $this->load->view('infra/infra_solicitacao_servico/timeline'); ?>	
				</div>

				<div class="tab-pane active" id="tab_1_2">
					<?php $this->load->view('infra/infra_solicitacao_servico/form_editar_solicitacao');	?>							
				</div>

				<div class="tab-pane" id="tab_1_3">
					<?php
						$this->load->view('infra/infra_solicitacao_servico/tarefas_main-list');
					?>
				</div>

				<div class="tab-pane" id="tab_1_4">
					<!-- Totais -->
					
				</div>	

				<div class="tab-pane" id="tab_1_5">
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT INNER -->



