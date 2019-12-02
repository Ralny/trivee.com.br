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
						<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar "><i class="fa fa-check"></i> Novo Equipamento</a>
						<div class="btn-group">
							<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Importar / Exportar</button>
							<ul class="dropdown-menu pull-right">
								<li> <a data-toggle="modal" href="#basic"> Importar arquivo CSV</a> </li>
								<li class="divider"></li>
								<li> <a href="<?= base_url()?>zata/export/get_pdf_eventos_equipamentos"> Salvar em PDF</a></li>
								<li> <a href="<?= base_url()?>zata/export/get_xls_eventos_equipamentos"> Exportar lista em Excel</a></li>
								<li> <a href="<?= base_url()?>zata/export/get_csv_eventos_equipamentos"> Exportar um arquivo CSV</a></li>
								<li> <a href="<?= base_url()?>zata/export/get_xml_eventos_equipamentos"> Exportar um arquivo XML</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<th>Descrição do Equipamento</th>
						<th width="15%" style="text-align: center;">Quantidade</th>
						<th width="15%">Valor da Diária</th>
						<th width="15%" style="text-align: center;">Observações</th>
						<th width="10%" style="text-align: center;">Ativo?</th>
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
							<td><?= $linha->desc_equipamento ?></td>
							<td style="text-align: center;"><span class="label label-primary"><?= $linha->qtd_equipamento ?></span></td>
							<td><strong><?= moeda($linha->valor_diaria) ?></strong></td>
							<?php  if ($linha->observacoes != '') { ?>
							<td style="text-align: center;"><span class=" btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="left" data-content="<?= $linha->observacoes ?>" aria-describedby="popover263156"><i class="fa fa-file-text-o"></i></span> </td>
							<?php } else { ?>
							<td></td>
							<?php } ?>
							<td style="text-align: center;"><?= $registro_ativo ?></td>
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

<?php  $this->load->view('tpl/modal-import') ?>
