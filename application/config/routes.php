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
|	https://codeigniter.com/user_guide/general/routing.html
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


/**
 * Codeigniter
 */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Zata
 */
$route['default_controller'] = 'welcome';
$route['download_tpl_importacao/(:any)']		= 'zata/Download/download_tpl_importacao/$1';

/**
 * Login / Request / Signout
 */
$route['login'] 			  = 'zata/UserAccount/page_login';
$route['entrar'] 			  = 'zata/UserAccount/exec_login';
$route['solicitar']		 	  = 'zata/UserAccount/request_account';
$route['sair'] 				  = 'zata/UserAccount/signout';

/**
 * Modulo de Eventos 
 */
    /**
     * Utilização de sala
     */
    $route['eventos/config/utilizacao-de-sala/listar'] 	       = 'eventos/Eventos_utilizacao_de_sala/listar';
    $route['eventos/config/utilizacao-de-sala/cadastrar'] 	   = 'eventos/Eventos_utilizacao_de_sala/cadastrar';
    $route['eventos/config/utilizacao-de-sala/editar/(:any)']  = 'eventos/Eventos_utilizacao_de_sala/editar/$1';
    $route['eventos/config/utilizacao-de-sala/salvar']   	   = 'eventos/Eventos_utilizacao_de_sala/salvar';
    $route['eventos/config/utilizacao-de-sala/excluir/(:any)'] = 'eventos/Eventos_utilizacao_de_sala/excluir/$1';

    /**
     * Formato de Sala
     */
    $route['eventos/config/formato-de-sala/listar'] 	    = 'eventos/Eventos_formato_de_salas/listar';
    $route['eventos/config/formato-de-sala/cadastrar'] 	  	= 'eventos/Eventos_formato_de_salas/cadastrar';
    $route['eventos/config/formato-de-sala/editar/(:any)'] 	= 'eventos/Eventos_formato_de_salas/editar/$1';
    $route['eventos/config/formato-de-sala/salvar']   	  	= 'eventos/Eventos_formato_de_salas/salvar';
    $route['eventos/config/formato-de-sala/excluir/(:any)']	= 'eventos/Eventos_formato_de_salas/excluir/$1';
    
    /**
     * Salas
     */
    $route['eventos/config/salas/listar'] 	      = 'eventos/Eventos_salas/listar';
    $route['eventos/config/salas/cadastrar'] 	  = 'eventos/Eventos_salas/cadastrar';
    $route['eventos/config/salas/editar/(:any)']  = 'eventos/Eventos_salas/editar/$1';
    $route['eventos/config/salas/salvar']   	  = 'eventos/Eventos_salas/salvar';
    $route['eventos/config/salas/excluir/(:any)'] = 'eventos/Eventos_salas/excluir/$1';
    
    /**
     * Reserva de sala
     */
    $route['eventos/reserva-de-evento/listar'] 	      	          = 'eventos/Eventos_reserva_evento/listar';
    $route['eventos/reserva-de-evento/cadastrar'] 	  		      = 'eventos/Eventos_reserva_evento/cadastrar';
    $route['eventos/reserva-de-evento/editar/(:any)'] 		      = 'eventos/Eventos_reserva_evento/editar/$1';
    $route['eventos/reserva-de-evento/salvar']   	  		      = 'eventos/Eventos_reserva_evento/salvar';
    $route['eventos/reserva-de-evento/adicionar_reserva_de_sala'] = 'eventos/Eventos_reserva_evento/adicionar_reserva_de_sala';
    $route['eventos/reserva-de-evento/excluir/(:any)']		      = 'eventos/Eventos_reserva_evento/excluir/$1';

