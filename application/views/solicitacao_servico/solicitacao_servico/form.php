<style>
	
.categories{
	display:inline-block;
	width:100%;
}

.categories ul{
	margin: 0 -1.3%;
	padding:0;
	list-style: none;
}

.categories ul li{
	width: 100%;
	float: left;
	margin:0 1% 20px;
	background-color:#4DB3A2;
	cursor: pointer;
	border-radius:0;
	-moz-transition: ease-in .1s;
	-webkit-transition: ease-in .1s;
	transition: ease-in .1s;
}

.categories ul li:not(.nohover):hover img {
    background-color:  #4DB3A2 !important;
}

.categories ul li:hover{
    background-color:  #4DB3A2 !important;
}
.categories ul li img{
	background-color: #3A87ad;
	width: 92%;
	height:auto;
	margin: 4%;
	vertical-align: middle;
	border:0;
}

.categories ul li label{
	display: block;
	padding:8px 4px 8px;
	overflow:hidden;
	text-overflow:ellipsis;
	color: #111;
	text-align:center;
	/**font-size:12px; */
	line-height: 1.2;
	max-width: 100%;
	margin-bottom: 05px;
	font-weight:bold; 
}


</style>
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
			
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url().$url ?>/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
					<input type="hidden" name="id" value="<?=  isset($show->id_solicitacao_servico) ? $show->id_solicitacao_servico : null ;?>">
					<?php  $this->load->view('tpl/forms-btn-actions-save-top') ?>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>

						<div class="row">
							<div class="col-md-2">
								<div class="categories">
									<ul>
										<li data-id="238">
											<a href="#">
												<img alt="Fire" src="<?= base_url() ?>files/uploads/images/ae0caf95b065edcb8f8ca1051a631ad9.png" class="">
												<label>Categoria</label>
											</a>
										</li>
										<li data-id="238">
											<a href="#">
												<img alt="Fire" src="<?= base_url() ?>files/uploads/images/ae0caf95b065edcb8f8ca1051a631ad9.png" class="">
												<label>Subcategoria</label>
											</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label">Referência</label>
									<input value="<?=  isset($show->referencia) ? $show->referencia : null ;?>" name="referencia"  type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
						</div>
											<!--/row-->

						<div class="form-group">
							<div class="col-md-2">
								
							</div>

							<div class="col-md-5">
								<input value="<?=  isset($show->nota_adcional) ? $show->nota_adcional : null ;?>" name="nota_adcional"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>				 
						
						<div class="form-group">
							<label class="control-label col-md-2">Nota Adcional </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->nota_adcional) ? $show->nota_adcional : null ;?>" name="nota_adcional"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Local </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->local) ? $show->local : null ;?>" name="local"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dth Abertura Solicitacao </label>
							<div class="col-md-3">
									<input value="<?=  data_hora(isset($show->dth_abertura_solicitacao) ? $show->dth_abertura_solicitacao : null) ;?>" name="dth_abertura_solicitacao" id="dth_abertura_solicitacao" class="form-control form-control-inline date-picker" size="16" type="text"/>
							</div>
						</div>

						
						<div class="form-group">
							<label class="control-label col-md-2">Laudo Tecnico </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->laudo_tecnico) ? $show->laudo_tecnico : null ;?>" name="laudo_tecnico"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Observacoes </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->observacoes) ? $show->observacoes : null ;?>" name="observacoes"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Solucao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->solucao) ? $show->solucao : null ;?>" name="solucao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Numero Solicitacao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->numero_solicitacao) ? $show->numero_solicitacao : null ;?>" name="numero_solicitacao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dth Previsao Conclusao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dth_previsao_conclusao) ? $show->dth_previsao_conclusao : null ;?>" name="dth_previsao_conclusao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Hora Previsao Conclusao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->hora_previsao_conclusao) ? $show->hora_previsao_conclusao : null ;?>" name="hora_previsao_conclusao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dth Conclusao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dth_conclusao) ? $show->dth_conclusao : null ;?>" name="dth_conclusao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Hora Conclusao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->hora_conclusao) ? $show->hora_conclusao : null ;?>" name="hora_conclusao"  type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Status Solicitacao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->status_solicitacao) ? $show->status_solicitacao : null ;?>" name="status_solicitacao"  type="text" class="form-control" maxlength="300"/>
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


