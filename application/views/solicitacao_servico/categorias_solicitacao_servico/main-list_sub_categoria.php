	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				Subcategorias
			</div>
			<div class="actions btn-set">
				<div class="form-actions top">
					<a class="btn btn-success" href="<?= base_url() ?>solicitacao-servico/subcategoria/cadastrar/<?= $show->token_id ?> "><i class="fa fa-check"></i> Novo</a>
				</div>
			</div>
		</div>
		<div class="portlet-body">

			<table class="table table-striped table-bordered table-hover" id="sample_2">
				<thead>
					<th>Nome da Subcategoria</th>
					<th width="10%">Ações</th>
				</thead>
				<tbody>
					<?php 
							/**
							 * Listando registros da tabela
							 * Listing table records
							 */
							foreach ($lista_subcategorias as $linha):
								/**
								 * Listar registros da tabela
								 * Change Active Label
								 */		            
					?>	
							<tr class="odd gradeX">
								<td><?= $linha->desc_cat_solicitacao_servico ?></td>
								<td>
									<a class=" btn btn-default" href="<?= base_url() ?>solicitacao-servico/subcategoria/editar/<?= $linha->token_id ?>"><i class="fa fa-pencil"></i></a>
									<a class=" btn btn-default" href="<?= base_url() ?>solicitacao-servico/subcategoria/excluir/<?= $linha->token_id ?>"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
							<?php endforeach ?>	
						</tbody>
					</table>


			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->



