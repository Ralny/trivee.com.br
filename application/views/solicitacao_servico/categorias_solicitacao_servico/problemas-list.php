<div class="row">
	<form id="formProblemas" action="" method="post">
		<div class="col-md-7">
			<div class="form-group">
				<label class="control-label">Adicionar um problema</label>
				<input value="" id="descProblema" name="descProblema"  type="text" data-required="1" class="form-control"/>
				<input type="hidden" name="token_id_cat_solicitacao_servico" id="id_cat_solicitacao_servico" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>" />			
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Prioridade</label>
				<select name="id_prioridade" data-required="1" class="form-control select2me" data-placeholder="Selecionar...">
					<option></option>
					<?php 

					$select = '';	
					foreach ($prioridade as $row):
					?>
						<option value="<?= $row->id_prioridade ?>" <?=  $select ?>><?= $row->desc_prioridade ?></option>
					<?php endforeach ?>
				</select>
				<p class="help-block">
					Para ver a legenda
					<a  data-toggle="modal" href="#basic">
					clique aqui </a>
				</p>

			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<button value="" type="submit" class="btn green-haze"><i class="fa fa-check"></i>Adcionar</button>
			</div>
		</div>
	</form>	
</div>

<script>

	jQuery(document).ready(function() {

		$("#formProblemas").validate({
			rules:{
				descProblema: {required:true},
				id_prioridade: {required:true}
			},
			messages:{
				descProblema: {required: 'Insira um problema'},
				id_prioridade: {required: 'Defina a prioridade do problema'}
			},
			submitHandler: function( form ){       
				
				var dados = $( form ).serialize();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>solicitacao_servico/Categorias_solicitacao_servico/adicionarProblema",
					data: dados,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$( "#divListProblemas" ).load("<?= base_url() ?>solicitacao-servico/subcategoria/editar/<?=  isset($show->token_id) ? $show->token_id : null ;?> #divListProblemas" );
							$("#descProblema").val('').focus();

						}
						else
						{
							alert('Ocorreu um erro ao tentar excluir problema.');
						}
					}
				});

				return false;
			}

		});

		$(document).on('click', 'a', function(event) {
			var idProblema = $(this).attr('idAcao');

			if((idProblema % 1) == 0){
				
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>solicitacao_servico/Categorias_solicitacao_servico/excluirProblema",
					data: "idProblema="+idProblema,
					dataType: 'json',
					success: function(data)
					{
						if(data.result == true){
							$( "#divListProblemas" ).load("<?= base_url() ?>solicitacao-servico/subcategoria/editar/<?=  isset($show->token_id) ? $show->token_id : null ;?> #divListProblemas" );

						}
						else{
							alert('Ocorreu um erro ao tentar excluir problema.');
						}
					}
				});
				return false;
			}

		});

	});
</script>

<!-- Serviços -->	
<div class="row">
	<div class="col-xs-12">
		<table class="table table-striped table-hover" id="divListProblemas">
			<thead>
				<tr>
					<th>
						Descrição do Problema 
					</th>
					<th>
						Prioridade 
					</th>
					<th width="10%">
						
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					/**
					 * Listando registros da tabela
					 * Listing table records
					 */
					foreach ($problemas as $linha):
						/**
						 * Listar registros da tabela
						 * Change Active Label
						 */		            
						?>	
						<tr>
							<td>
								<?=  isset($linha->desc_problema_solicitacao_servico) ? $linha->desc_problema_solicitacao_servico : null ;?>
							</td>
							<td>
								<?php 
									if(isset($linha->desc_prioridade)){
								?>
								<span class="label label-danger" style="background-color:<?= $linha->hex_color ?>;">
									<?= $linha->desc_prioridade ?></span>
								<?php 			
								}else{
									echo 'Nao foi definido a prioridade';
								} ?>
							</td>
							<td>
								<a idAcao=" <?=  isset($linha->id_problema_solicitacao_servico) ? $linha->id_problema_solicitacao_servico : null ;?>" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
							</td>

						</tr>
					<?php endforeach ?>

				</tbody>
			</table>

		</div>

	</div>

	<?php $this->load->view('solicitacao_servico/categorias_solicitacao_servico/modal_legenda_prioridades') ?>
