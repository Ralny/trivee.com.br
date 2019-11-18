<!-- BEGIN WELLS PORTLET-->
<div class="portlet light">

<div class="portlet-body">

        <div class="row" style="margin: 0 auto; width: 80%">
        
			<img style="display: block; margin-left: auto; margin-right: auto; margin-top:5%; width:20%" src="<?= base_url() ?>assets/zata/meeting.svg" alt="logo">

			<h3 class="text-center" style="font-weight: 600; "> Nenhum <span class="text-info">formato de sala</span> cadastrado </h3>

			<br>

			<blockquote>
				<p class="text-center">
                   " Exercer atividades profissionais em um local agradável e adequado à programação prevista é 
				   ideal para conseguir desfrutar de uma boa experiência e aproveitar o momento ao máximo para trocar ideias, discutir negócios e criar uma nova rede de contatos."
				</p>
			</blockquote>

			<div class="text-center">
				<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar " style="width: 260px;"> Criar o primeiro formato de sala</a>
				<a class="btn btn-default" data-toggle="modal" href="#basic" style="width: 270px;"> Importar meus formatos de sala</a>
			</div>

			<br>

			<?php $this->load->view('tpl/txt-importacao-dados') ?>
			
			<br><br>
	
		</div>
	</div>	
</div>
<!-- END WELLS PORTLET-->

<?php $this->load->view('tpl/modal-import') ?>