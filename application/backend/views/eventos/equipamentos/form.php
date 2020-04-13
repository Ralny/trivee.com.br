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
										 
						<div class="form-group">
							<label class="control-label col-md-2">Fornecedor <span class="required"> * </span></label>
							<div class="col-md-5">
							<select name="id_cf" id="id_cf" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
								<option></option>
							<?php  
								foreach ($lista_fornecedores as $row): 
									$select = '';
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
								<option value="<?= $row->id_cf ?>" <?=  $select ?> ><?= $row->nome_fantasia ?></option>
							<?php  endforeach ?>
							</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Descrição <span class="required"> * </span></label>
							<div class="col-md-5">
								<input value="<?=  isset($show->desc_equipamento) ? $show->desc_equipamento : null ;?>" name="desc_equipamento" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Quantidade <span class="required"> * </span></label>
							<div class="col-md-3">
								<div class="input-group">
									<input value="<?=  isset($show->qtd_equipamento) ? $show->qtd_equipamento : null ;?>" name="qtd_equipamento" data-required="1" type="text" class="form-control" maxlength="300"/>
									<span class="input-group-addon">und</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Valor da Diária <span class="required"> * </span></label>
							<div class="col-md-3">
								<input value="<?=  isset($show->valor_diaria) ? moeda($show->valor_diaria) : null ;?>" name="valor_diaria" id="valor_diaria"  placeholder="R$ 300,00" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Observações </label>
							<div class="col-md-5">
								<textarea id="observacoes"  name="observacoes" class="form-control autosizeme" rows="6" data-autosize-on="true" style="overflow-y: hidden; resize: horizontal; height: 134px;" aria-invalid="false"><?=  isset($show->observacoes) ? $show->observacoes : null ;?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Ativo?</label>
							<div class="col-md-5">
									<input type="checkbox" name="sit_ativo" class="make-switch" <?= $checked; ?> data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
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
		<!-- END VALIDATION STATES-->
	</div>
</div>
<!-- END PAGE CONTENT INNER -->
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

		$('input[name="valor_diaria"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 

		$('input[name="qtd_equipamento"]').inputmask({
    		"mask": "9",
    		"repeat": 4,
    		"greedy": false
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
						id_cf: {
                        required: true
                    },	
						desc_equipamento: {
                        required: true
                    },	
						qtd_equipamento: {
                        required: true
                    },		
						valor_diaria: {
                        required: true
                    }		   

                },
                messages: {

                },

				errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parents('.radio-list').size() > 0) { 
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.radio-inline').size() > 0) { 
                        error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
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


