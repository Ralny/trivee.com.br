<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
?>

<div class="portlet light">
	<div class="portlet-body">
		<div class="invoice">
			<div class="row invoice-logo">
				<div class="col-xs-6 invoice-logo-space">
					<img src="<?= base_url()?>assets/zata/logo-default.png" class="img-responsive" width="200" alt="logo"/>
				</div>
				<div class="col-xs-6">
					<p>
						<?= $title_portlet ?>
						<span class="muted"></span>
					</p>
				</div>
				<div class="col-xs-12 invoice-block">
					<br/>
					<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
					Imprimir <i class="fa fa-print"></i>
					</a>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th>
							 ID
						</th>
						<th>
							 Nome do Usuario
						</th>
						<th>
							 E-mail
						</th>
						<th>
							 Cadastros
						</th>
						<th>
							Edições
						</th>
						<th>
							Exclusões
						</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($interacoes_usuarios as $usuarios) :

							foreach ($usuarios as $int_usuarios) :
					?>
					<tr>
						<td>
							 <?= $int_usuarios['id_usuario'] ?>
						</td>
						<td>
							 <?= $int_usuarios['nome'] ?>
						</td>
						<td>
							<?= $int_usuarios['email'] ?>
						</td>
						<td>
							<?= $int_usuarios['cad'] ?>
						</td>
						<td>
							<?= $int_usuarios['edit'] ?>
						</td>
						<td>
							<?= $int_usuarios['del'] ?>
						</td>
					</tr>
						<?php endforeach ;
										endforeach;
													?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light">

			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<th width="5%">Log</th>
						<th width="14%">Data</th>
						<th width="8%">Origem</th>
						<th width="8%">Tipo</th>
						<th>Request URI</th>
						<th>Mensagem</th>
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

							<td>#<?= $linha->id_activity ?></td>
							<td><?= $linha->log_date ?></td>
							<td><?= $linha->remote_addr ?></td>
							<td><?= ucfirst($linha->tipo) ?></td>
							<td><?= $linha->request_uri ?></td>
							<td><?= $linha->mensagem ?></td>

						</tr>
					<?php  endforeach ?>	
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
</div>

<!-- END PAGE CONTENT INNER -->

</div>
