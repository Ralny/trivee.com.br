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
				<form action="<?= base_url() ?>infra/infra_solicitacao_servico/salvar_tarefa" method="post" id="form_sample_1" <?= $form_class ?>>
					<input type="hidden" name="id" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">
					<input type="hidden" name="token_id_solicitacao_servico" value="<?= $this->uri->segment(4);?>">
					<?php  $this->load->view('tpl/forms-btn-actions-save-top') ?>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2">Status</label>
									<div class="col-md-8">
										<div class="input-group">
											<div class="icheck-inline">
												<label>
													<input type="radio" name="sit_status" value="Pra fazer" class="icheck" data-radio="iradio_square-blue" checked>Pra fazer
												</label>
												<label>
													<input type="radio" name="sit_status" value="Fazendo" class="icheck" data-radio="iradio_square-blue">Fazendo
												</label>
												<label>
													<input type="radio" name="sit_status" value="Prorrogado" class="icheck" data-radio="iradio_square-blue">Prorrogado
												</label>
												<label>
													<input type="radio" name="sit_status" value="Completada" class="icheck" data-radio="iradio_square-blue">Completada 
												</label>
											</div>	
										</div>
									</div>
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2">Titulo da tarefa</label>
									<div class="col-md-8">
										<input type="text" name="desc_titulo" class="form-control">
									</div>
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2">Responsável</label>
									<div class="col-md-5">
										<select name="id_responsavel_tecnico" class="form-control select2me" data-placeholder="Selecionar...">
											<option></option>
											<option value="1">Ralny Andrade</option>
											<option>Nasio Victor</option>				
										</select>
									</div>
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2">Descrição da tarefa</label>
									<div class="col-md-8">
										<textarea class="form-control autosizeme" name="desc_breve_tarefa" rows="5"></textarea>
									</div>
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-2">Inicio da Tarefa</label>
									<div class="col-md-3">
										<select name="inicio_tarefa" id="inicio_tarefa" class="form-control select2me" data-placeholder="Selecionar...">
											<option value="Prioridade" selected>Prioridade</option>
											<option value="Agendamento">Agendamento</option>		
														
										</select>
									</div>
								</div>
							</div>	
						</div>
						<!-- Iniciar em -->
						<div id="agendamento" style="visibility:hidden;  display:none;"> 
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-2">Agendar inicio para</label>
										<div class="col-md-5">
											<div class="input-group date form_datetime" data-date="<?= date("Y-m-d") ?>T07:00:00Z">
												<input name="dth_inicio_tarefa" type="text" size="16" class="form-control" readonly>
													<span class="input-group-btn">
														<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>	
						<!-- Prioridade -->
						<div id="prioridade"> 
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-2">Entrega desejada</label>
										<div class="col-md-5">
											<div class="input-group date form_datetime" data-date="<?= date("Y-m-d") ?>T07:00:00Z">
												<input name="dth_entrega_deseja" type="text" size="16" class="form-control" readonly data-error-container="#editor1_error">
													<span class="input-group-btn">
														<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
														<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
													</span>
														<div id="editor1_error">
													</div>

											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>	
						<!-- Repeticao -->
						<div id="repeticao" style="visibility:hidden;  display:none;"> 

							<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2">Repetição</label>
											<div class="col-md-3">
												<select name="repeticao_tarefa" id="repeticao_tarefa" class="form-control select2me" data-placeholder="Selecionar...">
													<option value="nunca">Nunca</option>
													<option value="diaria">Diaria</option>		
													<option value="semanal">Semanal</option>
													<option value="mensal">Mensal</option>	
													<option value="anual">Anual</option>			
												</select>
											</div>
										</div>
									</div>	
							</div>

							<!-- Diaria -->
							<div id="diaria" style="visibility:hidden;  display:none;"> 

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">Repetir a cada</label>
													<div class="col-md-3">
														<div id="spinner_diaria" class="form-inline">
															<div class="input-group" style="width:150px;">
																<input type="text" class="spinner-input form-control" maxlength="3" name="repetir_a_cada[]">
																<div class="spinner-buttons input-group-btn">
																	<button type="button" class="btn spinner-up default"><i class="fa fa-angle-up"></i>
																	</button>
																	<button type="button" class="btn spinner-down default"><i class="fa fa-angle-down"></i>
																	</button>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-3">Dia(s)</div>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">Fim</label>
													<div class="col-md-3">
														<select name="repeticao_fim[]" alt="repeticao_fim"  class="form-control select2me" data-placeholder="Selecionar...">
															<option value="nunca">Nunca</option>
															<option value="depois_de">Depois de</option>
															<option value="na_data">Na Data</option>		
														</select>
													</div>
													
													<div alt="depois_de" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
																<input name="num_ocorrencia_fim[]" type="text" class="form-control">
														</div>
														<div class="col-md-3">
																ocorrência(s)
														</div>
													</div>
													
													<div alt="na_data" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
															<div class="input-group input-small date date-picker" data-date="01-06-2018" data-date-format="dd-mm-yyyy">
																<input name="dth_ocorrencia_fim[]"type="text" class="form-control">
																	<span class="input-group-btn">
																		<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																	</span>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>	
								</div>

							</div>
							<!-- Diaria -->
							
							<!-- Semanal -->
							<div id="semanal" style="visibility:hidden;  display:none;">

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">
														<input type="radio" name="quando_repetir" value="Pra fazer" class="icheck" data-radio="iradio_square-blue" checked>Repetir a cada</label>
													<div class="col-md-3">
														<div id="spinner_semanal" class="form-inline">
															<div class="input-group" style="width:150px;">
																<input type="text" class="spinner-input form-control" maxlength="3" name="repetir_a_cada[]">
																<div class="spinner-buttons input-group-btn">
																	<button type="button" class="btn spinner-up default"><i class="fa fa-angle-up"></i>
																	</button>
																	<button type="button" class="btn spinner-down default"><i class="fa fa-angle-down"></i>
																	</button>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-3">Semanas(s)</div>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">
														<input type="radio" name="quando_repetir" value="Pra fazer" class="icheck" data-radio="iradio_square-blue" checked>às/aos</label>
													<div class="col-md-10">
														<div class="input-group">
															<div class="icheck-inline">
																<label><input name="repetir_dia_semana[]" value="DOM" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">DOM</label>
																<label><input name="repetir_dia_semana[]" value="SEG" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">SEG</label>
																<label><input name="repetir_dia_semana[]" value="TER" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">TER</label>
																<label><input name="repetir_dia_semana[]" value="QUA" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">QUA</label>
																<label><input name="repetir_dia_semana[]" value="QUI" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">QUI</label>
																<label><input name="repetir_dia_semana[]" value="SEX" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">SEX</label>
																<label><input name="repetir_dia_semana[]" value="SAB" type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue">SAB</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">Fim</label>
													<div class="col-md-3">
														<select name="repeticao_fim[]" alt="repeticao_fim"  class="form-control select2me" data-placeholder="Selecionar...">
															<option value="nunca">Nunca</option>
															<option value="depois_de">Depois de</option>
															<option value="na_data">Na Data</option>		
														</select>
													</div>
													
													<div alt="depois_de" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
																<input name="num_ocorrencia_fim[]" type="text" class="form-control">
														</div>
														<div class="col-md-3">
																ocorrência(s)
														</div>
													</div>
													
													<div alt="na_data" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
															<div class="input-group input-small date date-picker" data-date="01-06-2018" data-date-format="dd-mm-yyyy">
																<input name="dth_ocorrencia_fim[]" type="text" class="form-control">
																	<span class="input-group-btn">
																		<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																	</span>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>	
								</div>

							</div>
							<!-- Semanal -->

							<!-- Mensal -->
							<div id="mensal" style="visibility:hidden;  display:none;"> 

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">
														<input type="radio" name="quando_repetir" value="Pra fazer" class="icheck" data-radio="iradio_square-blue" checked>No dia</label>
															<div class="col-md-3">
																<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
																	<option value="1">1</option>
																	<option value="2">2</option>			
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																	<option value="8">8</option>
																	<option value="9">9</option>
																	<option value="10">10</option>
																	<option value="11">11</option>
																	<option value="12">12</option>
																	<option value="13">13</option>
																	<option value="14">14</option>
																	<option value="15">15</option>
																	<option value="16">16</option>
																	<option value="17">17</option>
																	<option value="18">18</option>
																	<option value="19">19</option>
																	<option value="20">20</option>
																	<option value="21">21</option>
																	<option value="22">22</option>
																	<option value="23">23</option>
																	<option value="24">24</option>
																	<option value="25">25</option>
																	<option value="26">26</option>
																	<option value="27">27</option>
																	<option value="28">28</option>
																	<option value="29">29</option>
																	<option value="30">30</option>
																	<option value="31">31</option>
																	<option value="ultimo">último</option>		
																</select>
															</div>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2"><input type="radio" name="quando_repetir" value="Pra fazer" class="icheck" data-radio="iradio_square-blue" checked>no</label>
													<div class="col-md-3">
														<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="Primeiro(a)">Primeiro(a)</option>
															<option value="Segundo(a)">Segundo(a)</option>			
															<option value="Terceiro(a)">Terceiro(a)</option>
															<option value="Quarto(a)">Quarto(a)</option>
															<option value="Último(a)">Último(a)</option>
														</select>
													</div>
													<div class="col-md-3">
														<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="Domingo">Domingo</option>
															<option value="Segunda-feira">Segunda-feira</option>			
															<option value="Terça-feira">Terça-feira</option>
															<option value="Quarta-feira">Quarta-feira</option>
															<option value="Quinta-feira">Quinta-feira</option>
															<option value="Sexta-feira">Sexta-feira</option>
															<option value="Sábado">Sábado</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2" style="text-align:right;">Fim</label>
													<div class="col-md-3">
														<select name="repeticao_fim[]" alt="repeticao_fim"  class="form-control select2me" data-placeholder="Selecionar...">
															<option value="nunca">Nunca</option>
															<option value="depois_de">Depois de</option>
															<option value="na_data">Na Data</option>		
														</select>
													</div>
													
													<div alt="depois_de" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
																<input name="num_ocorrencia_fim[]" type="text" class="form-control">
														</div>
														<div class="col-md-3">
																ocorrência(s)
														</div>
													</div>
													
													<div alt="na_data" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
															<div class="input-group input-small date date-picker" data-date="01-06-2018" data-date-format="dd-mm-yyyy">
																<input name="dth_ocorrencia_fim[]"type="text" class="form-control">
																	<span class="input-group-btn">
																		<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																	</span>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>	
								</div>

							</div>
							<!-- Mensal -->

							<div id="anual" style="visibility:hidden;  display:none;"> <!-- Anual -->

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">em</label>
													<div class="col-md-3">
														<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="Janeiro">Janeiro</option>
															<option value="Fevereiro">Fevereiro</option>			
															<option value="Março">Março</option>
															<option value="Abril">Abril</option>
															<option value="Maio">Maio</option>
															<option value="Junho">Junho</option>
															<option value="Julho">Julho</option>
															<option value="Agosto">Agosto</option>
															<option value="Setembro">Setembro</option>
															<option value="Outubro">Outubro</option>
															<option value="Novembro">Novembro</option>
															<option value="Dezembro">Dezembro</option>
														</select>
													</div>
													<div class="col-md-3">	
														<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="1">1</option>
															<option value="2">2</option>			
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
															<option value="16">16</option>
															<option value="17">17</option>
															<option value="18">18</option>
															<option value="19">19</option>
															<option value="20">20</option>
															<option value="21">21</option>
															<option value="22">22</option>
															<option value="23">23</option>
															<option value="24">24</option>
															<option value="25">25</option>
															<option value="26">26</option>
															<option value="27">27</option>
															<option value="28">28</option>
															<option value="29">29</option>
															<option value="30">30</option>
															<option value="31">31</option>
															<option value="ultimo">último</option>			
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">no</label>
													<div class="col-md-3">
														<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="Primeiro(s)">Primeiro(a)</option>
															<option value="Segundo(a)">Segundo(a)</option>			
															<option value="Terceiro(a)">Terceiro(a)</option>
															<option value="Quarto(a)">Quarto(a)</option>
															<option value="Último(a)">Último(a)</option>
														</select>
													</div>
													<div class="col-md-3">
														<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="Domingo">Domingo</option>
															<option value="Segunda-feira">Segunda-feira</option>			
															<option value="Terça-feira">Terça-feira</option>
															<option value="Quarta-feira">Quarta-feira</option>
															<option value="Quinta-feira">Quinta-feira</option>
															<option value="Sexta-feira">Sexta-feira</option>
															<option value="Sábado">Sábado</option>
														</select>
													</div>
													<div class="col-md-1">
															de
													</div>
													<div class="col-md-3">
														<select name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar...">
															<option value="Janeiro">Janeiro</option>
															<option value="Fevereiro">Fevereiro</option>			
															<option value="Março">Março</option>
															<option value="Abril">Abril</option>
															<option value="Maio">Maio</option>
															<option value="Junho">Junho</option>
															<option value="Julho">Julho</option>
															<option value="Agosto">Agosto</option>
															<option value="Setembro">Setembro</option>
															<option value="Outubro">Outubro</option>
															<option value="Novembro">Novembro</option>
															<option value="Dezembro">Dezembro</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-2"></label>
											<div class="col-md-10">
												<div class="col-md-12">
													<label class="control-label col-md-2">Fim</label>
													<div class="col-md-3">
														<select name="repeticao_fim[]" alt="repeticao_fim"  class="form-control select2me" data-placeholder="Selecionar...">
															<option value="nunca">Nunca</option>
															<option value="depois_de">Depois de</option>
															<option value="na_data">Na Data</option>		
														</select>
													</div>
													
													<div alt="depois_de" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
																<input name="num_ocorrencia_fim[]" type="text" class="form-control">
														</div>
														<div class="col-md-3">
																ocorrência(s)
														</div>
													</div>
													
													<div alt="na_data" style="visibility:hidden;  display:none;">
														<div class="col-md-2">
															<div class="input-group input-small date date-picker" data-date="01-06-2018" data-date-format="dd-mm-yyyy">
																<input name="dth_ocorrencia_fim[]"type="text" class="form-control">
																	<span class="input-group-btn">
																		<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
																	</span>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>	
								</div>

							</div>
							<!-- Anual -->
						</div>
					</div>
					<br>
					<!-- END FORM-->
				</form>	
			</div>  
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>

<!--
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES--
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Anexar arquivos
				</div>
			</div>

			<div class="portlet-body form">
				<!-- BEGIN FORM--
				<form id="fileupload" action="<?= base_url() ?>assets/global/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
					<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload --
					<div class="row fileupload-buttonbar">
						<div class="col-lg-7">
							<!-- The fileinput-button span is used to style the file input field as button --
							<span class="btn green fileinput-button"><i class="fa fa-plus"></i>
								<span>Add Arquivos... </span>
								<input type="file" name="files[]" multiple="">
							</span>
							
							<button type="submit" class="btn blue start"><i class="fa fa-upload"></i>
								<span>Iniciar upload </span>
							</button>
							
							<button type="reset" class="btn warning cancel"><i class="fa fa-ban-circle"></i>
								<span>Cancelar upload </span>
							</button>

							<button type="button" class="btn red delete"><i class="fa fa-trash"></i>
								<span>Deletar</span>
							</button>
								<input type="checkbox" class="toggle">
								<!-- The global file processing state --
								<span class="fileupload-process"></span>
						</div>
						<!-- The global progress information --
						<div class="col-lg-5 fileupload-progress fade">
							<!-- The global progress bar --
							<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								<div class="progress-bar progress-bar-success" style="width:0%;">
								</div>
							</div>
							<!-- The extended global progress information --
							<div class="progress-extended">
								 &nbsp;
							</div>
						</div>
					</div>
					<!-- The table listing the files available for upload/download --
					<table role="presentation" class="table table-striped clearfix">
					<tbody class="files">
					</tbody>
					</table>
				</form>
			</div>  
		</div>
		<!-- END VALIDATION STATES--
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES--
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Seguidores
					
				</div>
			</div>

			<div class="portlet-body form">
				<!-- BEGIN FORM--

				<div class="portlet-body form">

					<h4 class="block">ADICIONAR SEGUIDOR <span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Pessoas que precisam receber notificações a cada alteração ou comentário, onde precisam se envolver na demanda, decidir ou aprovar, mas não precisaram trabalhar nela." data-original-title="" title=""> ?
					</span></h4>

					

					<!-- BEGIN FORM--
					<form action="index.html" class="form-horizontal form-row-seperated">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-9">
									<select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
										<option>Brizenia Brito</option>
										<option>Paulo de Sousa</option>
										<option selected>Nasio Victor</option>
										<option selected>Monica Lima</option>
										<option>Ralny Andrade</option>
										<option>Manoel Dantas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<button type="submit" class="btn green">
									<i class="fa fa-check"></i>Adcionar
								</button>
							</div>
						</div>
					</form>
					<!-- END FORM--
				</div>
				<!-- END PORTLET--
			</div>  
		</div>
		<!-- END VALIDATION STATES--
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES--
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Adicionar uma nova regra
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM--
				<h4 class="block">TAREFAS PRÉ-REQUISITO <span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Aqui você pode adicionar tarefas que são pré-requisito, ou seja, que devem ser entregues para que esta(a atual tarefa) possa ser iniciada" data-original-title="" title=""> ?
					</span>
				</h4>



				<div class="row">
					<form id="formProduto" action="" method="post">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Buscar</label>
								<input value="" id="produto" name="produto"  type="text" data-required="1" class="form-control"/>
								<input type="hidden" name="idRequisicaoProduto" id="idRequisicaoProduto" value="" />
								<input type="hidden" name="nome_produto" id="nome_produto" />
								<input type="hidden" name="unidade_medida" id="unidade_medida" />
								<input type="hidden" name="idProduto" id="idProduto" />				
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Responsável</label>
								<input value="" id="qtdProduto" name="qtdProduto"  type="text" class="form-control"/>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label"> Data Desejada</label>
								<input value="" id="valor_total_produto_exib" name="valor_total_produto_exib" disabled  type="text" class="form-control"/>
								<input type="hidden" name="valor_total_produto" id="valor_total_produto" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								
								<button value="" type="submit" class="btn green-haze"><i class="fa fa-check"></i>Adicionar</button>
								
							</div>
						</div>
					</form>	
				</div>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-striped table-hover" id="divProdutos">
							<thead>
								<tr>
									<th>
										Titulo da Tarefa 
									</th>
									<th width="15%">
										Responsável
									</th>
									<th width="15%">
										Entrega desejada
									</th>
									<th width="15%">

									</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>
										Rebocar parede esquedar do apartamento
									</td>
									<td>
										Willame 
									</td>
									<td>
										10/07/2018
									</td>
									<td>
										<a excluir="" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>

								<tr>
									<td>
										Aplicar massa corrida
									</td>
									<td>
										Cesar
									</td>
									<td>
										12/07/2018
									</td>
									<td>
										<a excluir="" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>		
							
								<tr>
									<td>
										Pintura do Apartamento
									</td>
									<td>
										Julimar
									</td>
									<td>
										14/07/2018
									</td>
									<td>
										<a excluir="" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
						</tbody>
					</table>

				</div>
			</div>
		</div>
		<br>
		<!-- END FORM--
	</div>	
</div>
<!-- END VALIDATION STATES--
</div>

<!-- END PAGE CONTENT INNER -->
<!-- VALIDAÇÃO -->
<script>


	jQuery(document).ready(function() {

		

		$("#inicio_tarefa").click(function(){

		    //Pegando tipo de repetição
		    var inicio_tarefa = ($(this).val());

		    if (inicio_tarefa == 'Prioridade')
		    {
		    	$("#prioridade").show();
		    		$("#prioridade").css("visibility", "visible");
		    		$("#prioridade").css("display", "block");
				$("#agendamento").hide();
				$("#repeticao").hide();
		    }

		    if (inicio_tarefa == 'Agendamento')
		    {
		    	$("#prioridade").show();
		    		$("#prioridade").css("visibility", "visible");
		    		$("#prioridade").css("display", "block");
				$("#agendamento").show();
					$("#agendamento").css("visibility", "visible");
		    		$("#agendamento").css("display", "block");
		    	$("#repeticao").show();
					$("#repeticao").css("visibility", "visible");
		    		$("#repeticao").css("display", "block");
		    }		    		

		});

		$("#repeticao_tarefa").click(function(){

		    //Pegando tipo de repetição
		    var repeticao_tarefa = ($(this).val());

		    if (repeticao_tarefa == 'diaria')
		    {
		    	$("#diaria").show();
		    		$("#diaria").css("visibility", "visible");
		    		$("#diaria").css("display", "block");
				$("#semanal").hide();
				$("#mensal").hide();
				$("#anual").hide();
		    }

		    if (repeticao_tarefa == 'semanal')
		    {
		    	$("#diaria").hide();
				$("#semanal").show();
					$("#semanal").css("visibility", "visible");
		    		$("#semanal").css("display", "block");
				$("#mensal").hide();
				$("#anual").hide();
		    }

		    if (repeticao_tarefa == 'mensal')
		    {
		    	$("#diaria").hide();
				$("#semanal").hide();
				$("#mensal").show();
					$("#mensal").css("visibility", "visible");
		    		$("#mensal").css("display", "block");
				$("#anual").hide();
		    }

		    if (repeticao_tarefa == 'anual')
		    {
		    	$("#diaria").hide();
				$("#semanal").hide();
				$("#mensal").hide();
				$("#anual").show();
					$("#anual").css("visibility", "visible");
		    		$("#anual").css("display", "block");
		    }

		     if (repeticao_tarefa == 'nunca')
		    {
		    	$("#diaria").hide();
				$("#semanal").hide();
				$("#mensal").hide();
				$("#anual").hide();
		    }		

		});

		$("select[alt='repeticao_fim']").click(function(){

		    //Pegando tipo de repetição
		    var repeticao_fim = ($(this).val());

		    if (repeticao_fim == 'depois_de')
		    {
		    	$("div[alt='depois_de']").css("visibility", "visible");
		    	$("div[alt='depois_de']").css("display", "block");
		    	$("div[alt='depois_de']").show();
				$("div[alt='na_data']").hide();
		    }

		    if (repeticao_fim == 'na_data')
		    {
		    	$("div[alt='na_data']").css("visibility", "visible");
		    	$("div[alt='na_data']").css("display", "block");
		    	$("div[alt='na_data']").show();
				$("div[alt='depois_de']").hide();
		    }

		    if (repeticao_fim == 'nunca')
	        {
	    		$("div[alt='depois_de']").hide();
	    		$("div[alt='na_data']").hide();
	        }

		});

		$('#spinner_diaria').spinner({value:1, step: 1, min: 1});
		$('#spinner_semanal').spinner({value:1, step: 1, min: 1});

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
			$(location).attr('href', '<?php // $url_fechar ?>');
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

					desc_titulo: {
						required: true
					},
					id_responsavel_tecnico: {
						required: true
					},
					dth_entrega_deseja: {
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

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn blue start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn red cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="fa fa-trash-o"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn yellow cancel btn-sm">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>



