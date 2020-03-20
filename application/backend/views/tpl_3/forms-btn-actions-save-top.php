<div class="form-actions top" style="background: #f5f5f5;padding-left: 10px;">
	<button value="salvar" type="submit" class="btn btn-default"><i class="fa fa-save"></i> Salvar</button>
	<button value="salvar-e-novo" type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Salvar e Criar Novo</button>
	<button value="salvar-e-fechar" type="submit" class="btn btn-default"><i class="fa fa-bars"></i> Salvar e Fechar</button>
	<?php 
	//Verifica se o formulario esta em modo de edição
	if (isset($form_editar)){ ?>
	<a value="apagar"  href="<?= base_url().$btExcluir ?>" type="submit" class="btn btn-danger"><i class="fa fa-minus-circle"></i> Apagar</a>
	<?php }else{ ?>
	<a value="apagar" type="submit" class="btn btn-default disabled"><i class="fa fa-minus-circle"></i> Apagar</a>
	<?php } ?>
	<button id="fechar" type="button" class="btn btn-default"><i class="fa fa-times"></i> Fechar</button>
	<input  type="hidden" name="acao" id="acao">
</div>