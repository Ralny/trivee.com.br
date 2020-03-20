

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
		<a class="dashboard-stat dashboard-stat-light blue-madison" href="<?= base_url(). 'zata/logs/lista_interacoes_sistema' ?>">
		<div class="visual">
			<i class="fa fa-keyboard-o fa-icon-medium"></i>
		</div>
		<div class="details">
			<div class="number">
				 <?= $num_interacoes_zata ?>
			</div>
			<div class="desc">
				 Interações com o sistema
			</div>
		</div>
		</a>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<a class="dashboard-stat dashboard-stat-light green-haze" href="<?= base_url(). 'zata/logs/lista_logins_realizados' ?>">
		<div class="visual">
			<i class="fa fa-group fa-icon-medium"></i>
		</div>
		<div class="details">
			<div class="number">
				 <?= $num_login_realizados_zata ?>
			</div>
			<div class="desc">
				 Logins Realizados
			</div>
		</div>
		</a>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<a class="dashboard-stat dashboard-stat-light red-intense" href="<?= base_url(). 'zata/logs/lista_erros_zata' ?>">
		<div class="visual">
			<i class="fa fa-bug"></i>
		</div>
		<div class="details">
			<div class="number">
				 <?= $num_erros_zata ?>
			</div>
			<div class="desc">
				 Erros do Sistema
			</div>
		</div>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<!-- Begin: life time stats -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Visao Geral</span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="javascript:;" class="reload">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="tabbable-line">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#overview_1" data-toggle="tab">
							Interações com o sistema </a>
						</li>
						<li>
							<a href="#overview_2" data-toggle="tab">
							Logins Realizados</a>
						</li>
						<li>
							<a href="#overview_3" data-toggle="tab">
							Erros do sistema </a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="overview_1">
							<div class="table-responsive">
								<table class="table table-hover table-light">
								<thead>
								<tr class="uppercase">
									<th>
										 Nome do Usuario
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

									<th>
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>

								<?php foreach ($interacoes_usuarios as $usuarios) :

										foreach ($usuarios as $int_usuarios) :
								?>

									<td>
										<?= $int_usuarios['nome'] ?>
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
									<td>
										<a href="<?= base_url().'zata/logs/detalhes_interacao/'. $int_usuarios['id_usuario'] ?> " class="btn default btn-xs green-stripe">
										Detalhes </a>
									</td>
								</tr>
								<?php endforeach ;
										endforeach;
													?> 
								</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="overview_2">
							<div class="table-responsive">
								<table class="table table-hover table-light">
								<thead>
								<tr class="uppercase">
									<th>
										 Login
									</th>
									<th>
										 Data
									</th>
									<th>
										 Status
									</th>
									<th>
									</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($lista_logins_zata_top_7 as $lista_login) :

										switch ($lista_login->sit_status) {
											case 'L':
												$status = 'Livre';
												break;
											
											case 'F':
												$status = 'Falhou';
												break;

											case 'B':
												$status = 'Bloqueado';
												break;
											
											case 'R':
												$status = 'Soliticação';
												break;
										}

								 ?>
								<tr>
									<td>
										<?= $lista_login->login ?> 
									</td>
									<td>
										<?= $lista_login->dthLoginUsuario ?>
									</td>
									<td>
										 <?= $status ?>
									</td>
									<td>
										<a href="<?= $lista_login->idLoginUsuario ?>" class="btn default btn-xs green-stripe">
										Detalhes </a>
									</td>
								</tr>
								<?php endforeach ?>	
								</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="overview_3">
							<div class="table-responsive">
								<table class="table table-hover table-light">
								<thead>
								<tr class="uppercase">
									<th>
										 Log
									</th>
									<th>
										 Data
									</th>
									<th>
										 Origem
									</th>
									<th>
										 Tipo
									</th>
									<th>
									</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($lista_erros_zata_top_7 as $lista_erros) : ?>
								<tr>
									<td>
										#<?= $lista_erros->id_log ?>
									</td>
									<td>
										<?= $lista_erros->log_date ?>
									</td>
									<td>
										<?= $lista_erros->remote_addr ?>
									</td>
									<td>
										<?= $lista_erros->tipo ?>
									</td>
									<td>
										<a href="<?= base_url()?>zata/logs/detalhes_error/<?= $lista_erros->id_log ?>" class="btn default btn-xs green-stripe">
										Detalhes </a>
									</td>
								<?php endforeach ?>	
								</tr>
								</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="overview_4">
							<div class="table-responsive">
								<table class="table table-hover table-light">
								<thead>
								<tr class="uppercase">
									<th>
										 Customer Name
									</th>
									<th>
										 Date
									</th>
									<th>
										 Amount
									</th>
									<th>
										 Status
									</th>
									<th>
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										<a href="javascript:;">
										David Wilson </a>
									</td>
									<td>
										 3 Jan, 2013
									</td>
									<td>
										 $625.50
									</td>
									<td>
										<span class="label label-sm label-warning">
										Pending </span>
									</td>
									<td>
										<a href="javascript:;" class="btn default btn-xs green-stripe">
										View </a>
									</td>
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
	<div class="col-md-6">
		<!-- Begin: life time stats -->
		<div class="portlet light">
			<div class="portlet-title tabbable-line">
				<div class="caption">
					<i class="icon-share font-red-sunglo"></i>
					<span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
					<span class="caption-helper">weekly stats...</span>
				</div>
				<ul class="nav nav-tabs">
					<li>
						<a href="#portlet_tab2" data-toggle="tab" id="statistics_amounts_tab">
						Amounts </a>
					</li>
					<li class="active">
						<a href="#portlet_tab1" data-toggle="tab">
						Orders </a>
					</li>
				</ul>
			</div>
			<div class="portlet-body">
				<div class="tab-content">
					<div class="tab-pane active" id="portlet_tab1">
						<div id="statistics_1" class="chart">
						</div>
					</div>
					<div class="tab-pane" id="portlet_tab2">
						<div id="statistics_2" class="chart">
						</div>
					</div>
				</div>
				<div class="margin-top-20 no-margin no-border">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
							<span class="label label-success uppercase">
							Revenue: </span>
							<h3>$1,234,112.20</h3>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
							<span class="label label-info uppercase">
							Tax: </span>
							<h3>$134,90.10</h3>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
							<span class="label label-danger uppercase">
							Shipment: </span>
							<h3>$1,134,90.10</h3>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
							<span class="label label-warning uppercase">
							Orders: </span>
							<h3>235090</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>