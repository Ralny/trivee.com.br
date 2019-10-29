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
		<div class="portlet-body" id="divRequisicoes">

			<table class="table table-striped table-bordered table-hover" >
				<thead>

					<th width="10%"># Num.</th>
					<th width="20%">Origem </th>
					<th width="20%">Destino</th>
					<th width="10%">Necessidade</th>
					<th width="15%">Status</th>
					<th width="15%">Ações</th>
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

									switch ($linha->sit_status_requisicao)
									{
										case 'P':
										$status = '<span class="label label-default">Aguardando Envio</span>';
										break;

										case 'G':
										$status = '<span class="label label-warning">Aguardando Aprovação</span>';
										break;

										case 'E':
										$status = '<span class="label label-success">Aguardado Entrega</span>';
										break;	

										case 'F':
										$status = '<span class="label label-primary">Finalizada</span>';
										break;	
									}	

									?>	
									<tr class="odd gradeX">


										<td><?= $linha->num_requisicao ?></td>
										<td><?= $linha->unidade_origem ?> / <?= $linha->origem ?></td>
										<td><?= $linha->unidade_destino ?> / <?= $linha->destino ?></td>
										<td><?= mostraData($linha->data_necessidade_entrega) ?></td>
										<td><?= $status ?></td>

										<td>
											<a class=" btn btn-default" href="<?= base_url() . $url ?>/editar/<?= $linha->token_id ?>"><i class="fa fa-pencil"></i></a>
											<?php if($linha->sit_status_requisicao != 'F'){ ?>
											<a class=" btn btn-default" href="<?= base_url() . $url ?>/excluir/<?= $linha->token_id ?>"><i class="fa fa-trash-o"></i></a>
											<?php } ?>
											<!--<button value="<?= isset($linha->token_id) ? $linha->token_id : null ;?>" class="btn btn-default"><i class="fa fa-thumbs-up"></i></button>-->
											<a class=" btn btn-default" href="<?= base_url() ?>produtos/requisicao/print_requisicao/<?= $linha->token_id ?>" target="_blank"><i class="fa fa-print"></i></a>
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

				jQuery(document).ready(function() {

					$(document).on('click', 'button', function(event) {

						var idRequisicao =  this.value;

						$.ajax({
							type: "POST",
							url: "<?= base_url() ?>produtos/requisicao/aprovar_requisicao",
							data: "idRequisicao="+idRequisicao,
							dataType: 'json',
							success: function(data)
							{
								if(data.result == true){
									$("#divRequisicoes").load("<?php echo current_url();?> #divRequisicoes" );
								}
								else{
									alert('Ocorreu um erro ao tentar aprovar a Requisição.');
								}
							}
						});
						return false;
					});

				});
			</script>

