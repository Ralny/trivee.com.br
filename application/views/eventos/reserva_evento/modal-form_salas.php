<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
?>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="width: 1100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title">Adicionar salas</h2>
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
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Sala<span class="required" aria-required="true"> * </span></label>
									<select id="id_sala" name="id_sala" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										
										foreach ($lista_salas as $row): 

											if(isset($form_editar))
											{
											/*	if($show->id_sala == $row->id_sala ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
												*/
											}
											?>
											<option value="<?= $row->id_sala ?>" <?=  $select ?>><?= $row->nome_sala ?></option>
										<?php endforeach ?>
									</select>

								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Formato<span class="required" aria-required="true"> * </span></label>
									<input type="hidden" name="id_formato_de_sala" id="id_formato_de_sala">
									<select id="id_arrumacao" name="id_arrumacao" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
									</select>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Número de PAX</label>
									<div class="input-group input-small">
									<input readonly value="<?php //=  isset($show->nome_sala) ? $show->nome_sala : null ;?>" name="limite_pax_arrumacao" type="text" class="form-control"/>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-users"></i></button>
												</span>
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
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Data de Início<span class="required" aria-required="true"> * </span></label>
									<div class="input-group date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
									<input type="text" class="form-control" name="dth_inicio" id="dth_inicio" value="" aria-required="true" aria-invalid="false">
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

							<div class="col-md-3">
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

						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Utilização da Sala<span class="required" aria-required="true"> * </span></label>
									<select id="id_utilizacao_sala" name="id_utilizacao_sala" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										
										foreach ($lista_utilizacao_de_sala as $row): 

											if(isset($form_editar))
											{
											/*	if($show->id_sala == $row->id_sala ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
												*/
											}
											?>
											<option value="<?= $row->id_utilizacao_sala ?>" <?=  $select ?>><?= $row->desc_utilizacao_sala ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Pax Estimadas</label>
									<div class="input-group">
									<input value="<?php //=  isset($show->nome_sala) ? $show->nome_sala : null ;?>" name="pax_estimadas"  id="pax_estimadas" data-required="1" type="text" class="form-control"/>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-users"></i></button>
												</span>
									</div>		
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Pax Garantidas<span class="required" aria-required="true"> * </span></label>
									<div class="input-group">
									<input value="<?php //=  isset($show->nome_sala) ? $show->nome_sala : null ;?>" name="pax_garantidas" id="pax_garantidas" data-required="1" type="text" class="form-control"/>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-users"></i></button>
												</span>
									</div>		
								</div>
							</div>

						</div>

						<hr>

						<div class="row">

							<div class="col-md-3">
								<div class="well" style="background-color: #fcf8e3">
									<div class="form-group">
										<label class="control-label"><h4>Selecione o tipo da tarifa</h4></label>
											<div class="radio-list">
												<label><input type="radio" name="tipo_tarifa" id="especial_iss" checked value="E"/>  Especial + ISS </label>
													<input type="hidden" name="trf_especial">
												<label><input type="radio" name="tipo_tarifa" id="balcao" value="B"/>  Balcão </label>	
													<input type="hidden" name="trf_balcao">	
											</div>
									</div>		
								</div>	
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Valor Diária</label>
									<input readonly name="valor_diaria"  type="text" class="form-control"/>
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
										<input value="<?php //=  isset($show->nome_sala) ? $show->nome_sala : null ;?>" name="desconto" data-required="1" type="text" class="form-control"/>
										<span class="input-group-addon">%</i></span>
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">ISS</label>
									<div class="input-group">
										<input readonly value="5,00" name="iss" data-required="1" type="text" class="form-control"/>
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

	<!-- VALIDAÇÃO -->
<script>

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

	$('input[name="dth_inicio"]').mask('99/99/9999');
	$('input[name="dth_fim"]').mask('99/99/9999');

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
				//console.log(trf_balcao);

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
	 * Limpando mascara (String) para poder usar somente numeros nos calculos
	 */
	?>
	function moeda2float(ajuste_moeda){

		var ajuste_moeda = ajuste_moeda.replace("R$","");

		ajuste_moeda = ajuste_moeda.replace(".","");

		ajuste_moeda = ajuste_moeda.replace(",",".");

		return parseFloat(ajuste_moeda);

	}

	function moeda2float2(ajuste_moeda){

		var ajuste_moeda = ajuste_moeda.replace("R$","");

		//ajuste_moeda = ajuste_moeda.replace(".","");

		ajuste_moeda = ajuste_moeda.replace(",",".");

		return parseFloat(ajuste_moeda);

		}

	<?php
	/**
	 * Preparando para exibir
	 * Obs. Não estou utilizando essa função, eu utilizo a função nativa [.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })]
	 */
	?>
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

	<?php
	/**
	 * Resetando Combo (Toda vez que muda a filtragem, elimina a consuta anterior)
	 */
	?>
	function resetaCombo( el) {
		<?php
		/**
		 * Setaando o campo que ira ser limpo
		 */
		?>
		$("select[name='"+ el +"']").empty();

		var option = document.createElement('option');                                  
		$("#s2id_" + el + " span[class='select2-chosen']").text('Selecionar...');
		$( option ).attr( {value : ''} );
		$( option ).append( '' );
		$("select[name='"+el+"']").append( option );
	}

	<?php
	/**
	 * Calcula o ISS
	 */
	?>
	function ajusta_iss(valor_diaria_sem_iss){
		//Pegando valor diaria
		var valor_diaria = moeda2float(valor_diaria_sem_iss);
		//Pegandio valor do iss
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

		var valor_ajuste = moeda2float(valor);
		var acrescimo = moeda2float(percentual);

		var valor_total_diaria = valor_ajuste +  ( valor_ajuste * (acrescimo / 100));
				
		return valor_total_diaria;

	}
	<?php
	/**
	 * Calcula o desconto
	 */
	?>
	function ajusta_desconto(valor, percentual){

		var valor_ajuste = moeda2float(valor);
		var acrescimo = moeda2float(percentual);

		var valor_total_diaria = valor_ajuste - ( valor_ajuste * (acrescimo / 100));
				
		return valor_total_diaria;

	}

	<?php
	/**
	 * Quando for inserido o valor do acrescimo
	 */
	?>
	$("input[name=acrescimo]").change(function(){

		$('input[name="desconto"]').attr( {value : ''} );

		var valor_diaria = $("input[name=valor_diaria]").val();
		var acrescimo = $("input[name=acrescimo]").val();

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
			valor_diaria = valor_diaria.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_diaria} );
			
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = Valor da diaria + ISS
			 */
			?>
			var valor_iss = ajusta_iss(valor_diaria);
			var valor_total_taxas = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_total_taxas} );
		}
		else
		{
			<?php
			/**
			 *  Se o acrescimo for maior que 0
			 *  VALOR TOTAL = VALOR DIARIA + ACRESCIMO 
			 */
			?>	
			var valor_acrescimo = ajusta_acrescimo(valor_diaria, acrescimo);
			valor_acrescimo = valor_acrescimo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_acrescimo} );
			
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = VALOR (DIARIA + ACRESCIMO) + ISS 
			 */
			?>
			var valor_total = $("input[name=valor_total]").val();
			var valor_iss = ajusta_iss(valor_total);
			valor_acrescimo_iss = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_acrescimo_iss} );
		}

	});

	<?php
	/**
	 * Calcular Desconto
	 */
	?>
	$("input[name=desconto]").change(function(){
		
		$('input[name="acrescimo"]').attr( {value : ''} );

		var valor_diaria = $("input[name=valor_diaria]").val();
		var desconto = $("input[name=desconto]").val();

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
			valor_diaria = valor_diaria.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_diaria} );

			<?php
			/**
			 * VALOR TOTAL COM TAXAS = Valor da diaria + ISS
			 */
			?>
			var valor_iss = ajusta_iss(valor_diaria);
			var valor_total_taxas = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_total_taxas} );
		}
		else
		{
			<?php
			/**
			 *  Se o desconto for maior que 0
			 *  VALOR TOTAL = VALOR DIARIA + ACRESCIMO 
			 */
			?>	
			var valor_desconto = ajusta_desconto(valor_diaria, desconto);
			valor_desconto = valor_desconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total"]').attr( {value : valor_desconto} );
			<?php
			/**
			 * VALOR TOTAL COM TAXAS = VALOR (DIARIA - DESCONTO) + ISS 
			 */
			?>
			var valor_total = $("input[name=valor_total]").val();	
			var valor_iss = ajusta_iss(valor_total);
			valor_desconto_iss = valor_iss.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			$('input[name="valor_total_taxas"]').attr( {value : valor_desconto_iss} );
		}

	});


var path = '<?php echo base_url(); ?>';
<?php
/**
 * A funçao ira executa quando houver mudança no combobox
 */
?>	
$("select[name=id_sala]").change(function(){
	
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
			//console.log(obj.valor_diaria_trf_especial_iss);
			//console.log(trf_especial_formatado);
			trf_especial_formatado = trf_especial_formatado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			//console.log(trf_especial_formatado);


			<?php
			/**
			 * Armazerndo informacoes
			 */
			?>
			$('input[name="trf_balcao"]').attr( {value : obj.valor_diaria_trf_balcao} );
			$('input[name="trf_especial"]').attr( {value : obj.valor_diaria_trf_especial_iss} );
			$('input[name="valor_diaria"]').attr( {value : trf_especial_formatado} );
			$('input[name="valor_total"]').attr( {value : trf_especial_formatado} );

			var valor_total_taxas = ajusta_iss(parseFloat(obj.valor_diaria_trf_especial_iss));
			console.log(valor_total_taxas);
			//valor_total_taxas = valor_total_taxas.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			//$('input[name="valor_total_taxas"]').attr( {value : valor_total_taxas} );
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



