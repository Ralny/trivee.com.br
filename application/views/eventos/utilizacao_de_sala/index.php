<!-- BEGIN WELLS PORTLET-->
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption">
			<!--Utilização de Salas-->
		</div>
	</div>
	<div class="portlet-body">

        <div class="row" style="margin: 0 auto; width: 80%">
        
			<img style="display: block; margin-left: auto; margin-right: auto; margin-top:5%; width:20%" src="<?= base_url() ?>assets/zata/utilizacao_sala.svg" alt="logo">

			<h3 class="text-center" style="font-weight: 600; "> Nenhuma <span class="text-info">utilização de sala</span> cadastrada </h3>

			<br>

			<blockquote>
				<p class="text-center">
                    Eventos corporativos podem ser nomeados de diferentes maneiras e modalidades, são exemplos: conferência, simpósio, seminário.
                     Definir como as salas serão utlizadas vai ajudar a criar indicadores de gestão do seu negócio.
				</p>
			</blockquote>

			<h4 class="text-center" style="font-weight: 600"> Recursos adicionais</h4>

            <p class="text-center"><i class="fa fa-check font-green-sharp"></i>
                    <a href="<?=base_url ()?>download_tpl_importacao/tpl_imp_Eventos_utilizacao_salas.csv"> Download do template de importação</a> 
            </p>
	
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