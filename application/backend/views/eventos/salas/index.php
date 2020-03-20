<!-- BEGIN WELLS PORTLET-->
<div class="portlet light">

<div class="portlet-body">

        <div class="row" style="margin: 0 auto; width: 80%">
        
			<img style="display: block; margin-left: auto; margin-right: auto; margin-top:5%; width:20%" src="<?= base_url() ?>assets/zata/training.svg" alt="logo">

			<h3 class="text-center" style="font-weight: 600; "> Nenhuma <span class="text-info">sala</span> cadastrada </h3>

			<br>

			<blockquote>
				<p class="text-center">
                   " Quem se preocupa em organizar experiências memoráveis deve ter em mente
				    a buscar por oferecer os melhores recursos para suas salas de eventos."
				</p>
			</blockquote>

			<div class="text-center">
				<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar " style="width: 260px;"> Criar a sua primeira sala</a>
				<a class="btn btn-default" data-toggle="modal" href="#basic" style="width: 270px;"> Importar minhas salas</a>
			</div>

			<br>

			<?php $this->load->view('tpl/txt-importacao-dados') ?>
			
			<br><br>
	
		</div>
	</div>	
</div>
<!-- END WELLS PORTLET-->

<?php $this->load->view('tpl/modal-import') ?>