<div class="hor-menu hor-menu hor-menu-light">
	<ul class="nav navbar-nav">
		
		<li class="menu-dropdown classic-menu-dropdown ">
			<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
			Cadastros <i class="fa fa-angle-down"></i></a>
			<ul class="dropdown-menu pull-left">
				<li class="dropdown">
					<a href="<?= base_url(); ?>clientes-e-fornecedores/listar"></i>Clientes / Fornecedores</a>
				</li>				
			</ul>
		</li>

		<li class="menu-dropdown classic-menu-dropdown ">
			<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
			Estoque <i class="fa fa-angle-down"></i></a>
			<ul class="dropdown-menu pull-left">
				<li class="dropdown">
					<a href="<?= base_url(); ?>produtos/listar"></i>Produtos</a>
				</li>
				<li class="dropdown">
					<a href="<?= base_url(); ?>requisicao-de-produtos/listar"></i>Requisições</a>
				</li>					
			</ul>
		</li>
				
	</ul>
</div>