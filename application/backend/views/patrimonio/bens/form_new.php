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
										 
						
						<div class="form-group">
							<label class="control-label col-md-2">Id Item Patrimonio </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_item_patrimonio) ? $show->id_item_patrimonio : null ;?>" name="id_item_patrimonio"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Patrimonio </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->patrimonio) ? $show->patrimonio : null ;?>" name="patrimonio"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Id Situacao Bem </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_situacao_bem) ? $show->id_situacao_bem : null ;?>" name="id_situacao_bem"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Desc Item Patrimonio </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->desc_item_patrimonio) ? $show->desc_item_patrimonio : null ;?>" name="desc_item_patrimonio"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Id Tipo Incorporacao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_tipo_incorporacao) ? $show->id_tipo_incorporacao : null ;?>" name="id_tipo_incorporacao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Id Cf </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_cf) ? $show->id_cf : null ;?>" name="id_cf"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Id Grupo Bem </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_grupo_bem) ? $show->id_grupo_bem : null ;?>" name="id_grupo_bem"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Depreciacao Anual </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->depreciacao_anual) ? $show->depreciacao_anual : null ;?>" name="depreciacao_anual"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Num Nota Fiscal </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->num_nota_fiscal) ? $show->num_nota_fiscal : null ;?>" name="num_nota_fiscal"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dth Nota Fiscal </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dth_nota_fiscal) ? $show->dth_nota_fiscal : null ;?>" name="dth_nota_fiscal"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Valor Patrimonio </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->valor_patrimonio) ? $show->valor_patrimonio : null ;?>" name="valor_patrimonio"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Id Departamento </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_departamento) ? $show->id_departamento : null ;?>" name="id_departamento"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Local </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->local) ? $show->local : null ;?>" name="local"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Desc Garantia </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->desc_garantia) ? $show->desc_garantia : null ;?>" name="desc_garantia"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dth Fim Garantia </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dth_fim_garantia) ? $show->dth_fim_garantia : null ;?>" name="dth_fim_garantia"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Obsv Item Patrimonio </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->obsv_item_patrimonio) ? $show->obsv_item_patrimonio : null ;?>" name="obsv_item_patrimonio"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Token Id </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->token_id) ? $show->token_id : null ;?>" name="token_id"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Token Company </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->token_company) ? $show->token_company : null ;?>" name="token_company"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Id Usuario Criacao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_usuario_criacao) ? $show->id_usuario_criacao : null ;?>" name="id_usuario_criacao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dth Criacao </label>
							<div class="col-md-3">
									<input value="<?=  data_hora(isset($show->dth_criacao) ? $show->dth_criacao : null) ;?>" name="dth_criacao" id="dth_criacao" class="form-control form-control-inline date-picker" size="16" type="text"/>
							</div>
						</div>

						
						<div class="form-group">
							<label class="control-label col-md-2">Id Usuario Atualizacao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->id_usuario_atualizacao) ? $show->id_usuario_atualizacao : null ;?>" name="id_usuario_atualizacao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dth Atualizacao </label>
							<div class="col-md-3">
									<input value="<?=  data_hora(isset($show->dth_atualizacao) ? $show->dth_atualizacao : null) ;?>" name="dth_atualizacao" id="dth_atualizacao" class="form-control form-control-inline date-picker" size="16" type="text"/>
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


