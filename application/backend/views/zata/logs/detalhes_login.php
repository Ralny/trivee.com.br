<?php 

switch ($linha->sit_status) {
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


<div class="portlet light">
	<div class="portlet-body">
		<div class="invoice">
			<div class="row invoice-logo">
				<div class="col-xs-6 invoice-logo-space">
					<img src="<?= base_url()?>assets/zata/logo-default.png" class="img-responsive" width="200" alt="logo"/>
				</div>
				<div class="col-xs-6">
					<p>
						Log: #<?= $linha->idLoginUsuario ?>
						<span class="muted"> <?= data_hora($linha->dthLoginUsuario) ?> </span>
					</p>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th>
							 Log
						</th>
						<th>
							 Login
						</th>
						<th>
							 Origem
						</th>
						<th>
							 Status
						</th>
						<th>
							 Dispositivo
						</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>
							 #<?= $linha->idLoginUsuario ?>
						</td>
						<td>
							 <?= $linha->login ?>
						</td>
						<td>
							 <?= $linha->ip_address ?>
						</td>
						<td>
							 <?= $status ?>
						</td>
						<td>
							 <?= $linha->dispositivo ?>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
				<div class="col-xs-12">
					<div class="well">
						<strong><h3>Informações do Navegador</h3></strong>
						<h4><?= $linha->about_browser ?></h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 invoice-block">
					<br/>
					<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
					Imprimir <i class="fa fa-print"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT INNER -->
</div>
</div>