<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
		<div class="modal-dialog modal-full">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Legenda de Prioridade</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									#
								</th>
								<th width="70%">
									Pergunta
								</th>
								<th>
									Resposta
								</th>
								<th>
									Prioridade
								</th>
								<th>
									SLA
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
	
								foreach ($prioridade as $row):
							?>
							<tr>
								<td>
									<?= $row->index_letra ?>
								</td>
								<td>
									<?= $row->legenda ?>
								</td>
								<td>
									Sim
								</td>
								<td>
									<span class="label label-danger" style="background-color:<?= $row->hex_color ?>;">
									<?= $row->desc_prioridade ?></span>
								</td>
								<td>
									<?= $row->sla ?>
								</td>
								
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>