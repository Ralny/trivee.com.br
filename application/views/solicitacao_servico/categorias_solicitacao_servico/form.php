<?php 
/**
 * GABIARRA - TOTALMENTE DESACORCO COM MVC E COM O RESTO DO DESIGN PATTERNS - PURA E SIMPLES : "GO HORSE" 
 * Usando a URL para definir se eh uma categoria ou subcategoria
 * O mesmo formulario eh usado para cadastro/alteracao de CATEGORIA e SUBCATEGORIA
 * Configurei as rotas [config/routes.php]
 *
 * IMPROVISATION - COMPLETELY DISCOVER WITH MVC AND WITH THE REST OF DESIGN PATTERNS - PURE AND SIMPLE: "GO HORSE"
 * Using the URL to define whether a category or subcategory is
 * The same form is used for registration / alteration of CATEGORY and SUBCATEGORY
 * Configure the routes [config / routes.php]
 *
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */

/**
 * Pegando valor da url
 * Getting value from url
 */
$tipo = $this->uri->segment(2); 

/**
 * Categoria
 * Category
 */ 
if ($tipo == 'categoria')
{
	/**
	 * Aux usado no portlet-title
	 * Aux used in the portlet-title
	 */ 
	$des_cat_ou_subcat = 'categoria';

	/**
	 * Setando o valor da categoria pai
	 * Set parent category value
	 */
	$cat_pai = null;

	/**
	 * aux para definir o redirecionamento do botao fechar do formulario
	 * aux to set the redirection of the close button of the form
	 */ 
	$url_fechar = base_url().'solicitacao-servico/categoria/listar';
}

/**
 * Subcategoria
 * Subcategory
 */ 
if ($tipo == 'subcategoria')
{
	/**
	 * Aux usado no portlet-title
	 * Aux used in the portlet-title
 	 */ 
	$des_cat_ou_subcat = 'subcategoria';

	/**
	 * Pegando valor da url da categoria pai
	 */
	$cat_pai = $this->uri->segment(4);


	/**
 	 * Buscando informacoes da categoria pai 
 	 * Searching for information of the parent category
 	 */
	$sql = "SELECT token_id_cat_pai, token_id FROM ss_cat_solicitacao_servico WHERE token_id = '$cat_pai'";
	$query = $this->db->query($sql);
	$row = $query->row();

	/**
	 * Temos que definir se o formulario de subcategoria esta em modo de cadastro ou alteracao
	 * We have to define if the subcategory form is in register mode or change
	 */
	$tipo_subcat = $this->uri->segment(3); 
	
	/**
	 * Cadastro
	 * Register
	 */ 
	if ($tipo_subcat == 'cadastrar')
	{
		/**
	 	 * aux para definir o redirecionamento do botao fechar
	 	 * aux to set the redirection of the close button
	 	 */
		$url_fechar = base_url().'solicitacao-servico/subcategoria/editar/'.$row->token_id;
	}

	if ($tipo_subcat == 'editar')
	{
			/**
			 * aux para definir o ID da categoria/subcategoria pai
			 * aux to set the parent category / subcategory ID
			 */
			$cat_pai = $row->token_id_cat_pai;

			/**
			 * Se token_id_cat_pai nao for nulo entao temos uma subcategoria
			 * If token_id_cat_pai is not null then we have a subcategory
			 */
			if ($cat_pai != null)
	        {

		        /**
			 	 * Verificando se existe uma categoria/subcategoria a cima 
			 	 * 
			 	 */
				$sql_parent = "SELECT token_id_cat_pai, token_id FROM ss_cat_solicitacao_servico WHERE token_id = '$row->token_id_cat_pai'";
				$query_parent = $this->db->query($sql_parent);
				$row_parent = $query_parent->row();
				
				if ($row_parent->token_id_cat_pai == null)
				{
					/**
				 	 * aux para definir o redirecionamento do botao fechar
				 	 * aux to set the redirection of the close button
				 	 */
			            $url_fechar = base_url().'solicitacao-servico/categoria/editar/'.$row->token_id_cat_pai;	
				}
				else
				{
					 /**
				 	 * aux para definir o redirecionamento do botao fechar
				 	 * aux to set the redirection of the close button
				 	 */
			            $url_fechar = base_url().'solicitacao-servico/subcategoria/editar/'.$row->token_id_cat_pai;		
				}	
			        
	           
	        }
	        else
	        {
	        /**
		 	 * aux para definir o redirecionamento do botao fechar
		 	 * aux to set the redirection of the close button
		 	 */
	           $url_fechar = base_url().'solicitacao-servico/subcategoria/editar/'.$row->token_id_cat_pai;    
	        }
		
	}


}

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
					<?= $title_portlet .' '. $des_cat_ou_subcat ?>
				</div>
			</div>	
			
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url() ?>solicitacao-servico/categoria/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
					<input type="hidden" name="id" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">
					<input type="hidden" name="id_cat_pai" value="<?= $cat_pai ?>">
					<input type="hidden" name="tipo_cat" value="<?= $this->uri->segment(2) ?>">
					<?php  $this->load->view('tpl/forms-btn-actions-save-top') ?>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?= $erro_valid_form ?>
						</div>

						<?php 
							/**
							 * Verificar o status do registro e se botão ATIVO ira ficar marcado
							 * quando o formulario estiver em modo de edição
							 * Check the status of the record and if the ACTIVE button will be marked
							 * When the form is in edit mode
							 */
							if (isset($form_editar)){ 

								/**
								 * Se for 'S', este registro está ativo
								 * If 'S', this record is active
								 */
								if ($show->sit_ativo == 'S')
								{
									$checked = 'checked';
								}
								else
								{
									/**
									 * não está ativo
									 * Is not active
									 */
									$checked = '';
								}

								/**
								 * Se for 'S', existe subcategoria
								 * If 'S', this record is active
								 */
								if ($show->sit_possui_subcategoria == 'S')
								{
									$checked_subcat = 'checked';
								}
								else
								{
									/**
									 * não está ativo
									 * Is not active
									 */
									$checked_subcat = '';
								}
							}
							else
							{
								/**
								 * Formulario em modo de Cadastro por padrao ficará ativo
								 * Form in Registration mode by default will be active
								 */
								$checked 		= 'checked';
								$checked_subcat = '';
							}

							?>
	

							<div class="form-group">
								<label class="control-label col-md-3">Nome da <?= $des_cat_ou_subcat?><span class="required"> * </span> </label>
								<div class="col-md-5">
									<input value="<?=  isset($show->desc_cat_solicitacao_servico) ? $show->desc_cat_solicitacao_servico : null ;?>" name="desc_cat_solicitacao_servico" data-required="1" type="text" class="form-control" maxlength="255"/>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Responsável Tecnico<span class="required"> * </span> </label>
								<div class="col-md-5">
									<select name="id_responsavel_tecnico" id="id_responsavel_tecnico" class="form-control select2me" data-placeholder="Selecionar...">
										<option value=""></option>
										<?php 

										$select = '';	
										foreach ($lista_responsavel_tecnico as $row):
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
											<option value="<?= $row->id_usuario ?>" <?=  $select ?>><?= $row->nome. ' ' .$row->sobrenome  ?></option>
										<?php endforeach ?>
									</select>	
								</div>
							</div> 

							<div class="form-group">
								<label class="control-label col-md-3">Possui Subcategoria ?</label>
								<div class="col-md-5">
									<input type="checkbox" name="sit_possui_subcategoria" class="make-switch" <?= $checked_subcat; ?> data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3">Ativo?</label>
								<div class="col-md-5">
									<input type="checkbox" name="sit_ativo" class="make-switch" <?= $checked; ?> data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
								</div>
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

	<?php 
	/**
	 * Verificar o status do registro e se botão ATIVO ira ficar marcado
	 * quando o formulario estiver em modo de edição
	 * Check the status of the record and if the ACTIVE button will be marked
	 * When the form is in ed\it mode
	 */
	if (isset($form_editar)){ 
	?>
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							Imagem
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<?php $this->load->view('zata/modulos/template/public/upload_imagem')  ?>
					</div>  
				</div>
				<!-- END VALIDATION STATES-->
			</div>
		</div>

		<?php if ($show->sit_possui_subcategoria == null){?>

		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN VALIDATION STATES-->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							Problemas
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<?php $this->load->view('solicitacao_servico/categorias_solicitacao_servico/problemas-list')  ?>
					</div>  
				</div>
				<!-- END VALIDATION STATES-->
			</div>
		</div>

		<?php }else{ ?>
		
		<div class="row">
			<div class="col-md-12">
				<?php $this->load->view('solicitacao_servico/categorias_solicitacao_servico/main-list_sub_categoria')  ?>
			</div>
		</div>

		<?php }} ?>

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
			$(location).attr('href', '<?= $url_fechar ?>');
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

						desc_cat_solicitacao_servico: {
                        	required: true
                    	},
                    	id_responsavel_tecnico: {
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


