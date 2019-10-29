<?php 

if ($this->uri->segment(3) == 'eu-recebi')
{
	$recebi_aba_ativa = 'class="active"';
}
else
{
	$recebi_aba_ativa = '';
}



if ($this->uri->segment(3) == 'eu-solicitei')
{
	$solicitei_aba_ativa = 'class="active"';
}
else
{
	$solicitei_aba_ativa = '';
}	


/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<!-- BEGIN TODO SIDEBAR -->
	<div class="todo-sidebar">
		<div class="portlet light">
			<div class="portlet-title">
				<!--
				<div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
					<span class="caption-subject font-green-sharp bold">Minhas solicitações </span>								
				</div>
				-->
				<div class="actions btn-set">
					<div class="form-actions top">
						<a class="btn btn-success" style="width: 190px;" href="<?= base_url() . $url ?>/cadastrar "><i class="fa fa-plus"></i> Nova Solicitação</a>
					</div>
				</div>			
			</div>
			<div class="portlet-body todo-project-list-content">
				<div class="todo-project-list">
					<ul class="nav nav-pills nav-stacked">
						<li <?= $recebi_aba_ativa ?>>
							<a href="<?= base_url() ?>solicitacao-servico/minhas-solicitacoes/eu-recebi">
								<?php

									if ($count_recebidas >= 1){
										echo '<span class="badge badge-success"> '.$count_recebidas.' </span>';
									}

								?>
							 Eu Recebi</a>
						</li>
						<li <?= $solicitei_aba_ativa ?>>
							<a href="<?= base_url() ?>solicitacao-servico/minhas-solicitacoes/eu-solicitei">
								<?php

									if ($count_solicitadas >= 1){
										echo '<span class="badge badge-success"> '.$count_solicitadas.' </span>';
									}

								?>
							Eu Solicitei</a>
						</li>
						<!--
						<li class="active">
							<a href="<?= base_url() . $url ?>/solicitacao-servico/minhas-solicitacoes/concluidas">
							<span class="badge badge-success badge-active"> 3 </span> Concluidas</a>
						</li>
						<li>
							<a href="<?= base_url() . $url ?>/solicitacao-servico/minhas-solicitacoes/canceladas">
							<span class="badge badge-default"> 14 </span> Canceladas </a>
						</li>
					-->
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- END TODO SIDEBAR -->

	<div class="col-md-4">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Não Analizada
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
					<div class="scroller" style="max-height: 800px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7">
						<div class="todo-tasklist">
							<?php
								/**
								 * Listando registros da tabela
								 * Listing table records
								 */
								if (empty($lista_recebidas_nao_analizadas))
								{
									echo '
											<blockquote>
												<p>
													 Não existem solicitações de serviço!
												</p>
											</blockquote>
											';
								}

								foreach ($lista_recebidas_nao_analizadas as $linha):
									//Critico
									if ($linha->prioridade == '1'){
										$status 	  = 'style="border-left:#F3565D 2px solid;"';
										$prioridade   = 'Critico';
									}
									//Alta
									if ($linha->prioridade == '2'){
										$status 	= 'style="border-left:#dfba49 2px solid;"';
										$prioridade = 'Alta';
									}
									//Media
									if ($linha->prioridade == '3'){
										$status 	= 'style="border-left:#89C4F4 2px solid;"';
										$prioridade = 'Media';
									}
									//Baixo
									if ($linha->prioridade == '4'){
										$status 	= 'style="border-left:#c6c6c6 2px solid;"';
										$prioridade = 'Baixa';
									}	
							?>
								<div class="todo-tasklist-item todo-tasklist-item-border-green" <?= $status ?>>
									<img class="todo-userpic pull-left" src="../../assets/admin/layout/img/avatar4.jpg" width="27px" height="27px">
									<div class="todo-tasklist-item-title">
										<?= $linha->nome.' '.$linha->sobrenome; ?>
										<span class="pull-right">

											<a class="btn btn-default popovers" href="<?= base_url() ?>infra/infra_solicitacao_servico/gerenciar_solicitacao_servico/<?= $linha->token_id ?>" data-container="body" data-trigger="hover" data-placement="top" data-content="Gerenciar Solicitação" data-original-title="" title=""><i class="fa fa-file-text-o"></i></a>

											<a class="btn btn-default popovers" href="<?= base_url() ?>infra/infra_solicitacao_servico/cancelar_solicitacao/<?= $linha->token_id ?>" data-container="body" data-trigger="hover" data-placement="top" data-content="Cancelar Solicitação" data-original-title="" title=""><i class="fa fa-ban"></i></a>

											<a class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Imprimir" data-original-title="" title=""><i class="fa fa-print"></i></a>

										</span>

									</div>
									<div class="todo-tasklist-item-title">
										 <?= strtoupper($linha->categoria) ?> | <?= strtoupper($linha->subcategoria) ?> <BR/>
										 <?= $linha->problema ?>
									</div>
									<div class="todo-tasklist-item-text">
										 Prioridade: <?= $prioridade ?> <br/>
										 Local: <?= $linha->area ?> <br/>
									</div>
									<div class="todo-tasklist-controls pull-left">
										<span class="todo-tasklist-date">
											<i class="fa fa-calendar"></i> Abertura: <?= data_extenso_abreviado($linha->dth_abertura_solicitacao) ?>
											<i class="fa fa-clock-o"></i><?= exibir_hora($linha->dth_abertura_solicitacao, $soma_hora = '') ?>
										</span>
										<br/>
										<span class="todo-tasklist-date">
											<i class="fa fa-calendar-o"></i> Previsão : <?= data_extenso_abreviado(exibir_hora($linha->dth_abertura_solicitacao, $linha->sla)) ?>
										 	<i class="fa fa-clock-o"></i><?= exibir_hora(exibir_hora($linha->dth_abertura_solicitacao, $linha->sla), $soma_hora = '') ?> 
										</span>
										<br/>	
										<?php 

										 	$atraso = dateDiff(date("Y-m-d H:i:s"), exibir_hora($linha->dth_abertura_solicitacao, $linha->sla));

										 	if ($atraso)
										 	{
										 		echo '<span class="todo-tasklist-date"><i class="fa fa-history"></i>
										Atraso: <strong>'.$atraso.' </strong></span>';	
											}

										?>
										
									</div>
									
								</div>
								
								<?php endforeach ?>	

						</div>
					</div>
				</div>			
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>	

	<div class="col-md-4">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Em Andamento
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
					<div class="scroller" style="max-height: 800px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7">
						<div class="todo-tasklist">
							<?php
								/**
								 * Listando registros da tabela
								 * Listing table records
								 */								
								if (empty($lista_recebidas_analizadas))
								{
									echo '
											<blockquote>
												<p>
													 Não existem solicitações serviço em andamento!
												</p>
											</blockquote>
											';
								}

								foreach ($lista_recebidas_analizadas as $linha):
									//Critico
									if ($linha->prioridade == '1'){
										$status 	= 'style="border-left:#F3565D 2px solid;"';
										$prioridade = 'Critico';
									}
									//Alta
									if ($linha->prioridade == '2'){
										$status 	= 'style="border-left:#dfba49 2px solid;"';
										$prioridade = 'Alta';
									}
									//Media
									if ($linha->prioridade == '3'){
										$status 	= 'style="border-left:#89C4F4 2px solid;"';
										$prioridade = 'Media';
									}
									//Baixo
									if ($linha->prioridade == '4'){
										$status 	= 'style="border-left:#c6c6c6 2px solid;"';
										$prioridade = 'Baixa';
									}	
							?>
								<div class="todo-tasklist-item todo-tasklist-item-border-green" <?= $status ?>>
									<img class="todo-userpic pull-left" src="../../assets/admin/layout/img/avatar4.jpg" width="27px" height="27px">
									<div class="todo-tasklist-item-title">
										  <?= $linha->nome.' '.$linha->sobrenome; ?>
										<span class="pull-right">

											<a class="btn btn-default popovers" href="<?= base_url() ?>infra/infra_solicitacao_servico/gerenciar_solicitacao_servico/<?= $linha->token_id ?>" data-container="body" data-trigger="hover" data-placement="top" data-content="Gerenciar Solicitação" data-original-title="" title=""><i class="fa fa-file-text-o"></i></a>

											<a class="btn btn-default popovers" href="<?= base_url() ?>infra/infra_solicitacao_servico/cancelar_solicitacao/<?= $linha->token_id ?>" data-container="body" data-trigger="hover" data-placement="top" data-content="Cancelar Solicitação" data-original-title="" title=""><i class="fa fa-ban"></i></a>

											<a class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Imprimir" data-original-title="" title=""><i class="fa fa-print"></i></a>

										</span>

									</div>
									<div class="todo-tasklist-item-title">
										 <?= strtoupper($linha->categoria) ?> | <?= strtoupper($linha->subcategoria) ?> <BR/>
										 <?= $linha->problema ?>
									</div>
									<div class="todo-tasklist-item-text">
										 Prioridade: <?= $prioridade ?> <br/>
										 Local: <?= $linha->area ?> <br/>
										 Status: <strong><?= $linha->status ?></strong>

									</div>
									<div class="todo-tasklist-controls pull-left">
										<span class="todo-tasklist-date"><i class="fa fa-calendar"></i> Abertura: <?= data_extenso_abreviado($linha->dth_abertura_solicitacao) ?>  <i class="fa fa-clock-o"></i><?= exibir_hora($linha->dth_abertura_solicitacao, $soma_hora = '') ?> </span>
										<br/>
										<span class="todo-tasklist-date"><i class="fa fa-calendar-o"></i>
										 Previsão : <?= data_extenso_abreviado(exibir_hora($linha->dth_abertura_solicitacao, $linha->sla)) ?>
										 <i class="fa fa-clock-o"></i><?= exibir_hora(exibir_hora($linha->dth_abertura_solicitacao, $linha->sla), $soma_hora = '') ?> </span>
										 <br/>
										 <?php 

										 	$atraso = dateDiff(date("Y-m-d H:i:s"), exibir_hora($linha->dth_abertura_solicitacao, $linha->sla));

										 	if ($atraso)
										 	{
										 		 echo '<span class="todo-tasklist-date"><i class="fa fa-history"></i>
										 Atraso: <strong>'.$atraso.' </strong></span>';	
										 	}

										 ?>
									</div>
									
								</div>	
								<?php endforeach ?>			

						</div>
					</div>
				</div>			
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>	
</div>
<!-- END PAGE CONTENT INNER -->

