<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3 class="modal-title">Importar Dados</h3>
			</div>
			<div class="modal-body">
				<form method="post" action="<?= $importar ?>" enctype="multipart/form-data" class="form-horizontal form-bordered">
					<input type="hidden" name="tabela" value="<?=  isset($tabela) ? $tabela : null ;?>">
					<div class="form-body">
						<div class="note note-info">
							<p>
								Selecione o arquivo CSV para importação.
							</p>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2"></label>
							<div class="col-md-9">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="input-group input-large">
										<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
											<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
											</span>
										</div>
										<span class="input-group-addon btn default btn-file">
											<span class="fileinput-new">
											Selecione o Arquivo </span>
											<span class="fileinput-exists">
											Alterar </span>
											<input type="file" name="csvfile">
										</span>
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
										Remove </a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn blue">Importar</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
