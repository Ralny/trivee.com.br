<div class="portlet light">
	<div class="portlet-body">
		<div class="invoice">
			<div class="row invoice-logo">
				<div class="col-xs-6 invoice-logo-space">
					<img src="<?= base_url()?>assets/zata/logo-default.png" class="img-responsive" width="200" alt="logo"/>
				</div>
				<div class="col-xs-6">
					<p>
						#<?= isset($show->numero_os) ? $show->numero_os : null ;?>
						<span class="muted">Numero da OS</span>
					</p>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-3">
					<h4><strong> Detalhes</strong></h4>
					<ul class="list-unstyled">
						<li>
							Tipo: <strong>Ordem de Servico</strong>
						</li>
						<li>
							Data de Abertura:<strong><?=  isset($show->dth_abertura_os) ? mostraData($show->dth_abertura_os) : null ;?></strong>
						</li>
						<li>
							Tecnico Responsavel:<strong><?= isset($show->tecnico) ? $show->tecnico : null ;?></strong>
						</li>
						<li>
							Data da Realização:<strong><?=  isset($show->dth_realizacao) ? mostraData($show->dth_realizacao) : null ;?></strong>
						</li>
						<li>
							Hora da Realização:<strong><?=  isset($show->hora_realizacao) ? $show->hora_realizacao : null ;?></strong>
						</li>
						<li>
							Data da conclusão:<strong><?=  isset($show->dth_conclusao_os) ? mostraData($show->dth_conclusao_os) : null ;?></strong>
						</li>
						<?php 
							$garantia = '';

							switch ($show->garantia) {
								case '1':
									$garantia = '30 Dias';
									break;

								case '2':
									$garantia = '3 Meses';
									break;

								case '3':
									$garantia = '6 Meses';
									break;
									
								case '4':
									$garantia = '1 Ano';
									break;
									
								case '4':
									$garantia = 'Não tem Garantia';
									break;				
							}
							?>
							<li>
								Garantia: <strong><?= $garantia ?></strong>
							</li>
						</ul>
					</div>

					<?php

					if ($cliente->tipo_pessoa = 'J'){

						$pessoa = $cliente->razao_social;

					}else{

						$pessoa = $cliente->nome_fantasia;

					}

					?>

					<div class="col-xs-5">
						<h4><strong>Cliente</strong></h4>
						<ul class="list-unstyled">
							<li>
								Nome/Razao Social: <strong><?= $pessoa ?></strong>
							</li>
							<li>
								CPF/CNPJ: <strong><?= $cliente->numCPF_numCNPJ ?></strong>
							</li>
							<li>
								Endereco: <strong><?= $cliente->endereco ?>, <?= $cliente->numero ?> </strong>
							</li>
							<li>
								Complemento: <strong><?= $cliente->complemento ?></strong>
							</li>
							<li>
								Bairro: <strong><?= $cliente->bairro ?></strong> 	Cidade/PI: <strong><?= $cliente->cidade ?>/<?= $cliente->uf ?></strong>
							</li>						
							<li>
								Email: <strong><?= $cliente->email ?></strong>
							</li>
							<li>
								Celular: <strong><?= $cliente->contato_celular ?></strong>
							</li>
						</ul>
					</div>
					<div class="col-xs-4">
						<h4><strong> Laudo Técnico </strong></h4>
						<ul class="list-unstyled">
							<li>
								<?=  isset($show->laudo_tecnico) ? $show->laudo_tecnico : null ;?>
							</li>					
						</ul>
					</div>
				</div>
				<!-- Aqui -->
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>
										Servicos
									</th>
									<th width="15%">
										Qtd
									</th>
									<th width="15%">
										Valor unit.
									</th>
									<th width="15%">
										Valor Total
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								/**
								 * Grande Valor total inicia com ZERO
								 */
								$total_servicos = 0;
								/**
								 * Listando registros da tabela
								 * Listing table records
								 */

								foreach ($itens_os_servico as $item):
									

									if (isset($item->valor_total)){

										$valor_item = $item->valor_total;

									}
									else
									{
										$valor_item = 0;
									}	

									/**
									 * Grande Valor Total
									 */

									$total_servicos = $total_servicos + $valor_item;



									/**
									 * Listar registros da tabela
									 * Change Active Label
									 */
									?>	
									<tr>
										<td>
											<?=  isset($item->nome) ? $item->nome : null ;?>
										</td>
										<td>
											<?=  isset($item->qtd) ? $item->qtd : null ;?>
										</td>
										<td>
											<?=  isset($item->valor_unit) ? moeda($item->valor_unit) : null ;?>
										</td>
										<td>
											<?=  isset($item->valor_total) ? moeda($item->valor_total) : null ;?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>
										Produtos 
									</th>
									<th width="15%">
										Qtd
									</th>
									<th width="15%">
										Valor unit.
									</th>
									<th width="15%">
										Valor Total
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								/**
								 * Grande Valor total inicia com ZERO
								 */
								$total_produtos = 0;
								/**
								 * Listando registros da tabela
								 * Listing table records
								 */

								foreach ($itens_os_produto as $item):
									

									if (isset($item->valor_total)){

										$valor_item = $item->valor_total;

									}
									else
									{
										$valor_item = 0;
									}	

									/**
									 * Grande Valor Total
									 */

									$total_produtos = $total_produtos + $valor_item;



									/**
									 * Listar registros da tabela
									 * Change Active Label
									 */
									?>
									<tr>
										<td>
											<?=  isset($item->nome) ? $item->nome : null ;?>
										</td>
										<td>
											<?=  isset($item->qtd) ? $item->qtd : null ;?>
										</td>
										<td>
											<?=  isset($item->valor_unit) ? moeda($item->valor_unit) : null ;?>
										</td>
										<td>
											<?=  isset($item->valor_total) ? moeda($item->valor_total) : null ;?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					</div>
					<div class="col-md-6">
						<div class="well">
							<div class="row static-info align-reverse">
								<div class="col-md-8 name">
									Total em Servicos:
								</div>
								<div class="col-md-3 value">
									<?= moeda($total_servicos); ?>
								</div>
							</div>
							<div class="row static-info align-reverse">
								<div class="col-md-8 name">
									Total em Produtos:
								</div>
								<div class="col-md-3 value">
									<?= moeda($total_produtos); ?>
								</div>
							</div>
							<div class="row static-info align-reverse">
								<div class="col-md-8 name">
									Descontos:
								</div>
								<div class="col-md-3 value">
									$ 0,00
								</div>
							</div>
							<div class="row static-info align-reverse">
								<div class="col-md-8 name">
									Grande Valor Total:
								</div>
								<div class="col-md-3 value">
									<?= moeda($total_servicos + $total_produtos); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 invoice-block">
						<br/>
						<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
							Imprimir <i class="fa fa-print"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT INNER -->
</div>
</div>
