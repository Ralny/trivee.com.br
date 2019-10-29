<div class="row">
<?php echo $this->session->flashdata('error_upload') ?>	
	<div class="col-md-6">
		<form action="<?= base_url() ?>zata/upload/do_upload_imgs" role="form" method="post" enctype="multipart/form-data">
		<input type="hidden" name="token" value="<?=  isset($token) ? $token : null ;?>">
		<input type="hidden" name="folder" value="<?=  isset($folder) ? $folder : null ;?>">
		<input type="hidden" name="url_redirect_aux" value="<?=  isset($url_redirect_aux) ? $url_redirect_aux : null ;?>">
			<div class="form-group">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
						<img src="<?= base_url()?>assets/zata/no-image.png">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
					</div>
					<div>
						<span class="btn default btn-file">
							<span class="fileinput-new">
								Procurar</span>
								<span class="fileinput-exists">
									Alterar </span>
									<input type="file" name="picture">
								</span>
								<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
									Remove </a>
								</div>
				</div>
			</div>
			<div class="margin-top-10">
				<button value="salvar" type="submit" class="btn green-haze"><i class="fa fa-check"></i> Salvar Imagem</button>
			</div>
		</form>
	</div>

	<div class="col-md-6">
		<span class="label label-danger">NOTA IMPORTANTE!</span><br />
		<span> A miniatura de imagem somente será exibida nas ultimas versões dos navegadores: Firefox, Chrome, Opera, Safari e Internet Explorer 10 </span>
	</div>
</div>
			<!--/row-->