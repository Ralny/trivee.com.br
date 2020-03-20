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
								<th>Tipo</th>
								<th>Nome Fantasia</th>
								<th>CNPJ/CPF</th>
								<th>Telefone</th>
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
									 if ($linha->tipo_cadastro == 'Fornecedor'){
									 	$tipo_cadastro = '<span class="label bg-green">'. $linha->tipo_cadastro .'</span>';
									 }
									 elseif($linha->tipo_cadastro == 'Cliente')
									 {
									 	$tipo_cadastro = '<span class="label bg-blue">'. $linha->tipo_cadastro .'</span>';
									 }
									 else
									 {
									 	$tipo_cadastro = '<span class="label bg-purple">'. $linha->tipo_cadastro .'</span>';
									 }	         
					        ?>	
								<tr class="odd gradeX">									
									<td><?= $tipo_cadastro ?></td>
									<td><?= $linha->nome_fantasia ?></td>
									<td><?= $linha->numCPF_numCNPJ ?></td>	
									<td><?= $linha->telefone ?></td>									
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

