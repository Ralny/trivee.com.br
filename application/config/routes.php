<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//Login
//$route['default_controller'] 				= 'gelato_grano/Gelatograno_categorias_gelato/listar';
$route['default_controller']  = 'Controller_default';
$route['login'] 			  = 'zata/UserAccount/page_login';
$route['entrar'] 			  = 'zata/UserAccount/exec_login';
$route['solicitar']		 	  = 'zata/UserAccount/request_account';
$route['sair'] 				  = 'zata/UserAccount/signout';

//Clientes e Fornecedores
$route['clientes-e-fornecedores/listar'] 			= 'clientes_fornecedores/Clientesfornecedores/listar';
$route['clientes-e-fornecedores/cadastrar'] 		= 'clientes_fornecedores/Clientesfornecedores/cadastrar';
$route['clientes-e-fornecedores/editar/(:any)'] 	= 'clientes_fornecedores/Clientesfornecedores/editar/$1';
$route['clientes-e-fornecedores/excluir/(:any)'] 	= 'clientes_fornecedores/Clientesfornecedores/excluir/$1';
$route['clientes-e-fornecedores/salvar'] 			= 'clientes_fornecedores/Clientesfornecedores/salvar';

//Ordem de Servicos
$route['servicos/ordem-de-servico/listar'] 	        = 'Os/listar';
$route['servicos/ordem-de-servico/cadastrar'] 	    = 'Os/cadastrar';
$route['servicos/ordem-de-servico/editar/(:any)']   = 'Os/editar/$1';
$route['servicos/ordem-de-servico/salvar']   	    = 'Os/salvar';
$route['servicos/ordem-de-servico/excluir/(:any)']  = 'Os/excluir/$1';

//Produtos
$route['produtos/listar'] 	       = 'produtos/Produtos/listar';
$route['produtos/cadastrar'] 	   = 'produtos/Produtos/cadastrar';
$route['produtos/editar/(:any)']   = 'produtos/Produtos/editar/$1';
$route['produtos/salvar']   	   = 'produtos/Produtos/salvar';
$route['produtos/excluir/(:any)']  = 'produtos/Produtos/excluir/$1';

//Produtos
$route['requisicao-de-produtos/listar'] 	     = 'produtos/Requisicao/listar';
$route['requisicao-de-produtos/cadastrar'] 	  	 = 'produtos/Requisicao/cadastrar';
$route['requisicao-de-produtos/editar/(:any)'] 	 = 'produtos/Requisicao/editar/$1';
$route['requisicao-de-produtos/salvar']   	  	 = 'produtos/Requisicao/salvar';
$route['requisicao-de-produtos/excluir/(:any)']	 = 'produtos/Requisicao/excluir/$1';

//Solicitacao de Servico - Categorias
$route['solicitacao-servico/categoria/listar'] 		   	= 'solicitacao_servico/Categorias_solicitacao_servico/listar';
$route['solicitacao-servico/categoria/cadastrar'] 	   	= 'solicitacao_servico/Categorias_solicitacao_servico/cadastrar';
$route['solicitacao-servico/categoria/editar/(:any)']  	= 'solicitacao_servico/Categorias_solicitacao_servico/editar/$1';
$route['solicitacao-servico/categoria/salvar']    	   	= 'solicitacao_servico/Categorias_solicitacao_servico/salvar';
$route['solicitacao-servico/categoria/excluir/(:any)']  = 'solicitacao_servico/Categorias_solicitacao_servico/excluir/$1';

//Solicitacao de Servico - Subcategorias
$route['solicitacao-servico/subcategoria/listar'] 		   	= 'solicitacao_servico/Categorias_solicitacao_servico/listar';
$route['solicitacao-servico/subcategoria/cadastrar/(:any)'] = 'solicitacao_servico/Categorias_solicitacao_servico/cadastrar';
$route['solicitacao-servico/subcategoria/editar/(:any)']  	= 'solicitacao_servico/Categorias_solicitacao_servico/editar/$1';
$route['solicitacao-servico/subcategoria/salvar']    	   	= 'solicitacao_servico/Categorias_solicitacao_servico/salvar';
$route['solicitacao-servico/subcategoria/excluir/(:any)'] 	= 'solicitacao_servico/Categorias_solicitacao_servico/excluir/$1';

//Solicitacao de Servico - Minhas Solicitacoes
$route['solicitacao-servico/minhas-solicitacoes/eu-recebi'] 	= 'infra/infra_solicitacao_servico/listar';
$route['solicitacao-servico/minhas-solicitacoes/eu-solicitei'] 	= 'infra/infra_solicitacao_servico/listar';

//Eventos - Formato de Sala
$route['eventos/config/formato-de-sala/listar'] 	    = 'eventos/Eventos_formato_de_salas/listar';
$route['eventos/config/formato-de-sala/cadastrar'] 	  	= 'eventos/Eventos_formato_de_salas/cadastrar';
$route['eventos/config/formato-de-sala/editar/(:any)'] 	= 'eventos/Eventos_formato_de_salas/editar/$1';
$route['eventos/config/formato-de-sala/salvar']   	  	= 'eventos/Eventos_formato_de_salas/salvar';
$route['eventos/config/formato-de-sala/excluir/(:any)']	= 'eventos/Eventos_formato_de_salas/excluir/$1';

//Eventos - Utilização de sala
$route['eventos/config/utilizacao-de-sala/listar'] 	      	    = 'eventos/Eventos_utilizacao_de_sala/listar';
$route['eventos/config/utilizacao-de-sala/cadastrar'] 	  		= 'eventos/Eventos_utilizacao_de_sala/cadastrar';
$route['eventos/config/utilizacao-de-sala/editar/(:any)'] 		= 'eventos/Eventos_utilizacao_de_sala/editar/$1';
$route['eventos/config/utilizacao-de-sala/salvar']   	  		= 'eventos/Eventos_utilizacao_de_sala/salvar';
$route['eventos/config/utilizacao-de-sala/excluir/(:any)']		= 'eventos/Eventos_utilizacao_de_sala/excluir/$1';

//Eventos - Salas
$route['eventos/config/salas/listar'] 	      	    = 'eventos/Eventos_salas/listar';
$route['eventos/config/salas/cadastrar'] 	  		= 'eventos/Eventos_salas/cadastrar';
$route['eventos/config/salas/editar/(:any)'] 		= 'eventos/Eventos_salas/editar/$1';
$route['eventos/config/salas/salvar']   	  		= 'eventos/Eventos_salas/salvar';
$route['eventos/config/salas/excluir/(:any)']		= 'eventos/Eventos_salas/excluir/$1';

//Eventos -Reserva de sala
$route['eventos/reserva-de-evento/listar'] 	      	    = 'eventos/Eventos_reserva_evento/listar';
$route['eventos/reserva-de-evento/cadastrar'] 	  		= 'eventos/Eventos_reserva_evento/cadastrar';
$route['eventos/reserva-de-evento/editar/(:any)'] 		= 'eventos/Eventos_reserva_evento/editar/$1';
$route['eventos/reserva-de-evento/salvar']   	  		= 'eventos/Eventos_reserva_evento/salvar';
$route['eventos/reserva-de-evento/adicionar_reserva_de_sala']   	  		= 'eventos/Eventos_reserva_evento/adicionar_reserva_de_sala';
$route['eventos/reserva-de-evento/excluir/(:any)']		= 'eventos/Eventos_reserva_evento/excluir/$1';




$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;
