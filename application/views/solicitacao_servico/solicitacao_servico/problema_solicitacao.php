<style>
	
	.categories{
		display:inline-block;
		width:100%;
	}

	.categories ul{
		margin: 0 -1.3%;
		padding:0;
		list-style: none;
	}

	.categories ul li{
		width: 14.6666666%;
		float: left;
		margin:0 1% 20px;
		background-color:#cacaca;
		cursor: pointer;
		border-radius:0;
		-moz-transition: ease-in .1s;
		-webkit-transition: ease-in .1s;
		transition: ease-in .1s;
	}

	.categories ul li:not(.nohover):hover img {
		background-color:  #4DB3A2 !important;
	}

	.categories ul li:hover{
		background-color:  #4DB3A2 !important;
	}
	.categories ul li img{
		background-color: #3A87ad;
		width: 92%;
		height:auto;
		margin: 4%;
		vertical-align: middle;
		border:0;
	}

	.categories ul li label{
		display: block;
		padding:8px 4px 8px;
		overflow:hidden;
		text-overflow:ellipsis;
		color: #111;
		text-align:center;
		/**font-size:12px; */
		line-height: 1.2;
		max-width: 100%;
		margin-bottom: 05px;
		font-weight:bold; 
	}


</style>

<?php 
/**
 * Carregando configurações auxiliares
 * Loading auxiliary settings
 */
include ('application/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet light">

		<div class="portlet-body">
			<h1 style="margin-top:0px">Identificação do problema:</h1>
			<br>
			<div class="list-group">
			<?php 
			
			foreach ($problema_solicitacao as $row): 	?>

				<a href="<?= base_url() ?>infra/infra_solicitacao_servico/cadastrar/<?= $row->token_id ?>" class="list-group-item">
					<p class="list-group-item-text">
						<?= $row->desc_problema_solicitacao_servico ?>
					</p>
				</a>
				<?php endforeach ?>
			</div>
		</div>
	</div>	
</div>	
<!-- END PAGE CONTENT INNER -->
