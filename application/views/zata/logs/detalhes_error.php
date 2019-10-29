<div class="portlet light">
	<div class="portlet-body">
		<div class="invoice">
			<div class="row invoice-logo">
				<div class="col-xs-6 invoice-logo-space">
					<img src="<?= base_url()?>assets/zata/logo-default.png" class="img-responsive" width="200" alt="logo"/>
				</div>
				<div class="col-xs-6">
					<p>
						Log #<?= $linha->id_log ?>
						<span class="muted"> <?= data_hora($linha->log_date) ?> </span>

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
							 Tipo
						</th>
						<th>
							 Origem
						</th>
						<th>
							 Request URI
						</th>
						<th>
							 Usuario
						</th>
						<th>
							 E-mail
						</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>
							 #<?= $linha->id_log ?>
						</td>
						<td>
							 <?= $linha->tipo ?>
						</td>
						<td>
							 <?= $linha->remote_addr ?>
						</td>
						<td>
							 <?= $linha->request_uri ?>
						</td>
						<td>
							 <?= $linha->nome ?>
						</td>
						<td>
							 <?= $linha->email ?>
						</td>
					</tr>
					<tr>
						<td colspan="6" style="font-size: 14px; font-weight: 600"><strong>Mensagem:</strong> <?= $linha->mensagem ?></td>
					</tr>
					</tbody>
					</table>

				</div>

				<div class="col-xs-12">
					<div class="well" style="padding-bottom: 5px;">
						<?= $linha->indicesServer ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 invoice-block">
					<br/>
					<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
					Imprimir <i class="fa fa-print"></i>
					</a>
					<a class="btn btn-lg green hidden-print margin-bottom-5">
					Enviar para Equipe de Desenvolvimento <i class="fa fa-check"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT INNER -->
</div>
</div>