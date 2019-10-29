<?php 
// Carregando configurações auxiliares
include ('application/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->

		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>
					Gerenciar Modulos
				</div>
				<div class="actions btn-set">
					<div class="form-actions top">
						<a class="btn btn-success" href="<?= base_url() . $url ?>/criar "><i class="fa fa-plus"></i> Criar Novo</a>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
					<thead>
						<tr>
							<th>#</th>	
							<th>Modulo</th>
							<th>Class Controller</th>
							<th>Table|Database</th>
							<th>PRI</th>
							<th width="10%">Ações</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						// Listando registros da tabela
						foreach ($lista as $linha):
	                	
			        ?>	
						<tr class="odd gradeX">
							<td> <?= $linha->id_modulo ?> </td>
							<td><a class="primary-link" href="<?= base_url() . $url ?>/construir/<?= $linha->token_id ?>"><?= $linha->nome_modulo ?></a>  </td>
							<td> <?= $linha->nome_controller ?> </td>
							<td> <?= $linha->tabela_db ?>       </td>
							<td> <?= $linha->key_tabela_db ?>   </td>
							<td>
		                    	<div class="btn-group">
									<button class=" btn btn-default" type="button" data-toggle="dropdown"> <i class="fa fa-cogs"></i> <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li>
											<a href="#"><i class="fa fa-eye"></i> Visualizar</a>
										</li>
										<li>
											<a href="<?= base_url() . $url ?>/construir/<?= $linha->token_id ?>"><i class="fa fa-eye"></i> Editar</a>
										</li>
										<li>
											<a href=""><i class="fa fa-trash-o"></i> Remover </a>
										</li>
										<li class="divider"></li>
										<li>
											<a href=""><i class="fa fa-cog"></i> Reconstruir </a>
										</li>
									</ul>
								</div>
		                	</td> 
						</tr>
					<?php endforeach ?>	
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->


<!-- END PAGE CONTENT INNER -->


