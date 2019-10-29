<?php
//Carregando configurações de conteiner
include ('application/views/tpl/config_container.php');

$status_solicitacao_disabled = '';

$msg_conclusao = '';

/**
 * Concluida
 */ 
if ($show->id_status_solicitacao == 100)
{
		/**
	 	 * O Usuario logado eh o solicitante
	 	 */ 
		if ($show->id_solicitante == $this->session->userdata('id_usuario')) 
		{	
			/**
		 	 * Verifica se ela pode ser reaberta, [critério] 24H depois da conclusao 
		 	 */ 	
			$atraso = dateDiffReaberturaSolicitacaoServico(date("Y-m-d H:i:s"), $show->dth_conclusao_solicitacao);

			if ($atraso == TRUE)
			{

				$btn_acoes =	'
								<button value="reabrir" type="submit" class="btn btn-default"><i class="fa fa-unlock-alt"></i> Reabrir Solicitação</button>
								<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
								';
			}
			else
			{
				$btn_acoes =	'
								<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
								';
			}					
		}
		else
		{
				$btn_acoes =	'
								<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
								';
		}

		$status_solicitacao_disabled = 'disabled';

		$msg_conclusao = '
			<div class="note note-success">
				<h3 class="block"><strong>Solicitação de serviço concluída !</strong></h3>
			</div>
		';


}
/**
 * Aberta
 */
elseif($show->id_status_solicitacao != 100 and $show->id_status_solicitacao != 300){

		/**
		 * Reaberta
		 */
		if ($show->id_status_solicitacao == 200) 
		{
				$msg_conclusao = '
									<div class="note note-warning">
										<h3 class="block"><strong>Solicitação de serviço reaberta !</strong></h3>
									</div>
								 ';
		}
		else
		{
			$msg_conclusao = '';
		}

		/**
	 	 * O Usuario logado eh o solicitante
	 	 */ 
		if ($show->id_solicitante == $this->session->userdata('id_usuario')) 
		{
			$btn_acoes =	'
							<button value="cancelar" type="submit" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar Solicitação</button>
							<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
							';

			$status_solicitacao_disabled = 'disabled';				
		}
		elseif ($show->id_responsavel_tecnico == $this->session->userdata('id_usuario'))
		{
			$btn_acoes =	'
							<button value="salvar" type="submit" class="btn btn-default"><i class="fa fa-save"></i> Salvar Alterações</button>		
							<button value="concluir" type="submit" class="btn btn-default"><i class="fa fa-check"></i> Concluir Solicitação </button>
							<button value="cancelar" type="submit" class="btn btn-default"><i class="fa fa-ban"></i> Cancelar Solicitação</button>
							<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
							';
		}
		else
		{
			$btn_acoes =	'
							<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
							';

			$status_solicitacao_disabled = 'disabled';					
		}
}
/**
 * Cancelada
 */
elseif ($show->id_status_solicitacao == 300) {
		
		$status_solicitacao_disabled = 'disabled';

		$msg_conclusao = '
							<div class="note note-danger">
								<h3 class="block"><strong>Solicitação de serviço cancelada !</strong></h3>
							</div>
						 ';

		$btn_acoes =	'
						<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
						';
}
?>

<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">			
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url() ?>/infra/infra_solicitacao_servico/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
				<input type="hidden" name="id" value="<?=  isset($show->token_id) ? $show->token_id : null ; ?>">
				
				<?= $msg_conclusao ?>

				<div class="form-actions top" style="background: #f5f5f5;padding-left: 10px;">

					<?= $btn_acoes ?>
					
					<input  type="hidden" name="acao" id="acao">

				</div>

					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>	
						<!--<h4 class="block">Identificação do problema:</h4> -->

						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Número da Solicitação </label>
									<input disabled value="<?= isset($show->numero_solicitacao) ? $show->numero_solicitacao : null ;?>" name="numero_solicitacao"  type="text" class="form-control"/>
									<input type="hidden" name="numero_solicitacao" value="<?=  isset($show->numero_solicitacao) ? $show->numero_solicitacao : null ;?>">
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Status da Solicitação</label>
										<select <?= $status_solicitacao_disabled ?> name="id_status_solicitacao" class="form-control select2me" data-placeholder="Selecionar..." >
										<option></option>
										<?php 

										$select = '';	
										foreach ($status_solicitacao as $row):
											if(isset($form_editar))
											{
												if($show->id_status_solicitacao == $row->id_status_solicitacao ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_status_solicitacao ?>" <?=  $select ?>><?= $row->desc_status_solicitacao ?></option>
										<?php endforeach ?>
									</select>
								
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Prioridade
										(<span class="help-block" style="display:inline;">
											<a  data-toggle="modal" href="#basic"> Ver legenda</a>
										</span>)

									</label>
									<select <?= $status_solicitacao_disabled ?> name="id_prioridade" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										foreach ($prioridade as $row):
											if(isset($form_editar))
											{
												if($show->id_prioridade == $row->id_prioridade ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_prioridade ?>" <?=  $select ?>><?= $row->desc_prioridade ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						
						</div>
						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Data de abertura</label>
									<input disabled name="dth_abertura_solicitacao" class="form-control date-picker" size="16" type="text" value="<?=  isset($show->dth_abertura_solicitacao) ? data_hora($show->dth_abertura_solicitacao) : null ;?>" />
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Data de conclusão</label>
									<input disabled  name="dth_conclusao_solicitacao" class="form-control date-picker" size="16" type="text" value="<?=  isset($show->dth_conclusao_solicitacao) ? data_hora($show->dth_conclusao_solicitacao) : null ;?>"/>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Garantia </label>
									<select <?= $status_solicitacao_disabled ?> name="id_tempo_garantia" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	
										foreach ($garantia as $row):
											if(isset($form_editar))
											{
												if($show->id_tempo_garantia == $row->id_tempo_garantia ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_tempo_garantia ?>" <?=  $select ?>><?= $row->desc_tempo_garantia ?></option>
										<?php endforeach ?>
									</select>
								</div>		
							</div>
						</div>
						<!--/row-->		
						<!--/row-->

						<hr>	
						<h3 class="block">Identificação do problema</h3>


						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="id_problema_solicitacao_servico" value="<?=  isset($show->id_problema_solicitacao_servico) ? $show->id_problema_solicitacao_servico : null ;?>">
								<blockquote>
									<p>
										<?php 
											foreach($categorias_pai as $cat):
								    
											    foreach($cat as $desc_cat):
											        
											        echo "$desc_cat <i class='fa fa-angle-double-right'></i> ";
											    
											    endforeach;
											          
											endforeach; 
										?>
									</p>		
									<p>
										<strong><?= isset($problema) ? $problema : null ;?></strong>
									</p>
								</blockquote>	
							</div>

							<?php

							if ($show->id_responsavel_tecnico == $this->session->userdata('id_usuario')) 
							{
								if ($show->id_status_solicitacao != 100 and $show->id_status_solicitacao != 300) { ?>

								<div class="col-md-6">
									 <div class="form-group">
										<label class="control-label">O problema foi identificado incorretamente?</label>
										<br/>
										<a class="btn btn-success" data-toggle="modal" href="<?= base_url() ?>infra/infra_solicitacao_servico/cadastrar/">
										Clique para redefinir o problema </a>
									</div>	
								</div>

							<?php } } ?>

						</div>
						<!--/row-->

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Local da Ocorrência</label>
									<select <?= $status_solicitacao_disabled ?> name="id_area_instalacao" id="id_area_instalacao" class="form-control select2me" data-placeholder="Selecionar...">
											<option></option>
											<?php 

											$select = '';	
											foreach ($local_ocorrencia as $row):
												if(isset($form_editar))
												{
													if($show->id_area_instalacao == $row->id_area_instalacao ) 
													{
														$select = 'selected="selected"';
													}
													else
													{
														$select = '';		
													}
												}
												?>
												<option value="<?= $row->id_area_instalacao ?>" <?=  $select ?>><?= $row->desc_area_instalacao ?></option>
											<?php endforeach ?>
										</select>							
								</div>
							</div>

							<div class="col-md-6">
													
							</div>

						</div>
						<!--/row-->

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Solicitante</label>
									<select <?= $status_solicitacao_disabled ?> name="id_solicitante" id="id_solicitante" class="form-control select2me" data-placeholder="Selecionar...">
											<option value="528">Hóspede | Visitante | Cliente</option>
											<?php 
											$select = '';	
											foreach ($lista_solicitantes as $row):
												if(isset($form_editar))
												{
													if($show->id_solicitante == $row->id_usuario ) 
													{
														$select = 'selected="selected"';
													}
													else
													{
														$select = '';		
													}
												}
												?>
												<option value="<?= $row->id_usuario ?>" <?=  $select ?>><?= $row->nome.' '.$row->sobrenome ?></option>
											<?php endforeach ?>
										</select>							
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Responsável Técnico</label>
									<select <?= $status_solicitacao_disabled ?> name="id_responsavel_tecnico" id="id_responsavel_tecnico" class="form-control select2me" data-placeholder="Selecionar...">
											<?php 

											$select = '';	
											foreach ($lista_solicitantes as $row):
												if(isset($form_editar))
												{
													if($show->id_responsavel_tecnico == $row->id_usuario ) 
													{
														$select = 'selected="selected"';
													}
													else
													{
														$select = '';		
													}
												}
												?>
												<option value="<?= $row->id_usuario ?>" <?=  $select ?>><?= $row->nome.' '.$row->sobrenome ?></option>
											<?php endforeach ?>
										</select>							
								</div>
							</div>
						</div>
						<!--/row-->

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<h4 class="block">Problema/Defeito apresentado na solicitação</h4>
									<textarea <?= $status_solicitacao_disabled ?> name="desc_problema_solicitacao" class="form-control autosizeme" rows="5"></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<h4 class="block">Laudo Técnico
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Relato do técnico ou especialista designado para avaliar determinada situação." aria-describedby="popover263156"> ? </span> </h4>
									<textarea <?= $status_solicitacao_disabled ?> name="laudo_tecnico" class="form-control autosizeme"  rows="5"><?=  isset($show->laudo_tecnico) ? $show->laudo_tecnico : null ;?></textarea>
								</div>
							</div>
						</div>
						<!--/row-->		

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<h4 class="block">Solução
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Descrição da solução proposta para solucionar o problema/defeito." aria-describedby="popover263156"> ? </span> </h4>
									<textarea <?= $status_solicitacao_disabled ?> name="solucao" class="form-control autosizeme"  rows="5"><?=  isset($show->solucao) ? $show->solucao : null ;?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<h4 class="block">Observações
									<span class="badge badge-primary popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Registrar alguma informação relevante sobre essa Solicitação de Serviço." aria-describedby="popover263156"> ? </span> </h4>
									<textarea <?= $status_solicitacao_disabled ?> name="observacoes" class="form-control autosizeme"  rows="5"><?=  isset($show->observacoes) ? $show->observacoes : null ;?></textarea>
								</div>
							</div>
						</div>
						<!--/row-->

					</div>
					
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
    	$(location).attr('href', '<?= base_url() ."solicitacao-servico/minhas-solicitacoes/eu-recebi"?>');
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

<?php $this->load->view('infra/infra_cat_solicitacao_servico/modal_legenda_prioridades') ?>
