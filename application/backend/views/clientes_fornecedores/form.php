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
				<form action="<?= base_url() ?>clientes-e-fornecedores/salvar" method="post" id="form_sample_1" <?= $form_class ?>>

					<input type="hidden" name="id" id="id" value="<?= isset($show->token_id) ? $show->token_id : null ;?>">

					<?php  $this->load->view('tpl/forms-btn-actions-save-top') ?>

					<div class="form-body">

						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Tipo Pessoa</label>
									<select id="tipoPessoa" name="tipo_pessoa" class="form-control select2me" data-placeholder="Selecionar...">
									<?php 

											if(isset($form_editar)){

												$Juridica = ''; $Fisica = '';
												
												if($show->tipo_pessoa == 'J')
												{
													$Juridica = 'selected';
												}
												else
												{
													$Fisica	= 'selected';
												}
												
											}
									?>
										<option <?= isset($Juridica) ? $Juridica : null ?> value="J">Pessoa Juridica</option>
										<option <?= isset($Fisica) ? $Fisica : null ?> value="F">Pessoa Fisica</option>
									</select>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" id="pcnpj">CNPJ</label>
									<label class="control-label" id="pcpf">CPF</label>
									<span class="form-group">
										<input value="<?=  isset($show->numCPF_numCNPJ) ? $show->numCPF_numCNPJ : null ;?>" name="numCPF_numCNPJ" id="numCPF_numCNPJ" type="text" class="form-control" maxlength="18"/>
										<!--
										<span class="input-group-btn" id="bt_buscarCNPJ">
											<a class="btn green" id="buscarCNPJ" data-toggle="modal" href="#basic">
											<i class="fa fa-search"></i></a>
										</span>
									-->
									</span>		

								</div>
							</div>
							<div class="col-md-6" id="razaosocial">
								<div class="form-group">
									<label class="control-label">Razao Social </label>
									<input value="<?=  isset($show->razao_social) ? $show->razao_social : null ;?>" name="razao_social"  type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->

						<div class="row"> 
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label" id="nomefantasia">Nome Fantasia <span class="required" aria-required="true"> * </span></label>
									<label class="control-label" id="nomecliente">Nome <span class="required" aria-required="true"> * </span></label>
									<input value="<?=  isset($show->nome_fantasia) ? $show->nome_fantasia : null ;?>" id="nome_fantasia" name="nome_fantasia" data-required="1" type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" id="inscmunicipal">Inscrição Municipal</label>
									<label class="control-label" id="rg">RG</label>
									<input value="<?=  isset($show->insc_municipal) ? $show->insc_municipal : null ;?>" name="insc_municipal" id="insc_municipal"  type="text" class="form-control" maxlength="20"/>
								</div>
							</div>

							<div class="col-md-3" id="inscestadual">
								<div class="form-group">
									<label class="control-label">Inscrição Estadual</label>
									<input value="<?=  isset($show->insc_estadual) ? $show->insc_estadual : null ;?>" name="insc_estadual"  type="text" class="form-control" maxlength="20"/>
								</div>
							</div>
							<!--/span-->
							<!--
							<div class="col-md-2">
								<label class="control-list"></label>
								<div class="checkbox-list">
									<label class="checkbox-inline">
									<input type="checkbox" name="optionsRadios2" value="option1"/>
									Isento </label>
								</div>

							</div>
							<!--/span-->

						</div>
						<!--/row-->

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Cep</label>
									<input value="<?=  isset($show->cep) ? $show->cep : null ;?>" name="cep" id="cep"  type="text" class="form-control" maxlength="10"/>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Endereco</label>
									<input value="<?=  isset($show->endereco) ? $show->endereco : null ;?>" name="endereco" id="logradouro" type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Numero</label>
									<input value="<?=  isset($show->numero) ? $show->numero : null ;?>" name="numero" type="text" class="form-control" maxlength="5"/>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Complemento</label>
									<input value="<?=  isset($show->complemento) ? $show->complemento : null ;?>" name="complemento"  type="text" class="form-control" maxlength="100"/>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Bairro</label>
									<input value="<?=  isset($show->bairro) ? $show->bairro : null ;?>" name="bairro" id="bairro"  type="text" class="form-control" maxlength="50"/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Cidade</label>
									<input value="<?=  isset($show->cidade) ? $show->cidade : null ;?>" name="cidade" id="cidade"  type="text" class="form-control" maxlength="200"/>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
	
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">UF </label>
									<select name="uf" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php 

											$select = '';	
											foreach ($ufs as $uf):
												if(isset($form_editar))
												{
													if($show->uf == $uf->sigla ) 
													{
														$select = 'selected="selected"';
													}
													else
													{
														$select = '';		
													}
												}
										?>
										<option value="<?= $uf->sigla ?>" <?=  $select ?>><?= $uf->nome_uf ?></option>
										<?php endforeach ?>
												}
									</select>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Pais</label>
									<input value="<?=  isset($show->pais) ? $show->pais : null ;?>" name="pais" id="pais"  type="text" class="form-control" maxlength="20"/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Telefone </label>
									<input value="<?=  isset($show->telefone) ? $show->telefone : null ;?>" name="telefone"  type="text" class="form-control" maxlength="15"/>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
					
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label class="control-label">Email</label>
									<input value="<?=  isset($show->email) ? $show->email : null ;?>" name="email" id="email" type="text" class="form-control" maxlength="45"/>
								</div>
								<span class="help-block">
											Este e-mail irá receber a nota fiscal. Para mais de um e-mail, separe por ponto e vírgula (;)
									</span>
							</div>
							<!--/span-->
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Tipo Cadastro </label>
									<select name="tipo_cadastro" class="form-control select2me" data-placeholder="Selecionar...">

									<?php 

											if(isset($form_editar)){

												$cliente = ''; $fornecedor = ''; $ambos = '';
												
												if($show->tipo_cadastro == 'Cliente')
												{
													$cliente = 'selected';
												}
												elseif ($show->tipo_cadastro == 'Fornecedor')
												{
													$fornecedor = 'selected';
												}
												else
												{
													$ambos	= 'selected';
												}
												
											}
									?>

										<option <?= isset($cliente) ? $cliente : null ?> value="Cliente">Cliente</option>
										<option <?= isset($fornecedor) ? $fornecedor : null ?>  value="Fornecedor">Fornecedor</option>
										<option <?= isset($ambos) ? $ambos : null ?> value="Ambos">Ambos</option>
									</select>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
					</div>
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
					Contatos
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
				</div>
			</div>
			
			<div class="portlet-body form">

				<!-- BEGIN FORM--
				<div <?= $form_class ?>>
				
					<div class="form-body">

						<div class="row">
							<div class="col-md-9">
								<div class="form-group">
									<label class="control-label">Nome</label>
									<input value="<?=  isset($show->contato_nome) ? $show->contato_nome : null ;?>" name="contato_nome"  type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Data de Nascimento</label>
									<input value="<?=  mostraData(isset($show->contato_dth_nascimento) ? $show->contato_dth_nascimento : null) ;?>" name="contato_dth_nascimento" id="contato_dth_nascimento" class="form-control form-control-inline date-picker" size="10" type="text"/>
								</div>
							</div>
						</div>
						<!--/row--

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Telefone </label>
									<input value="<?=  isset($show->contato_telefone) ? $show->contato_telefone : null ;?>" name="contato_telefone" id="contato_telefone" type="text" class="form-control" maxlength="15"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Ramal </label>
									<input value="<?=  isset($show->contato_ramal) ? $show->contato_ramal : null ;?>" name="contato_ramal"  type="text" class="form-control" maxlength="4"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Fax </label>
									<input value="<?=  isset($show->contato_fax) ? $show->contato_fax : null ;?>" name="contato_fax"  type="text" class="form-control" maxlength="15"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Celular </label>
									<input value="<?=  isset($show->contato_celular) ? $show->contato_celular : null ;?>" name="contato_celular"  type="text" class="form-control" maxlength="15"/>
								</div>
							</div>
						</div>
						<!--/row--						 
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Email </label>
									<input value="<?=  isset($show->contato_email) ? $show->contato_email : null ;?>" name="contato_email" id="contato_email"  type="text" class="form-control" maxlength="45"/>
								</div>							
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Website</label>
									<input value="http://<?=  isset($show->contato_website) ? $show->contato_website : null ;?>" name="contato_website"  type="text" class="form-control" maxlength="45"/>
								</div>	
							</div>
						</div>
						<!--/row--							   	

					</div>
					
				</div>
				<!-- END FORM--
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
					Enderecos <small>(Opcional)</small>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM--
				<div <?= $form_class ?>>
				
					<div class="form-body">

						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Tipo </label>
									<select name="endereco_tipo" class="form-control select2me" data-placeholder="Selecionar...">
										<option value="Retirada">Retirada</option>
										<option value="Entrega">Entrega</option>
										<option value="Cobranca">Cobranca</option>
									</select>
								</div>				
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">CEP </label>
									<input value="<?=  isset($show->endereco_cep) ? $show->endereco_cep : null ;?>" name="endereco_cep" id="endereco_cep"  type="text" class="form-control" maxlength="18"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-2">Endereco </label>
									<input value="<?=  isset($show->endereco_endereco) ? $show->endereco_endereco : null ;?>" name="endereco_endereco"  type="text" class="form-control" maxlength="300"/>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Numero </label>
									<input value="<?=  isset($show->endereco_numero) ? $show->endereco_numero : null ;?>" name="endereco_numero"  type="text" class="form-control" maxlength="5"/>
								</div>
							</div>
						</div>
						<!--/row--	
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Complemento </label>
									<input value="<?=  isset($show->endereco_complemento) ? $show->endereco_complemento : null ;?>" name="endereco_complemento"  type="text" class="form-control" maxlength="100"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Bairro </label>
									<input value="<?=  isset($show->endereco_bairro) ? $show->endereco_bairro : null ;?>" name="endereco_bairro"  type="text" class="form-control" maxlength="50"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Cidade </label>
									<input value="<?=  isset($show->endereco_cidade) ? $show->endereco_cidade : null ;?>" name="endereco_cidade"  type="text" class="form-control" maxlength="50"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">UF </label>
									<select name="endereco_uf" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php foreach ($ufs as $uf):?>
										<option value="<?= $uf->sigla ?>"><?= $uf->nome_uf ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>
						<!--/row--
					</div>
				</div>
				<!-- END FORM--
			</div>	
		</div>
		<!-- END VALIDATION STATES--
	</div>
</div>
<!--
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES--
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Configuracoes adicionais<small> (Opcional)</small>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM--
				<div <?= $form_class ?>>
				
					<div class="form-body">								 
						
						<div class="form-group">
							<label class="control-label col-md-2">Config Id Lista Preco </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->config_id_lista_preco) ? $show->config_id_lista_preco : null ;?>" name="config_id_lista_preco"  type="text" class="form-control" maxlength="1"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Config Id Cond Pagto </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->config_id_cond_pagto) ? $show->config_id_cond_pagto : null ;?>" name="config_id_cond_pagto"  type="text" class="form-control" maxlength="1"/>
							</div>
						</div>

					</div>
					
				</div>
				<!-- END FORM--
			</div>	
		</div>
		<!-- END VALIDATION STATES--
	</div>
</div>
-->
<!--
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES--
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Fiscais e tributarias <small>(Opcional)</small>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM--
				<div <?= $form_class ?>>
				
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Observacoes </label>
									<textarea name="fiscais_tributarias_obsvc" class="form-control autosizeme" rows="6"><?=  isset($show->fiscais_tributarias_obsvc) ? $show->fiscais_tributarias_obsvc : null ;?></textarea>
								</div>
							</div>
						</div>		
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Consumidor Final </label>
									<div class="input-group">
										<div class="icheck-inline">
											<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Sim </label>
											<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Nao </label>
										</div>
									</div>
								</div>
							</div>	

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Ramo de Atividade</label>
										<div class="input-group">
											<div class="icheck-inline">
												<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Servicos </label>
												<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Industria </label>
												<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Atacado </label>
												<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Varejo </label>
											</div>
										</div>
								</div>
							</div>	

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Regime Tributario</label>
									<select name="endereco_tipo" class="form-control select2me" data-placeholder="Selecionar...">
										<option value="Simples Nascional">Simples Nascional</option>
										<option value="Regime Normal">Regime Normal</option>
									</select>
								</div>
							</div>
						</div>		

					</div>
					
				</div>
				</form>
				<!-- END FORM--
			</div>	
		</div>
		<!-- END VALIDATION STATES--
	</div>
</div>

<!--
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Dados adcionais<small>(Opcional)</small>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM--
				<div <?= $form_class ?>>
				
					<div class="form-body">	
						
						<div class="form-group">
							<label class="control-label col-md-2">Dados Adcionais Id Categoria </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dados_adcionais_id_categoria) ? $show->dados_adcionais_id_categoria : null ;?>" name="dados_adcionais_id_categoria"  type="text" class="form-control" maxlength="1"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dados Adcionais Inicio Atividade </label>
							<div class="col-md-3">
									<input value="<?=  data_hora(isset($show->dados_adcionais_inicio_atividade) ? $show->dados_adcionais_inicio_atividade : null) ;?>" name="dados_adcionais_inicio_atividade" id="dados_adcionais_inicio_atividade" class="form-control form-control-inline date-picker" size="16" type="text"/>
							</div>
						</div>

						
						<div class="form-group">
							<label class="control-label col-md-2">Dados Adcionais Final Atividade </label>
							<div class="col-md-3">
									<input value="<?=  data_hora(isset($show->dados_adcionais_final_atividade) ? $show->dados_adcionais_final_atividade : null) ;?>" name="dados_adcionais_final_atividade" id="dados_adcionais_final_atividade" class="form-control form-control-inline date-picker" size="16" type="text"/>
							</div>
						</div>

						
						<div class="form-group">
							<label class="control-label col-md-2">Dados Adcionais Id Vendedor </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dados_adcionais_id_vendedor) ? $show->dados_adcionais_id_vendedor : null ;?>" name="dados_adcionais_id_vendedor"  type="text" class="form-control" maxlength="1"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dados Adcionais Situacao </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dados_adcionais_situacao) ? $show->dados_adcionais_situacao : null ;?>" name="dados_adcionais_situacao"  type="text" class="form-control" maxlength="1"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dados Adcionais Insc Suframa </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dados_adcionais_insc_suframa) ? $show->dados_adcionais_insc_suframa : null ;?>" name="dados_adcionais_insc_suframa"  type="text" class="form-control" maxlength="100"/>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Dados Adcionais Obsvc </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->dados_adcionais_obsvc) ? $show->dados_adcionais_obsvc : null ;?>" name="dados_adcionais_obsvc"  type="text" class="form-control" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2">Sit Ativo </label>
							<div class="col-md-5">
								<input value="<?=  isset($show->sit_ativo) ? $show->sit_ativo : null ;?>" name="sit_ativo"  type="text" class="form-control" maxlength="1"/>
							</div>
						</div>
										   	
					</div>
					
				</div>
				</form>
				<!-- END FORM--
			</div>	
		</div>
		<!-- END VALIDATION STATES--
	</div>
</div> -->
<!-- END PAGE CONTENT INNER -->
<!-- VALIDAÇÃO -->
<script>

	jQuery(function($){
	   $("#cep").change(function(){
	      var cep_code = $(this).val();
	      if( cep_code.length <= 0 ) return;
	      $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
	         function(result){
	            if( result.status!=1 ){
	               alert(result.message || "Houve um erro desconhecido");
	               return;
	            }
	            $("input#cep").val( result.code );
	            $("input#cidade").val( result.city );
	            $("input#bairro").val( result.district );
	            $("input#logradouro").val( result.address );
	            $("#uf").val( result.state );
	            $('select[name="uf"]').val(result.state).change();
	            $("input#pais").val("Brasil");  

	            $('input[name="numero"]').focus();
	            
	            //$('select[name="uf"]').attr("disabled", true);
	            //$("input#cidade").attr("disabled", true);
	            //$("input#pais").attr("disabled", true);

	         });
	   });
	});

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

		$("#pcpf").hide();
		$("#nomecliente").hide();
		$("#rg").hide();
		$("#numCPF_numCNPJ").mask("99.999.999/9999-99");
		$("#numCPF_numCNPJ").val("<?=  isset($show->numCPF_numCNPJ) ? $show->numCPF_numCNPJ : null ;?>");

		<?php
		
    	if(isset($form_editar)){


    		if($show->tipo_pessoa == 'J'){

    			echo '
    			$("#pcpf").hide();
		    	$("#nomecliente").hide();
		    	$("#razaosocial").show();
		    	$("#rg").hide();
		    	$("#numCPF_numCNPJ").mask("99.999.999/9999-99");
    			';
    		}elseif($show->tipo_pessoa == 'F'){

    			echo '
    			$("#pcnpj").hide();
		    	$("#razaosocial").hide();
		    	$("#pcpf").show();
		    	$("#rg").show();
		    	$("#numCPF_numCNPJ").mask("999.999.999-99");
		    	$("#nomefantasia").hide();
		    	$("#inscmunicipal").hide();
    			$("#inscestadual").hide();
    			$("#bt_buscarCNPJ").hide();
		    	';

    		}
    		

    	}


    	?>
    	


    	$('#tipoPessoa').change(function() {
    	 	
    		var pessoa = this.value;

    		if (pessoa == 'F'){
    			$('#razaosocial').hide();
    			$('#nomefantasia').hide();
    			$('#pcnpj').hide();
    			$('#pcpf').show();
    			$('#nomecliente').show();
    			$('#rg').show();
    			$('#inscmunicipal').hide();
    			$('#inscestadual').hide();
    			$('#bt_buscarCNPJ').hide();
    			$("#numCPF_numCNPJ").val('');
    			$('#insc_municipal').val('');
    			$("#numCPF_numCNPJ").mask('999.999.999-99');

    		}
    		else
    		{
    			$('#pcpf').hide();
    			$('#rg').hide();
    			$('#nomecliente').hide();
    			$('#pcnpj').show();
    			$('#razaosocial').show();
    			$('#nomefantasia').show();
    			$('#inscmunicipal').show();
    			$('#inscestadual').show();
    			$('#bt_buscarCNPJ').show();
    			$("#numCPF_numCNPJ").val('');
    			$("#numCPF_numCNPJ").mask('99.999.999/9999-99');
    		}
        });

		$('input[name=telefone]').focusout(function(){
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

        $("#cep").mask('99.999-999');

        $("#endereco_cep").mask('99.999-999');

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

                	nome_fantasia: {
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

<?php // $this->load->view('zata/modulos/template/base_html/cnpj_modal_captcha.php') ?>

