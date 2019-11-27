<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');



if(isset($form_editar)){
	
	$collapse = 'expand';
	$info     = '<h2 style="clear: both">'.$show->desc_evento.' -  '.data_extenso($show->dth_previsao_inicio).' | '.$show->num_pax.' Pax</h2>';
	$contato  = '<h4>'.$show->contato_nome.' - '.$show->contato_telefone.'</h4>';
	$style    = 'style="display: none;"';


}else{
	$collapse = 'collapse';
	$info 	  = '';
	$contato  = '';
	$style 	  = '';

}



?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<?= $title_portlet ?>
						<?= isset($show->numero_reserva) ? '<strong>#'.$show->numero_reserva.'</strong> ' : null ;?>
				</div>
				<div class="tools">
					<a href="javascript:;" class="<?= $collapse ?>" data-original-title="" title=""></a>
				</div>
				
				<?= $info ?>
				<?= $contato ?>
				
			</div>
			<div class="portlet-body form" <?= $style ?>>
				<!-- BEGIN FORM-->
				<form action="<?= base_url().$url ?>/salvar" method="post" name="form_sample_1" id="form_sample_1"  <?= $form_class ?>>
					<input type="hidden" name="id" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">
					
					
					<div class="form-actions top" style="background: #f5f5f5;padding-left: 10px;">
						<button value="salvar" type="submit" class="btn btn-default"><i class="fa fa-save"></i> Salvar</button>
						<?php 
						//Verifica se o formulario esta em modo de edição
						if (isset($form_editar)){ ?>
						<a value="apagar"  href="<?= base_url().$btExcluir ?>" type="submit" class="btn btn-danger"><i class="fa fa-minus-circle"></i> Apagar</a>
						<?php }else{ ?>
						<a value="apagar" type="submit" class="btn btn-default disabled"><i class="fa fa-minus-circle"></i> Apagar</a>
						<?php } ?>
						<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
						<input  type="hidden" name="acao" id="acao">
					</div>
						<input type="hidden" name="numero_reserva" value="<?= isset($show->numero_reserva) ? $show->numero_reserva : null ;?>">
					
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Cliente<span class="required" aria-required="true"> * </span></label>
									<select name="id_cf" id="id_cf" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
									<?php  
										foreach ($lista_clientes as $row): 
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
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Previsão de Inicio<span class="required" aria-required="true"> * </span></label>
									<div class="input-group input-medium date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
											<input value="<?=  isset($show->dth_previsao_inicio) ? mostraData($show->dth_previsao_inicio) : null ;?>" type="text" class="form-control" name="dth_previsao_inicio" id="dth_previsao_inicio">
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
									</div>		
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Deadline<span class="required" aria-required="true"> * </span></label>
									<div class="input-group input-medium date date-picker"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
											<input value="<?=  isset($show->dth_dead_line) ? mostraData($show->dth_dead_line) : null ;?>" type="text" class="form-control" name="dth_dead_line" id="dth_dead_line">
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
									</div>		
								</div>
							</div>
						</div>		
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Descrição do Evento<span class="required" aria-required="true"> * </span></label>
									<input value="<?=  isset($show->desc_evento) ? $show->desc_evento : null ;?>" name="desc_evento" data-required="1" type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Número de PAX<span class="required" aria-required="true"> * </span></label>
									<div class="input-group input-medium">
									<input value="<?=  isset($show->num_pax) ? $show->num_pax : null ;?>" name="num_pax" data-required="1" type="text" class="form-control" maxlength="4"/>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-users"></i></button>
												</span>
									</div>		
								</div>
							</div>
						</div>	

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nome de Contato<span class="required" aria-required="true"> * </span></label>
									<input value="<?=  isset($show->contato_nome) ? $show->contato_nome : null ;?>" name="contato_nome" data-required="1" type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Telefone<span class="required" aria-required="true"> * </span></label>
									<div class="input-group input-medium">
									<input value="<?=  isset($show->contato_telefone) ? $show->contato_telefone : null ;?>" name="contato_telefone" data-required="1" type="text" class="form-control" maxlength="15"/>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-phone"></i></button>
												</span>
									</div>		
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Email<span class="required" aria-required="true"> * </span></label>
									<div class="input-group input-medium">
									<input value="<?=  isset($show->contato_email) ? strtolower($show->contato_email) : null ;?>" name="contato_email" data-required="1" type="text" class="form-control" maxlength="45"/>
												<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-envelope"></i></button>
												</span>
									</div>		
								</div>
							</div>
						</div>				   	

					</div>
					<br>
					<?php  $this->load->view('tpl/forms-info-alter-registro') ?>
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

		$('input[name="dth_previsao_inicio"]').mask('99/99/9999');
		$('input[name="dth_dead_line"]').mask('99/99/9999');

		$('input[name="num_pax"]').inputmask({
    		"mask": "9",
    		"repeat": 4,
    		"greedy": false
    	});

		$('input[name=contato_telefone]').focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			if(phone.length > 10) {
				element.mask("(99) 99999-999?9");
			} else {
				element.mask("(99) 9999-9999?9");
			}
		}).trigger('focusout');

    });

    var FormValidation = function () {

    <?php
	/**
	 * Validação Basica
	 * Basic Validation
	 */
	?>	
    var handleValidation1 = function() {

            var form1 = $("form[name=form_sample_1]");
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
					
					dth_previsao_inicio: {
                        required: true
					},

					dth_dead_line: {
                        required: true
					},

					desc_evento: {
                        required: true
					},

					num_pax: {
                        required: true
					},
	
					contato_nome: {
                        required: true
                    },

					contato_telefone: {
						required: true
                    },

					contato_email: {
						required: true,
                        email: true 
                    },

										   

                },
                messages: {

					contato_email: { 
						email: "Email inválido"
                    },

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
	
	// Validação do formulario de salas
	<?php if (isset($form_editar)){ ?>

	var handleValidation2 = function() {

		var form2 = $("form[name=form_sample_2]");
		var error2 = $('.alert-danger', form2);

		form2.validate({
			errorElement: 'span', //container default de input error
			errorClass: 'help-block help-block-error', // classe de mensagem default input error
			focusInvalid: false, // Não focar no ultimo input da validação
			ignore: "",  // Validar todos os campos inclusos no form
		
			rules: {
					id_sala: {
						required: true
					},
					id_arrumacao: {
						required: true
					},
					dth_inicio: {
						required: true
					},
					dth_fim: {
						required: true
					},
					id_utilizacao_sala: {
						required: true
					},
					pax_garantidas: {
						required: true
					},
		
			},
			messages: {

				pax_garantidas: { 
					required: "Obrigatório"
                    },

			},

			submitHandler: function( form2 ){       

				var dados = $(form2).serialize();

				$.ajax({
					type: "POST",
					url: "<?= base_url()?>eventos/Eventos_reserva_evento/adicionar_reserva_de_sala",
					data: dados,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							window.location.reload(true);
						}
						else{
							alert('Ocorreu um erro ao tentar adicionar produto.');
						}
					}
				});

				return false;
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
				error2.show();
				Metronic.scrollTo(error2, -200);
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

	<?php } ?>
    
    return {
        
        init: function () {

			handleValidation1();
			<?php if (isset($form_editar)){?>
			handleValidation2();
			<?php } ?>

        }

    };

}();

</script>



<?php 
	//Verifica se o formulario esta em modo de edição
	if (isset($form_editar)){ 
		$this->load->view('eventos/reserva_evento/main-list_salas');
		$this->load->view('eventos/reserva_evento/modal-form_salas');
	}
 ?>



