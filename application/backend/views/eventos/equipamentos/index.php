<!-- BEGIN WELLS PORTLET-->
<div class="portlet light">

<div class="portlet-body">

        <div class="row" style="margin: 0 auto; width: 80%">
        
			<img style="display: block; margin-left: auto; margin-right: auto; margin-top:5%; width:20%" src="<?= base_url() ?>assets/zata/equipment.svg" alt="logo">

			<h3 class="text-center" style="font-weight: 600; "> Nenhum <span class="text-info">equipamento</span> cadastrado </h3>

			<br>

			<blockquote>
				<p class="text-center">
				   " 
				   	Equipamentos de ponta, processos de revisão e manutenção de equipamentos, equipe treinada, compõe algumas 
				    das diretrizes na locação de equipamentos para eventos. Na locação é importante 
				    levar em conta a expertise do seu fornecedor para que tudo saia como o planejado.
				   "
				</p>
			</blockquote>

			<div class="text-center">
				<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar " style="width: 280px;"> Cadastrar meu primeiro equipamento</a>
				<a class="btn btn-default" data-toggle="modal" href="#basic" style="width: 270px;"> Importar meus equipamentos</a>
			</div>

			<br>

			<?php $this->load->view('tpl/txt-importacao-dados') ?>
			
			<br><br>
	
		</div>
	</div>	
</div>
<!-- END WELLS PORTLET-->

<?php $this->load->view('tpl/modal-import') ?>