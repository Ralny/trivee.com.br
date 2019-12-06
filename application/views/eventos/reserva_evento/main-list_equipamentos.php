<div class="row" id="div_lista_equipamentos">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Equipamentos
				</div>
				
				<div class="actions btn-set">
					<div class="form-actions top">
						<button id="add_equipamento" class="btn btn-success" data-toggle="modal" href="#equipamento"><i class="fa fa-plus"></i> Adicionar Equipamento</button>
					</div>
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped table-hover" id="divSalas" >
							<thead>
								<tr>
									<th>
										Equipamento 
									</th>
									<th>
										Sala
									</th>
									<th>
										Inicio
									</th>
									<th>
										Fim
									</th>
									<th width="12%">
										Valor
									</th>
									<th width="12%">
										Total c/ taxas
									</th>
									<th width="10%">
										Ações
									</th>
								</tr>
							</thead>
							<tbody>
					<?php 

					/*
					 * Grande Valor total inicia com ZERO
					 *
					$valor_total = 0;
					$valor_total_com_taxas = 0;
					/**
					 * Listando registros da tabela
					 * Listing table records
					 *
                    
					foreach ($lista_reserva_salas as $sala):

						/**
						 * Grande Valor Total
						 *
						$valor_total 		   = $valor_total + $sala->valor_total;
						$valor_total_com_taxas = $valor_total_com_taxas + $sala->valor_total_taxas;

						/**
						 * Listar registros da tabela
						 * Change Active Label
						 */
						?>	
						<tr>
							<td>
								<?php //= isset($sala->nome_sala) ? $sala->nome_sala : null ;?>
							</td>
							<td>
								<?php //= isset($sala->desc_formato_de_sala) ? $sala->desc_formato_de_sala : null ;?>
							</td>
							<td>
								<?php //= isset($sala->dth_inicio) ? mostraData($sala->dth_inicio): null ;?>
								<span class="label label-success"> 
									<?php //= isset($sala->hora_inicio) ? exibir_hora($sala->hora_inicio,'') : null ;?>
								</span>
							</td>
							<td>
								<?php //= isset($sala->dth_fim) ? mostraData($sala->dth_fim) : null ;?>
								<span class="label label-warning"> 
									<?php //= isset($sala->hora_fim) ? exibir_hora($sala->hora_fim,'') : null ;?>
								</span>
							</td>
							<td>
								<?php //= isset($sala->valor_total) ? moeda($sala->valor_total) : null ;?>
							</td>
							<td>
								<?php //= isset($sala->valor_total_taxas) ? moeda($sala->valor_total_taxas) : null ;?>
							</td>
							<td>
								<button name="alterar" value="<?php //= isset($sala->id_reserva_evento_sala) ? $sala->id_reserva_evento_sala : null ;?>" class=" btn btn-default"><i class="fa fa-pencil"></i></button>
								<!--<button name="excluir" value="<?php //= isset($sala->id_reserva_evento_sala) ? $sala->id_reserva_evento_sala : null ;?>" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>-->
								<a excluir="<?php //= isset($sala->id_reserva_evento_sala) ? $sala->id_reserva_evento_sala : null ;?>" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
							</td>

						</tr>
						<?php //  endforeach ?>
						
						<tr style="text-align: right; font-size: 16px; background-color:#FCF8E3">
							<td colspan="9" style="border-top: 0px;">
								<strong>Valor total: <?php //=  moeda($valor_total) ?></strong>
							</td>
						</tr>

						<tr style="text-align: right; font-size: 16px; background-color:#FCF8E3;">
							<td colspan="9" style="border-top: 0px;">
								<strong>ISS: <?php //=  moeda($valor_total_com_taxas - $valor_total) ?></strong>
							</td>
						</tr>

						<tr style="text-align: right; font-size: 16px; background-color:#FCF8E3">
							<td colspan="9"  style="border-top: 0px;">
								<strong>Total de pagamento: <?php //=  moeda($valor_total_com_taxas) ?></strong>
							</td>
						</tr>

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

<script>
	/*

	jQuery(document).ready(function() {

			$(document).on('click', 'a', function(event) {

			var id_reserva_evento_sala = $(this).attr('excluir');

			console.log(id_reserva_evento_sala);	
						
			if((id_reserva_evento_sala % 1) == 0){
				
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>eventos/Eventos_reserva_evento/excluir_reserva_de_sala",
					data: "id_reserva_evento_sala="+id_reserva_evento_sala,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							//window.location.reload(true);
							$("#divSalas").load("<?php echo current_url();?> #divSalas" );
						}
						else{
							alert('Ocorreu um erro ao tentar excluir a reserva de sala.');
						}
					}
				});

				return false;
			}

		});

		
		$("button[name=alterar]").click(function() {
		
			var id_reserva_evento_sala = $(this).val();

			var path = '<?php echo base_url(); ?>'
			
			if((id_reserva_evento_sala % 1) == 0){

				$.getJSON( path + 'eventos/Eventos_reserva_evento/ajax_retorna_reserva_sala/' + id_reserva_evento_sala, function (data){

					$.each(data, function(i, obj){				
						
						$('input[name="id_reserva_evento"]').attr( {value : obj.id_reserva_evento} );
						$('select[name=id_sala]').val(obj.id_sala).change();
						$('input[name=id_formato_de_sala]').val(obj.id_formato_de_sala);
						$('input[name="limite_pax_arrumacao"]').attr( {value : obj.limite_pax_arrumacao} );
						$('input[name="periodo_integral"]').attr( {value : obj.periodo_integral} );					
						$('input[name="dth_inicio"]').attr({value : obj.dth_inicio.split('-').reverse().join('/')});
						$('input[name="hora_inicio"]').attr( {value : obj.hora_inicio.substring(0, obj.hora_inicio.length -3)} );
						$('input[name="dth_fim"]').attr( {value : obj.dth_fim.split('-').reverse().join('/')} );
						$('input[name="hora_fim"]').attr( {value : obj.hora_fim.substring(0, obj.hora_fim.length -3)} );
						$('select[name="id_utilizacao_sala"]').val(obj.id_utilizacao_sala).change();			
						$('input[name="pax_estimadas"]').attr( {value : pax_estimadas = obj.pax_estimadas == 0 ? '' : obj.pax_estimadas} );
						$('input[name="pax_garantidas"]').attr( {value : obj.pax_garantidas} );
						$('input[name="tipo_tarifa"]').attr( {value : obj.tipo_tarifa} );
						$('input[name="trf_especial"]').attr( {value : obj.trf_especial} );
						$('input[name="trf_balcao"]').attr( {value : obj.trf_balcao} );
						$('input[name="valor_diaria"]').attr( {value : parseFloat(obj.valor_diaria).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })} );
						$('input[name="acrescimo"]').attr( {value : obj.acrescimo.replace(".",",")} );
						$('input[name="desconto"]').attr( {value : obj.desconto.replace(".",",")} );
						$('input[name="iss"]').attr( {value : obj.iss.replace(".",",")} );
						$('input[name="valor_total"]').attr( {value : parseFloat(obj.valor_total).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })} );
						$('input[name="valor_total_taxas"]').attr( {value : parseFloat(obj.valor_total_taxas).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })} );
						$('#observacoes_sala').val(obj.observacoes_sala);

					});	
					
					$("#basic").modal();
						
				});

				return false;
			}

		});

		$("#add_sala").click(function() {

			$('#basic').find('input[type="text"]').val('');
			$("select[name=id_sala]").val('').change();
			$("select[name=id_arrumacao]").val('').change();
			$("select[name=id_utilizacao_sala]").val('').change();
			$('#observacoes_sala').val('');
			$('input[name="iss"]').val('5,00');
			$('input[name="qtd_diarias"]').val('1');
			
			/**
			 * Iniciando a data de inicio da reserva com a data atual 
			 *
			var data = new Date;
			var dia = data.getDate();
			var mes = data.getMonth();
			var ano = data.getFullYear();

			var data_inicio = dia + '/' + (mes + 1) + '/' + ano;
			$('input[name="dth_inicio"]').val(data_inicio);

			var data_fim = (data.getDate() + 1) + '/' + (mes + 1) + '/' + ano;
			$('input[name="dth_fim"]').val(data_fim);
			
		});

	});
</script>