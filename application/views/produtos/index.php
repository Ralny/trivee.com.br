<!-- BEGIN WELLS PORTLET-->
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption">
			Produtos e Servicos
		</div>
	</div>
	<div class="portlet-body">

		<div class="row" style="margin: 0 auto; width: 80%">

			<br><br>

			<img style="display: block; margin-left: auto; margin-right: auto;" src="<?= base_url() ?>assets/zata/box-normal.svg" alt="logo">

			<h3 class="text-center" style="font-weight: 600; "> Nenhum <span class="text-info">produto</span> cadastrado </h3>

			<br>

			<blockquote>
				<p class="text-center">
					Cadastre seus produtos para facilitar suas compras e vendas, gerencie seu estoque, customize seus impostos, crie produtos compostos (Estrutura de KIT) e defina suas listas de preço.
				</p>
			</blockquote>

			<h4 class="text-center" style="font-weight: 600"> Recursos adcionais</h4>

			<p class="text-center"><i class="fa fa-check font-green-sharp"></i> Crie galerias de fotos</p>
			<p class="text-center"><i class="fa fa-check font-green-sharp"></i> Categorize seus produtos e servicos</p>
			<p class="text-center"><i class="fa fa-check font-green-sharp"></i> Gerencie listas de precos</p>
			<p class="text-center"><i class="fa fa-check font-green-sharp"></i> Imprima etiquetas</p>

			<br><br>

			<div class="text-center">
				<a class="btn btn-success" href="<?= base_url()?>produtos/cadastrar" style="width: 200px;"> Adicionar Novo</a>
				<a class="btn btn-default" data-toggle="modal" href="#basic" style="width: 200px;"> Importar</a>
			</div>

			<br><br>

		</div>
	</div>	
</div>
<!-- END WELLS PORTLET-->

<?php $this->load->view('tpl/modal-import') ?>