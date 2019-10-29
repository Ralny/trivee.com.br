<?php
/**
 * ZATA
 * 
 * Uma estrutura baseada na framework codeiginiter para o desenvolvimento
 * de aplicativos que proporciona a criação de soluções de forma rápida
 * e inovadora, reduzindo o tempo de desenvolcimento em 80%.
 * 
 * Este conteudo é publicado sob a Lincença MIT
 *
 * Copyright(c) 2015-2017, TRIVEE SERVICES IT
 * 
 * É concedida permissão a qualquer pessoa que obtenha uma cópia deste 
 * software e arquivos de documentação associados, sem restrições e limitação,
 * incluindo os direitos de copiar, modificar, fundir, publicar, 
 * distribuir, sublicenciar e/ou vender.
 *
 * O aviso de copyright acima a este aviso de permissão devem ser incluidos
 * em todas as cópias ou partes substancias do software.
 *
 * O SOFTWARE É FORNECIDO "COMO ESTÁ", SEM GARANTIA DE QUALQUER TIPO,
 * EXPRESSA OU IMPLÍCITA, INCLUINDO, MAS NÃO SE LIMITANDO AS GARANTIAS
 * DE COMERCIALIZAÇÃO, ADEQUAÇÃO A UMA FINALIZADE ESPECIFICA E NÃO VIOLAÇÃO.
 *
 * EM NENHUMA CIRCUNSTÂNCIA, AUTORES OU TITULARES DE DIREITOS DE AUTOR SERÃO
 * RESPONSÁVEIS POR QUALQUER RECLAMAÇÃO, DANOS OU OUTRAS RESPONSABILIDADES,
 * SEJA EM UMA AÇÃO DE CONTRATO, ATO OU DE OUTRA FORMA DECORRENTE DE FORA, OU
 * EM CONEXÃO COM OUTRO SOFTWARE OU O USO OU OUTROS NEGECIOS
 *
 * ZATA
 *
 * A framework based on the codeiginiter framework for development
 * application that provides the creation of solutions quickly
 * and innovative, reducing the time of development by 80%.
 *
 * This content is published under the MIT Licensing
 *
 * Copyright (c) 2015-2017, TRIVEE SERVICES IT
 *
 * Permission is granted to anyone who obtains a copy of this
 * software and associated documentation files, without restrictions and limitations,
 * including the rights to copy, modify, merge, publish,
 * distribute, sublicense and / or sell.
 *
 * The above copyright notice to this permission notice must be included
 * on all copies or any parts of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * OF MERCHANTABILITY, FITNESS FOR A SPECIFIC FINISH AND NON-INFRINGEMENT.
 *
 * IN NO EVENT SHALL AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * RESPONSIBLE FOR ANY CLAIM, DAMAGES OR OTHER RESPONSIBILITIES,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE ARISING OUTSIDE, OR
 * IN CONNECTION WITH OTHER SOFTWARE OR THE USE OR OTHER DEALINGS
 *
 * @package   Zata
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 * @copyright TRIVEE SERVICES IT MEI | Copyright (c) 2015 - 2016
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      http://www.trivee.com.br
 * @since     Versão 1.0.0 
 */

defined('BASEPATH') OR exit('Não é permitido acesso direto ao script');

/**
 * Class Logs 
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio. 
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Logs extends MY_Controller 
{
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $modulo  = 'logs';

    public $url     = 'logs';

    /**
     * Constructor
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @return    void
     */
    function __construct() 
    {       
        parent::__construct();

        /**
         * Verificando se existe usuario logado
         * Checking if a user is logged in
         */
        if(!$this->session->userdata('is_logged_in')) redirect('login'); 
        
        /**    
         * Carregando Model
         * Loading Model 
         */
        $this->load->model('zata/Logs_model');
        $this->model  = $this->Logs_model;
       
        /**
         * Carregando Informacoes do Modulos
         * Loading Module information
         */
        $this->info   = $this->MY_model->makeInfo($this->modulo);

        /**
         * Carregando Permissoes de Acesso
         * Loading Access Permissions
         */
        $this->access = $this->MY_model->validAccess($this->info['id_modulo']);

    }

    /**
     * Index
     *
     * Metodo inicial do controller
     * The controller's initial method
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function index()
    { 

        /**
         * Carregando o metodo dashboard() como default do controller
         * Loading the method dashboard() as controller default
         */
        $this->dashboard();
        
    }// Fim da Funcao - End of function

    /**
     * Dashboard
     *
     * Metodo responsavel por carregar a view de dashboard
     * Method responsible for loading the dashboard view 
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function dashboard()
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo da Pagina
         * Page Title
         */
        $page_data['page_title']                = 'Logs - dashboard ';

        /**
         * Retorna o numero de interacoes com o zata
         * Returns the number of interactions with the zata
         */
        $page_data['num_interacoes_zata']       = $this->model->num_interacoes_zata();

        /**
         * Retorna o numero de login realizados no zata
         * Returns the login number made in the zata
         */
        $page_data['num_login_realizados_zata'] = $this->model->num_login_realizados_zata();

        /**
         * Retorna o numero de erros ocorridos no zata
         * Returns the number of errors occurred in the zata
         */
        $page_data['num_erros_zata']            = $this->model->num_erros_zata();

        /**
         * Retorna as interacoes entre os usuarios e o zata
         * Returns the interactions between users and zata
         */
        $page_data['interacoes_usuarios']       = $this->model->num_interacoes_usuario();

        /**
         * Lista os ultimos 7 erros ocorridos
         * Lists the last 7 errors that occurred
         */    
        $page_data['lista_erros_zata_top_7']    = $this->model->lista_erros_zata_top_7();

        /**
         * Lista os ultimos 7 logins realizados
         * Lists the last 7 completed logins
         */
        $page_data['lista_logins_zata_top_7']   = $this->model->lista_logins_zata_top_7();

        /**
         * View 
         */
        $page_data['page']                      = 'zata/logs/dashboard';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function


    /**
     * Lista Erros Zata
     *
     * Metodo responsavel por carregar a view de listagem de erros ocorridos
     * Method responsible for loading the list view of errors occurred
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function lista_erros_zata()
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet']      = 'Erros ocorridos no sistema';

        /**
         * Lista de Erros 
         * List of Errors
         */
        $sql_erros_sistema               = "SELECT * FROM _log_error ORDER BY id_log DESC"; 
        $page_data['list_erros_sistema'] = $this->model->getAll($sql_erros_sistema); 

        /**
         * View 
         */
        $page_data['page']               = 'zata/logs/main-list_erros_sistema';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function


    /**
     * Detalhes Error
     *
     * Metodo responsavel por carregar a view de detalhamento de erro
     * Method responsible for loading the error detail view 
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function detalhes_error($id)
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Method responsible for loading the error detail view
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Detalhes do Erro';

        /**
         * Resgatando o registro do erro 
         * Rescuing the error log
         */
        $page_data['linha']         = $this->model->get_error($id); 

        /**
         * View 
         */
        $page_data['page']          = 'zata/logs/detalhes_error';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function


    /**
     * Lista Logins Realizados
     *
     * Metodo responsavel por carregar a view de listagem de logins
     * Method responsible for loading the logins listing view 
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function lista_logins_realizados()
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Logins Realizados';

        /**
         * Resgatando a lista de registros 
         * Redeeming the list of records
         */
        $sql_erros_sistema          = " SELECT * FROM _log_login_usuario ORDER BY idLoginUsuario DESC "; 
        $page_data['list_logins']   = $this->model->getAll($sql_erros_sistema); 

        /**
         * View 
         */
        $page_data['page']          = 'zata/logs/main-list_logins_realizados';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function


    /**
     * Detalhes Login
     *
     * Metodo responsavel por carregar a view de detalhamento do login
     * Method responsible for loading the login detail view 
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function detalhes_login($id)
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Detalhes do Erro';

        /**
         * Resgatando a lista de registros 
         * Redeeming the list of records
         */
        $page_data['linha'] = $this->model->get_login($id); 

        /**
         * View 
         */
        $page_data['page']          = 'zata/logs/detalhes_login';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function

     /**
     * Lista interacoes sistema
     *
     * Metodo responsavel por carregar a view de listagem de interacoes dos usuarios com o zata
     * Method responsible for loading the list of user interaction list with the zata
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function lista_interacoes_sistema()
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Interacoes com o sitema';

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']           = $this->url;

        /**
         * Resgatando a lista de registros 
         * Redeeming the list of records
         */
        $sql_interacoes = "
                                Select
                                  l.*,
                                  u.nome
                                From
                                  _log_usu_step_by_step l Inner Join
                                  usu_usuario u On u.id_usuario = l.id_user
                                Order By
                                  l.id_step Desc
                            "; 
        $page_data['lista'] = $this->model->getAll($sql_interacoes); 

        /**
         * View 
         */
        $page_data['page']          = 'zata/logs/main-list_interacoes_sistema';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function


    /**
     * Detalhes Interacao
     *
     * Metodo responsavel por carregar a view de detalhamento da interacao de um usuario
     * Method responsible for loading the detail view of the interaction of a user
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function detalhes_interacao($id)
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Interações do Usuario com o Zata';

        /**
         * Resgatando as interacoes do usuario 
         * Rescuing User Interactions
         */
        $page_data['interacoes_usuarios']       = $this->model->num_interacoes_usuario($id);

        /**
         * Resgatando a lista de interacoes 
         * Redeeming the list of interactions
         */
        $page_data['lista'] = $this->model->get_interacoes_usuario($id); 

        /**
         * View 
         */
        $page_data['page']          = 'zata/logs/detalhes_interacao';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function
    
    

}//FIM DA CLASSE - END OF CLASS
