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
								<th width="10%">Nº OS</th>
								<th width="10%">Data</th>
								<th>Cliente</th>
								<th width="10%">Tipo</th>
								<th width="10%">Valor Total</th>
								<th width="10%">Situação</th>
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
									<td><?= $linha->numero_os ?></td>
									<td><?= mostraData($linha->dth_abertura_os) ?></td>
									<td><?= $linha->id_cf ?></td>
									<td><?= $linha->tipo_os ?></td>
									<td><?= $linha->tipo_os ?></td>
									<td><?= $linha->status_os ?></td>
									<td>
										<a class=" btn btn-default" href="<?= base_url() . $url ?>/editar/<?= $linha->id_os ?>"><i class="fa fa-pencil"></i></a>
	                    				<a class=" btn btn-default" href="<?= base_url() . $url ?>/excluir/<?= $linha->id_os ?>"><i class="fa fa-trash-o"></i></a>
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

