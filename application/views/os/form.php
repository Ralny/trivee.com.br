<?php 
//Carregando configurações de conteiner
include ('application/views/tpl/config_container.php');

// --------------------------------------------------------
// Aux para desabilidar elementos do formulario que nao podem mais ser editados
if (isset($form_editar))
{
	$disabled = 'disabled';
}
else
{
	$disabled = '';
}
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<div class="tabbable-custom tabbable-noborder">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1_1" data-toggle="tab">Detalhes da OS</a></li>
				<li><a href="#tab_1_2" data-toggle="tab">Serviços</a></li>
				<li><a href="#tab_1_3" data-toggle="tab">Produtos</a></li>
				<li><a href="#tab_1_4" data-toggle="tab">Pagamento</a></li> 
				<li><a href="#tab_1_5" data-toggle="tab">Resumo</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1_1">
					<!-- Detalhes -->	
					<!-- BEGIN PAGE CONTENT INNER -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN VALIDATION STATES-->
							<div class="portlet light">
								<div class="portlet-title">
									<div class="caption">
										<? // $title_portlet ?>
									</div>
								</div>
								
								<div class="portlet-body form">
									<!-- BEGIN FORM-->
									<form action="<?= base_url().$url ?>/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
										<input type="hidden" name="id" value="<?=  isset($show->id_os) ? $show->id_os : null ;?>">
										<div class="form-body">
											<div class="alert alert-danger display-hide">
												<button class="close" data-close="alert"></button>
												<?= $erro_valid_form ?>
											</div>

											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Tipo da OS</label>
														<select id="tipo_os" name="tipo_os" class="form-control select2me" data-placeholder="Selecionar...">
															<?php 

															if(isset($infoRegistro)){

																$orcamento = ''; $ordem = '';
																
																if($show->tipo_os == 'Orçamento')
																{
																	$orcamento = 'selected';
																}
																else
																{
																	$ordem	= 'selected';
																}
																
															}
															?>
															<option <?= isset($ordem) ? $ordem : null ?> value="Ordem de Serviço">Ordem de Servico</option>
															<option <?= isset($orcamento) ? $orcamento : null ?> value="Orçamento">Orçamento</option>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Data de abertura da OS <span class="required" aria-required="true"> * </span></label>
														<input data-required="1"  name="dth_abertura_os" class="form-control date-picker" size="16" type="text" value="<?=  isset($show->dth_abertura_os) ? mostraData($show->dth_abertura_os) : null ;?>" />
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Número da OS </label>
														<input disabled value="<?= isset($show->numero_os) ? $show->numero_os : null ;?>" name="numero_os"  type="text" class="form-control"/>
														<input type="hidden" name="numero_os_2" value="<?=  isset($show->numero_os) ? $show->numero_os : null ;?>">
													</div>
												</div>
											</div>
											<!--/row-->

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Descrição <span class="required" aria-required="true"> * </span></label>
														<input value="<?=  isset($show->descricao) ? $show->descricao : null ;?>" name="descricao"  type="text" data-required="1" class="form-control" maxlength="300"/>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Referência</label>
														<input value="<?=  isset($show->referencia) ? $show->referencia : null ;?>" name="referencia"  type="text" class="form-control" maxlength="300"/>
													</div>
												</div>
											</div>
											<!--/row-->

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Cliente <span class="required" aria-required="true"> * </span></label>
														<input value="<?=  isset($nome_cliente) ? $nome_cliente : null ;?>" id="cliente" name="cliente"  type="text" data-required="1" class="form-control"/>
														<input id="id_cf" type="hidden" name="id_cf" value="<?=  isset($show->id_cf) ? $show->id_cf : null ;?>"  />
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Responsável Técnico <span class="required" aria-required="true"> * </span></label>
														<input value="<?= isset($show->tecnico) ? $show->tecnico : null ;?>" name="tecnico"  type="text" data-required="1" class="form-control" maxlength="300"/>
													</div>
												</div>
											</div>
											<!--/row-->

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Problema/Defeito apresentado pelo cliente <span class="required" aria-required="true"> * </span></label>
														<textarea name="desc_problema_defeito" class="form-control" rows="6"><?=  isset($show->desc_problema_defeito) ? $show->desc_problema_defeito : null ;?></textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Laudo Técnico</label>
														<textarea name="laudo_tecnico" class="form-control " rows="6"><?=  isset($show->laudo_tecnico) ? $show->laudo_tecnico : null ;?></textarea>
													</div>
												</div>
											</div>
											<!--/row-->		

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Observações</label>
														<textarea name="observacoes" class="form-control " rows="4"><?=  isset($show->observacoes) ? $show->observacoes : null ;?></textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Observações Internas</label>
														<textarea name="observacoes_internas" class="form-control " rows="4"><?=  isset($show->observacoes_internas) ? $show->observacoes_internas : null ;?></textarea>
													</div>
												</div>
											</div>
											<!--/row-->			

											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Data da Realização </label>
														<input  name="dth_realizacao" class="form-control date-picker" size="16" type="text" value="<?=  isset($show->dth_realizacao) ? mostraData($show->dth_realizacao) : null ;?>"/>
													</div>
												</div>
												
												<div class="col-md-3">
													<label class="control-label">Hora da Realização </label>
													<div class="input-group date">
														<input name="hora_realizacao" type="text" value="<?=  isset($show->hora_realizacao) ? $show->hora_realizacao : null ;?>"  class="form-control timepicker timepicker-24">
														<span class="input-group-btn">
															<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
														</span>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Data de conclusão da OS</label>
														<input  name="dth_conclusao_os" class="form-control date-picker" size="16" type="text" value="<?=  isset($show->dth_conclusao_os) ? mostraData($show->dth_conclusao_os) : null ;?>"/>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Garantia </label>
														<select name="garantia" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="0"></option>
															<?php 

															$select = '';	

															foreach ($tempo_garantia as $key => $value):
																
																if(isset($form_editar))
																{
																	if($show->garantia == $key) 
																	{
																		$select = 'selected="selected"';
																	}
																	else
																	{
																		$select = '';		
																	}
																}
																?>
																<option value="<?= $key ?>" <?=  $select ?> ><?= $value ?></option>
															<?php endforeach ?>
														</select>
													</div>		
												</div>
											</div>
											<!--/row-->														 

											

										</div>
										<br>
										<?php 
											// So ira exibir se o formulario estiver em modo de cadastro
										if (!isset($form_editar)){ ?>

										<div class="form-actions" style="background: #f5f5f5;">
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-offset-2 col-md-9">
															<input  type="hidden" name="acao" id="acao">
															<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Criar Ordem de Serviço</button>
														</div>
													</div>
												</div>
											</div>
										</div>

										<?php }else{ ?>

										<div class="form-actions" style="background: #f5f5f5;">
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-offset-3 col-md-9">
															<input  type="hidden" name="acao" id="acao">
															<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Salvar Alteracoes</button>
														</div>
													</div>
												</div>
											</div>
										</div>

										<?php } ?>
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

							$("#cliente").autocomplete({
								source: "<?= base_url(); ?>os/auto_complete_cliente",
								minLength: 1,
								select: function( event, ui ) {
									$("#id_cf").val(ui.item.id);
								}
							});

							$('.date-picker').datepicker({
								rtl: Metronic.isRTL(),
								orientation: "left",
								autoclose: true,
								format: 'dd/mm/yyyy'
							});

							$('.timepicker-24').timepicker({
								autoclose: true,
								minuteStep: 5,
								showSeconds: false,
								showMeridian: false,
								defaultTime: '',
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

				                	dth_abertura_os: {
				                		required: true
				                	},
				                	descricao: {
				                		required: true
				                	},
				                	cliente: {
				                		required: true
				                	},
				                	tecnico: {
				                		required: true
				                	},
				                	desc_problema_defeito: {
				                		required: true
				                	}

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
		</div>

		<div class="tab-pane" id="tab_1_2">
			<?php
			
				 	//$this->load->view('os/tab_servicos');
				
			?>								
		</div>

		<div class="tab-pane" id="tab_1_3">
			<?php 
				
				//$this->load->view('os/tab_produtos') ;
				
			?>								
		</div>

		<div class="tab-pane" id="tab_1_4">
			<!-- Totais -->
			
		</div>	

		<div class="tab-pane" id="tab_1_5">
			<?php 
				
					//$this->load->view('os/resumo');
			
			?>
		</div>
	</div>
</div>
</div>
</div>
<!-- END PAGE CONTENT INNER -->



