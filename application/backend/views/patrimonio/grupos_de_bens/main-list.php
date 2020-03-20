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
						<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar "><i class="fa fa-check"></i> Novo grupo de bem</a>
						<div class="btn-group">
							<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Importar / Exportar
							</button>
							<ul class="dropdown-menu pull-right">
								<li> <a data-toggle="modal" href="#basic"> Importar arquivo CSV</a> </li>
								<li class="divider"></li>
								<li> <a href="<?= base_url()?>zata/export/get_pdf_patrimonio_grupos_de_bens"> Salvar em PDF</a></li>
								<li> <a href="<?= base_url()?>zata/export/get_xls_patrimonio_grupos_de_bens"> Exportar lista em Excel</a></li>
								<li> <a href="<?= base_url()?>zata/export/get_csv_patrimonio_grupos_de_bens"> Exportar um arquivo CSV</a></li>
								<li> <a href="<?= base_url()?>zata/export/get_xml_patrimonio_grupos_de_bens"> Exportar um arquivo XML</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<th width="1"></th>
						<th>Nome do grupo</th>
						<th>Depreciação Anual</th>
						<th>Ativo?</th>
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
							$registro_ativo = ($linha->sit_ativo == 'S') ? $registro_ativo_true : $registro_ativo_false ;		            
						?>	
						<tr class="odd gradeX">
							<td></td>										
							<td><?= $linha->desc_grupo_bem ?></td>
							<td><?= decimal_ajuste_exibir($linha->depreciacao_anual) .' %'; ?></td>
							<td><?= $registro_ativo ?></td>
							<td>
								<a class=" btn btn-default" href="<?= base_url() . $url ?>/editar/<?= $linha->token_id ?>"><i class="fa fa-pencil"></i></a>
								<a class=" btn btn-default" href="<?= base_url() . $url ?>/excluir/<?= $linha->token_id?>"><i class="fa fa-trash-o"></i></a>
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

<?php  $this->load->view('tpl/modal-import') ?>

