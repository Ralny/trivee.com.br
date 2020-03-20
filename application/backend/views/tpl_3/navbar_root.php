
<div class="hor-menu hor-menu hor-menu-light">
	<ul class="nav navbar-nav">
		
		<li>
			<a href="<?= base_url(); ?>">Dashboard</a>
		</li>

		<li class="menu-dropdown classic-menu-dropdown ">
			<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
				Cadastros <i class="fa fa-angle-down"></i></a>
				<ul class="dropdown-menu pull-left">
					<li class="dropdown">
						<a href="<?= base_url(); ?>clientes-e-fornecedores/listar"></i>Clientes / Fornecedores</a>
					</li>				
				</ul>
		</li>

		<li class="menu-dropdown mega-menu-dropdown ">
		<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
		Solicitações de Serviço <i class="fa fa-angle-down"></i>
		</a>
		<ul class="dropdown-menu" style="min-width: 710px">
			<li>
				<div class="mega-menu-content">
					<div class="row">
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong> Minhas Solicitações </strong></h3>
								</li>
								<li>
									<a href="<?= base_url(); ?>infra/infra_solicitacao_servico/cadastrar" class="iconify"> Nova Solicitação </a>
								</li>
								<li>
									<a href="<?= base_url(); ?>solicitacao-servico/minhas-solicitacoes/eu-recebi" class="iconify"> Recebidas </a>
								</li>
								<li>
									<a href="<?= base_url(); ?>solicitacao-servico/minhas-solicitacoes/eu-solicitei" class="iconify">  Solicitadas </a>
								</li>
								<li>
									<a href="<?= base_url(); ?>car/tipocombustivel" class="iconify"> Concluidas</a>
								</li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong>Infraestrutura</strong></h3>
								</li>
								<li>
									<a href="<?= base_url() ?>infra/Infra_areas_instalacoes" class="iconify"> Áreas e Instalações </a>
								</li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong>Configurações</strong></h3>
								</li>
								<li>
									<a href="<?= base_url() ?>solicitacao-servico/categoria/listar" class="iconify"> Categorias e Problemas </a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</li>

	<li class="menu-dropdown mega-menu-dropdown ">
		<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
		Patrimonio <i class="fa fa-angle-down"></i>
		</a>
		<ul class="dropdown-menu" style="min-width: 710px">
			<li>
				<div class="mega-menu-content">
					<div class="row">
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong> Cadastros </strong></h3>
								</li>
								<li>
									<a href="<?= base_url(); ?>patrimonio/config/grupos-de-bens/listar" class="iconify"> Bens Patrimoniais</a>
								</li>
								<li>
									<a href="<?= base_url(); ?>eventos/reserva-de-evento/listar" class="iconify">Grupos de Bens</a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</li>
		</ul>
	</li>

	<li class="menu-dropdown mega-menu-dropdown ">
		<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
		Eventos <i class="fa fa-angle-down"></i>
		</a>
		<ul class="dropdown-menu" style="min-width: 710px">
			<li>
				<div class="mega-menu-content">
					<div class="row">
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong> Orçamentos </strong></h3>
								</li>
								<li>
									<a href="<?= base_url(); ?>eventos/reserva-de-evento/listar" class="iconify"> Reservas de Eventos </a>
								</li>
								<li>
									<a href="<?= base_url(); ?>eventos/reserva-de-evento/listar" class="iconify">Ordem de Serviço </a>
								</li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong>Configurações</strong></h3>
								</li>
								<li>
									<a href="<?= base_url() ?>eventos/config/salas/listar" class="iconify">Salas</a>
								</li>
								<li>
									<a href="<?= base_url() ?>eventos/config/formato-de-sala/listar" class="iconify"> Formato de Salas</a>
								</li>
								<li>
									<a href="<?= base_url() ?>eventos/config/utilizacao-de-sala/listar" class="iconify"> Utilização de Salas</a>
								</li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong>&nbsp;</strong></h3>
								</li>
								<li>
									<a href="#" class="iconify">Serviços A&B</a>
								</li>
								<li>
									<a href="<?= base_url() ?>eventos/config/equipamentos/listar" class="iconify"> Equipamentos</a>
								</li>
								<li>
									<a href="#" class="iconify"> Internet</a>
								</li>
								<li>
									<a href="#" class="iconify"> Pessoal</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</li>

		<!--

		<li class="menu-dropdown mega-menu-dropdown ">
		<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
		Financeiro <i class="fa fa-angle-down"></i>
		</a>
		<ul class="dropdown-menu" style="min-width: 710px">
			<li>
				<div class="mega-menu-content">
					<div class="row">
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong>Caixa</strong></h3>
								</li>
								<li>
									<a href="ecommerce_index.html" class="iconify">
									Contas a Pagar </a>
								</li>
								<li>
									<a href="ecommerce_orders.html" class="iconify">
									Contas a Receber</a>
								</li>
								<li>
									<a href="<?= base_url(); ?>car/tipocombustivel" class="iconify">
									Extrato</a>
								</li>
								<li>
									<a href="<?= base_url(); ?>car/tipocombustivel" class="iconify">
									Fluxo de Caixa</a>
								</li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong>Vendas</strong></h3>
								</li>
								<li>
									<a href="layout_fluid.html" class="iconify">
									Notas Fiscais </a>
								</li>
								<li>
									<a href="layout_mega_menu_fixed.html" class="iconify">
									Pedidos </a>
								</li>
								<li>
									<a href="layout_top_bar_fixed.html" class="iconify">
									Orcamentos </a>
								</li>
								<li>
									<a href="layout_light_header.html" class="iconify">
									Venda Balcao </a>
								</li>
								<li>
									<a href="layout_blank_page.html" class="iconify">
									NFC-e Consumidor </a>
								</li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="mega-menu-submenu">
								<li>
									<h3><strong>Compras</strong></h3>
								</li>
								<li>
									<a href="layout_click_dropdowns.html" class="iconify">
									Entrada de Mercadorias </a>
								</li>
								<li>
									<a href="layout_fontawesome_icons.html" class="iconify">
									Ordem de Compra </a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</li>
-->




		<!--

		<li class="menu-dropdown classic-menu-dropdown ">
			<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
			Configuracoes <i class="fa fa-angle-down"></i></a>
			<ul class="dropdown-menu pull-left">
				<li class="dropdown">
					<a href=":;"></i>Dados da Empresa</a>
				</li>
				<li class="dropdown">
					<a href=":;"></i>Usuarios</a>
				</li>
				<li class="dropdown">
					<a href=":;"></i>Certificado Digital</a>
				</li>
				<li class="dropdown">
					<a href=":;"></i>Paramentros do sistema</a>
				</li>				
			</ul>
		</li> 

-->

	<li class="menu-dropdown classic-menu-dropdown ">
		<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
			Zata <i class="fa fa-angle-down"></i></a>
			<ul class="dropdown-menu pull-left">
				<li class="dropdown-submenu">
					<a href=":;"></i>Desenvolvimento</a>
					<ul class="dropdown-menu">
						<li class="">
							<a href="<?= base_url() ?>zata/modulos ">
							Modulos</a>
						</li>
					</ul>
				</li>
				<li class=" dropdown-submenu">
					<a href=":;"></i>Logs</a>
					<ul class="dropdown-menu">
						<li class=" ">
							<a href="<?= base_url() ?>zata/logs ">
							Dashboard</a>
						</li>
						<li class=" ">
							<a href="<?= base_url() ?>zata/logs/lista_interacoes_sistema ">
							Interacoes</a>
						</li>
						<li class=" ">
							<a href="<?= base_url() ?>zata/logs/lista_logins_realizados ">
							Logins</a>
						</li>
						<li class=" ">
							<a href="<?= base_url() ?>zata/logs/lista_erros_zata ">
							Erros</a>
						</li>
					</ul>
				</li>
				<li class=" dropdown-submenu">
					<a href=":;"></i>Ajuda</a>
					<ul class="dropdown-menu">
						<li class=" ">
							<a href="table_basic.html">
								Banco de Conhecimento
							</a>
						</li>
						<li class=" ">
							<a href="table_basic.html">
								Suporte
							</a>
						</li>
						<li class=" ">
							<a href="table_basic.html">
							Sobre</a>
						</li>
					</ul>
				</li>
				
			</ul>
		</li>







	</ul>
</div>