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
							<th width="1"></th>
							<th>Nome Sala</th>
							<th width="10%">TRF Balcão / dia</th>
							<th width="10%">TRF Especial + ISS / dia</th>
							<th width="10%">Dimensões</th>
							<th width="10%">Área</th>
							<th width="10%">Pé Direito</th>
							<th width="10%">Ativo?</th>
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
								<td><?= $linha->nome_sala ?></td>
								<td><?= moeda($linha->valor_diaria_trf_balcao) ?></td>
								<td><strong><?= moeda($linha->valor_diaria_trf_especial_iss) ?></strong></td>
								<td><?= ($linha->dimensoes != '') ? $linha->dimensoes.' m' : ''; ?></td>
								<td><?= ($linha->area != '') ? $linha->area.' m' : ''; ?></td>
								<td><?= ($linha->pe_direito != '') ? $linha->pe_direito.' m' : ''; ?></td>
								<td><?= $registro_ativo ?></td>
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

