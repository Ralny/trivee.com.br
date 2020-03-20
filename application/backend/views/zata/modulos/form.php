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
				<li class="active"><a href="#tab_1_1" data-toggle="tab">Geral</a></li>
				<?php if (isset($form_editar)){ ?>
				<li><a href="#tab_1_2" data-toggle="tab">SQL</a></li>
				<li><a href="#tab_1_3" data-toggle="tab">Grid</a></li>
				<li><a href="#tab_1_4" data-toggle="tab">Formulario</a></li> 
				<li><a href="#tab_1_5" data-toggle="tab">Permissoes</a></li>
				<li><a href="#tab_1_6" data-toggle="tab">Reconstruir</a></li>
				<?php } ?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1_1">
					<!-- GERAL -->	
					<div class="row">
						<!-- BEGIN VALIDATION STATES-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-cogs font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">CRIAR NOVO MODULO</span>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form action="<?= base_url() ?>zata/modulos/save_create" method="post" id="form_sample_1" <?= $form_class ?>>
									<input type="hidden" name="id" id="id" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">
									<div class="form-body">
										<div class="alert alert-danger display-hide">
											<button class="close" data-close="alert"></button>
											<?= $erro_valid_form ?>
										</div>

										<div class="form-group">
											<label class="control-label col-md-2">Nome do Modulo<span class="required"> * </span></label>
											<div class="col-md-5">
												<input value="<?=  isset($show->nome_modulo) ? $show->nome_modulo : null ;?>" name="nome_modulo" data-required="1" type="text" class="form-control" maxlength="100"/>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-md-2">Titulo<span class="required"> * </span></label>
											<div class="col-md-5">
												<input value="<?=  isset($titulo_modulo) ? $titulo_modulo : null ;?>" name="titulo_modulo" data-required="1" type="text" class="form-control" maxlength="100"/>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-md-2">Descrição<span class="required"> * </span></label>
											<div class="col-md-5">
												<input value="<?=  isset($show->desc_modulo) ? $show->desc_modulo : null ;?>" name="desc_modulo" data-required="1" type="text" class="form-control" maxlength="255"/>
											</div>
										</div>				   	

										<div class="form-group">
											<label class="control-label col-md-2">Class Controller<span class="required"> * </span></label>
											<div class="col-md-5">
												<input type="hidden" name="nome_controller" value="<?=  isset($show->nome_controller) ? $show->nome_controller : null ;?>">
												<input value="<?=  isset($show->nome_controller) ? $show->nome_controller : null ;?>" name="nome_controller" data-required="1" type="text" class="form-control" maxlength="255" <?= $disabled ?> />
											</div>
										</div>				   

										<div class="form-group">
											<label class="control-label col-md-2">Tabela<span class="required"> * </span></label>
											<input type="hidden" name="tabela_db" id="tabela_db_c" value="<?=  isset($show->tabela_db) ? $show->tabela_db : null ;?>">
											<div class="col-md-4">
												<select name="tabela_db" <?= $disabled ?> class="form-control select2me" data-placeholder="Selecionar...">
													<option value=""></option>
													<?php 
													// Listando registros da tabela
													foreach ($tabelas as $tabela):

														if (isset($form_editar))
														{
															//Verificando qual unidade deve ficar selecionada no COMBO
															if ($tabela == $show->tabela_db)
															{ 
																$select = 'selected="selected"';
															}
															else
															{
																//Senão não está ativo
																$select = '';
															}
														}	
														?>	
														<option value="<?= $tabela ?>" <?=  $select ?> ><?= $tabela ?></option>
													<?php  endforeach ?>	
												</select>
											</div>
										</div>	

										<?php 
							// So ira exibir se o formulario estiver em modo de cadastro
										if (!isset($form_editar)){ ?>

										<div class="form-group">
											<label class="col-md-2 control-label"></label>
											<div class="col-md-9">
												<div class="input-group" >
													<div class="icheck-inline">
														<label><input type="radio" name="criar_sql" value="auto" class="icheck" data-radio="iradio_square-blue" checked> Auto SQL</label>
														<label><input type="radio" name="criar_sql" value="manual" class="icheck" data-radio="iradio_square-blue"> Manual SQL</label>
													</div>
												</div>
											</div>
										</div>

										<div id="sql">	

											<div class="form-group">
												<label class="col-md-2 control-label">SQL SELECT </label>
												<div class="col-md-7">
													<textarea class="form-control" rows="4" name="sql_select"></textarea>
												</div>
											</div>

										</div>

										<?php } ?>	

									</div>
									<br>

									<?php 
									// So ira exibir se o formulario estiver em modo de cadastro
									if (!isset($form_editar)){ ?>

									<div class="form-actions" style="background: #f5f5f5;">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<input  type="hidden" name="acao" id="acao">
														<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Criar novo modulo</button>
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
					</div>
				</div>

				<div class="tab-pane" id="tab_1_2">
					<!-- SQL -->	
					<div class="row">
						<!-- BEGIN VALIDATION STATES-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-desktop font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">EDITAR SQL</span>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<form action="<?= base_url() ?>zata/modulos/save_sql/<?=  isset($show->token_id) ? $show->token_id : null ;?>" method="post" <?= $form_class ?>>

									<div class="form-body">
										<div class="alert alert-danger display-hide">
											<button class="close" data-close="alert"></button>
											<?= $erro_valid_form ?>
										</div>

										<div class="note note-info ">
											<h4 class="block">Informacao Importante!</h4>
											<p>
												Voce pode usar SGBD como ferramenta de construcao de consulta como SQL YOG ou PHPMyAdmin, para construir sua instrução de consulta e visualizar o resultado esperado.
												<br />
												Em seguida, copie a sintaxe aqui.
											</p>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">SQL SELECT</label>
											<div class="col-md-7">
												<textarea class="form-control" rows="4" name="sql_select"><?=  isset($sql_select) ? $sql_select : null ;?></textarea>
											</div>
										</div>

									</div>
									<br>
									<div class="form-actions" style="background: #f5f5f5;">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<input  type="hidden" name="acao" id="acao">
														<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Salvar SQL</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- END FORM-->
							</div>
						</div>
					</div>

				</div>

				<div class="tab-pane" id="tab_1_3">
					<!-- TABELA -->
					<div class="row">
						<!-- BEGIN VALIDATION STATES-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-desktop font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">Grid - Lista de registros</span>
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<div class="form-body">
									<form action="<?= base_url() ?>zata/modulos/save_grid/<?=  isset($show->token_id) ? $show->token_id : null ;?>" method="post" <?= $form_class ?>>

										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Field</th>
													<th>Type</th>
													<th>Titulo / Caption</th>
													<th width="5%">Show</th>
												</tr>
											</thead>
											<tbody>
												<?php 
										// Listando campos da tabela
												if (isset($fields_grid)){

													$num = 0; 
													foreach ($fields_grid as $field):
														$id  =  ++$num;			            
														?>	
														<tr class="odd gradeX">
															<td><?= $id ?></td>
															<td><strong><?= $field['field'] ?></strong></td>
															<td><?= $field['type'] ?></td>
															<td>
																<input name="label[<?= $id ?>]" type="text" class="form-control" value="<?= $field['label'] ?>"/> 
															</td> 
															<td>
																<input <?php if($field['show'] == 1) echo 'checked="checked"';?> type="checkbox" class="icheck"  data-checkbox="icheckbox_square-blue" name="show[<?= $id ?>]">

																<input type="hidden" name="field[<?php echo $id;?>]" value="<?php echo $field['field'];?>" />
																<input type="hidden" name="alias[<?php echo $id;?>]" value="<?php echo $field['alias'];?>" />
																<input type="hidden" name="type[<?php echo $id;?>]"  value="<?php echo $field['type'];?>" />
																<input type="hidden" name="download[<?php echo $id;?>]" value="<?php echo $field['download'];?>" />

															</td>
														</tr>
														<?php 
													endforeach; }
													?>	
												</tbody>
											</table>

										</div>
										<br>
										<div class="form-actions" style="background: #f5f5f5;">
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-offset-3 col-md-9">
															<button value="salvar_grid" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Salvar Grid</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
									<!-- END FORM-->
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="tab_1_4">
						<!-- FORMULARIO -->
						<div class="portlet-body">
							<div class="tabbable tabs-left">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#tab_4_1" data-toggle="tab"> Elementos </a>
									</li>
									<li>
										<a href="#tab_4_2" data-toggle="tab"> Layout </a>
									</li>

								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_4_1">

										<div class="row">
											<!-- BEGIN VALIDATION STATES-->
											<div class="portlet light">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-desktop font-green-sharp"></i>
														<span class="caption-subject font-green-sharp bold uppercase">Form Grid</span>
													</div>
												</div>
												<div class="portlet-body form">
													<!-- BEGIN FORM-->
													<form action="<?= base_url() ?>zata/modulos/save_form/<?=  isset($show->token_id) ? $show->token_id : null ;?>" method="post" <?= $form_class ?>>

														<div class="form-body">

															<table class="table table-striped table-bordered table-hover">
																<thead>
																	<tr>
																		<th>No</th>
																		<th>Field</th>
																		<th>Titulo / Caption</th>
																		<th>Type</th>
																		<th width="5%">Show</th>
																		<th width="20%">Obrigatorio</th>
																		<th width="5%">Config</th>
																	</tr>
																</thead>
																<tbody>
																	<?php 
																// Listando campos da tabela
																	if (isset($fields_form)){

																		$num = 0; 
																		foreach ($fields_form as $field):
																			$id  =  ++$num;			            
																			?>	
																			<tr class="odd gradeX">
																				<td><?= $id ?></td>
																				<td><strong><?= $field['field'] ?></strong></td>
																				<td>
																					<input name="label[<?= $id ?>]" type="text" class="form-control" value="<?= $field['label'] ?>"/> 
																				</td> 
																				<td><?= $field['type'] ?></td>
																				<td>
																					<input <?php if($field['show'] == 1) echo 'checked="checked"';?> type="checkbox" class="icheck"  data-checkbox="icheckbox_square-blue" name="show[<?= $id ?>]">
																				</td>
																				<td>
																					<?php
																					$reqType = array(
																						'required'	=> 'Required',
																						'alpa'		=> 'Required Only Alpha ',
																						'numeric'	=> 'Required Only Number',	
																						'alpa_num'	=> 'Required Alpha & Numeric ',
																						'email'		=> 'Required Email',
																						'url'		=> 'Required Url',
																						'date'		=> 'Required Date'
																					);
																					?>
																					<select name="required[<?php echo $id;?>]" id="required" class="form-control select2me" data-placeholder="Selecionar...">
																						<option value="0" <?php if($field['required'] == 1) echo 'selected="selected"';?>>No Required</option>

																						<?php foreach($reqType as $item=>$val) { ?>

																						<option value="<?php echo $item;?>" <?php if($field['required'] == $item) echo 'selected="selected"';?>><?php echo $val;?></option>

																						<?php } ?>

																					</select>
																				</td>
																				<td>
																					<a href="#config-form" name="<?= $field['field'] ?>" class="btn btn-default" type="button" id="btn_field" data-toggle="modal">
																						<i class="fa fa-cog"></i>
																					</a>
																				</td> 
																			</tr>

																			<input type="hidden" name="field[<?php echo $id;?>]" value="<?php echo $field['field'];?>" />
																			<input type="hidden" name="alias[<?php echo $id;?>]" value="<?php echo $field['alias'];?>" />
																			<input type="hidden" name="type[<?php echo $id;?>]"  value="<?php echo $field['type'];?>" />

																			<?php 
																		endforeach; 
															 	}//Fim do IF
															 	?>		
															 </tbody>
															</table>

														</div>
														<br>
														<div class="form-actions" style="background: #f5f5f5;">
															<div class="row">
																<div class="col-md-12">
																	<div class="row">
																		<div class="col-md-offset-3 col-md-9">
																			<input  type="hidden" name="acao" id="acao">
																			<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Salvar Formulario</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</form>
													<!-- END FORM-->
												</div>
											</div>
										</div>

										<!-- MODAL CONFIG FORMULARIO -->
										<div class="modal fade modal-scroll" id="config-form" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
														<h4 class="modal-title">Editar Field: id_grupo</h4>
													</div>
													<div class="modal-body">
														<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
															<div class="row">
																<form action="<?= base_url() ?>zata/modulos/save_form/<?=  isset($show->token_id) ? $show->token_id : null ;?>" method="post" <?= $form_class ?>>
																	<input type="hidden" name="module_id" value="" />		
																	<input type="hidden" name="field"     value="" />
																	<input type="hidden" name="alias"     value="" />
																	<input type="hidden" name="type"      value="" />
																	<input type="hidden" name="label"     value=""/>
																	<input type="hidden" name="show"      value="" />
																	<input type="hidden" name="required"  value="" />

																	<div class="form-group">
																		<label class="control-label col-md-3">Form Type</label>
																		<div class="col-md-9">
																			<select name="form_type" id="form_type" class="form-control select2me" data-placeholder="Selecionar...">

																				<?php if (isset($field_type_opt)){ ?>	

																				<?php foreach($field_type_opt as $val => $item) { ?>
																				<option value="<?= $val; ?>"><?php echo $item;?></option>
																				<?php } ?>

																				<?php } ?> 	
																			</select>
																		</div>
																	</div>
																	<br />
																	<br />

																	<div class="form-group">
																		<label class="control-label col-md-3">Data Type</label>
																		<div class="col-md-9">
																			<div class="input-group">
																				<div class="icheck-inline">
																					<label><input type="radio" name="datatype" class="icheck" data-radio="iradio_square-blue" checked> Custom Value </label>
																					<label><input type="radio" name="datatype" class="icheck" data-radio="iradio_square-blue" value="database"> Database</label>
																				</div>
																			</div>
																		</div>
																	</div>

																	<div id="custon_value">

																		<br />

																		<div class="form-group clonado hide">
																			<label class="control-label col-md-3">Custom Value</label>
																			<div class="col-md-3">
																				<input name="custom_field_val[]" type="text" class="form-control" value="Value" />
																			</div>
																			<div class="col-md-3">
																				<input name="custom_field_display[]" type="text" class="form-control" value="Display Name" />
																			</div>
																			<div class="col-md-3">
																				<a href="" rel="" class=" btn btn-icon-only green">
																					<i class="fa fa-plus"></i>
																				</a>
																				<a href="javascript:;" class="btn btn-icon-only red">
																					<i class="fa fa-minus"></i>
																				</a>

																			</div>

																		</div>

																		<div class="form-group">
																			<label class="control-label col-md-3">Custom Value</label>
																			<div class="col-md-3">
																				<input name="custom_field_val[]" type="text" class="form-control" value="Value" />
																			</div>
																			<div class="col-md-3">
																				<input name="custom_field_display[]" type="text" class="form-control" value="Display Name" />
																			</div>
																			<div class="col-md-3">
																				<a class="clonador btn btn-icon-only green">
																					<i class="fa fa-plus"></i>
																				</a>
																				<a href="javascript:;" class="btn btn-icon-only red">
																					<i class="fa fa-minus"></i>
																				</a>

																			</div>

																		</div>

																	</div>

																	<div id="database">

																		<br />

																		<div class="form-group">
																			<label class="control-label col-md-3">Tabela</label>
																			<div class="col-md-9">
																				<select name="opt_tabela_db" id="opt_tabela_db" class="form-control select2me" data-placeholder="Selecionar...">
																					<option value=""></option>

																					<?php if (isset($show)){ ?>

																					<?php 
																			// Listando registros da tabela
																					foreach ($tabelas as $tabela):

																				//Verificando qual unidade deve ficar selecionada no COMBO
																						if ($tabela == $show->tabela_db)
																						{ 
																							$select = 'selected="selected"';
																						}
																						else
																						{
																					//Senão não está ativo
																							$select = '';
																						}

																						?>	
																						<option value="<?= $tabela ?>" <?=  $select ?> ><?= $tabela ?></option>
																					<?php  endforeach ?>	
																					<?php } ?>
																				</select>
																			</div>
																		</div>

																		<br />
																		<br />

																		<div class="form-group">

																			<label class="control-label col-md-3">Fields</label>
																			<div class="col-md-9">
																				<select name="field_table" id="field_table" class="form-control select2me" data-placeholder="Selecionar...">
																					<option value=""></option>
																				</select>
																			</div>
																		</div>


																		<br />
																		<br />

																		<div class="form-group">
																			<label class="control-label col-md-3">Display</label>
																			<div class="col-md-9">
																				<input id="name" name="name" type="text" class="form-control" value="Nome" />
																			</div>
																		</div>

																	</div>
																</form>																
															</div>
														</div>
													</div>


													<div class="modal-footer">
														<input type="hidden" name="idExclusao" id="idExclusao" value="">
														<button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
														<button type="button" class="btn green-haze">Salvar</button>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->

										<script>

										//Combo Dinamico - Campos de uma tabela
										jQuery(document).ready(function() {

											$('#database').hide();

											$('input:radio[name=datatype]').on('ifClicked', function() {

												val = $(this).val(); 

												if(val == 'database')
												{
													$('#database').show();
													$('#custon_value').hide();
												} else {
													$('#custon_value').show();
													$('#database').hide();
												}		  

											});


											$("select[name=form_type]").change(function(){
													//Pegando valor 
													tabela_db = $(this).val();

													//Verifica se esta vazio
													if ( tabela_db === '')
														return false;

													if(tabela_db == 'select' || tabela_db == 'radio' || tabela_db == 'checkbox')
													{
														$('#editar_field').show();
													} else {
														$('#editar_field').hide();
													}   

												});

										});

										$('.clonador').click(function(){
											    //clona o modelo oculto, clone(true) para copiar também os manipuladores de eventos
											    $clone = $('.clonado.hide').clone(true);
											    //remove a classe que oculta o modelo do elemento clonado
											    $clone.removeClass('hide');
											    //adiciona no form
											    $('form').append($clone);
											});

											//Para remover
											$('.btn_remove').click(function(){
												$(this).parents('.box_pergunta').remove();
											});


										    //Combo Dinamico - Campos de uma tabela
										    $(function(){

										    	var path = '<?php echo base_url(); ?>'
												//A funçao ira executa quando houver mudança no combobox
												$("select[name=opt_tabela_db]").change(function(){
													//Pegando valor 
													tabela_db = $(this).val();
													//Verifica se esta vazio
													if ( tabela_db === '')
														return false;
													
													resetaCombo('field_table');
													//Enviando Pesquisa	
													$.getJSON( path + 'zata/modulos/comboFieldsTabelaDB/' + tabela_db, function (data){

														//console.log(data);

														var option = new Array();
														//Preenchendo Combo com as informações de filtragem
														$.each(data, function(i, obj){
															//Criando Elemento
															option[i] = document.createElement('option');
													    	//Value
													    	$( option[i] ).attr( {value : obj.Field} );
													 		//Desc
													 		$( option[i] ).append( obj.Field );
													 		//Adcionando
													 		$("select[name='field_table']").append( option[i] );

													 	});

													});

												});

											});

											//Resetando Combo (Toda vez que muda a filtragem, elimina a consuta anterior)
											function resetaCombo( el) {
												//Nome do Compo
												$("select[name='"+ el +"']").empty();

												var option = document.createElement('option');                                  
												$("#s2id_" + el + " span[class='select2-chosen']").text('Selecionar...');
												$( option ).attr( {value : ''} );
												$( option ).append( '' );
												$("select[name='"+el+"']").append( option );
											}


										</script>    



										
									</div>
									<div class="tab-pane fade" id="tab_4_2">
										
									</div>
								</div>
							</div>
						</div>
					</div>	

					<div class="tab-pane" id="tab_1_5">
						<!-- PERMISSOES -->
						<div class="row">
							<!-- BEGIN VALIDATION STATES-->
							<div class="portlet light">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-desktop font-green-sharp"></i>
										<span class="caption-subject font-green-sharp bold uppercase">Permissoes do Modulo</span>
									</div>
								</div>
								<div class="portlet-body form">
									<!-- BEGIN FORM-->
									<form action="<?= base_url() ?>zata/modulos/save_permission/<?= isset($show->token_id) ? $show->token_id : null ;?>" method="post" id="form_sample_10" <?= $form_class ?>>

										<div class="form-body">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>No</th>
														<th>Usuario</th>
														<th>Listar</th>
														<th>Cadastrar</th>
														<th>Editar</th>
														<th>Excluir</th>
													</tr>
												</thead>
												<tbody>
													<?php

													$i=0; foreach($access as $gp) {?>	
													<tr class="odd gradeX">
														<td>1</td>
														<input type="hidden" name="id_usuario[]" value="<?php echo $gp['id_usuario'];?>" /></td>
														<td><?php echo $gp['nome_usuario'];?></td>
														<?php 
														foreach($tasks as $item=>$val) {?>												
														<td>
															<input name="<?php echo $item;?>[<?php echo $gp['id_usuario'];?>]" type="checkbox" class="icheck"data-checkbox="icheckbox_square-blue" value="<?php $gp[$item] ?>" <?php if($gp[$item] == 1) echo ' checked="checked" ';?> >
														</td> 
														<?php } ?>
													</tr>
													<?php  } ?>	
												</tbody>
											</table>

										</div>
										<br>
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
									</form>
									<!-- END FORM-->
								</div>
							</div>
						</div>
						
					</div>

					<div class="tab-pane" id="tab_1_6">
						<!-- RECONTRUIR -->
						<div class="row">
							<!-- BEGIN VALIDATION STATES-->
							<div class="portlet light">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-desktop font-green-sharp"></i>
										<span class="caption-subject font-green-sharp bold uppercase"> Reconstruir Arquivos </span>
									</div>
								</div>
								<div class="portlet-body form">
									<!-- BEGIN FORM-->
									<form action="<?= base_url() ?>zata/modulos/dobuild/<?= isset($show->token_id) ? $show->token_id : null ;?>" method="post" id="form_sample_11" <?= $form_class ?>>

										<div class="form-body">
											<table class="table table-bordered table-striped">
												<tbody>
													<tr>
														<td width="20%">
															Tipo de Arquivos
														</td>
														<td>
															<div class="input-group">
																<div class="icheck-inline">
																	<label>
																		<input checked type="radio" value="d" name="tipoArquivo" class="icheck" data-radio="iradio_square-blue"> Arquivos Dinamicos </label>
																		<label><input type="radio" value="e" name="tipoArquivo" class="icheck" data-radio="iradio_square-blue"> Arquivos Estaticos</label>
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td>
																Controller
															</td>
															<td>
																<div class="icheck-inline">
																	<label>
																		<input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="controller" value="1">
																		<code>
																			<?=  isset($show->nome_controller) ? $show->nome_controller : null ;?>
																			.php
																		</code>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Model
														</td>
														<td>
															<div class="icheck-inline">
																<label><input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="model" value="1">
																	<code>
																		<?=  isset($show->nome_controller) ? $show->nome_controller : null ;?>_model.php
																	</code> 
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Grid
														</td>
														<td>
															<div class="icheck-inline">
																<label><input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="grid" value="1" checked>
																	<code>main.php</code> em <code>views/<?=  isset($show->nome_controller) ? strtolower($show->nome_controller) : null ;?></code> 
																</label>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															Form
														</td>
														<td>
															<div class="icheck-inline">
																<label><input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue" name="form" value="1" checked>
																	<code>form.php</code> em <code>views/<?=  isset($show->nome_controller) ? strtolower($show->nome_controller) : null ;?></code> 
																</label>
															</div>
														</td>
													</tr>									
												</tbody>
											</table>
										</div>

										<p class="help-block">
											Os arquivos marcados serão substituídos pelo novo código.
										</p>

										<div class="form-actions" style="background: #f5f5f5;">
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-offset-3 col-md-9">
															<input name="rebuild" type="hidden" id="rebuild" value="ok">
															<input name="id_modulo" type="hidden" id="id_modulo" value="<?=  isset($show->token_id) ? $show->id_modulo : null ;?>">
															<input  type="hidden" name="acao" id="acao">
															<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Salvar Formulario</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
									<!-- END FORM-->
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>	
		</div>
		<!-- END VALIDATION STATES-->

</div>
<!-- END PAGE CONTENT INNER -->
<!-- VALIDAÇÃO -->
<script>

	jQuery(document).ready(function() {

        // Botao fechar do formulario 
        $('#fechar').click(function() {
            // Retorna para listagem
            $(location).attr('href', '<?= base_url().$url."/listar"?>');
        });

        // Iniciar Validação do formulario
        FormValidation.init();

        // Passando ação do button do formulario 
        $("button").click(function() {
        	// Recebe o value do button clicado
        	var acao = this.value;
			// Altera o value do hidden que vai no POST do formulario
			$("#acao").attr('value', acao);
		});

		// Exibir campo para inserir Sql Manual 
		$('#sql').hide();
		$('input:radio[name=criar_sql]').on('ifClicked', function() {
			val = $(this).val(); 
			if(val == 'manual')
			{
				$('#sql').show();
			} else {
				$('#sql').hide();
			}		  

		});

	});

	var FormValidation = function () {

    // Validação Basica
    var handleValidation1 = function() {

    	var form1 = $('#form_sample_1');
    	var error1 = $('.alert-danger', form1);

    	form1.validate({
                errorElement: 'span', //container default de input error
                errorClass: 'help-block help-block-error', // classe de mensagem default input error
                focusInvalid: false, // Não focar no ultimo input da validação
                ignore: "",  // Validar todos os campos inclusos no form

                rules: {
                	nome_modulo: {
                		required: true
                	},
                	titulo_modulo: {
                		required: true
                	},
                	desc_modulo: {
                		required: true
                	},
                	nome_controller_c: {
                		required: true
                	},
                	tabela_db_c: {
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
        // iniciando chamada da função validacao
        init: function () {

        	handleValidation1();

        }

    };

}();

</script>


