<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * TRIVEE SERVICES IT
 * 
 * @package   Zata
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 * @copyright TRIVEE SERVICES IT | Copyright (c) 2015 - 2020
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      http://www.trivee.com.br
 * @since     Versão 1.0.0 
 */

/**
 * Class Home
 *
 * Camada responsável por controlar o fluxo da pagina principal, contem a logica e as regras do negocio.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */ 
class Site extends CI_Controller {

	/**
     * Constructor
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @return    void
     */
    public function __construct()
    {
		parent::__construct();
		
        /**
         * Carregando Model
         * Loading Model
         */
        //$this->load->model('zata/UserAccount_model');
	}

	/**
     * Index
     *
     * Pagina inicial
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
	public function index()
	{
         $page_data['class_header_menu'] = 'header-menu-area';

          /**
         * View
         */
	    $page_data['page'] = 'prizon/pages/index';
			
	   /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('prizon/index', $page_data);
	}

	/**
     * Contato
     *
     * Pagina de contato
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
	public function contato()
	{
         $page_data['class_header_menu'] = 'header-menu-area header-menu-area4 header-menu-area5';
         /**
          * View
          */
		$page_data['page'] = 'prizon/pages/contato';

         /**
          * Carregando tudo na view
          * Loading everything on the view
          */
          $this->load->view('prizon/index', $page_data);
     }
     
     /**
     * Trivee IT Care - Soluções
     *
     * Pagina de contato
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
	public function trivee_it_care()
	{
         /**
          * View
          */
		$page_data['page'] = 'prizon/pages/trivee-it-care';

         /**
          * Carregando tudo na view
          * Loading everything on the view
          */
          $this->load->view('prizon/index', $page_data);
     }
     
     /**
     * Trivee CFTV Guard - Soluções
     *
     * Pagina de contato
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
	public function trivee_cftv_guard()
	{
         /**
          * View
          */
		$page_data['page'] = 'prizon/pages/trivee-cftv-guard';

         /**
          * Carregando tudo na view
          * Loading everything on the view
          */
          $this->load->view('prizon/index', $page_data);
	}

}
