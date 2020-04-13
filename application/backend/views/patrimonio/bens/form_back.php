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
		<div class="tabbable-custom tabbable-noborder">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1_1" data-toggle="tab">Dados Gerais</a></li>
				<?php // if (isset($form_editar)){ ?>
				<li><a href="#tab_1_2" data-toggle="tab">Troca de Departamento</a></li>
				<li><a href="#tab_1_3" data-toggle="tab">Fotos do Bem</a></li>
				<li><a href="#tab_1_4" data-toggle="tab">Históricos</a></li>
				<?php // } ?>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1_1">
					<div class="row">
						<!-- BEGIN VALIDATION STATES-->
						<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-desktop font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase"><?= $title_portlet ?></span>
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
											<?php if (isset($form_editar)){ ?>
												<input type="hidden" name="patrimonio" id="patrimonio" value="<?=  isset($show->patrimonio) ? $show->patrimonio : null ;?>">
												<a class="btn btn-default" data-toggle="modal" href="#basic"><i class="fa fa-refresh"></i> Trocar Patrimonio</a>
											<?php } ?>	
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
											<input value="<?=  isset($view->depreciacao_anual) ? $view->depreciacao_anual : null ;?>" name="depreciacao_anual" id="depreciacao_anual" type="text" class="form-control" maxlength="2"/>
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
											<input value="<?=  isset($view->dth_nota_fiscal) ? $view->dth_nota_fiscal : null ;?>" name="dth_nota_fiscal" id="dth_nota_fiscal" class="form-control form-control-inline date-picker" size="16" type="text"/>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Valor do Bem</label>
											<input value="<?=  isset($view->valor_patrimonio) ? $view->valor_patrimonio : null ;?>" name="valor_patrimonio" id="valor_patrimonio" type="text" class="form-control" maxlength="100"/>
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
													<option value="<?= $linha->id_departamento ?>" <?=  $select ?> ><?= $linha->id_departamento ?></option>
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
				</div>
				<div class="tab-pane" id="tab_1_2">
						<!-- BEGIN VALIDATION STATES-->
						<div class="portlet light"  style="padding: 12px 0px 0px 5px;">
							<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">TROCA DE DEPARTAMENTO</span>
							</div>
							<?php // $this->load->view('tpl/forms-btn-actions-tools') ?>
							<?php // $this->load->view('tpl/forms-btn-actions') ?>
							</div>
							<div class="portlet-body form">
							<!-- BEGIN FORM-->
								<form action="<?= base_url() ?>patrimonio/change_patrimonio_departamento" method="post" id="form_sample_3" <?= $form_class ?>>
									<input type="hidden" name="idItemPatrimonio" id="idItemPatrimonio" value="<?=  isset($view->idItemPatrimonio) ? $view->idItemPatrimonio : null ;?>">
									<input type="hidden" name="idDepartamentoOrigem" id="idDepartamentoOrigem" value="<?=  isset($view->idDepartamento) ? $view->idDepartamento : null ;?>">
									<?php $this->load->view('tpl/forms-btn-actions-save-top-aux') ?>
									<div class="form-body">
										<div class="alert alert-danger display-hide">
											<button class="close" data-close="alert"></button>
											<?= $erro_valid_form ?>
										</div>

										<div class="form-group">
											<label class="control-label col-md-2">Departamento</label>
											<div class="col-md-3">
												<select name="idDepartamentoDestino" id="idDepartamentoDestino" class="form-control select2me" data-placeholder="Selecionar...">
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
										<div class="form-group">
											<label class="control-label col-md-2">Local</label>
											<div class="col-md-5">
												<input name="local" id="local" type="text" class="form-control" maxlength="300"/>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Motivo</label>
											<div class="col-md-5">
												<textarea name="descMotivo" id="descMotivo" class="form-control autosizeme" rows="6"></textarea>
											</div>
										</div>
									</div>
									<br>
									<?php // $this->load->view('tpl/forms-info-alter-registro') ?>
									<?php // $this->load->view('tpl/forms-btn-actions-save') ?>
								</form>
							<!-- END FORM-->
							</div>	
						</div>
				</div>
				<div class="tab-pane" id="tab_1_3">
					<div class="row">

						<div class="col-md-4">
						<?php echo $this->session->flashdata('error_upload') ?>	
							<div class="clearfix margin-top-10">
								<span class="label label-danger">NOTA! </span>
								<span>A miniatura de imagem somente será exibida nas ultimas versões dos navegadores: Firefox, Chrome, Opera, Safari e Internet Explorer 10  </span>
							</div>
							<br />
							<form action="<?= base_url() ?>upload/upload_patrimonio" role="form" method="post" enctype="multipart/form-data">
							<input type="hidden" name="idItemPatrimonio" id="idItemPatrimonio" value="<?=  isset($view->idItemPatrimonio) ? $view->idItemPatrimonio : null ;?>">
								<div class="form-group">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											<img src="<?= base_url() ?>assets/ello/no-image.png" alt=""/>
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
										<div>
											<span class="btn default btn-file">
												<span class="fileinput-new">Selecionar Imagem</span>
												<span class="fileinput-exists">	Alterar </span>
												<input type="file" name="picture"></span>
												<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remover</a>
										</div>
									</div>
								</div>
								<div class="margin-top-9">
									<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Upload</button>
								</div>
							</form>
						</div>
						<div class="col-md-7">
						<!-- Galeria -->			
							<div class="row mix-grid">
							<?php 
								//Listando resultados
								//foreach ($lista_imagens_patrimonio as $linha){ 			          
							?>	
								<div class="col-md-6 col-sm-4 mix">
									<div class="mix-inner">
										<img class="img-responsive" src="<?php // echo base_url().'files/'.$linha->path.'/'.$linha->raw_name.$linha->file_ext ?>" alt="">
									</div>
								</div>
							<?php // } ?>	

							</div>
						<!-- Fim da Galeria -->
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_1_4">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">TROCA DE PATRIMÔNIO</span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th width="20%">Data</th>
									<th width="10%">Antigo</th>
									<th width="10%">Novo</th>
									<th>Motivo</th>
								</tr>
								</thead>
									<tbody>
									<?php 
										//Listando resultados
										//foreach ($lista_historio_troca_patrimonio as $linha){ 			          
								        ?>	
									<tr>
										<td><? //= $linha->dthCriacao ?></td>
										<td><? //= $linha->antigoPatrimonio ?></td>
										<td><? //= $linha->novoPatrimonio ?></td>
										<td><? // = $linha->descMotivo ?></td>
									</tr>
									<?php //} ?>
				
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">TROCA DE DEPARTAMENTO</span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th width="20%">Data</th>
									<th width="10%">Origem</th>
									<th width="10%">Destino</th>
									<th>Motivo</th>
								</tr>
								</thead>
									<tbody>
									<?php 
						
										//Listando resultados
										//foreach ($lista_historio_troca_patrimonio_departamento as $linha){ 			          
								        ?>	
									<tr>
										<td><?//= $linha->dthCriacao ?></td>
										<td><?//= $linha->origem ?></td>
										<td><?//= $linha->destino ?></td>
										<td><?//= $linha->descMotivo ?></td>
									</tr>
									<?php //} ?>
				
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
</div>			
<!-- END PAGE CONTENT INNER -->
<script>
    jQuery(document).ready(function() {
        //Botao fechar do formulario Principal
        $('#fechar').click(function() {
            //Retornar para listagem
            $(location).attr('href', '<?= base_url() ?>patrimonio/listar');
        });
        //Botao fechar do formulario Principal
        $('#fechar2').click(function() {
            //Retornar para listagem
            $(location).attr('href', '<?= base_url() ?>patrimonio/editar/<?= isset($view->idItemPatrimonio) ? $view->idItemPatrimonio : null ;?>"');
        });

        //Enviar Formulario para alteração do Patrimonio
        $('#btnNovoPatrimonio').click(function() {
            //Submit
            $( "#form_sample_2" ).submit();
        });

        //Mascaras
        $("#patrimonio").inputmask({
            "mask": "9",
            "repeat": 10,
            "greedy": false
        });

        $("#numNotaFiscal").inputmask({
            "mask": "9",
            "repeat": 10,
            "greedy": false
        });

        $("#depreciacaoAnual").inputmask({
            "mask": "9",
            "repeat": 10,
            "greedy": false
        });

        $("#valorPatrimonio").inputmask('R$ 999.999.999,99', {
            numericInput: true
        });

        $("#valorAtualPatrimonio").inputmask('R$ 999.999.999,99', {
            numericInput: true
        });
        
        $("#dthNotaFiscal").inputmask("d/m/y", {
            autoUnmask: true
        }); 

        $("#dthFimGarantia").inputmask("d/m/y", {
            autoUnmask: true
        }); 

        //Iniciar Validação do formulario
        FormValidation.init();

        //Passando ação do button do formulario 
        $("button").click(function() {
        	//Recebe o value do button clicado
			var acao = this.value;
			//altera o value do hidden que vai no POST do formulario
			$("#acao").attr('value', acao);
		});
		
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

	//dias = getDateDiff('2012-12-25', new Date(), 'dias');
	//total_meses = getDateDiff('2015-05-18', new Date(), 'meses');
 	//anos = getDateDiff('2012-12-25', new Date(), 'anos');

 	/********************** CALCULAR DEPRECIAÇÃO DO PATRIMONIO - não baudie o negocio****************/
 	//
 	var dataNF = document.getElementById('dthNotaFiscal').value;
 	//Organizando data no padrao americano
 	var diaNF = dataNF.substr(0,2);
 	var mesNF = dataNF.substr(2,2);
 	var anoNF = dataNF.substr(4,4);
 	//Data no formatada
 	var dataNotaFiscal = anoNF + '-' + mesNF + '-' + diaNF;

 	var er                     = /\^|~|\?|,|\*|\.|\-/g;
 	//Calcula a quantidade de meses entre a data da nota fiscal e a data atual
 	var total_meses            = getDateDiff(dataNotaFiscal, new Date(), 'meses');
 	//Valor patrimonio
 	var valorPatrimonio        = document.getElementById('valorPatrimonio').value.replace(er,"") / 100; 
 	//Taxa de Depreciação Anual
 	var taxaDepreciacaoAnual   = document.getElementById('depreciacaoAnual').value; 
	//Calcula valor da depreciação anual
	var valorDepreciavelAnual  = (valorPatrimonio * taxaDepreciacaoAnual) / 100;
	//Calcula valor da depreciação mensal
	var valorDepreciavelMensal = valorDepreciavelAnual / 12;
	//Multiplica a depreciação mensal pela quantidade de meses que o patrimonio foi comprado 
	var valorDepreciacao       = valorDepreciavelMensal * total_meses;
	//Calcula o valor atual: Valor do patrimonio menos o valor total da depreciação
	var valorAtualPatrimonio = (valorPatrimonio - valorDepreciacao) * 100;
	//Valor Formatado
	var valorAtualPatrimonioFormatado = valorAtualPatrimonio.toFixed(0).replace(er,"");
	//Insere no imput o valor da depreciação
	document.getElementById('valorAtualPatrimonio').value = valorAtualPatrimonioFormatado; 
 
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
                    descItemPatrimonio: {
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

//Resgatando Depreciação Anual do Grupo de Bem
$(function(){
	//Definindo url
	var path = '<?php echo base_url(); ?>'
	//A funçao ira executa quando houver mudança no combobox
	$("select[name=idGrupoBem]").change(function(){
		//Pegando value do combo selecionado 
		idGrupoBem = $(this).val();
		//Enviando Pesquisa	
		$.getJSON( path + 'patrimonio/retornaDeprecAnualGrupoBensAjax/' + idGrupoBem, function (data){
			//Exibir no console
			//console.log(data);
			//Verrendo resultado
			$.each(data, function(i, obj){
				//inseirindo valor resgatado
		    	$("input[name='depreciacaoAnual']").attr( {value : obj.depreciacaoAnual} );
		 		
			});
		});
	});
});

</script>



