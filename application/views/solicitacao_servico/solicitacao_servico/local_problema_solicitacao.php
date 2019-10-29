<style>
	
	.categories{
		display:inline-block;
		width:100%;
	}

	.categories ul{
		margin: 0 -1.3%;
		padding:0;
		list-style: none;
	}

	.categories ul li{
		width: 14.6666666%;
		float: left;
		margin:0 1% 20px;
		background-color:#cacaca;
		cursor: pointer;
		border-radius:0;
		-moz-transition: ease-in .1s;
		-webkit-transition: ease-in .1s;
		transition: ease-in .1s;
	}

	.categories ul li:not(.nohover):hover img {
		background-color:  #4DB3A2 !important;
	}

	.categories ul li:hover{
		background-color:  #4DB3A2 !important;
	}
	.categories ul li img{
		background-color: #3A87ad;
		width: 92%;
		height:auto;
		margin: 4%;
		vertical-align: middle;
		border:0;
	}

	.categories ul li label{
		display: block;
		padding:8px 4px 8px;
		overflow:hidden;
		text-overflow:ellipsis;
		color: #111;
		text-align:center;
		/**font-size:12px; */
		line-height: 1.2;
		max-width: 100%;
		margin-bottom: 05px;
		font-weight:bold; 
	}


</style>

<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet light">

		<div class="portlet-body">

			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url().$url ?>/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
					<input type="hidden" name="token_id_problema_solicitacao_servico" value="<?=  $this->uri->segment(4) ?>">
					<input type="hidden" name="id" value="<?= isset($_SESSION['id_solicitacao_servico']) ? $_SESSION['id_solicitacao_servico'] : null ; ?>">
					<div class="form-body">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<h2 style="margin-top:0px">Problema identificado:</h2>
									<div class="col-md-12">
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
								</div>
							</div>
						</div>
						<div class="row">	
							<div class="col-md-6">
								<div class="form-group">
									<h2 style="margin-top:0px">Problema apresentado na solicitação</h2>
									<div class="col-md-12">
										<textarea name="desc_problema_solicitacao" class="form-control" rows="8"></textarea>
									</div>
								</div>
									<div class="form-group">
									<h2 style="margin-top:0px">Onde é o local?</h2>
									<div class="col-md-12">
										<select name="id_area_instalacao" class="form-control select2me" data-placeholder="Selecionar...">
										<option></option>
										<?php

											$select = '';	
											
											foreach ($local as $row):
												if(isset($hide_solicitacao_servico))
												{
													if($hide_solicitacao_servico->id_area_instalacao == $row->id_area_instalacao) 
													{
														$select = 'selected="selected"';
													}
													else
													{
														$select = '';		
													}
												}
										?>
										<option value="<?= $row->id_area_instalacao ?>" <?=  $select ?> > <?= $row->desc_area_instalacao ?></option>
										<?php endforeach ?>
									</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions top" style="background: #f5f5f5;padding-left: 10px;">

						<?php if (isset($_SESSION['id_solicitacao_servico'])){ ?>	

							<button value="alterar-problema-solicitacao-servico" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Redefinir o Problema da Solicitação de Serviço</button>
						
						<?php }else{ ?>
						
							<button value="criar-solicitacao-servico" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Criar Solicitação de Serviço</button>
						
						<?php } ?>
							<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
			
							<input  type="hidden" name="acao" id="acao">
						</div>
					</div>
					<!--/row-->
					<br>
				</form>
			</div>
			<!-- END FORM-->
		</div>	
	</div>
</div>
<?php 
if (isset($form_editar)){ 
	?>
	<div class="row">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-green-sharp bold uppercase">Imagem</span>
				</div>
			</div>

			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<div class="row">
					<div class="col-md-6">
						<?php $this->load->view('zata/modulos/template/public/upload_imagens')  ?>
					</div>
					<div class="col-md-6">
						<div class="row mix-grid thumbnails" style="">
							<?php foreach ($galeria as $img) : ?>
							<div class="col-md-6 col-sm-6 mix" style="display: block; opacity: 1;">
								<div class="mix-inner">
									<img class="img-responsive" src="<?= base_url()?>files/uploads/images/<?= $img->file_name?>" alt="">
									<div class="mix-details">
										<a class="mix-preview fancybox-button" href="<?= base_url()?>files/uploads/images/<?= $img->file_name?>"  data-rel="fancybox-button">
											<i class="fa fa-search"></i>
										</a>
										
									</div>
								</div>
							</div>
							<?php endforeach ?>
						</div>
					</div>
				</div>	
			</div>  
		</div>
		<!-- END VALIDATION STATES-->
	</div>	
	<!-- END PAGE CONTENT INNER -->
	<?php } ?>

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
			$(location).attr('href', '<?= base_url()."solicitacao-servico/minhas-solicitacoes/eu-recebi"?>');
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

					local: {
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

