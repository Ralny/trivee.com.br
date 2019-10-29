<div class="row">
	<form id="formProduto" action="<?= base_url() ?>/os/adicionarServico" method="post">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Buscar Produto</label>
				<input value="" id="produto" name="produto"  type="text" data-required="1" class="form-control"/>
				<input type="hidden" name="idOsServico" id="idOsServico" value="<?=  isset($show->id_os) ? $show->id_os : null ;?>" />
				<input type="hidden" name="idProduto" id="idProduto" />				
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">Qtd.</label>
				<input value="" id="qtdProduto" name="qtdProduto"  type="text" class="form-control"/>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">Valor unit. </label>
				<input value="" id="precoProduto_exib" name="precoProduto_exib"  type="text" class="form-control"/>
				<input type="hidden" name="precoProduto" id="precoProduto" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label"> Valor Total </label>
				<input value="" id="valor_total_produto_exib" name="valor_total_produto_exib" disabled  type="text" class="form-control"/>
				<input type="hidden" name="valor_total_produto" id="valor_total_produto" />
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

		$("#produto").autocomplete({
			source: "<?= base_url(); ?>os/auto_complete_produto",
			minLength: 1,
			select: function( event, ui ) {
				$("#idProduto").val(ui.item.id);
				$("#qtdProduto").val('1');
				$("#precoProduto").val(ui.item.preco);
				$("#precoProduto_exib").val(ui.item.preco_exib);
				$("#valor_total_produto").val(ui.item.preco);
				$("#valor_total_produto_exib").val(ui.item.preco_exib);

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


		$("#qtdProduto").change(function(){

				    		//Pegando valor original
				    		valor_produto = $("#precoProduto_exib").val();
				    		// Ajustando para moeda
				    		valor_moeda_ajuste = moeda2float(valor_produto);
				    		// Multiplicando pela quantidade
				    		valor_total_produto = $("#qtdProduto").val()  * valor_moeda_ajuste;
				    		// Ajustando centavos
				    		valor_total_produto = valor_total_produto.toFixed(2);
				    		// Armazenando no hidden o valor total
				    		$("#valor_total_produto").val(valor_total_produto);
				    		//Pegando valor total
				    		valor_total_produto = $("#valor_total_produto").val();
				    	 	// Ajustando moenda para padrao brasileiro
				    	 	valor_total_produto = float2moeda(valor_total_produto);
				    	 	// Exibindo valor formatado
				    	 	$("#valor_total_produto_exib").val('R$ ' + valor_total_produto);

				    	 });

		$("#precoProduto_exib").change(function(){

				    		// Pegando valor original
				    		valor_produto = $("#precoProduto_exib").val();
				    		// Ajustando para moeda
				    		valor_moeda_ajuste = moeda2float(valor_produto);
				    		// Multiplicando pela quantidade
				    		valor_total_produto = $("#qtdProduto").val()  * valor_moeda_ajuste;
				    		// Ajustando centavos
				    		valor_total_produto = valor_total_produto.toFixed(2);
				    		// Armazenando no hidden o valor total
				    		$("#valor_total_produto").val(valor_total_produto);
				    		$("#precoProduto").val(valor_moeda_ajuste.toFixed(2));
				    		// Pegando valor total
				    		valor_total_produto = $("#valor_total_produto").val();
				    	 	// Ajustando moenda para padrao brasileiro
				    	 	valor_total_produto = float2moeda(valor_total_produto);
				    	 	// Exibindo valor formatado
				    	 	$("#valor_total_produto_exib").val('R$ ' + valor_total_produto);
				    	 	
				    	 });

		$('input[name="precoProduto_exib"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 


		$("#formProduto").validate({
			rules:{
				produto: {required:true}
			},
			messages:{
				produto: {required: 'Insira um serviço'}
			},
			submitHandler: function( form ){       

				$("#divProdutos").html("<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 80%'><span class='sr-only'>80% Complete (success) </span></div></div>");

				var dados = $( form ).serialize();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>os/adicionarProduto",
					data: dados,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$( "#divProdutos" ).load("<?= base_url() ?>servicos/ordem-de-servico/editar/<?=  isset($show->id_os) ? $show->id_os : null ;?> #divProdutos" );

							$("#produto").val('').focus();
							$("#qtdProduto").val('') ;
							$("#precoProduto_exib").val('');
							$("#valor_total_produto_exib").val(''); 
						}
						else{
							alert('Ocorreu um erro ao tentar adicionar produto.');
						}
					}
				});

				return false;
			}

		});

		$(document).on('click', 'a', function(event) {
			var idProduto = $(this).attr('idAcao');

			if((idProduto % 1) == 0){

				$("#divServicos").html("<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 80%'><span class='sr-only'>80% Complete (success) </span></div></div>");

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>os/excluirProduto",
					data: "idProduto="+idProduto,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$("#divProdutos").load("<?php echo current_url();?> #divProdutos" );

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

<!-- Serviços -->
<div class="row">
	<div class="col-xs-12">
		<table class="table table-striped table-hover" id="divProdutos">
			<thead>
				<tr>
					<th>
						Produtos 
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

					foreach ($itens_os_produto as $item):
						

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
							<input type="hidden" id="total-venda-produtos" value="<?= $grande_valor_total ?>"></strong></td>
						</tr>

						<?php } ?>	

					</tbody>
				</table>
				
			</div>

		</div>