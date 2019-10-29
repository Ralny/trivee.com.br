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
						<th>Log Step</th>
						<th>Usuario</th>
						<th>Data</th>
						<th>Origem</th>
						<th>Request URI</th>
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

							<td>#<?= $linha->id_step ?></td>
							<td><?= $linha->nome ?></td>
							<td><?= $linha->log_date ?></td>
							<td><?= $linha->remote_addr ?></td>
							<td><?= $linha->request_uri ?></td>

						</tr>
					<?php endforeach ?>	
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
</div>

<!-- END PAGE CONTENT INNER -->

