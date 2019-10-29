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
						
						<tr>
						<!--<th>#</th>-->
							<?php foreach ($tableGrid as $k => $t) : ?>

								<?php if($t['show'] =='1'): ?>
								
									<th><?php echo $t['label'] ?></th>
								
								<?php endif; ?>
							
							<?php endforeach; ?>
							<th width="10%">Ativo?</th>
							<th width="10%">Ações</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						/**
						 * Listando registros da tabela
						 * Listing table records
						 */
						foreach ($lista as $i => $linha):
							/**
							 * Listar registros da tabela
							 * Change Active Label
							 */		            
							$registro_ativo = ($linha->sit_ativo == 'S') ? $registro_ativo_true : $registro_ativo_false ;
			        ?>	
						<tr class="odd gradeX">

						<!--<td width="20"><strong><?php echo ($i+1) ?></strong> </td>-->

						 <?php foreach ( $tableGrid as $j => $field ) :  ?>

						 	<?php $column = $field['field'] ?>

							<?php if($field['show'] == '1'): ?>

								<td><?= $linha->$column ?></td>

							<?php endif; ?>

						<?php endforeach; ?>

							<td><?= $registro_ativo; ?></td>
								
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

