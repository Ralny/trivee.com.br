<!-- BEGIN WELLS PORTLET-->
<div class="portlet light">

<div class="portlet-body">

        <div class="row" style="margin: 0 auto; width: 80%">
        
			<img style="display: block; margin-left: auto; margin-right: auto; margin-top:5%; width:20%" src="<?= base_url() ?>assets/zata/utilizacao_sala.svg" alt="logo">

			<h3 class="text-center" style="font-weight: 600; "> Nenhuma <span class="text-info">utilização de sala</span> cadastrada </h3>

			<br>

			<blockquote>
				<p class="text-center">
                   " Eventos corporativos podem ser nomeados de diferentes maneiras.
                     Definir como as salas serão utlizadas vai ajudar a criar indicadores de gestão do seu negócio."
				</p>
			</blockquote>

			<div class="text-center">
				<a class="btn btn-success" href="<?= base_url() . $url ?>/cadastrar " style="width: 260px;"> Criar a primeira utilização de sala</a>
				<a class="btn btn-default" data-toggle="modal" href="#basic" style="width: 270px;"> Importar minhas utilizações de sala</a>
			</div>

			<br>

			<?php $this->load->view('tpl/txt-importacao-dados') ?>
			
			<br><br>
	
		</div>
	</div>	
</div>
<!-- END WELLS PORTLET-->

<?php $this->load->view('tpl/modal-import') ?>