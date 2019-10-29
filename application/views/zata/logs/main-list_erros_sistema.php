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
					<i class="fa fa-cubes font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase"><?= $title_portlet ?></span>
				</div>
				<div class="actions btn-set">
					<div class="form-actions top">
						<a class="btn btn-success" href="<?= base_url() .'zata/logs' ?>"><i class="fa fa-mail-reply"> </i> Dashboard</a>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<th>Log</th>
						<th>Data</th>
						<th>Origem</th>
						<th>Tipo</th>
						<th width="10%"></th>
					</thead>
					<tbody>
					<?php 
						/**
						 * Listando registros da tabela
						 * Listing table records
						 */
						foreach ($list_erros_sistema as $i => $linha):
							/**
							 * Listar registros da tabela
							 * Change Active Label
							 */		            
			        ?>	
						<tr class="odd gradeX">

							<td>#<?= $linha->id_log ?></td>
							<td><?= data_hora($linha->log_date) ?></td>
							<td><?= $linha->remote_addr ?></td>
							<td><?= $linha->tipo ?></td>
							<td>
								<a href="<?= base_url().'/zata/logs/detalhes_error/'.$linha->id_log ?>" class="btn default btn-xs green-stripe"> Detalhes </a>
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

