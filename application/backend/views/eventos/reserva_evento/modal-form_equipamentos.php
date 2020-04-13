<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('../application/backend/views/tpl/config_container.php');
?>
<div class="modal fade" id="equipamento" tabindex="-1" role="basic" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="width: 1100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title">Adicionar equipamento</h2>
				</div>
				<div class="modal-body">
				
				<div class="portlet-body form" id="div_adicionar_salas">
				<!-- BEGIN FORM-->
				<form action="<?= base_url().$url ?>/adicionar_reserva_de_sala" method="post" name="form_sample_2" id="form_sample_2" <?= $form_class ?>>
					<input type="hidden" name="id_reserva_evento" value="<?=  isset($show->id_reserva_evento) ? $show->id_reserva_evento : null ;?>">
				
					<div class="form-actions top" style="background: #f5f5f5;padding-left: 10px;">
						<button name="salvar_sala" value="salvar" type="submit" class="btn btn-default"><i class="fa fa-save"></i> Salvar</button>
					</div>

					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>

						<?php 

						    /**
							 * Verificar o status do registro e se botão ATIVO ira ficar marcado
							 * quando o formulario estiver em modo de edição
							 * Check the status of the record and if the ACTIVE button will be marked
							 * When the form is in edit mode
							 */
							if (isset($form_editar)){ 

								/**
								 * Se for 'S', este registro está ativo
								 * If 'S', this record is active
								 */
								if ($show->sit_ativo == 'S')
								{
									$checked = 'checked';
								}
								else
								{
									/**
									 * não está ativo
									 * Is not active
									 */
									$checked = '';
								}
							}
							else
							{
								/**
								 * Formulario em modo de Cadastro por padrao ficará ativo
								 * Form in Registration mode by default will be active
								 */
								$checked 		= 'checked';
							}		

						?>		
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Equipamento<span class="required" aria-required="true"> * </span></label>
									<select id="id_sala_equipamento" name="id_sala_equipamento" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										
										foreach ($lista_equipamentos as $row): 
										?>
											<option value="<?= $row->id_equipamento ?>" <?=  $select ?>><?= $row->desc_equipamento ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Quantidade<span class="required" aria-required="true"> * </span></label>								
									<div class="input-group">
										<input name="hora_fim_equipamento" data-required="1" type="text" class="form-control"/>
										<span class="input-group-addon"><i class="fa fa-shopping-cart"></i></span>
									</div>
								</div>
							</div>
						</div>	
						
						<hr>
												
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<div class="well" style="background-color: #fcf8e3">
										<label class="control-label" style="margin-right: 30px;"><h4>Período Integral ? </h4></label>
										<input name="periodo_integral"  id="periodo_integral" type="checkbox" checked  data-checkbox="icheckbox_square-blue">
									</div>
								</div>
							</div>
						</div>			

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Sala<span class="required" aria-required="true"> * </span></label>
									<select id="id_sala" name="id_sala" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										
										foreach ($lista_salas as $row): 
										?>

											<option value="<?= $row->id_sala ?>" <?=  $select ?>><?= $row->nome_sala ?></option>
										<?php endforeach ?>
									</select>

								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Data de Início<span class="required" aria-required="true"> * </span></label>
									<div class="input-group date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
									<input type="text" class="form-control" name="dth_inicio" id="dth_inicio" value="">
										<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>	
								</div>
							</div>
							
							<div class="col-md-2">
								<label class="control-label">Horário</label>
								<div class="input-group date">
									<input disabled name="hora_inicio" type="text" value="<?php //=  isset($show->hora_realizacao) ? $show->hora_realizacao : null ;?>"  class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Data do Fim<span class="required" aria-required="true"> * </span></label>
									<div class="input-group date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
										<input type="text" class="form-control" name="dth_fim" id="dth_fim">
											<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
									</div>			
								</div>
							</div>

							<div class="col-md-2">
								<label class="control-label">Horário</label>
								<div class="input-group date">
									<input disabled name="hora_fim" type="text" value="<?php //=  isset($show->hora_realizacao) ? $show->hora_realizacao : null ;?>"  class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>
						</div>

						<hr>

						<div class="row">

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Valor Diária</label>
									<input readonly name="valor_diaria"  type="text" class="form-control"/>
									<input type="hidden" name="qtd_diarias">	
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Acréscimo</label>
									<div class="input-group">
										<input name="acrescimo" data-required="1" type="text" class="form-control"/>
										<span class="input-group-addon">%</i></span>
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Desconto</label>
									<div class="input-group">
										<input name="desconto" data-required="1" type="text" class="form-control"/>
										<span class="input-group-addon">%</i></span>
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">ISS</label>
									<div class="input-group">
										<input readonly name="iss" data-required="1" type="text" class="form-control" value="5,00"/>
										<span class="input-group-addon">%</i></span>
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Valor Total</label>
									<input  readonly name="valor_total"  data-required="1" type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Valor Total c/ Taxas</label>
									<input readonly name="valor_total_taxas" type="text" class="form-control"/>
								</div>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-md-9">
								<div class="form-group">
									<label class="control-label">Observações</label>
									<textarea id="observacoes_sala"  name="observacoes_sala" class="form-control autosizeme" rows="6" data-autosize-on="true" style="overflow-y: hidden; resize: horizontal; height: 134px;" aria-invalid="false"></textarea>
								</div>
							</div>
						</div>
														
					</div>
					<br>
					<?php  //$this->load->view('tpl/forms-info-alter-registro') ?>
					<?php //$this->load->view('tpl/forms-btn-actions-save') ?>
				</form>
				<!-- END FORM-->
			</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!--<script src="https://momentjs.com/downloads/moment.min.js"></script>-->

	<!-- VALIDAÇÃO -->
<script>
	/*
window.onload = function () {
	
    document.getElementsByName("dth_inicio")[0].addEventListener('change', doThing);
    
    function doThing()
    {
        alert('Horray! Someone wrote "' + this.value + '"!');
    }
}	
*/

jQuery(document).ready(function() {

	<?php
	/**
	 * Botao fechar do formulario 
	 * Close form button
	 */
	?>
	$('#fechar').click(function() {

		<?php
		/**
		 * Retorna para listagem
		 * Return to listing
		 */
		?>
		$(location).attr('href', '<?= base_url().$url."/listar"?>');
	});

	<?php
	/**
	 * Iniciar Validação do formulario
	 * Start Form Validation
	 */
	?>
	FormValidation.init();

	<?php
	/**
	 * Passando ação do button do formulario 
	 * Passing form button action
	 */
	?>
	$("button").click(function() {

		<?php
		/**
		 * Recebe o value do button clicado 
		 * Receive value of button clicked
		 */
		?>
		var acao = this.value;

		<?php
		/**
		 * Altera o value do hidden que vai no POST do formulario
		 * Change the value of hidden that goes in the POST of the form
		 */
		?>
		$("#acao").attr('value', acao);
	});

	<?php
	/**
	 * Valida habilita tempo integral ou não da reserva de sala
	 */
	?>
	$('#periodo_integral').click(function() {

		if ($(this).prop( "checked"))
		{
			$('input[name="hora_inicio"]').prop("disabled", true);
			$('input[name="hora_fim"]').prop("disabled", true);
		}
		else
		{
			$('input[name="hora_inicio"]').prop("disabled", false);	
			$('input[name="hora_fim"]').prop("disabled", false);
		} 
	
	});

	<?php
	/**
	 * Mascaras 
	 */
	?>
	//$('input[name="dth_inicio"]').mask('99/99/9999');	
	//$('input[name="dth_fim"]').mask('99/99/9999');

	$('input[name="valor_diaria"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 
	$('input[name="valor_total"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','});
	$('input[name="valor_total_taxas"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 

	$('input[name="acrescimo"]').maskMoney({thousands:'.',decimal:','});  
	$('input[name="desconto"]').maskMoney({thousands:'.',decimal:','});  
	$('input[name="iss"]').maskMoney({thousands:'.',decimal:','}); 

	$('input[name="pax_estimadas"]').inputmask({
		"mask": "9",
		"repeat": 10,
		"greedy": false
	});

	$('input[name="pax_garantidas"]').inputmask({
		"mask": "9",
		"repeat": 10,
		"greedy": false
	});

	<?php
	/**
	 * Verificando o limite de PAX estimadas na arrumação 
	 */	
	?>	
	 $("input[name=pax_estimadas]").blur(function() {

		var pax_estimadas = $("input[name=pax_estimadas]").val();
		pax_estimadas = parseInt(pax_estimadas);

		var limite_pax_arrumacao = $("input[name=limite_pax_arrumacao]").val();			
		limite_pax_arrumacao = parseInt(limite_pax_arrumacao);

		if (pax_estimadas > limite_pax_arrumacao) 
		{
			$("input[name=pax_estimadas]").attr('value','');
			$("input[name=pax_estimadas]").focus();
			alert('A quantidade de PAX Estimadas não pode ser superior ao limite Maximo de Pax da arrumação selecionada.');
			return false;
		} 
		else 
		{ 
			return true; 
		}
	});

	<?php
	/**	
	 * Verificando o limite de PAX garantidas na arrumação 
	 */
	?>	
	$("input[name=pax_garantidas]").blur(function() {

		var pax_estimadas = $("input[name=pax_garantidas]").val();
		pax_estimadas = parseInt(pax_estimadas);

		var limite_pax_arrumacao = $("input[name=limite_pax_arrumacao]").val();			
		limite_pax_arrumacao = parseInt(limite_pax_arrumacao);

		if (pax_estimadas > limite_pax_arrumacao) 
		{
			$("input[name=pax_garantidas]").attr('value','');
			$("input[name=pax_garantidas]").focus();
			alert('A quantidade de PAX Garantidas não pode ser superior ao limite Maximo de Pax da arrumação selecionada.');
			return false;
		} 
		else 
		{ 
			return true; 
		}
	});

	<?php
	/**
	 * Alterar tarifas balcão e Especial + ISS
	 */
	?>
	$("#balcao").click(function() {
		<?php
		/**
		 * Alterar para tarifa Balcao
		 */
		?>
		if ($(this).prop("checked", true)){
			
			$('input[name="desconto"]').attr( {value : ''} );
			$('input[name="acrescimo"]').attr( {value : ''} );
			
			<?php
			/**
			 * Setando os valores originais nos campos
			 */
			?>
			var trf_balcao = moeda2float2($('input[name="trf_balcao"]').val());
			
			trf_balcao = trf_balcao.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_diaria"]').attr( {value : trf_balcao} );
			$('input[name="valor_total"]').attr( {value : trf_balcao} );
			
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = Valor da diaria + ISS
			 */
			?>
			var valor_iss = ajusta_iss(trf_balcao);
			var valor_total_taxas = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_total_taxas} );
			
		}
	});	

	$("#especial_iss").click(function() {
		<?php
		/**
		 * Alterar para tarifa Especial + ISS
		 */
		?>
		if ($(this).prop("checked", true)){
			
			$('input[name="desconto"]').attr( {value : ''} );
			$('input[name="acrescimo"]').attr( {value : ''} );

			<?php
			/**
			 * Setando os valores originais nos campos
			 */
			?>
			var trf_especial = moeda2float2($('input[name="trf_especial"]').val());
			trf_especial = trf_especial.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_diaria"]').attr( {value : trf_especial} );
			$('input[name="valor_total"]').attr( {value : trf_especial} );

			<?php
			/**
			 * VALOR TOTAL COM TAXAS = Valor da diaria + ISS
			 */
			?>
			var valor_iss = ajusta_iss(trf_especial);
			var valor_total_taxas = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_total_taxas} );

		}
	});

	<?php
	/**
	 * Verificando o limite de PAX estimadas na arrumação 
	 */	
	?>
	/* event listener 
    
		
	document.getElementById("dth_inicio").addEventListener("change", function(){
	//$("input[name=dth_inicio]").change(function() {

		//document.getElementById("dth_inicio").addEventListener("click", teste);
		//console.log(document.getElementById("dth_inicio"));

		var dth_inicio = formatDate($("input[name=dth_inicio]").val());
		var dth_fim    = formatDate($("input[name=dth_fim]").val());

		var time1 = moment(dth_inicio).format('YYYY-MM-DD');
		var time2 = moment(dth_fim).format('YYYY-MM-DD');

		if(time2 > time1){
			//console.log('Data Inicial: '+ time1);
			//console.log('Data Final: '+ time2);
			//console.log('Data final é maior');
		}else if(time2 < time1){
			$("input[name=dth_inicio]").attr('value','');
			$("input[name=dth_inicio]").focus();
			alert('A data inicial não pode ser maior que a data final.');
			return false;
		}else{
			//console.log('Data Inicial: '+ time1);
			//console.log('Data Final: '+ time2);
			//console.log('Datas iguais');
			//alert('As datas são iguais.');
			//return false;
		}
		
		// use "moment()" para a data/hora atual
		//var dth_inicio= moment(formatDate($("input[name=dth_inicio]").val()));
		//'console.log(dth_inicio);
		//var dth_inicio = new Date(formatDate($("input[name=dth_inicio]").val()));

		// por padrão, já usa o timezone do browser (em vez de UTC)
		//onsole.log(d.format('YYYY-MM-DD[T]HH:mm:ss')); // 2018-11-17T14:22:29

		//var dth_inicio = new Date(formatDate($("input[name=dth_inicio]").val()));
		//var dth_fim    = new Date(formatDate($("input[name=dth_fim]").val()));

		//console.log( dth_inicio.toGMTString());

		//console.log(dth_inicio);
		//console.log(dth_fim);

		// Verifico se primeira data é igual, maior ou menor que a segunda
		/*if (dth_inicio.getTime() === dth_fim.getTime()) {
			console.log('As datas são iguais');
		}
		else if (dth_inicio.getTime() > dth_fim.getTime()) {
			//console.log(dth_inicio.toString() + ' maior que ' + dth_fim.toString());
			console.log('Data Inicil é maior');
		}
		else {
			//console.log(dth_inicio.toString() + ' menor que ' + dth_fim.toString());
			console.log('Data inicial é menor');
		}
		/*
		var pax_estimadas = $("input[name=pax_estimadas]").val();
		pax_estimadas = parseInt(pax_estimadas);

		var limite_pax_arrumacao = $("input[name=limite_pax_arrumacao]").val();			
		limite_pax_arrumacao = parseInt(limite_pax_arrumacao);

		if (pax_estimadas > limite_pax_arrumacao) 
		{
			$("input[name=pax_estimadas]").attr('value','');
			$("input[name=pax_estimadas]").focus();
			alert('A quantidade de PAX Estimadas não pode ser superior ao limite Maximo de Pax da arrumação selecionada.');
			return false;
		} 
		else 
		{ 
			return true; 
		} */
	//});
	
	
	
	<?php
	/**
	 * Calcula o ISS
	 */
	?>
	function ajusta_iss(valor_diaria_sem_iss){

		var valor_diaria = moeda2float(valor_diaria_sem_iss);
		var iss = moeda2float($("input[name=iss]").val());

		var valor_diaria_com_iss = valor_diaria + ( valor_diaria * (iss / 100));
		
		return valor_diaria_com_iss;
		
	}

	<?php
	/**
	 * Calcula o acrescimo
	 */
	?>
	function ajusta_acrescimo(valor, percentual){

		var valor_total_diaria = valor +  ( valor * (percentual / 100));
				
		return valor_total_diaria;

	}
	
	<?php
	/**
	 * Quando for inserido o valor do acrescimo
	 */
	?>
	$("input[name=acrescimo]").change(function(){

		<?php
		/**
		 * Reseta o campo desconto
		 */
		?>
		$('input[name="desconto"]').attr( {value : ''} );

		var tarifa      = moeda2float($('input[name="valor_diaria"]').val());
		var acrescimo = $("input[name=acrescimo]").val();

		console.log(acrescimo);
		var qtd_diarias = diferenca_entre_datas($("input[name=dth_inicio]").val(), $("input[name=dth_fim]").val());
		var valor_total 	= multiplica_diaria_valor_de_sala(qtd_diarias, tarifa);
		<?php
		/**
		 * Se o acrescimo for 0 ou NULO, deve retornar ao valores iniciais
		 */
		?>
		if (acrescimo == '' || acrescimo == 0 ){
			<?php
			/**
			 * VALOR TOTAL = valor da diaria
			 */
			?>
			valor_total_exibir = valor_total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_total_exibir} );
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = Valor da diaria + ISS
			 */
			?>
			valor_total = $("input[name=valor_total]").val();	
			var valor_iss = ajusta_iss(valor_total);
			var valor_acrescimo_iss = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_acrescimo_iss} );
		}
		else
		{
			<?php
			/**
			 *  Se o acrescimo for maior que 0
			 *  VALOR TOTAL = VALOR DIARIA + ACRESCIMO 
			 */
			?>	
			var valor_acrescimo = ajusta_acrescimo(valor_total, moeda2float(acrescimo));
			valor_acrescimo = valor_acrescimo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_acrescimo} );
			
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = VALOR (DIARIA + ACRESCIMO) + ISS 
			 */
			?>		
			valor_total = $("input[name=valor_total]").val();	
			var valor_iss = ajusta_iss(valor_total);
			valor_acrescimo_iss = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_acrescimo_iss} );
		}

	});

	<?php
	/**
	 * Calcula o desconto
	 */
	?>
	function ajusta_desconto(valor, percentual){

		var valor_total_diaria = valor - ( valor * (percentual / 100));
				
		return valor_total_diaria;

	}
	<?php
	/**
	 * Calcular Desconto
	 */
	?>
	$("input[name=desconto]").change(function(){

		<?php
		/**
		 * Reseta o campo acrescimo
		 */
		?>
		$('input[name="acrescimo"]').attr( {value : ''} );

		var tarifa      = moeda2float($('input[name="valor_diaria"]').val());
		var desconto 	= $("input[name=desconto]").val();
		var qtd_diarias = diferenca_entre_datas($("input[name=dth_inicio]").val(), $("input[name=dth_fim]").val());
		var valor_total 	= multiplica_diaria_valor_de_sala(qtd_diarias, tarifa);
		<?php
		/**
		 * Se o desconto for 0 ou NULO, deve retornar ao valores iniciais
		 */
		?>
		if (desconto == '' || desconto == 0 ){
			<?php
			/**
			 * VALOR TOTAL = valor da diaria
			 */
			?>
			valor_total_exibir = valor_total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_total_exibir} );
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = Valor da diaria + ISS
			 */
			?>
			valor_total = $("input[name=valor_total]").val();	
			var valor_iss = ajusta_iss(valor_total);
			valor_desconto_iss = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_desconto_iss} );
		}
		else
		{
			<?php
			/**
			 *  Se o desconto for maior que 0
			 *  VALOR TOTAL = VALOR DIARIA + ACRESCIMO 
			 */
			?>	
			var valor_desconto = ajusta_desconto(valor_total, moeda2float(desconto));
			valor_desconto = valor_desconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_desconto} );
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = VALOR (DIARIA - DESCONTO) + ISS 
			 */
			?>
			valor_total = $("input[name=valor_total]").val();	
			var valor_iss = ajusta_iss(valor_total);
			valor_desconto_iss = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_desconto_iss} );
		}

	});

	<?php
	/**
	 * QUANDO ALTERAR A DATA INICIAL - RECALCULA A QUANTIDADE DE DIARIAS 
	 */
	?>
	$("input[name=dth_inicio]").change(function(){
		<?php
		/**
		 * CALCULA A QUANTIDADE DE DIARIAS= DATA_FIM - DATA_INICIO
		 */
		?>
		var qtd_diarias = diferenca_entre_datas($("input[name=dth_inicio]").val(), $("input[name=dth_fim]").val());
		<?php
		/**
		 * ALTERA A QUANTIDADE DE DIARIAS - SALVAS NO BANCO
		 */
		?>
		$('input[name="qtd_diarias"]').attr( {value : qtd_diarias} );
		<?php
		/**
		 * VALOR DA TARIFA DA SALA - INDEPENDETEMENTE SE FOR TRF BALCAO OU TRF ESPECIAL + ISS
		 */
		?>
		var tarifa = moeda2float($('input[name="valor_diaria"]').val());
		<?php
		/**
		 * MULTIPLICA A QTD DIARIAS PELO VALOR COBRADO NA DIARIA DA SALA
		 */
		?>
		var valor_total 		= multiplica_diaria_valor_de_sala(qtd_diarias, tarifa);
		<?php
		/**
		 * calcular iss em cima do valor total
		 */
		?>
		var valor_total_com_iss = ajusta_iss($("input[name=valor_total]").val());
		<?php
		/**
		 * AJUSTA O PARA REAL
		 */
		?>
		valor_total 		=  valor_total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
		valor_total_com_iss =  valor_total_com_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
		<?php
		/**
		 * EXIBI NOS CAMPOS DA VIEW
		 */
		?>
		$('input[name="valor_total"]').attr( {value : valor_total} );
		$('input[name="valor_total_taxas"]').attr( {value : valor_total_com_iss} );
	});

	<?php
	/**
	 * QUANDO ALTERAR A DATA FINAL - RECALCULA A QUANTIDADE DE DIARIAS 
	 */
	?>
	$("input[name=dth_fim]").change(function(){
		<?php
		/**
		 * CALCULA A QUANTIDADE DE DIARIAS= DATA_FIM - DATA_INICIO
		 */
		?>
		var qtd_diarias = diferenca_entre_datas($("input[name=dth_inicio]").val(), $("input[name=dth_fim]").val());
		<?php
		/**
		 * ALTERA A QUANTIDADE DE DIARIAS - SALVAS NO BANCO
		 */
		?>
		$('input[name="qtd_diarias"]').attr( {value : qtd_diarias} );
		<?php
		/**
		 * VALOR DA TARIFA DA SALA - INDEPENDETEMENTE SE FOR TRF BALCAO OU TRF ESPECIAL + ISS
		 */
		?>
		var tarifa = moeda2float($('input[name="valor_diaria"]').val());
		<?php
		/**
		 * MULTIPLICA A QTD DIARIAS PELO VALOR COBRADO NA DIARIA DA SALA
		 */
		?>
		var valor_total 		= multiplica_diaria_valor_de_sala(qtd_diarias, tarifa);
		<?php
		/**
		 * calcular iss em cima do valor total
		 */
		?>
		var valor_total_com_iss = ajusta_iss($("input[name=valor_total]").val());
		<?php
		/**
		 * AJUSTA O PARA REAL
		 */
		?>
		valor_total 		=  valor_total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
		valor_total_com_iss =  valor_total_com_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
		<?php
		/**
		 * EXIBI NOS CAMPOS DA VIEW
		 */
		?>
		$('input[name="valor_total"]').attr( {value : valor_total} );
		$('input[name="valor_total_taxas"]').attr( {value : valor_total_com_iss} );
	});


var path = '<?php echo base_url(); ?>';
<?php
/**
 * A funçao ira executa quando houver mudança no combobox
 */
?>	
$("select[name=id_sala]").change(function(){
	
	$("input[name=limite_pax_arrumacao]").attr('value','');
	
	id_sala = $(this).val();

	<?php
	/**
	 * A Verifica se esta vazio
	 */
	?>
	if ( id_sala === '')
		return false;
	
	<?php
	/**
	 * Limpa o bombo dinamico que vai ser preenchido
	 */
	?>	
	resetaCombo('id_arrumacao');

	<?php
	/**
	 * Enviando Pesquisa
	 */
	?>
	$.getJSON( path + 'eventos/Eventos_reserva_evento/ajax_combo_arrumacao/' + id_sala, function (data){

		<?php
		/**
		 * Criando combo dinamico com as arrumações pre-cadastrasdas
		 */
		?>
		var option = new Array();
		<?php
		/**
		 * Preenchendo Combo com as informações de filtragem
		 */
		?>
		$.each(data, function(i, obj){
			<?php
			/**
			 * Criando Elemento
			 */
			?>
			option[i] = document.createElement('option');
			<?php
			/**
			 * Value
			 */
			?>
			$( option[i] ).attr( {value : obj.id_formato_de_sala} );
			<?php
			/**
			 * Label
			 */
			?>
			$( option[i] ).append( obj.desc_formato_de_sala);
			<?php
			/**
			 * Adcionando
			 */
			?>
			$("select[name='id_arrumacao']").append( option[i] );
		
		});

			/**
			 * Observação para essa condicional
			 * So entra nela quando o form de alteração estilo modal é acessado
			 * Quando dou o get dos dados via ajax, preciso fazer o preenchimento do campo que ja é dinamico via ajax tambem, preciso setar o formato de sala
			 * 
			 */
			$('input[name=id_formato_de_sala]').val() != "" ? $('select[name=id_arrumacao]').val($('input[name=id_formato_de_sala]').val()).change() : '';
			
	});

	<?php
	/**
	 * Buscando dados informações adicionais da sala
	 */
	?>
	$.getJSON( path + 'eventos/Eventos_salas/ajax_get_sala/' + id_sala, function (data){
		
		$.each(data, function(i, obj){
			<?php
			/**
			 * Formatado valor para exibir na tele para R$
			 */
			?>
			var trf_especial_formatado = parseFloat(obj.valor_diaria_trf_especial_iss);
			trf_especial_formatado = trf_especial_formatado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

			<?php
			/**
			 * Armazerndo informacoes
			 */
			?>
			$('input[name="trf_balcao"]').attr( {value : obj.valor_diaria_trf_balcao} );
			$('input[name="trf_especial"]').attr( {value : obj.valor_diaria_trf_especial_iss} );
			$('input[name="valor_diaria"]').attr( {value : trf_especial_formatado} );
			$('input[name="valor_total"]').attr( {value : trf_especial_formatado} );

			var valor_total_taxas = ajusta_iss($("input[name=valor_diaria]").val());
			valor_total_taxas = valor_total_taxas.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_total_taxas} );

		});
	
	});

});

	<?php
	/**
	 * A funçao ira executa quando houver mudança no combob
	 */
	?>
	$("select[name=id_arrumacao]").change(function(){

		var id_formato_de_sala = $(this).val();

		var id_sala = $("select[name=id_sala]").val();

		<?php
		/**
		 * A Verifica se esta vazio
		 */
		?>
		if ( id_formato_de_sala === '')
			return false;
		
		<?php
		/**
		 * Buscando dados informações adicionais da sala
		 */
		?>
		$.getJSON( path + 'eventos/Eventos_salas/ajax_get_arrumacao/' + id_formato_de_sala+'/'+ id_sala, function (data){

			$.each(data, function(i, obj){
				<?php
				/**
				 * Armazerndo informacoes
				 */
				?>
				$('input[name="limite_pax_arrumacao"]').attr( {value : obj.num_pax} );
			});
		});

	});

	


	
});
</script>



