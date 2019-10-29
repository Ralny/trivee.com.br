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
			        ?>	
						<tr class="odd gradeX">

						<!--<td width="20"><strong><?php echo ($i+1) ?></strong> </td>-->

						 <?php foreach ( $tableGrid as $j => $field ) :  ?>

							<?php if($field['show'] == '1'): ?>

								<td><?= $linha->$field['field'] ?></td>

							<?php endif; ?>

						<?php endforeach; ?>

						</tr>
					<?php endforeach ?>	
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
</div>

<!-- END PAGE CONTENT INNER -->

