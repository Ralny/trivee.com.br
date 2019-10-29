<?php 
//Carregando configurações de conteiner
include ('application/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-green-sharp bold uppercase"><?= $title_portlet ?></span>
				</div>
				<?php $this->load->view('tpl/forms-btn-actions-tools') ?>
				<?php $this->load->view('tpl/forms-btn-actions') ?>
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-striped table-bordered">
					<tr>
						<td width="200">
							  <strong>Versão</strong>
						</td>
						<td>
							<?= $numVersao ?>							
						</td>
					</tr>
					<tr>
						<td>
							  <strong>Data da Liberação</strong>
						</td>
						<td>
							<?= mostra_data($dthLiberacaoVersao) ?>
						</td>
					</tr>
					<tr>
						<td>
							  <strong>Versionamento</strong>
						</td>
						<td>
						<a id="nova-versao" data-toggle="modal" href="#basic" class="btn yellow right"></i> Nova Versão</a>
						</td>
					</tr>
				</table>
			</div>
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-green-sharp bold uppercase">Release Notes</span>
				</div>
				<div class="actions btn-set">
					<?php $this->load->view('tpl/forms-actions-top') ?>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-striped table-bordered">
					<?php 					
					//Listando Versões
					foreach ($versoes as $versao) {
						//Aux = Limpar a lista de releases a cada loop
						$lista_releases = '';
						//Para cada versao listamos as sua releases
						foreach ($releases as $release) {
							//Verifica se a release pertece a versao listada
							if ($versao->idVersao == $release->idVersao){
								//Verifica qual o tipo release, para definirmos os icones e o tipo de release mostrados na view 
									if ($release->tipoRelease == 'bug-fix'){
											$class_icon = 'fa fa-bug';
											$tipoRelease = 'Bug Fix';
									}else{
										$class_icon = 'fa fa-lightbulb-o';
										$tipoRelease = 'Melhoria';
									}
								//Concatenando as releases para adicionar a <ul>	
								$lista_releases .= '<li><i class="'.$class_icon.'"></i><strong>'.$tipoRelease.':</strong> '.$release->descRelease.'</li>';
							}

					 	}

					?>
					
					<tr>
						<td width="200">
							<strong><?= $versao->numVersao ?></strong> - <?= $versao->dthVersao ?>
						</td>
						<td>
						    <ul>
								<?= $lista_releases ?>
							</ul>
						</td>
					</tr>


					<?php }?>
		
					
				</table>
			</div>
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>

<!-- END PAGE CONTENT INNER -->


<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="padding: 5px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Versionamento - Criar Nova Versão</h4>
			</div>

				<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url() ?>development/insert_new_version" method="post" id="form_sample_1" <?= $form_class ?>>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							Você tem alguns erros no formulário. Por favor, verifique abaixo.
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Tipo de Versionamento</label>
							<div class="col-md-4">
								<select id="versionamento" name="versionamento" data-required="true" class="form-control select2me" data-placeholder="Selecionar..." >
									<option value="release-revisao" selected="selected">Release de Revisão</option>
									<option value="release-menor">Release Menor</option>
									<option value="release-maior">Release Maior</option>
								</select>
							</div>
						</div>

					</div>
					<?php $this->load->view('tpl/forms-btn-actions-save') ?>
				</form>
				<!-- END FORM-->
			</div>

			<p style="margin: 20px;">
				Sempre quando fazemos ajustes é interessante mostrar aos usuários quais são esses, seja um novo recurso ou correção de bug.
			</p>
			<table class="table table-hover table-striped table-bordered">
					<tr>
						<td width="300">
							  <span class="label label-primary"><strong>x.x.X </strong> </span>
							  <strong style="margin-left:10px">Release de Revisão</strong>
						</td>
						<td>
							Para correções de falhas que passaram por desapercebidas, mas logo foram encontradas. Melhorias nos recursos existentes, que por sua vez são incorporadas ao software recém-lançado.
						</td>
					</tr>
					<tr>
						<td>
							  <span class="label label-primary"><strong>x.X.x </strong> </span>
							  <strong style="margin-left:10px">Release Menor</strong>
						</td>
						<td>
							 Quando tirvermos adcionamos suporte a uma tecnologia, ou acrescentamos o uso de alguns recursos ou qualquer tipo de grande melhoria, mas que continua sendo exatamente o mesmo, se comparado à versão anterior.
						</td>
					</tr>
					<tr>
						<td>
							  <span class="label label-primary"><strong>X.x.x </strong> </span>
							  <strong style="margin-left:10px">Release Maior</strong>
						</td>
						<td>
							Será utilizada para grandes modificações, ou seja, quando suas caracteristicas definidas no projeto se tornam bem diferente ou até mesmo incompatíveis com a versão anterior.
						</td>
					</tr>
				</table>


		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
