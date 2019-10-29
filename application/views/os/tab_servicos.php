<div class="row">
	<form id="formServicos" action="<?= base_url() ?>/os/adicionarServico" method="post">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Buscar Serviço</label>
				<input value="" id="servico" name="servico"  type="text" data-required="1" class="form-control"/>
				<input type="hidden" name="idOsServico" id="idOsServico" value="<?=  isset($show->id_os) ? $show->id_os : null ;?>" />
				<input type="hidden" name="idServico" id="idServico" />
				
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">Qtd.</label>
				<input value="" id="qtd" name="qtd"  type="text" class="form-control"/>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">Valor unit. </label>
				<input value="" id="precoServico_exib" name="precoServico_exib"  type="text" class="form-control"/>
				<input type="hidden" name="precoServico" id="precoServico" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label"> Valor Total </label>
				<input value="" id="valor_total_servico_exib" name="valor_total_servico_exib" disabled  type="text" class="form-control"/>
				<input type="hidden" name="valor_total_servico" id="valor_total_servico" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<button value="" type="submit" class="btn green-haze"><i class="fa fa-check"></i>Adcionar</button>
			</div>
		</div>
	</form>	
</div>

<script>

	jQuery(document).ready(function() {

		$("#servico").autocomplete({
			source: "<?= base_url(); ?>os/auto_complete_servico",
			minLength: 1,
			select: function( event, ui ) {
				$("#idServico").val(ui.item.id);
				$("#qtd").val('1');
				$("#precoServico").val(ui.item.preco);
				$("#precoServico_exib").val(ui.item.preco_exib);
				$("#valor_total_servico").val(ui.item.preco);
				$("#valor_total_servico_exib").val(ui.item.preco_exib);
				
			}
		});

		function moeda2float(ajuste_moeda){

			ajuste_moeda = ajuste_moeda.replace("R$","");

			ajuste_moeda = ajuste_moeda.replace(".","");

			ajuste_moeda = ajuste_moeda.replace(",",".");

			return parseFloat(ajuste_moeda);

		}

		function float2moeda(num) {

			x = 0;

			if(num<0) {
				num = Math.abs(num);
				x = 1;
			}

			if(isNaN(num)) num = "0";
			cents = Math.floor((num*100+0.5)%100);

			num = Math.floor((num*100+0.5)/100).toString();

			if(cents < 10) cents = "0" + cents;
			for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
				num = num.substring(0,num.length-(4*i+3))+'.'
			+num.substring(num.length-(4*i+3));

			ret = num + ',' + cents;    
			
			if (x == 1) ret = ' - ' + ret;
			return ret;

		}           
		

		$("#qtd").change(function(){

				    		//Pegando valor original
				    		valor_servico = $("#precoServico_exib").val();
				    		// Ajustando para moeda
				    		valor_moeda_ajuste = moeda2float(valor_servico);
				    		// Multiplicando pela quantidade
				    		valor_total_servico = $("#qtd").val()  * valor_moeda_ajuste;
				    		// Ajustando centavos
				    		valor_total_servico = valor_total_servico.toFixed(2);
				    		// Armazenando no hidden o valor total
				    		$("#valor_total_servico").val(valor_total_servico);
				    		//Pegando valor total
				    		valor_total_servico = $("#valor_total_servico").val();
				    	 	// Ajustando moenda para padrao brasileiro
				    	 	valor_total_servico = float2moeda(valor_total_servico);
				    	 	// Exibindo valor formatado
				    	 	$("#valor_total_servico_exib").val('R$ ' + valor_total_servico);
				    	 	
				    	 });

		$("#precoServico_exib").change(function(){

				    		//Pegando valor original
				    		valor_servico = $("#precoServico_exib").val();
				    		// Ajustando para moeda
				    		valor_moeda_ajuste = moeda2float(valor_servico);
				    		// Multiplicando pela quantidade
				    		valor_total_servico = $("#qtd").val()  * valor_moeda_ajuste;
				    		// Ajustando centavos
				    		valor_total_servico = valor_total_servico.toFixed(2);
				    		// Armazenando no hidden o valor total
				    		$("#valor_total_servico").val(valor_total_servico);
				    		$("#precoServico").val(valor_moeda_ajuste.toFixed(2));
				    		//Pegando valor total
				    		valor_total_servico = $("#valor_total_servico").val();
				    	 	// Ajustando moenda para padrao brasileiro
				    	 	valor_total_servico = float2moeda(valor_total_servico);
				    	 	// Exibindo valor formatado
				    	 	$("#valor_total_servico_exib").val('R$ ' + valor_total_servico);
				    	 	
				    	 });

		$('input[name="precoServico_exib"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 


		$("#formServicos").validate({
			rules:{
				servico: {required:true}
			},
			messages:{
				servico: {required: 'Insira um serviço'}
			},
			submitHandler: function( form ){       
				
				$("#divServicos").html("<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 80%'><span class='sr-only'>80% Complete (success) </span></div></div>");

				var dados = $( form ).serialize();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>os/adicionarServico",
					data: dados,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$( "#divServicos" ).load("<?= base_url() ?>servicos/ordem-de-servico/editar/<?=  isset($show->id_os) ? $show->id_os : null ;?> #divServicos" );
							
							$("#servico").val('').focus();
							$("#qtd").val('') ;
							$("#precoServico").val('');
							$("#valor_total_s").val(''); 
						}
						else{
							alert('Ocorreu um erro ao tentar adicionar serviço.');
						}
					}
				});

				return false;
			}

		});

		$(document).on('click', 'a', function(event) {
			var idServico = $(this).attr('idAcao');

			if((idServico % 1) == 0){
				
				$("#divServicos").html("<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 80%'><span class='sr-only'>80% Complete (success) </span></div></div>");

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>os/excluirServico",
					data: "idServico="+idServico,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$("#divServicos").load("<?php echo current_url();?> #divServicos" );

						}
						else{
							alert('Ocorreu um erro ao tentar excluir serviço.');
						}
					}
				});
				return false;
			}

		});

	});
</script>

<!-- Serviços -->	
<div class="row">
	<div class="col-xs-12">
		<table class="table table-striped table-hover" id="divServicos">
			<thead>
				<tr>
					<th>
						Serviço 
					</th>
					<th width="10%">
						Qtd.
					</th>
					<th width="10%">
						Valor unit.
					</th>
					<th width="10%">
						Valor Total
					</th>
					<th width="10%">
						
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 

								/**
								 * Grande Valor total inicia com ZERO
								 */
								$grande_valor_total = 0;
								/**
								 * Listando registros da tabela
								 * Listing table records
								 */

								foreach ($itens_os_servico as $item):
									

									if (isset($item->valor_total)){

										$valor_item = $item->valor_total;
										
									}
									else
									{
										$valor_item = 0;
									}	

									/**
									 * Grande Valor Total
									 */

									$grande_valor_total = $grande_valor_total + $valor_item;



									/**
									 * Listar registros da tabela
									 * Change Active Label
									 */
									?>	
									<tr>
										<td>
											<?=  isset($item->nome) ? $item->nome : null ;?>
										</td>
										<td>
											<?=  isset($item->qtd) ? $item->qtd : null ;?>
										</td>
										<td>
											<?=  isset($item->valor_unit) ? moeda($item->valor_unit) : null ;?>
										</td>
										<td>
											<?=  isset($item->valor_total) ? moeda($item->valor_total) : null ;?>
										</td>
										<td>
											<a idAcao=" <?=  isset($item->id_proser_os) ? $item->id_proser_os : null ;?>" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
										</td>
										
									</tr>
								<?php endforeach ?>

								<?php if ($grande_valor_total != 0){ ?>

								<tr style="text-align: right; font-size: 16px;">
									<td colspan="4"><strong>Grande Valor Total:</strong></td>
									<td style="text-align: left;""><strong><?= moeda($grande_valor_total) ?>
										<input type="hidden" id="total-venda-servicos" value="<?= $grande_valor_total ?>"></strong></td>
									</tr>

									<?php } ?>	

								</tbody>
							</table>
							
						</div>

					</div>