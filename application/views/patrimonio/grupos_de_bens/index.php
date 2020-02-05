<!-- BEGIN WELLS PORTLET-->
<div class="portlet light">

<div class="portlet-body">

        <div class="row" style="margin: 0 auto; width: 80%">
        
			<img style="display: block; margin-left: auto; margin-right: auto; margin-top:5%; width:20%" src="<?= base_url() ?>assets/zata/plan.svg" alt="logo">

			<h3 class="text-center" style="font-weight: 600; "> Nenhum <span class="text-info">grupo de bem</span> cadastrado </h3>

			<br>

			<blockquote>
				<p class="text-center">
				   " Fazer a classificação dos ativos é fundamental para os responsáveis pela administração e controle
					financeiro de qualquer negócio, assim como entender quais são os benefícios que 
					este controle pode proporcionar para a empresa."
				</p>
			</blockquote>

			<div class="text-center">
				<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar " style="width: 260px;"> Criar seu primeiro grupo de bem</a>
				<a class="btn btn-default" data-toggle="modal" href="#basic" style="width: 270px;"> Importar meus grupos de bens</a>
			</div>

			<br>

			<?php $this->load->view('tpl/txt-importacao-dados') ?>
			
			<br><br>
	
		</div>
	</div>	
</div>
<!-- END WELLS PORTLET-->

<?php $this->load->view('tpl/modal-import') ?>