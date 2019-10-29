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
				Tarefas individuais da equipe
			</div>
			<div class="actions btn-set">
				<div class="form-actions top">
					<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar_tarefa/<?= $this->uri->segment(4)?>"><i class="fa fa-check"></i> Novo</a>
					<div class="btn-group">
						<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-settings"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<li> <a href="<?= base_url()?>zata/export/get_csv_produtos">Exportar para CSV </a></li>
							<li> <a data-toggle="modal" href="#basic"> Importar dados</a> </li>
						</ul>
					</div>
				</div>

			</div>

		</div>
		<div class="portlet-body"> 

			<table class="table table-striped table-hover" id="sample_2">
				<thead>
					<th width="50%">Nome da Tarefa</th>
					<th width="15%">Responsável</th>
					<th width="15%">Entrega Desejada</th>				
					<th width="10%">Status</th>
					<th width="10%">Ações</th>
				</thead>
				<tbody>
					<?php 
				/**
				 * Listando registros da tabela
				 * Listing table records
				 *
				foreach ($lista as $linha):

					 /**
					 * Listar registros da tabela
					 * Change Active Label
					 *
					 $registro_ativo = ($linha->sit_ativo == 'S') ? $registro_ativo_true : $registro_ativo_false ; */			            
					 ?>	
					 <tr class="odd gradeX">
					 	<td>Pintar paredes</td>
					 	<td>Julimar</td>
					 	<td>07/09/2018</td>
					 	<td><span class="label label-warning">Fazendo</span></td>
					 	<td>
					 		<a class=" btn btn-default" href=""><i class="fa fa-pencil"></i></a>
					 		<a class=" btn btn-default" href=""><i class="fa fa-trash-o"></i></a>
					 	</td>

					 </tr>

					 <tr class="odd gradeX">
					 	<td>Pintar paredes</td>
					 	<td>Julimar</td>
					 	<td>07/09/2018</td>
					 	<td><span class="label label-warning">Fazendo</span></td>
					 	<td>
					 		<a class=" btn btn-default" href=""><i class="fa fa-pencil"></i></a>
					 		<a class=" btn btn-default" href=""><i class="fa fa-trash-o"></i></a>
					 	</td>

					 </tr>

					 <tr class="odd gradeX">
					 	<td>Pintar paredes</td>
					 	<td>Julimar</td>
					 	<td>07/09/2018</td>
					 	<td><span class="label label-warning">Fazendo</span></td>
					 	<td>
					 		<a class=" btn btn-default" href=""><i class="fa fa-pencil"></i></a>
					 		<a class=" btn btn-default" href=""><i class="fa fa-trash-o"></i></a>
					 	</td>

					 </tr>

					 <tr class="odd gradeX">
					 	<td>Pintar paredes</td>
					 	<td>Julimar</td>
					 	<td>07/09/2018</td>
					 	<td><span class="label label-warning">Fazendo</span></td>
					 	<td>
					 		<a class=" btn btn-default" href=""><i class="fa fa-pencil"></i></a>
					 		<a class=" btn btn-default" href=""><i class="fa fa-trash-o"></i></a>
					 	</td>

					 </tr>
					<?php // endforeach ?>	
				</tbody>
			</table>


		</div>
	</div>
	<!-- END EXAMPLE TABLE PORTLET-->
</div>

<!-- END PAGE CONTENT INNER -->
