<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('../application/backend/views/tpl/config_container.php');
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
								$checked 		= 'checked';
							}		
						?>		
							
                            <div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Patrimonio</label>
											<?php 
												if (isset($form_editar)){
													$disabled = 'disabled';
												}else{
													$disabled = '';
												}
											?>		
											<input <?= $disabled ?> value="<?=  isset($show->patrimonio) ? $show->patrimonio : null ;?>" name="patrimonio" id="patrimonio" data-required="1" type="text" class="form-control" maxlength="10" style="font-size: large;font-weight: bold;"/>
										</div>
                                    </div>
                                    
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Situação</label>
											<select name="idSituacaoBem" id="idSituacaoBem" class="form-control select2me" data-placeholder="Selecionar...">
											<option value=""></option>
												<?php 
												//setando valor vazio na variavel
												$select = '';	
												
												foreach ($lista_situacao_bem as $linha) { 

													if (isset($form_editar)){
														//Verificando qual unidade deve ficar selecionada no COMBO
														if ($show->id_situacao_bem == $linha->id_situacao_bem){ 
																$select = 'selected="selected"';
															}else{
																//Senão não está ativo
																$select = '';
														}
													}	
												?>
												<option value="<?= $linha->id_situacao_bem ?>" <?=  $select ?> > <?= $linha->desc_situacao_bem ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">&nbsp;</label>
											<br />
											<?php // if (isset($form_editar)){ ?>
												<input type="hidden" name="patrimonio2" id="patrimonio2" value="<?=  isset($show->patrimonio) ? $show->patrimonio : null ;?>">
												<a class="btn btn-default" data-toggle="modal" href="#basic"><i class="fa fa-refresh"></i> Trocar Patrimonio</a>
											<?php // } ?>	
										</div>
									</div>
								
                                </div>
                                
                                <div class="row">

									<div class="col-md-9">
										<div class="form-group">
											<label class="control-label">Descrição<span class="required"> * </span></label>
											<input value="<?=  isset($show->desc_item_patrimonio) ? $show->desc_item_patrimonio : null ;?>" name="desc_item_patrimonio" id="desc_item_patrimonio" data-required="1" type="text" class="form-control" maxlength="300"/>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
										<label class="control-label">Tipo de Incorporação</label>
										<select name="id_tipo_incorporacao" id="id_tipo_incorporacao" class="form-control select2me" data-placeholder="Selecionar...">
												<option value=""></option>
												<?php 
												//setando valor vazio na variavel
												$select = '';	
												
												foreach ($lista_tipo_incorporacao as $linha) { 

													if (isset($form_editar)){
														//Verificando qual unidade deve ficar selecionada no COMBO
														if ($show->id_tipo_incorporacao == $linha->id_tipo_incorporacao){ 
																$select = 'selected="selected"';
															}else{
																//Senão não está ativo
																$select = '';
														}
													}	
												?>
													<option value="<?= $linha->id_tipo_incorporacao ?>" <?=  $select ?> ><?= $linha->desc_tipo_incorporacao ?></option>
												<?php } ?>
										</select>
										</div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">

									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Fornecedor</label>
											<select name="id_cf" id="id_cf" class="form-control select2me" data-placeholder="Selecionar...">
											<option value=""></option>
												<?php 
												//setando valor vazio na variavel
												$select = '';	
												
												foreach ($lista_fornecedores as $linha) { 

													if (isset($form_editar)){
														//Verificando qual unidade deve ficar selecionada no COMBO
														if ($show->id_cf == $linha->id_cf){ 
																$select = 'selected="selected"';
															}else{
																//Senão não está ativo
																$select = '';
														}
													}	
												?>
													<option value="<?= $linha->id_cf ?>" <?=  $select ?> ><?= $linha->nome_fantasia ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
                                </div>
                                
                                <div class="row">

									<div class="col-md-9">
										<div class="form-group">
											<label class="control-label">Grupo do Bem</label>
											<select name="id_grupo_bem" id="id_grupo_bem" class="form-control select2me" data-placeholder="Selecionar...">
												<option value=""></option>
												<?php 
												//setando valor vazio na variavel
												$select = '';	
												
												foreach ($lista_grupo_bem as $linha) { 

													if (isset($form_editar)){
														//Verificando qual unidade deve ficar selecionada no COMBO
														if ($show->id_grupo_bem == $linha->id_grupo_bem){ 
																$select = 'selected="selected"';
															}else{
																//Senão não está ativo
																$select = '';
														}
													}	
												?>
													<option value="<?= $linha->id_grupo_bem ?>" <?=  $select ?> ><?= $linha->desc_grupo_bem ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Depreciação Anual</label>
                                            <div class="input-group">
                                                <input readonly name="depreciacao_anual" id="depreciacao_anual" data-required="1" type="text" class="form-control" value="<?=  isset($view->depreciacao_anual) ? $view->depreciacao_anual : null ;?>"/>
                                                <span class="input-group-addon">%</i></span>
                                            </div>
                                        </div>
                                    </div>
								
                                </div>
                                
                                <div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Nº Nota Fiscal</label>
											<input value="<?=  isset($view->num_nota_fiscal) ? $view->num_nota_fiscal : null ;?>" name="num_nota_fiscal" id="num_nota_fiscal" type="text" class="form-control" maxlength="11"/>
										</div>
									</div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Data da Nota</label>
                                            <div class="input-group input-medium date date-picker"  data-date-format="dd/mm/yyyy" data-date-viewmode="years">
                                                    <input value="<?=  isset($view->dth_nota_fiscal) ? $view->dth_nota_fiscal : null ;?>" type="text" class="form-control" name="dth_nota_fiscal" id="dth_nota_fiscal">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                            </div>		
                                        </div>
                                    </div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Valor do Bem</label>
											<input value="<?=  isset($view->valor_patrimonio) ? $view->valor_patrimonio : null ;?>" name="valor_patrimonio" id="valor_patrimonio" type="text" class="form-control" maxlength="18"/>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Valor atual</label>
											<input disabled="" value="" name="valorAtualPatrimonio" id="valorAtualPatrimonio" type="text" class="form-control"/>
										</div>
									</div>
								
                                </div>
                                
                                <div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Departamento</label>
											<select <?= $disabled ?> name="id_departamento" id="id_departamento" class="form-control select2me" data-placeholder="Selecionar...">
												<option value=""></option>
												<?php 
												//setando valor vazio na variavel
												$select = '';	
												
												foreach ($lista_departamentos as $linha) { 

													if (isset($form_editar)){
														//Verificando qual unidade deve ficar selecionada no COMBO
														if ($show->id_departamento == $linha->id_departamento){ 
																$select = 'selected="selected"';
															}else{
																//Senão não está ativo
																$select = '';
														}
													}	
												?>
													<option value="<?= $linha->id_departamento ?>" <?=  $select ?> ><?= $linha->desc_departamento ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									<div class="col-md-9">
										<div class="form-group">
											<label class="control-label">Local</label>
											<input value="<?=  isset($show->local) ? $show->local : null ;?>" name="local" id="local" type="text" class="form-control" maxlength="300"/>
										</div>
                                    </div>
                                    
                                </div>
                                
                                
								<div class="row">

									<div class="col-md-9">
										<div class="form-group">
											<label class="control-label">Descrição da Garantia</label>
											<input value="<?=  isset($show->descGaradesc_garantiantia) ? $show->desc_garantia : null ;?>" name="desc_garantia" id="desc_garantia" type="text" class="form-control" maxlength="300"/>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Fim da Garantia</label>
											<input value="<?=  isset($show->dth_fim_garantia) ? $show->dth_fim_garantia : null ;?>" name="dth_fim_garantia" id="dth_fim_garantia" class="form-control form-control-inline date-picker" size="16" type="text"/>
										</div>
                                    </div>
                                    
                                </div>

                                <div class="row">

									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Observações</label>
											<textarea name="obsv_item_patrimonio" id="obsv_item_patrimonio" class="form-control autosizeme" rows="6">
												<?=  isset($show->obsv_item_patrimonio) ? $show->obsv_item_patrimonio : null ;?>
											</textarea>
										</div>
                                    </div>
                                    
								</div>	
					</div>
				</form>
				<!-- END FORM-->
			</div>	
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>

<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><strong>Mudança de Patrimonio</strong></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?= base_url() ?>patrimonio/change_patrimonio" method="post" id="form_sample_2" <?= $form_class ?>>
                        <input type="hidden" name="id" id="id" value="<?=  isset($show->id_item_patrimonio) ? $show->id_item_patrimonio : null ;?>">
    
                            <div class="form-group">
                                    <label class="col-md-4 control-label">Novo Patrimônio</label>
                                    <div class="col-md-8">
                                        <input value="" name="novoPatrimonio" id="novoPatrimonio" data-required="1" type="text" class="form-control" maxlength="10" style="font-size: large;font-weight: bold;"/>
                                        <input type="hidden" name="antigoPatrimonio" id="antigoPatrimonio" value="<?=  isset($view->patrimonio) ? $view->patrimonio : null ;?>">
                                    </div>
                            </div>	
                            <div class="form-group">
                                    <label class="col-md-4 control-label">Motivo</label>
                                    <div class="col-md-8">
                                        <textarea name="descMotivo" id="descMotivo" class="form-control autosizeme" rows="6"></textarea>
                                    </div>
                            </div>				
                    </form>
                        <!-- END FORM-->
                </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnNovoPatrimonio" class="btn blue">Salvar</button>
            </div>
        </div>	
			</div>
			<!-- /.modal-content -->
	</div>
		<!-- /.modal-dialog -->
</div>

<?php 
	//Verifica se o formulario esta em modo de edição
	//if (isset($form_editar)){ 
		//$this->load->view('patrimonio/bens/form_troca-de-departamento');
	//}
 ?>

 <script>

/**
 *  Resgatando Depreciação Anual do Grupo de Bem 
 */
$(function(){
	/* Definindo path url */ 
	var path = '<?php echo base_url(); ?>';
	/* A funçao ira executa quando houver mudança no combobox */
	$("select[name=id_grupo_bem]").change(function(){
		/* Pegando value do combo selecionado */ 
		idGrupoBem = $(this).val();
			
		$.getJSON( path + 'patrimonio/ajax_depreciacao_anual_grupo_de_bens/' + idGrupoBem, function (data){
			console.log(data);
			/* Verrendo resultado */
			$.each(data, function(i, obj){
				//inseirindo valor resgatado
                $("input[name='depreciacao_anual']").attr( {value : obj.depreciacao_anual} );

			});
		});
	});
});

jQuery(document).ready(function() {

    $('.date-picker').datepicker({
        rtl: Metronic.isRTL(),
        orientation: "left",
        autoclose: true,
        format: 'dd/mm/yyyy'
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
        
    //Mascaras
    $("#patrimonio").inputmask({
        "mask": "9",
        "repeat": 10,
        "greedy": false
    });

    $("#num_nota_fiscal").inputmask({
        "mask": "9",
        "repeat": 10,
        "greedy": false
    });

    $('input[name="valor_patrimonio"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','});
    
    $('input[name="valor_atual_patrimonio"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','});
    
    $('input[name="dth_nota_fiscal"]').mask('99/99/9999');

	$('input[name="dth_fim_garantia"]').mask('99/99/9999');

});

function getDateDiff(date1, date2, interval) {
		var second = 1000,
		    minute = second * 60,
		    hour = minute * 60,
		    day = hour * 24,
		    week = day * 7;
			dateone = new Date(date1).getTime();
			datetwo = (date2) ? new Date().getTime() : new Date(date2).getTime();
		var timediff = datetwo - dateone;
			secdate = new Date(date2);
			firdate = new Date(date1);
			if (isNaN(timediff)) return NaN;
			switch (interval) {
			case "anos":
				return secdate.getFullYear() - firdate.getFullYear();
			case "meses":
		        return ((secdate.getFullYear() * 12 + secdate.getMonth()) - (firdate.getFullYear() * 12 + firdate.getMonth()));
			case "semanas":
				return Math.floor(timediff / week);
			case "dias":
				return Math.floor(timediff / day);
			case "horas":
				return Math.floor(timediff / hour);
			case "minutos":
				return Math.floor(timediff / minute);
			case "segundos":
				return Math.floor(timediff / second);
			default:
				return undefined;
			}
	}
	
	/********************** CALCULAR DEPRECIAÇÃO DO PATRIMONIO - não baudie o negocio****************/
 	//
	$("input[name=valor_patrimonio]").change(function(){

		//Data no formatada
		var dataNotaFiscal = formatDate(document.getElementById('dth_nota_fiscal').value);

		var er                     = /\^|~|\?|,|\*|\.|\-/g;
		//Calcula a quantidade de meses entre a data da nota fiscal e a data atual
		var total_meses            = getDateDiff(dataNotaFiscal, new Date(), 'meses');
		//Valor patrimonio
		//var valorPatrimonio        = document.getElementById('valor_patrimonio').value.replace(er,"") / 100; 
		var valorPatrimonio = moeda2float2($('input[name="valor_patrimonio"]').val());
		//Taxa de Depreciação Anual
		var taxaDepreciacaoAnual   = $('input[name="depreciacao_anual"]').val();
		//Calcula valor da depreciação anual
		var valorDepreciacaoAnual  = (valorPatrimonio * taxaDepreciacaoAnual) / 100;
		//Calcula valor da depreciação mensal
		var valorDepreciacaoMensal = valorDepreciacaoAnual / 12;
		//Multiplica a depreciação mensal pela quantidade de meses que o patrimonio foi comprado 
		var valorDepreciacao       = valorDepreciacaoMensal * total_meses;
		//Calcula o valor atual: Valor do patrimonio menos o valor total da depreciação
		var valorAtualPatrimonio = (valorPatrimonio - valorDepreciacao) * 100;
		//console.log(valorAtualPatrimonio);
		//Valor Formatado
		var valorAtualPatrimonioFormatado = valorAtualPatrimonio.toFixed(0).replace(er,"");
		//Insere no imput o valor da depreciação
		document.getElementById('valorAtualPatrimonio').value = valorAtualPatrimonioFormatado; 
	});
    /***************** FIM DO CALCULO DA DEPRECIAÇÃO **********************************/

var FormValidation = function () {

//Validação Basica - Formulario Principal
var handleValidation1 = function() {

        var form1 = $('#form_sample_1');
        var error1 = $('.alert-danger', form1);

        form1.validate({
            errorElement: 'span', //container default de input error
            errorClass: 'help-block help-block-error', // classe de mensagem default input error
            focusInvalid: false, // Não focar no ultimo input da validação
            ignore: "",  // Validar todos os campos inclusos no form
          
            rules: {
                patrimonio: {
                    required: true
                },
                desc_item_patrimonio: {
                    required: true
                }
            },
            messages: {

            },

            invalidHandler: function (event, validator) { //alerta display error do submit              
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
//Formulario para mudança de Patrimonio
var handleValidation2 = function() {

        var form1 = $('#form_sample_2');
        var error1 = $('.alert-danger', form1);

        form1.validate({
            errorElement: 'span', //container default de input error
            errorClass: 'help-block help-block-error', // classe de mensagem default input error
            focusInvalid: false, // Não focar no ultimo input da validação
            ignore: "",  // Validar todos os campos inclusos no form
          
            rules: {
                novoPatrimonio: {
                    required: true
                },
                descMotivo: {
                    required: true
                }
            },
            messages: {

            },

            invalidHandler: function (event, validator) { //alerta display error do submit              
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

//Formulario para mudança de Patrimonio
var handleValidation3 = function() {

        var form1 = $('#form_sample_3');
        var error1 = $('.alert-danger', form1);

        form1.validate({
            errorElement: 'span', //container default de input error
            errorClass: 'help-block help-block-error', // classe de mensagem default input error
            focusInvalid: false, // Não focar no ultimo input da validação
            ignore: "",  // Validar todos os campos inclusos no form
          
            rules: {
                descMotivo: {
                    required: true
                }
            },
            messages: {

            },

            invalidHandler: function (event, validator) { //alerta display error do submit              
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
    //iniciando chamada da função validacao
    init: function () {

        handleValidation1();
        handleValidation2();
        handleValidation3();

    }

};

}();

 </script>