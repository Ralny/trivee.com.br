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
										 
						
						<div class="form-group">
							<label class="control-label col-md-3">Descrição do Equipamento <span class="required"> * </span></label>
							<div class="col-md-5">
								<input value="<?=  isset($show->desc_equipamento) ? $show->desc_equipamento : null ;?>" name="desc_equipamento" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Quantidade <span class="required"> * </span></label>
							<div class="col-md-3">
								<input value="<?=  isset($show->qtd_equipamento) ? $show->qtd_equipamento : null ;?>" name="qtd_equipamento" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Valor da Diária <span class="required"> * </span></label>
							<div class="col-md-3">
								<input value="<?=  isset($show->valor_diaria) ? $show->valor_diaria : null ;?>" name="valor_diaria" data-required="1" type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Observações </label>
							<div class="col-md-5">
								<textarea id="observacoes_sala"  name="observacoes_sala" class="form-control autosizeme" rows="6" data-autosize-on="true" style="overflow-y: hidden; resize: horizontal; height: 134px;" aria-invalid="false"><?=  isset($show->observacoes) ? $show->observacoes : null ;?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Sit Ativo </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->sit_ativo) ? $show->sit_ativo : null ;?>" name="sit_ativo"  type="text" class="form-control" maxlength="300"/>
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


