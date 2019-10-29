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
								<th>Descrição do Evento</th>
								<th width="15%">Número de Pax</th>
								<th width="15%">Status</th>
								<th width="15%">Dead Line</th>
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
									<td><?= $linha->desc_evento ?></td>
									<td><?= $linha->num_pax ?></td>
									<td><?= $linha->sit_status ?></td>
									<td><?= $linha->dth_dead_line ?></td>
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