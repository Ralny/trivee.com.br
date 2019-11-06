<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3 class="modal-title">Assistente de importação de dados</h3>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= $importar ?>" enctype="multipart/form-data" class="form-horizontal form-bordered">
					<input type="hidden" name="tabela" value="<?=  isset($tabela) ? $tabela : null ;?>">
					<div class="form-body">

						<br>

						<p id="dynamic_pager_content2" class="well">
			    		     Selecione o arquivo .CSV de até 200 linhas e importe para o ZATA.
						</p>

						<br>

						<div class="form-group">
							
							<div class="col-md-12">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="input-group input-large">
										<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
											<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
											</span>
										</div>
										<span class="input-group-addon btn default btn-file">
											<span class="fileinput-new"> Selecione o seu arquivo para upload </span>
											<span class="fileinput-exists"> Outro arquivo </span>
											<input type="file" name="csvfile" id="csvfile">
										</span>
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
										Remover </a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btn_modal_cancelar" class="btn default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn blue">Importar</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
/**
 * Quando o usuario cancelar a importação, reservar os campos do formulario de upload
 */
$("#btn_modal_cancelar").click(function() {
	$("#csvfile").empty();
	$(".fileinput-filename").html("");
});

</script>
