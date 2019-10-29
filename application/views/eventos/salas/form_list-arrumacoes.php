<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Adicionar arrumações
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM-->

				<div class="row">
					<form id="formArruamacao" action="" method="post">
					<input type="hidden" name="id_sala" id="id_sala" value="<?=  isset($show->id_sala) ? $show->id_sala : null ;?>" />
					
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Formato de Sala</label>
								<select name="id_formato_de_sala" id="id_formato_de_sala" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
									<option value="0"></option>
									<?php foreach ($lista_formato_de_sala as $row): ?>
										<option value="<?= $row->id_formato_de_sala ?>"><?= $row->desc_formato_de_sala ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Pax.</label>
								<input value="" id="num_pax" name="num_pax"  type="text" class="form-control"/>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Tempo para montar</label>
								<input value="" id="tempo_montagem" name="tempo_montagem" type="text" class="form-control"/>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label"> Tempo para desmontar </label>
								<input value="" id="tempo_desmontagem" name="tempo_desmontagem" type="text" class="form-control"/>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<?php // if($show->sit_status_requisicao != 'F') {?>
								<button value="" type="submit" class="btn green-haze"><i class="fa fa-check"></i>Adicionar</button>
								<?php // } ?>
							</div>
						</div>
					</form>	
				</div>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped table-hover" id="lista_arruamacoes">
							<thead>
								<tr>
									<th>
										Formato de Sala 
									</th>
									<th width="10%">
										Pax
									</th>
									<th width="20%">
										Tempo montagem
									</th>
									<th width="20%">
										Tempo desmontagem
									</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody>
					<?php 

					/**			
					 * Listando registros da tabela
					 * Listing table records
					 */

					foreach ($lista_arrumacao as $arrumacao):

						/**
						 * Listar registros da tabela
						 * Change Active Label
						 */
						?>	
						<tr>
							<td>
								<?= isset($arrumacao->desc_formato_de_sala) ? $arrumacao->desc_formato_de_sala : null ;?>
							</td>
							<td>
								<span class="label label-primary">
								<?= isset($arrumacao->num_pax) ? $arrumacao->num_pax : null ;?>
							 	</span>
							</td>
							<td>
								<?= isset($arrumacao->tempo_montagem) ? $arrumacao->tempo_montagem : null ;?>
							</td>
							<td>
								<?= isset($arrumacao->tempo_desmontagem) ? $arrumacao->tempo_desmontagem : null ;?>
							</td>
							<td>
								<?= isset($arrumacao->valor_total) ? $arrumacao->valor_total : null ;?>
							</td>
							<td>
								<a excluir="<?= isset($arrumacao->id_arrumacao) ? $arrumacao->id_arrumacao : null ;?>" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
							</td>

						</tr>
						<?php   endforeach ?>

						</tbody>
					</table>

				</div>
			</div>
		</div>
		<br>
		<!-- END FORM-->
	</div>	
</div>
<!-- END VALIDATION STATES-->
</div>
</div>
<!-- END PAGE CONTENT INNER -->

<script>

	jQuery(document).ready(function() {

		$('input[name="num_pax"]').inputmask({
    		"mask": "9",
    		"repeat": 4,
    		"greedy": false
    	});

		$('input[name="tempo_montagem"]').mask('99h99');

		$('input[name="tempo_desmontagem"]').mask('99h99');

		$("#formArruamacao").validate({
			rules:{
				id_formato_de_sala: {
					required:true
				},
				num_pax: {
					required:true
				},
				tempo_montagem: {
					required:true
				},
				tempo_desmontagem: {
					required:true
				}

			},
			messages:{
				id_formato_de_sala: {
					required: 'Selecione um formato de sala'
				},
				num_pax: {
					required: 'Campo obrigatório'
				},
				tempo_montagem: {
					required: 'Campo obrigatório'
				},
				tempo_desmontagem: {
					required: 'Campo obrigatório'
				}
			},
			submitHandler: function( form ){       
				/*
				$("#divProdutos").html("<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 80%'><span class='sr-only'>80% Complete (success) </span></div></div>");
				*/

				var dados = $( form ).serialize();

				console.log(dados);

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>eventos/Eventos_salas/adicionarArrumacao",
					data: dados,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$("#lista_arruamacoes").load("<?php echo current_url();?> #lista_arruamacoes" );
							$("#id_formato_de_sala").val("0").change();
							$("#num_pax").val('') ;
							$("#tempo_montagem").val('');
							$("#tempo_desmontagem").val(''); 
						}
						else{
							alert('Ocorreu um erro ao tentar adicionar. Entre em contato com o suporte.');
						}
					}
				});

				return false;
			}

		});

		$(document).on('click', 'a', function(event) {
			var id_arrumacao = $(this).attr('excluir');

			if((id_arrumacao % 1) == 0){
				/*
				$("#divProdutos").html("<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 80%'><span class='sr-only'>80% Complete (success) </span></div></div>");
				*/

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>eventos/Eventos_salas/excluirArrumacao",
					data: "id_arrumacao="+id_arrumacao,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$("#lista_arruamacoes").load("<?php echo current_url();?> #lista_arruamacoes" );
						}
						else{
							alert('Ocorreu um erro ao tentar excluir produto.');
						}
					}
				});
				return false;
			}

		});

	});
</script>