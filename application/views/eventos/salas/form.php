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
								$checked 		= 'checked';
							}		

						?>		
										 
						
						<div class="form-group">
							<label class="control-label col-md-3">Nome da Sala <span class="required"> * </span></label>
							<div class="col-md-5">
								<input value="<?=  isset($show->nome_sala) ? $show->nome_sala : null ;?>" name="nome_sala" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Dimensões </label>
							<div class="col-md-3">
									<div class="input-group">
									<input value="<?=  isset($show->dimensoes) ? $show->dimensoes : null ;?>" name="dimensoes"  type="text" class="form-control" maxlength="300"/>
										<span class="input-group-addon">m</span>
									</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Área </label>
							<div class="col-md-3">
									<div class="input-group">
									<input value="<?=  isset($show->area) ? $show->area : null ;?>" name="area"  type="text" class="form-control" maxlength="4"/>
										<span class="input-group-addon">m</span>
									</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Pé Direito </label>
							<div class="col-md-3">
									<div class="input-group">
										<input value="<?=  isset($show->pe_direito) ? $show->pe_direito : null ;?>" name="pe_direito" placeholder=""  type="text" class="form-control" maxlength="6"/>
										<span class="input-group-addon">m</span>
									</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Valor Diaria TRF Balcão <span class="required"> * </span></label>
							<div class="col-md-3">
								<input style="border-color:#1c7d74;" value="<?=  isset($show->valor_diaria_trf_balcao) ? moeda($show->valor_diaria_trf_balcao) : null ;?>" name="valor_diaria_trf_balcao" placeholder="R$ 300,00" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Valor Diaria TRF Especial + ISS <span class="required"> * </span></label>
							<div class="col-md-3">
								<input value="<?=  isset($show->valor_diaria_trf_especial_iss) ? moeda($show->valor_diaria_trf_especial_iss) : null ;?>" name="valor_diaria_trf_especial_iss" placeholder="R$ 300,00" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>

						<div class="form-group">
								<label class="control-label col-md-3">Ativo?</label>
								<div class="col-md-5">
									<input type="checkbox" name="sit_ativo" class="make-switch" <?= $checked; ?> data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
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
		
		$('input[name="pe_direito"]').mask('99,99');

		$('input[name="dimensoes"]').mask('99,99x99,99');
		
		$('input[name="valor_diaria_trf_balcao"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 
		$('input[name="valor_diaria_trf_especial_iss"]').maskMoney({prefix:'R$ ', thousands:'.',decimal:','}); 

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
						 nome_sala: {
                        	required: true
                    	},
						valor_diaria_trf_balcao: {
                        	required: true
                    	},
						valor_diaria_trf_especial_iss: {
                        	required: true
                    	},
			   

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


<?php 
	//Verifica se o formulario esta em modo de edição
	if (isset($form_editar)){ 
		$this->load->view('eventos/salas/form_list-arrumacoes');
	}
 ?>


