<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
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
									 * Listar registros da tabela
									 * Change Active Label
									 */		            
					        ?>	
								<tr class="odd gradeX">									
									<td>
										<span class="label bg-blue"> <?= $linha->desc_status_reserva_evento ?> </span>
									</td>
									<td><?= $linha->numero_reserva ?></td>
									<td><?= $linha->desc_evento ?></td>
									<td><?= $linha->nome_fantasia ?></td>
									<td><?= moeda($linha->valor_total_reserva_evento) ?></td>
									<td style="text-align: center;">
									<span, class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="left" 
									data-content="
												
													Previsão de inicio: <strong>20/10/2019</strong>
													<br/>
													Numero de Pax: 209
													<br/>
													Qtde de Salas: 8
													<br/>
													Total de Salas: R$ 3.500,00
													<br/>
													Total de A&B: R$ 1.500,00
													<br/>
													Total de Outros: R$ 500,00
									
												" aria-describedby="popover263156"><i class="fa fa-file-text-o"></i></span>
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