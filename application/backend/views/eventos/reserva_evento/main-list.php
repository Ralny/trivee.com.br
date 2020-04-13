<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('../application/backend/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
	                <?= $title_portlet ?>
				</div>
				<div class="actions btn-set">
					<div class="form-actions top">
						<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar "><i class="fa fa-check"></i> Novo</a>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<th width="10%">Status</th>
						<th width="10%">Núm. reserva</th>
						<th>Evento</th>
						<th>Cliente</th>
						<th width="10%">Valor total</th>
						<th width="10%" style="text-align: center;">Detalhes</th>
						<th width="10%">Ações</th>
					</thead>
					<tbody>
					<?php 

						/**
						 * Listando registros da tabela
						 * Listing table records
						 */
						foreach ($lista as $linha):
							/**
							 * Somando valor total de cada serviço
							 */		
							$valor_evento = $linha->valor_total_sala;
					?>	
						<tr class="odd gradeX">									
							<td>
								<span class="label bg-blue"> <?= $linha->desc_status_reserva_evento ?> </span>
							</td>
							<td><?= $linha->numero_reserva ?></td>
							<td><?= $linha->desc_evento ?></td>
							<td><?= $linha->nome_fantasia ?></td>
							<td><?= moeda($valor_evento) ?></td>
							<td style="text-align: center;">
							<span class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="left" data-content=
							"
							<table class='table table-hover table-light'>
								<thead>
									<tr class='uppercase'>
										<th colspan='3'>
											DETALHES DA RESERVA : <strong><?= $linha->numero_reserva ?></strong>
										</th>
									</tr>
									</thead>
								<tbody>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>Inicio</a>
										</td>
										<td>
											<span class='bold theme-font'><?= mostraData($linha->dth_previsao_inicio) ?></span>
										</td>
									</tr>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>Pax</a>
										</td>
										<td>
											<span class='bold theme-font'><?= $linha->num_pax ?></span>
										</td>
									</tr>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>Salas</a>
										</td>
										<td>
											<span class='bold theme-font'><?= moeda($linha->valor_total_sala) ?></span>
										</td>
									</tr>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>A&B</a>
										</td>
										<td>
											<span class='bold theme-font'>R$ 2.000,00</span>
										</td>
									</tr>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>Equipamentos</a>
										</td>
										<td>
											<span class='bold theme-font'>R$ 500,00</span>
										</td>
									</tr>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>Internet</a>
										</td>
										<td>
											<span class='bold theme-font'>R$ 500,00</span>
										</td>
									</tr>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>Pessoal</a>
										</td>
										<td>
											<span class='bold theme-font'>R$ 300,00</span>
										</td>
									</tr>
									<tr>
										<td class='fit'>
											
										</td>
										<td>
											<a href='javascript:;' class='primary-link'>Outros</a>
										</td>
										<td>
											<span class='bold theme-font'>R$ 300,00</span>
										</td>
									</tr>
								</tbody>
							</table>			
							
							"
							aria-describedby="popover263156"><i class="fa fa-file-text-o"></i></span>
							</td>
							<td>
								<a class=" btn btn-default" href="<?= base_url() . $url ?>/editar/<?= $linha->token_id ?>"><i class="fa fa-pencil"></i></a>
								<a class=" btn btn-default" href="<?= base_url() . $url ?>/excluir/<?= $linha->token_id ?>"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
					<?php endforeach ?>	
					</tbody>
				</table>
				
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
</div>
<!-- END PAGE CONTENT INNER -->

<script>

/**
 * Para colocar conteúdo HTML dentro do texto ou do título ajuste a propriedade html para true
 */
$(document).ready(function(){
	$('[data-trigger="hover"]').popover({html: true});   
});


</script>