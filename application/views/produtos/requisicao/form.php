<style>
  .ui-helper-hidden-accessible {
            display: none;
        }
   #produto-error {
   	color:#FF0000;
   	font-weight: bold;
   }     
</style>
<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');

$checked_T = 'checked';
$checked_D = '';
$readonly  = '';
$disabled  = '';	


// Desabilita os compos se a requisicao estiver finalizada
	if (isset($form_editar)){
		if ($show->sit_status_requisicao == 'F'){
			$readonly = 'readonly';
			$disabled = 'disabled';	
		}else{
			$readonly = '';
			$disabled = '';
		}

		if ($show->tipo_destino == 'T'){
			$checked_T = 'checked';
		}else{
			$checked_T = '';
		}

		if ($show->tipo_destino == 'D'){
			$checked_D = 'checked';
		}else{
			$checked_D = '';
		}
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
				</div>
			</div>
			
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url().$url ?>/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
					<input type="hidden" name="id" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">
					<input type="hidden" name="data_aprovacao" value="<?=  isset($show->data_aprovacao) ? mostraData($show->data_aprovacao) : null ;?>">
					<input type="hidden" name="data_entrega" value="<?=  isset($show->data_entrega) ? mostraData($show->data_entrega) : null ;?>">
					<div class="form-actions top" style="background: #f5f5f5;padding-left: 10px;">
						<?php 
						//Verifica se o formulario esta em modo de edição
						if (isset($form_editar))
						{ 
							if($this->session->userdata('id_perfil') == '1' || $this->session->userdata('id_perfil') == '2' ){
								//Aquardando aprovacao do Gerente
								if($show->sit_status_requisicao == 'G')
								{
						?>
						<button value="aprovar" type="submit" class="btn btn-default"><i class="fa fa-thumbs-o-up"></i> Aprovar Requisição</button>
						<button value="recusar" type="submit" class="btn btn-default"><i class="fa fa-thumbs-o-down"></i> Recusar Requisição</button>
						<a value="apagar"  href="<?= base_url().$btExcluir ?>" type="submit" class="btn btn-danger"><i class="fa fa-minus-circle"></i> Excluir Requisição</a>
						<?php
								}
							}

								//Aquardando a producao enviar a requisicao
								if($show->sit_status_requisicao == 'P')
								{ 
						 ?>
						<button value="enviar" type="submit" class="btn btn-default"><i class="fa fa-check"></i> Enviar Requisição</button>
						<button value="salvar" type="submit" class="btn btn-default"><i class="fa fa-save"></i> Salvar Alterações</button>
						<a value="apagar"  href="<?= base_url().$btExcluir ?>" type="submit" class="btn btn-danger"><i class="fa fa-minus-circle"></i> Excluir Requisição</a>
						<?php
								}

							if($this->session->userdata('id_perfil') == '1' || $this->session->userdata('id_perfil') == '2' || $this->session->userdata('id_perfil') == '3' ){
								//Requisicao aprovada, aguardando entrega do estoque
								if($show->sit_status_requisicao == 'E')
								{ 
						 ?>	
						 <button value="entrega-concluida" type="submit" class="btn btn-default"><i class="fa fa-shopping-cart"></i> Entrega concluida</button>
						<?php
								}	
							}
						}
						else
						{ 
						// Cadastro de Requisicao	
						?>
						<button value="criar" type="submit" class="btn btn-default"><i class="fa fa-save"></i> Criar Requisição</button>
						<?php } ?>
						<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
						<input  type="hidden" name="acao" id="acao">
					</div>


					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>

						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Numero da Requisição</label>
									<input value="<?=  isset($show->num_requisicao) ? $show->num_requisicao : null ;?>" readonly name="num_requisicao"  type="text" class="form-control" maxlength="300"/>
								</div>							
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Tipo Destino<span class="required"> * </span>  </label>
									<div class="input-group">
										<div class="icheck-inline">
											<label><input value="T" <?= $checked_T ?> type="radio" <?= $disabled ?> name="tipo_destino" class="icheck" data-radio="iradio_square-blue"> Transferência</label>
											<label><input value="D" <?= $checked_D ?> type="radio" <?= $disabled ?> name="tipo_destino" class="icheck" data-radio="iradio_square-blue"> Devolução</label>
										</div>
									</div>
								</div>							
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Data Emissão</label>
									<input name="data_emissao" readonly class="form-control input-medium" size="16" type="text" value="<?=  isset($show->data_emissao) ? mostraData($show->data_emissao) : date('d/m/Y') ;?>"/>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Necessidade de Entrega <span class="required"> * </span></label><br />
									<input name="data_necessidade_entrega" <?= $readonly ?> data-required="1" class="form-control input-medium date-picker" size="16" type="text" value="<?=  isset($show->data_necessidade_entrega) ? mostraData($show->data_necessidade_entrega) : null ;?>"/>
								</div>							
							</div>						

						</div>

						<div class="row">

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Unidade de Origem</label>			
									<select id="id_unidade" <?= $disabled ?> name="id_unidade" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
										<?php 

										$select = '';	

										foreach ($unidades_empresas as $row): 

											if(isset($form_editar))
											{
												if($show->id_unidade == $row->id_unidade ) 
												{
													$select = 'selected="selected"';
												}
												else
												{
													$select = '';		
												}
											}
											?>
											<option value="<?= $row->id_unidade ?>" <?=  $select ?>><?= $row->apelido ?></option>
										<?php endforeach ?>
									</select>

								</div>
							</div>

							
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Estoque de Origem</label>			
									<select name="id_origem_estoque" <?= $disabled ?> class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
										<option></option>
										<?php 
											$select = '';	
											if(isset($form_editar))
											{
												foreach ($estoque_origem as $row): 
														
													if($show->id_origem_estoque == $row->id_estoque ) 
													{
														$select = 'selected="selected"';
													}
													else
													{
														$select = '';		
													}
														
										?>
											<option value="<?= $row->id_estoque ?>" <?=  $select ?>><?= $row->nome_estoque ?></option>
										<?php
											 endforeach ; 
											 }// IF 
										?>
									</select>

								</div>
							</div>

							<!--
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Unidade de Destino</label><br />
									<input value="<?=  isset($show->id_destino_estoque) ? $show->id_destino_estoque : null ;?>" name="id_destino_estoque" data-required="1" type="text" class="form-control" maxlength="300"/>
								</div>							
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Estoque de Destino</label><br />
									<input value="<?=  isset($show->id_destino_estoque) ? $show->id_destino_estoque : null ;?>" name="id_destino_estoque" data-required="1" type="text" class="form-control" maxlength="300"/>
								</div>							
							</div>
						-->

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
		/*
		function CompareDatasBRL() { 
			//Datas 
			dtUm = "28/02/2015"; //Formato dd/mm/aaaa 
			dtDois = "28/03/2015"; //Formato dd/mm/aaaa 
			//Convertendo em novas datas 
			var dtUmComp = new Date(dtUm.replace(/(\d{2})\/(\d{2})\/(\d{4})/,'$2/$1/$3')); 
			var dtDoisComp = new Date(dtDois.replace(/(\d{2})\/(\d{2})\/(\d{4})/,'$2/$1/$3')); 
			//Exemplo de comparação de datas 
			if(dtUmComp > dtDoisComp)
				 document.write(dtUm + " maior que " + dtDois + ".");
			else
			if(dtDoisComp > dtUmComp) 
				document.write(dtDois + " maior que " + dtUm + "."); 
			else document.write("Datas iguais."); 
		}*/

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

    	$('.date-picker').datepicker({
    		rtl: Metronic.isRTL(),
    		orientation: "left",
    		autoclose: true,
    		format: 'dd/mm/yyyy'
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

                	id_unidade: {
                        required: true
                    },



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

//Combo Dinamico - Categoria => Assunto
$(function(){

	var path = '<?php echo base_url(); ?>'
	//A funçao ira executa quando houver mudança no combobox
	$("select[name=id_unidade]").change(function(){
		//Pegando valor 
		id_unidade = $(this).val();

		//Verifica se esta vazio
		if ( id_unidade === '')
			return false;
		
		resetaCombo('id_origem_estoque');
		//Enviando Pesquisa	
		$.getJSON( path + 'produtos/requisicao/ajax_combo_estoque/' + id_unidade, function (data){

			console.log(data);
			var option = new Array();
			//Preenchendo Combo com as informações de filtragem
			$.each(data, function(i, obj){
				//Criando Elemento
				option[i] = document.createElement('option');
		    	//Value
		    	$( option[i] ).attr( {value : obj.id_estoque} );
		 		//Desc
		 		$( option[i] ).append( obj.nome_estoque);
		 		//Adcionando
		 		$("select[name='id_origem_estoque']").append( option[i] );

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

<?php 
	//Verifica se o formulario esta em modo de edição
	if (isset($form_editar)){ 

		 $this->load->view('produtos/requisicao/form_itens-requisicao');
	}
 ?>

