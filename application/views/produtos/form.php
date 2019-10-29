<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<?= $title_portlet ?>
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url().$url ?>/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
					<input type="hidden" name="id" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">
					<?php  $this->load->view('tpl/forms-btn-actions-save-top') ?>
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
							$checked = 'checked';
						}

						?>

						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nome<span class="required"> * </span> </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Descrição do Produto utilizada nas buscas do sistema e na emissao de notas." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->nome) ? $show->nome : null ;?>" name="nome" data-required="1" type="text" class="form-control" maxlength="300"/>

								</div>							
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Ativo?</label><br />
									<input type="checkbox" name="sit_ativo" class="make-switch" <?= $checked; ?> data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
								</div>							
							</div>

						</div>
						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Codigo interno</label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Código utilizado pelo estabelecimento para controle do produto. Pode ser indicado livremente." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->codigo) ? $show->codigo : null ;?>" name="codigo"  type="text" class="form-control" maxlength="13"/>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Código de barras (EAN):</label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Código de Barras do fabricante do produto. Deve ser o código original, registrado no GTIN." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->codigo_gtin_ean) ? $show->codigo_gtin_ean : null ;?>" name="codigo_gtin_ean"  type="text" class="form-control" maxlength="13"/>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Finalidade </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Indica a finalidade principal do produto." aria-describedby="popover263156"> ? </span> 
									<select data-required="1" name="id_tipo_classificacao" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										foreach ($tipo_classificacao as $row):
											if(isset($form_editar))
											{
												if($show->id_tipo_classificacao == $row->id_tipo_classificacao ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_tipo_classificacao ?>" <?=  $select ?>><?= $row->id_tipo_classificacao. ' - ' . $row->desc_tipo_classificacao ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>

						<div class="row">	

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Valor de Venda</label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="O Valor de Venda é a valoração monetária dos produtos comercializados pelo estabelecimento. É uma informação cadastrada diretamente no produto. Ele pode ser calculado, ou então indicado livremente pelo comerciante.." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->valor_venda) ? moeda($show->valor_venda) : null ;?>" name="valor_venda" placeholder="R$ 120,00"  type="text" class="form-control" maxlength="18"/>
								</div>					
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Valor de Custo</label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Somatório do Custo Médio, Despesas Acessórias e Outras Despesas." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->valor_custo) ? moeda($show->valor_custo) : null ;?>" name="valor_custo" placeholder="R$ 100,00" type="text" class="form-control" maxlength="18"/>
								</div>	
							</div>
						</div>
						<!--/row-->	

						<div class="row">
							
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Disponível em estoque </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Quantidade em Estoque para Revenda ou Industrialização." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->movi_qtd_estoque) ? $show->movi_qtd_estoque : null ;?>" name="movi_qtd_estoque" placeholder="10"  type="text" class="form-control" maxlength="11"/>
								</div>	
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Máximo em estoque </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Caso o número informado seja igual ou superior ao Disponível em Estoque o mesmo irá gerar avisos em relatórios." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->estoque_maximo) ? $show->estoque_maximo : null ;?>" name="estoque_maximo" placeholder="100"  type="text" class="form-control" maxlength="11"/>
								</div>
							</div>	

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label"> Mínimo em estoque</label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Caso o número informado seja igual ou inferior ao Disponível em Estoque o mesmo irá gerar avisos em relatórios e gráficos." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->estoque_minimo) ? $show->estoque_minimo : null ;?>" name="estoque_minimo" placeholder="10"  type="text" class="form-control" maxlength="11"/>
								</div>	
							</div>

						</div>
						<!--/row-->	
						
						<hr>	
						<h4 class="block">Informar dados usados na Nota Fiscal (Opcional)</h4>

						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Unidade de medida </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="A conversão é utilizada quando se compra em uma unidade ou quantidade diferente da que se vende. Por exemplo, quando se compra 1 caixa de sabão e vende-se 12 unidades separada, ou quando se compra 1 saca de feijão de 10kg e vende-se 100gr de feijão." aria-describedby="popover263156"> ? </span> 
									<select name="id_unidade_medida" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										foreach ($unidades_medidas as $row):
											if(isset($form_editar))
											{
												if($show->id_unidade_medida == $row->id_unidade_medida ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_unidade_medida ?>" <?=  $select ?>><?= $row->unidade_medida. ' - ' . $row->descricao ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>	
						</div>
						
						<div class="row">	

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">NCM </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Qualquer mercadoria, importada ou comprada no Brasil, deve ter um código NCM na sua documentação legal (nota fiscal, livros legais, etc.), cujo objetivo é classificar os itens de acordo com regulamentos do Mercosul." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->ncm_desc) ? $show->ncm_desc : null ;?>" id="ncm" type="text" class="form-control"/>
									<input type="hidden" name="ncm_ncm" id="ncm_ncm" value="<?=  isset($show->id_ncm) ? $show->id_ncm : null ;?>"/>	
								</div>	
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">CEST </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="O objetivo deste novo código é estabelecer uma forma de uniformizar e identificar as mercadorias e bens passíveis de sujeição ao regime de substituição tributária e de antecipação de recolhimento do ICMS com o encerramento de tributação, relativos às operações subsequentes. Sua regulamentação se dá através do convênio ICMS 92/15." aria-describedby="popover263156"> ? </span> 
									<input value="<?=  isset($show->cest_desc) ? $show->cest_cest .' - '. $show->cest_desc : null ;?>" id="cest" type="text" class="form-control"/>
									<input type="hidden" name="cest_cest" id="cest_cest" value="<?=  isset($show->id_cest) ? $show->id_cest : null ;?>"/>
								</div>
							</div>

						</div>
						<!--/row-->	

						<div class="row">

							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Origem de Produto - CST/ICMS</label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Sua finalidade é descrever, de forma clara, qual o tipo de tributação que o produto está sofrendo naquela operação e qual sua origem, se nacional ou estrangeira.O CST/ICMS é um importante e, podemos também dizer, fundamental instrumento, previsto na legislação tributária, para a emissão e interpretação das Notas Fiscais, Modelos 1, 1A e 55 (NF-e). " aria-describedby="popover263156"> ? </span> 
									<select data-required="1" name="id_origem_produto" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										foreach ($origem_produto as $row):
											if(isset($form_editar))
											{
												if($show->id_origem_produto == $row->id_origem_produto ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_origem_produto ?>" <?=  $select ?>><?= $row->id_origem_produto. ' - ' . $row->desc_origem ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>

						</div>
						<!--/row-->	

						<div class="row">
							
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Peso Liquido </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="O peso líquido é o peso do produto, sem a embalagem." aria-describedby="popover263156"> ? </span> 
									<div class="input-group">
										<input value="<?=  isset($show->peso_liquido) ? peso($show->peso_liquido) : null ;?>" name="peso_liquido" id="peso_liquido" placeholder="1,000"  type="text" class="form-control" maxlength="6"/>
										<span class="input-group-addon">
											(kg) 
										</span>
									</div>
								</div>	
							</div>	

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Peso Bruto </label>
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="O peso bruto é o peso de um produto mais o peso da embalagem." aria-describedby="popover263156"> ? </span> 
									<div class="input-group">
										<input value="<?=  isset($show->peso_bruto) ? peso($show->peso_bruto) : null ;?>" name="peso_bruto" placeholder="1,000"  type="text" class="form-control" maxlength="6"/>
										<span class="input-group-addon">
											(kg) 
										</span>
									</div>
								</div>	
							</div>						
						</div>
						<!--/row-->	
						
						<hr>
						<h4 class="block">Informar fornecedor (Opcional)</h4>	

						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Fornecedor  </label>
									<select data-required="1" name="id_cf" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php 
										$select = '';	
										foreach ($fornecedores as $row):
											if(isset($form_editar))
											{
												if($show->id_cf == $row->id_cf) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_cf ?>" <?=  $select ?> > <?= $row->nome_fantasia ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>

						</div>
						<!--/row-->	

					</div>
				</form>
				<!-- END FORM-->
			</div>	
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>
<!-- END PAGE CONTENT INNER -->
<!-- VALIDAÇÃO -->
<script>


	jQuery(document).ready(function() {

		$("#ncm").autocomplete({
			source: "<?= base_url(); ?>produtos/produtos/auto_complete_ncm",
			minLength: 1,
			select: function( event, ui ) {
				$("#ncm_ncm").val(ui.item.id);
			}
		});

		$("#cest").autocomplete({
			source: "<?= base_url(); ?>produtos/produtos/auto_complete_cest",
			minLength: 1,
			select: function( event, ui ) {
				$("#cest_cest").val(ui.item.id);
			}
		});


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

   		$('input[name="valor_venda"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 

        $('input[name="valor_custo"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 

         $('input[name="codigo"]').inputmask({
    		"mask": "9",
    		"repeat": 13,
    		"greedy": false
    	});

    	$('input[name="codigo_gtin_ean"]').inputmask({
    		"mask": "9",
    		"repeat": 13,
    		"greedy": false
    	});

    	$('input[name="movi_qtd_estoque"]').inputmask({
    		"mask": "9",
    		"repeat": 10,
    		"greedy": false
    	});

    	$('input[name="estoque_minimo"]').inputmask({
    		"mask": "9",
    		"repeat": 10,
    		"greedy": false
    	});

    	$('input[name="estoque_maximo"]').inputmask({
    		"mask": "9",
    		"repeat": 10,
    		"greedy": false
    	});

    	$('input[name="peso_liquido"]').keyup(function(){
    		this.value = formatWeight(this.value);
    	});

    	$('input[name="peso_bruto"]').keyup(function(){
    		this.value = formatWeight(this.value);
    	});
   





	});   




	var FormValidation = function () {

		<?php
	/**
	 * Validação Basica
	 * Basic Validation
	 */
	?>	
	var handleValidation1 = function() {

		var form1 = $('#form_sample_1');
		var error1 = $('.alert-danger', form1);

		form1.validate({
                errorElement: 'span', //container default de input error
                errorClass: 'help-block help-block-error', // classe de mensagem default input error
                focusInvalid: false, // Não focar no ultimo input da validação
                ignore: "",  // Validar todos os campos inclusos no form
                
                rules: {

                	<?php foreach ($tableForm as $k => $field) : ?>

                	<?php if($field['required'] != '0'): ?>

                	<?php echo SiteHelpers::fieldRequiredShow($field['field'], $field['required'])   ?>

                	<?php endif; ?>
                	
                	<?php endforeach; ?>					   

                },
                messages: {

                },

                invalidHandler: function (event, validator) { //display error submit              
                	error1.show();
                	Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                	$(element)
                        .closest('.form-group').addClass('has-error'); // set error class
                    },

                unhighlight: function (element) { // revert a mudança do hightlight
                	$(element)
                        .closest('.form-group').removeClass('has-error'); // set error class
                    },

                });
	}
	
	return {
		
		init: function () {

			handleValidation1();

		}

	};

}();



</script>


