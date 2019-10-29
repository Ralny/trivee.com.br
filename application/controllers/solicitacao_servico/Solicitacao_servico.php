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
 * Class Infra_solicitacao_servico 
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio. 
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Solicitacao_servico extends MY_Controller 
{
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $modulo  = 'solicitacao_servico';

    public $url     = 'solicitacao_servico/solicitacao_servico';

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
        $this->load->model('infra/Infra_areas_instalacoes_model');
        $this->load->model('solicitacao/solicitacao_servico_categorias_model');
        $this->load->model('solicitacao_servico/solicitacao_servico_model');
        //$this->load->model('infra/Infra_tarefas_model');
        $this->load->model('zata/UserAccount_model');
        $this->model = $this->Solicitacao_servico_model;

        /**
         * Carregando Informacoes do Modulos
         * Loading Module information
         */
        $this->info   = $this->MY_model->makeInfo($this->modulo);

        /**
         * Carregando Permissoes de Acesso
         * Loading Access Permissions
         */
        $this->access = $this->MY_model->validAccess($this->info['token_id']);

        

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
         * Carregando o metodo listar() como default do controller
         * Loading the method listar() as controller default
         */
        $this->listar(); 
        
    }// Fim da Funcao - End of function

    /**
     * Listar - List
     *
     * Metodo responsavel por carregar a view de listagem e seus registros
     * Method responsible for loading the listing view and its records 
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function listar()
    {

        /**
         * Verifica se o usuario tem permissao de acesso 
         * Checks whether the user has access permission
         */ 
        if($this->access['is_list'] == 0)
        { 
             show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!","301","Sem permissão de acesso :[");
        }

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['page_title'] = 'Solicitações de Serviço';

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']           = $this->url;

        //Conta Solicitacoes nao analizadas
        $page_data['count_recebidas']   = count($this->model->lista_solicitacoes_recebidas($id_status_solicitacao = 1)); 
        //Conta Solicitacoes nao analizadas
        $page_data['count_solicitadas'] = count($this->model->lista_solicitacoes_solicitadas($id_status_solicitacao = 1)); 

        if ($this->uri->segment(3) == 'eu-recebi')
        {
            /**
             * Resgatando a lista de registros 
             * Redeeming the list of records
             * @param id_status_solicitacao [1 - Nao analizada]
             */
            $page_data['lista_recebidas_nao_analizadas'] = $this->model->lista_solicitacoes_recebidas($id_status_solicitacao = 1); 
            $page_data['lista_recebidas_analizadas']     = $this->model->lista_solicitacoes_recebidas($id_status_solicitacao = 2); 
        }
        else
        {
            /**
             * Resgatando a lista de registros 
             * Redeeming the list of records
             * @param id_status_solicitacao [1 - Nao analizada]
             */
            $page_data['lista_recebidas_nao_analizadas'] = $this->model->lista_solicitacoes_solicitadas($id_status_solicitacao = 1); 
            $page_data['lista_recebidas_analizadas']     = $this->model->lista_solicitacoes_solicitadas($id_status_solicitacao = 2); 
        }    
    
        /**
         * Finalizando sessao Aux usada para identidicar a solicitação de serviço quando o problema eh identificado errado
         * 
         */
        $this->session->unset_userdata('id_solicitacao_servico');

        /**
         * View 
         */
        $page_data['page']          = 'infra/infra_solicitacao_servico/main-list';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function
    

   /**
    * Cadastrar - Add
    *
    * Metodo reponsavel por carregar a view de cadastro junto com suas dependencias
    * Method responsible for uploading the register view along with its dependencies
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */    
    public function cadastrar()
    {

        /**
         * Verifica se o usuario tem permissao de acesso 
         * Checks whether the user has access permission
         */ 
        if($this->access['is_add'] == 0)
        { 
            show_error("Você não tem permissão para acessar esse conteúdo. Entre em contato com o administrador do sistema!","500","Sem permissão de acesso :(");
        }

        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['page_title'] = 'Solicitações de Serviço';

        /**
         * Titulo Portlet
         * Portlet Title
         */
        //$page_data['title_portlet'] = 'Solicitação de Serviço';
        
        /**
         * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
         * Auxiliary variable for controller routes. Used only in form in edit mode
         */
        $page_data['url']           = $this->url;

        /**
         * Variavel auxiliar.  Usada somente no formulario em modo de edicao
         * Auxiliary Variable. Used only in form in edit mode
         */
        $page_data['show']          = '';

        /**
         * Configuracao do Formulario
         * Form Settings
         */ 
        $page_data['tableForm']     = $this->info['config']['form'];

        /**
         * Verificando se existe categorias PAI cadastradas
         * Checking for Registered PAI Categories
         */         
        $verifica_se_existe_categoria  = $this->Infra_cat_solicitacao_servico_model->lista_categorias_solicitacao_servico(); 

        if (empty($verifica_se_existe_categoria))
        {
            /**
             * Se não existir categorias PAI, redireciona para o cadastro de categoria
             */
             redirect(base_url('solicitacao-servico/categoria/listar'));
        }
        
        /**
         * Filtrando categorias e subcategorias
         * Filtering categories and subcategories
         */ 

        $page_data['categorias_solicitacao'] = $this->Infra_cat_solicitacao_servico_model->categorias_solicitacao_servico($this->uri->segment(4));

        /**
         * Se nao tiver parametro na funcao, entao vai abrir as categorias principais
         *
         */
        if (!empty($page_data['categorias_solicitacao']))
        {

            /**
             * View 
             */
            $page_data['page']          = 'infra/infra_solicitacao_servico/categoria_solicitacao';     
        }
        /**
         * Depois de listar todas as categorias e subcategorias, vai listar os problemas
         *
         */
        else
        {
            
            /**
             * Lista os problemas da categoria ou subcategoria
             *
             */
            $page_data['problema_solicitacao'] =  $this->Infra_cat_solicitacao_servico_model->problemas_categorias_solicitacao_servico($this->uri->segment(4));

            //var_dump($page_data['problema_solicitacao'] );exit;

            /**
             * Abre a view de problemas
             *
             */
            if (!empty($page_data['problema_solicitacao']))
            {                            
                /**
                 * View 
                 */
                 $page_data['page']         = 'infra/infra_solicitacao_servico/problema_solicitacao';
            }
            else
            {
                /**
                 * Retorna os as informacoes do problema 
                 */
                $problema       = $this->Infra_cat_solicitacao_servico_model->problema_solicitacao_servico($this->uri->segment(4));
                
                /**
                 * Retorna as categorias pai do problema
                 */
                $page_data['categorias_pai']  = $this->buscar_categoria_pai($problema->token_id_cat_solicitacao_servico);

                /**
                 * Lista as areas e instalacoes
                 */
                $page_data['local']        = $this->Infra_areas_instalacoes_model->listar_locais_instalacoes();

                if (isset($_SESSION['id_solicitacao_servico']))
                {    

                    $page_data['hide_solicitacao_servico'] = $this->model->getRow($_SESSION['id_solicitacao_servico']);
                
                }    
                
                /**
                 * View de Local da ocorrencia do problema
                 */
                $page_data['page']          = 'infra/infra_solicitacao_servico/local_problema_solicitacao';

                /**
                 * Finalizando sessao Aux usada para identidicar a solicitação de serviço quando o problema eh identificado errado
                 * 
                 */
                //if($_SESSION['redefinir_problema'] == 'Sim')
                // {
                //      $this->session->unset_userdata('id_solicitacao_servico');
                // }
        
                /**
                 * Ènvia para view somente a descricao do problema
                 */
                $page_data['problema'] = $problema->desc_problema_solicitacao_servico ;

            }
        }    
       
        /**
         * Carregando dados para a view
         * Loading data for the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function
    
    

   /**
    * Editar - To Edit
    *
    * Metodo reponsavel por carregar a view de edicao junto com suas dependencias
    * Method responsible for loading the edit view along with its dependencies
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @internal  int $id - ID do registro que vai ser editado - ID of the record to be edited
    */    
    public function gerenciar_solicitacao_servico()
    {

        /**
         * Verifica se o usuario tem permissao de acesso 
         * Checks whether the user has access permission
         */ 
        if($this->access['is_edit'] == 0)
        { 
            show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!","301","Sem permissão de acesso :[");
        }

        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Pega o identificador do registro que vai ser editado diretamente da URL
         * Get the identified from the record that will be edited directly from the URL
         */   
        $id = $this->uri->segment(4); 

        /**
         * Verfica se exite e se a variavel capturada diretamente da URL é um numero, 
         * Se o paremetro nao estiver correto, ira redirecionar para a pagina de erro.
         * Check if it exists and if the variable captured directly from the URL is a number, 
         * If the parameter is not correct, it will redirect to the error page.
         */ 
        if(!$id)
        {
            /**
             * Regitrando o log do erro no banco de dados
             * Logging the error log to the database
             */ 
            $this->log_zata->log_error('Danger','Acesso indevido: Controller_default->editar() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
        }
        else // Se o parametro esta CORRETO - If the parameter is CORRECT
        {
            /**
             * Verificamos se ele existe no banco de dados
             * Checked whether it exists in the database
             */
            if (!$this->model->getRow($id))
            {
                /**
                 * Gravando o Log do erro no banco de dados
                 * Writing the Error Log to the Database
                 */
                $this->log_zata->log_error('Error','Acesso invalido: Controller_default->editar() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */ 
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");
            }
            else
            {
                /**
                 * se existir vai carregar as infomações do registro na variavel show
                 * If it exists it will load the registry information in the variable show
                 */
                $page_data['show']          = $this->model->getRow($id);

                /**
                 * Titulo do Portlet
                 * Portlet Title
                 */
                $page_data['page_title'] = 'Solicitações de Serviço';

               
                /**
                 * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
                 * Auxiliary variable for controller routes. Used only in form in edit mode
                 */
                $page_data['url']          = $this->url;

                /**
                 * Configuracao do Formulario
                 * Form Settings
                 */ 
                $page_data['tableForm']    = $this->info['config']['form']; 

                /**
                 * Variavel Auxiliar para validar que o formulario esta no modo de Edição
                 * Help variable to validate that the form is in Edit mode
                 */ 
                $page_data['form_editar']  = true;

                /**
                 * Variavel auxiliar do Botao Excluir no formulario de edição
                 * Help variable Delete in the edit form
                 */
                $page_data['btExcluir']    = $this->url.'/excluir/'.$id;


                /**
                 * Status da Solicitacao de Servico
                 */
                $page_data['status_solicitacao']  = $this->model->lista_status_solicitacao_servico();

                /**
                 * Prioridade
                 */
                $page_data['prioridade']  =  $this->db->get('aux_prioridade')->result();

                /**
                 * Garantia
                 */
                $page_data['garantia']  =  $this->db->from('aux_tempo_garantia')->order_by("id_tempo_garantia","asc")->get()->result();

                /**
                 * Retorna os as informacoes do problema 
                 */
                $problema  = $this->Infra_cat_solicitacao_servico_model->problema_solicitacao_servico($page_data['show']->token_id_problema_solicitacao_servico);

                /**
                 * Retorna as categorias pai do problema
                 */
                $page_data['categorias_pai']  = $this->buscar_categoria_pai($problema->token_id_cat_solicitacao_servico);

                /**
                 * Ènvia para view somente a descricao do problema
                 */
                $page_data['problema'] = $problema->desc_problema_solicitacao_servico ; 

                /**
                 * Areas/Instalacoes de Ocorrencias
                 */
                $page_data['local_ocorrencia']  = $this->Infra_areas_instalacoes_model->listar_locais_instalacoes();

                /**
                 * Lista Solicitantes
                 */
                $page_data['lista_solicitantes']  = $this->UserAccount_model->listar_usuarios();

                /**
                 * Sessão Aux usada para resgatar o ID da solicitação de serviço quando o problema foi identificado incorretamente  - Meio Gambiarra
                 */
                $this->session->set_userdata('id_solicitacao_servico', $id);
  
                /**
                 * View 
                 */
                $page_data['page']         = 'infra/infra_solicitacao_servico/gerenciar_solicitacao_servico';

                /**
                 * Carregando dados para a view
                 * Loading data for the view
                 */
                $this->load->view('tpl/main', $page_data);
            }
        }             
    } // Fim da Funcao - End of function
    

   /**
    * Salvar - To save
    *
    * Registrar o cadastro ou atualiza os registros no banco de dados, esses dados vem do formulario
    * Register the registry or update the records in the database, this data comes from the form
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @return  void
    */
    public function salvar()
    {
        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Nova solicitação de Serviço
         * 
         */
        if( $this->input->post('id') == NULL)
        {

             $data = array(
                            "numero_solicitacao"                    => $this->gera_numero_solicitacao_servico(),
                            "token_id_problema_solicitacao_servico" => $this->input->post('token_id_problema_solicitacao_servico'),
                            "desc_problema_solicitacao"             => trim($this->input->post('desc_problema_solicitacao')),
                            "id_area_instalacao"                    => (int)$this->input->post('id_area_instalacao'),
                            "dth_abertura_solicitacao"              => date('Y-m-d H:i:s'),
                            "id_solicitante"                        => $this->session->userdata('id_usuario'),
                            "id_responsavel_tecnico"                => $this->buscar_responsavel_tecnico_da_solicitacao_servico($this->input->post('token_id_problema_solicitacao_servico')),
                            "id_prioridade"                         => $this->buscar_prioridade_da_solicitacao_servico($this->input->post('token_id_problema_solicitacao_servico'))
                    );

             $link_url = '/solicitacao-servico/minhas-solicitacoes/eu-recebi/';
        }
        else
        {
            /**
             * Alterar Solicitação
             * 
             */
            if ($this->input->post('acao') == 'alterar-problema-solicitacao-servico')
            {
                 /**
                  * Alterando somente o problema da solicitação, quando o mesmo eh indentidicado errado
                  * 
                  */
                $data = array(
                                "token_id_problema_solicitacao_servico"   => $this->input->post('token_id_problema_solicitacao_servico'),
                                "id_responsavel_tecnico"                  => $this->buscar_responsavel_tecnico_da_solicitacao_servico($this->input->post('token_id_problema_solicitacao_servico')),
                                "id_prioridade"                           => $this->buscar_prioridade_da_solicitacao_servico($this->input->post('token_id_problema_solicitacao_servico')),
                            );
            }
            else
            {
                /**
                  * Alterando os dados da solicitação
                  * 
                  */
                $status_solicitacao = $this->input->post('acao');

                switch ($status_solicitacao)
                {
                     case 'salvar':      
                           
                            $data = array(
                                            "id_status_solicitacao"         => (int)$this->input->post('id_status_solicitacao'),
                                            "id_prioridade"                 => (int)$this->input->post('id_prioridade'),
                                            "id_tempo_garantia"             => (int)$this->input->post('id_tempo_garantia'),
                                            "id_area_instalacao"            => (int)$this->input->post('id_area_instalacao'),
                                            "id_solicitante"                => (int)$this->input->post('id_solicitante'),
                                            "id_responsavel_tecnico"        => (int)$this->input->post('id_responsavel_tecnico'),
                                            "desc_problema_solicitacao"     => trim($this->input->post('desc_problema_solicitacao')),
                                            "laudo_tecnico"                 => trim($this->input->post('laudo_tecnico')),
                                            "solucao"                       => trim($this->input->post('solucao')),
                                            "observacoes"                   => trim($this->input->post('observacoes'))
                                            );
                            break;  

                    case 'concluir':      

                            $data = array(
                                            "id_status_solicitacao"         => 100,
                                            "id_prioridade"                 => (int)$this->input->post('id_prioridade'),
                                            "dth_conclusao_solicitacao"     => date("Y-m-d H:i:s"),
                                            "id_tempo_garantia"             => (int)$this->input->post('id_tempo_garantia'),
                                            "id_area_instalacao"            => (int)$this->input->post('id_area_instalacao'),
                                            "id_solicitante"                => (int)$this->input->post('id_solicitante'),
                                            "id_responsavel_tecnico"        => (int)$this->input->post('id_responsavel_tecnico'),
                                            "desc_problema_solicitacao"     => trim($this->input->post('desc_problema_solicitacao')),
                                            "laudo_tecnico"                 => trim($this->input->post('laudo_tecnico')),
                                            "solucao"                       => trim($this->input->post('solucao')),
                                            "observacoes"                   => trim($this->input->post('observacoes'))
                                            );
                            break;   
                    
                    case 'reabrir':                     

                            $data = array(
                                            "id_status_solicitacao"        => 200,
                                            "dth_reabertura_solicitacao"   => date("Y-m-d H:i:s")
                                         );
                            break;

                    case 'cancelar':                     

                            $data = array(
                                            "id_status_solicitacao"        => 300,
                                            "dth_cancelamento_solicitacao" => date("Y-m-d H:i:s")
                             );    
                            break;
                }  
            }    
        }

        /**
         * Insert ou Update
         */
        $id   = $this->MY_model->insertRow($data , $this->input->get_post( 'id' , true ));
        
        /**
         * Pra verificar se o formalario esta em modo de cadastro ou edição,  basta validar o hidden ID
         * esta NULL. Caso o hidden ID estiver vazio o formulario vai esta em modo de cadastro
         * To verify if the form is in register or edit mode, just validate the hidden ID is NULL. If the 
         * hidden ID is empty the form will be in registration mode
         */    
        if( $this->input->post('id') == NULL)
        {
            /**
             * --- FORMULARIO EM MODO DE CADASTRO --- FORM IN REGISTRATION MODE--- 
             *
             * Variavel auxiliar para criar sessao com mensagem de sucesso 
             * Help variable to create session with message success
             */
            $msg_flasdata = 'cadastro';
            
            /**
             * Definindo mensagem para registro do LOG
             * Setting message for LOG record
             */
            $msg_log      = 'Realizou novo cadastro. Controller: '.$this->modulo.'. ID --> '. $id;
        }
        else
        {
            /**
             * --- FORMULARIO EM MODO DE EDIÇÃO  --- FORM IN EDITING MODE --- 
             *
             * Variavel auxiliar para criar sessao com mensagem sucesso 
             * Help variable to create session with message success update
             */
            $msg_flasdata = 'alteracao'; 
            
            /**
             * Definindo mensagem para registro do LOG
             * Setting message for LOG record
             */
            $msg_log      = 'Realizou alteração de Registro. Controller: '.$this->modulo.'. ID --> '. $id;
        }

        /**
         * Gravando o Log de Atividade
         * Recording the Activity Log
         */
        $this->log_zata->log_activity($msg_log, $msg_flasdata);

        /**
         * [ $url ] Definimos o redirecionamento da aplicacao apos o processamento do registro,
         * essa informaçao vem dos botões de ação do formulario 
         * [ $url ] We define the redirection of the application after the registration processing,
         * this information comes from the action buttons of the form
         */
        switch ($this->input->post('acao'))
        {
            case 'salvar':                     
                    $link_url = $this->url.'/gerenciar_solicitacao_servico/'.$id;break;

            case 'concluir':                     
                    $link_url = '/solicitacao-servico/minhas-solicitacoes/eu-recebi/';break;

            case 'reabrir':                     
                    $link_url = '/solicitacao-servico/minhas-solicitacoes/eu-recebi/';break;

            case 'cancelar':                     
                    $link_url = '/solicitacao-servico/minhas-solicitacoes/eu-recebi/';break;                

            case 'alterar-problema-solicitacao-servico':                     
                    $link_url = $this->url.'/gerenciar_solicitacao_servico/'.$id;break;                       
            
        }

        /**
         * Finalizando sessao Aux usada para identidicar a solicitação de serviço quando o problema eh identificado errado
         * 
         */
        $this->session->unset_userdata('id_solicitacao_servico');

        /**
         * Criando sessao com mensagem UPDATE SUCESSO na operacao 
         * Creating session with message UPDATE SUCCESS in operation
         */
         $this->session->set_flashdata('msg', $msg_flasdata);
        
        /**
         * Redirecionando depois de finalizada o processamento   
         * Redirecting after processing is complete
         */
        redirect(base_url($link_url));
    } // Fim da Funcao - End of function

    /**
    * Salvar - To save
    *
    * Registrar o cadastro ou atualiza os registros no banco de dados, esses dados vem do formulario
    * Register the registry or update the records in the database, this data comes from the form
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @return  void
    */
    public function cancelar_solicitacao()
    {
        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Pega o identificador do registro que vai ser editado diretamente da URL
         * Get the identified from the record that will be edited directly from the URL
         */   
        $id = $this->uri->segment(4);

        /**
         * Verfica se exite e se a variavel capturada diretamente da URL é um numero, 
         * Se o paremetro nao estiver correto, ira redirecionar para a pagina de erro.
         * Check if it exists and if the variable captured directly from the URL is a number, 
         * If the parameter is not correct, it will redirect to the error page.
         */ 
        if(!$id)
        {
            /**
             * Regitrando o log do erro no banco de dados
             * Logging the error log to the database
             */ 
            $this->log_zata->log_error('Danger','Acesso indevido: Infra_solicitacao_servico->status_solicitacao() --> Parâmetro ID nao encontrado');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
        }
        else
        {
                                
                $data = array(
                    "id_status_solicitacao"        => 300,
                    "dth_cancelamento_solicitacao" => date("Y-m-d H:i:s")
                 );    
                

                /**
                 * Update
                 */
                 $id   = $this->MY_model->insertRow($data , $id);

                /**
                 *
                 * Variavel auxiliar para criar sessao com mensagem sucesso 
                 * Help variable to create session with message success update
                 */
                $msg_flasdata = 'alteracao'; 
                
                /**
                 * Definindo mensagem para registro do LOG
                 * Setting message for LOG record
                 */
                $msg_log      = 'Realizou alteração de Registro. Controller: '.$this->modulo.'. ID --> '. $id;

                /**
                 * Gravando o Log de Atividade
                 * Recording the Activity Log
                 */
                $this->log_zata->log_activity($msg_log, $msg_flasdata);

                /**
                 * Criando sessao com mensagem UPDATE SUCESSO na operacao 
                 * Creating session with message UPDATE SUCCESS in operation
                 */
                 $this->session->set_flashdata('msg', $msg_flasdata);

                /**
                 * Redirecionando depois de finalizada o processamento   
                 * Redirecting after processing is complete
                 */
                $link_url = '/solicitacao-servico/minhas-solicitacoes/eu-recebi/';

                redirect(base_url($link_url));
        }    

     
    } // Fim da Funcao - End of function



   /**
    * Excluir
    *
    * Excluir um registro
    * Delete a record
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    function excluir($id) 
    {
        /**
         * Verifica se o usuario tem permissao de acesso 
         * Checks whether the user has access permission
         */ 
        if($this->access['is_remove'] == 0)
        { 
            show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!","301","Sem permissão de acesso :[");
        }

        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */ 
        $this->log_zata->log_step_by_step();
        
        /**
         * Alterando status no registro
         * Changing status in the registry
         */
        if ($this->model->destroy($id) == TRUE)
        {
            /**
             * Gravando o Log de Atividade
             * Recording the Activity Log
             */
            $this->log_zata->log_activity('Realizou exclusão de Registro. Controller: '.$this->modulo.'. ID --> '. $id, 'Exclusao');
            
            /**
             * Mensagem - Exclusao realizada com sucesso 
             * Message - Deletion succeeded
             */
            $this->session->set_flashdata('msg', 'registro-excluido');

            /**
             * Redireciona para pagina de listagem
             * Redirects to listing page
             */
            redirect(base_url($this->url.'/listar'));
        }
        else
        {
            /**
             * Gravando o log do erro no banco de dados
             * Saving the error log to the database
             */
            $this->log_zata->log_error('Error', 'Falha ao excluir: Controller_default->excluir() --> Nao foi possivel excluir o registro '. $id);

            /** 
             * Mensagem - Erro ao excluir o registro
             * Message - Error deleting log
             */
            $this->session->set_flashdata('msg', 'falha-exclusao-registro');

            /**
             * Redireciona
             * Redirects
             */ 
            redirect(base_url($this->url.'/listar'));
        }
    }// Fim da Funcao - End of function

    /**
    * Gera Numero Ordem Servico
    *
    * Gerar sequncial do numero da ordem de servico 
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    function gera_numero_solicitacao_servico(){

        $num_ss = $this->model->buscar_num_ss();
        
        if ($num_ss == '')
        {
            $num_ss = 1;
        }
        else
        {
            $num_ss++;
        }

        return $num_ss;
        
    }

    /**
    * Buscar Prioridade da Solicitacao Servico
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    function buscar_prioridade_da_solicitacao_servico($problema){

        return $this->model->prioridade_solicitacao_servico($problema);
                
    }

    /**
    * Buscar Responsavel Tecnico da Solicitacao Servico
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    function buscar_responsavel_tecnico_da_solicitacao_servico($problema){

        return $this->model->retorna_responsavel_tecnico_solicitacao_servico($problema);
                
    }

    /**
    * Ajax_combo_subcategoria
    *
    * Retorna a lista de subcategorias de uma categoria de solicitacao de servico
    * 
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */ 
    public function ajax_combo_subcategoria($id_categoria){

        $lista_subcat = $this->Infra_sub_cat_solicitacao_servico_model->lista_subcategorias_solicitacao_servico($id_categoria);
            //Verifica se existe algum registro no banco de dados
        if ( empty ( $lista_subcat ) )
                //Deve retornar um array multidimencional pelo JSON, para que ele simule o mesmo tipo de retorno, quando existe registro, assim no formulario poderemos varrer o array e preencher com os registros ou a mensagem
            $lista_subcat =  array (
                array("desc_sub_cat_solicitacao_servico"=>"Nenhuma subcategoria encontrada")
            );

        echo json_encode($lista_subcat);

        return;
    }

    /**
    * Ajax combo problema subcategoria
    *
    * Retorna a lista de problemas da subcategorias de uma categoria de solicitacao de servico
    * 
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */ 
    public function ajax_combo_problemas_subcategoria($id_subcategoria){

        $lista_problema_subcat = $this->Infra_sub_cat_solicitacao_servico_model->problemas_subcategoria($id_subcategoria);
            //Verifica se existe algum registro no banco de dados
        if ( empty ( $lista_problema_subcat ) )
                //Deve retornar um array multidimencional pelo JSON, para que ele simule o mesmo tipo de retorno, quando existe registro, assim no formulario poderemos varrer o array e preencher com os registros ou a mensagem
            $lista_problema_subcat =  array (
                array("desc_problema_solicitacao_servico"=>"Nenhum problema encontrado")
            );

        echo json_encode($lista_problema_subcat);

        return;
    }


    
    /**
    * Buscar categoria pai
    *
    * Retorna a lista de categorias e subcategorias autorelacionadas
    * 
    * @param   $categoria - id_categoria de um problema 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */     
    public function buscar_categoria_pai($categoria){

        // Lista Primeira categoria ou subcategoria que o problema esta associado 
        $categoria = $this->Infra_cat_solicitacao_servico_model->cat_solicitacao_servico($categoria);
    
        /**
         * Irei montar um ARRAY Multidimencional para armazenar todo o autorelacionamento que envolve
         * categorias e subcategorias
         */ 
        $lista_cat[] = array($categoria->token_id => $categoria->desc_cat_solicitacao_servico);

            /*
             * Estou levendando em considecao de que o maximo de subcategeorias que uma
             *  Categoria PAI pode ter eh 20
             */
            for ($i = 1; $i <= 20; $i++) {

                // Se a coluna [token_id_cat_pai] estiver NULL, significa que nao tem nenhuma categoria acima
                if (is_null($categoria->token_id_cat_pai)) 
                {
                    // Adcionar o nome da categoria no ARRAY
                    $lista_cat[] = array($categoria->token_id => $categoria->desc_cat_solicitacao_servico);
                    
                    break;
                }
                else
                {
                    //Se tem categoria acima, iremos fazer a consulta novamente
                    $categoria = $this->Infra_cat_solicitacao_servico_model->cat_solicitacao_servico($categoria->token_id_cat_pai);
                    // Adcionar o nome da categoria no ARRAY
                    //$lista_cat[] = $categoria->desc_cat_solicitacao_servico;
                    $lista_cat[] = array($categoria->token_id => $categoria->desc_cat_solicitacao_servico);
            
                }
            } 

            /**
             * Remove o ultimo item do array, estou fazendo isso porque o item esta se repetindo
             */
            array_pop($lista_cat);

            /**
             * Ordena inversamente
             */
            krsort($lista_cat);

            //var_dump($lista_cat);

            // Retorna um array multidimencional com a lista de categorias e subcategorias
            return ($lista_cat);

    } // Fim da Funcao

    /**
    * Cadastrar - Add
    *
    * Metodo reponsavel por carregar a view de cadastro junto com suas dependencias
    * Method responsible for uploading the register view along with its dependencies
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */    
    public function cadastrar_tarefa()
    {

        /**
         * Verifica se o usuario tem permissao de acesso 
         * Checks whether the user has access permission
         *
        if($this->access['is_add'] == 0)
        { 
            show_error("Você não tem permissão para acessar esse conteúdo. Entre em contato com o administrador do sistema!","500","Sem permissão de acesso :(");
        }

        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['page_title'] = 'Solicitações de Serviço';

        /**
         * Titulo Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Tarefas';
        
        /**
         * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
         * Auxiliary variable for controller routes. Used only in form in edit mode
         */
        $page_data['url']           = $this->url;

        /**
         * Variavel auxiliar.  Usada somente no formulario em modo de edicao
         * Auxiliary Variable. Used only in form in edit mode
         */
        $page_data['show']          = '';

        /**
         * Configuracao do Formulario
         * Form Settings
         */ 
        $page_data['tableForm']     = $this->info['config']['form']; 

        /**
         * View de Local da ocorrencia do problema
         */
        $page_data['page']          = 'infra/infra_solicitacao_servico/tarefa_form';

        /**
         * Carregando dados para a view
         * Loading data for the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function

    /**
    * Salvar Tarefa - To save task
    *
    * Registrar o cadastro ou atualiza os registros no banco de dados, esses dados vem do formulario
    * Register the registry or update the records in the database, this data comes from the form
    *
    * @author  Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @return  void
    */
    public function salvar_tarefa()
    {
   

        //var_dump($_POST);
        //exit;

         /*  TRATANDO DATA DE INICIO DA TAREFA */
        //$aux_inicio_tarefa  = explode(" ", $this->input->post('dth_inicio_tarefa'));
        //Dia => $aux[0]  Mes => $aux[1] Ano => $aux[2] Hora => $aux[4]
        //$data_inicio_tarefa = $aux_inicio_tarefa[2].'-'.mostraMes_mysql($aux_inicio_tarefa[1]).'-'.$aux_inicio_tarefa[0];
        //$hora_inicio_tarefa = $aux_inicio_tarefa[4];

       
        /**********************************************************************************************  

        $data['repeticao_tarefa']         = $this->input->post('repeticao_tarefa');

        if ($data['repeticao_tarefa'] == 'nunca'){

        }

        if ($data['repeticao_tarefa'] == 'diaria'){

            $data['repetir_a_cada'] = $this->input->post('repetir_a_cada')[0];
            $data['repeticao_fim']  = $this->input->post('repeticao_fim')[0];
        
            if ($data['repeticao_fim'] == 'depois_de')
            {
                $data['num_ocorrencia_fim'] = $this->input->post('num_ocorrencia_fim')[0];
            }

            if ($data['repeticao_fim'] == 'na_data')
            {
                $data['dth_ocorrencia_fim'] = gravaData($this->input->post('dth_ocorrencia_fim')[0]);
            }

        }

        var_dump($data);exit;

        if ($repeticao_tarefa == 'semanal'){

        }

        if ($repeticao_tarefa == 'mensal'){

        }

        if ($repeticao_tarefa == 'anual'){

        }
*/


                





        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Nova solicitação de Serviço
         * 
         */

        $data = array(
                        "token_id_solicitacao_servico"  => $this->input->post('token_id_solicitacao_servico'),
                        "numero_tarefa"                 => $this->gera_numero_tarefa(),
                        "sit_status"                    => $this->input->post('sit_status'),
                        "desc_titulo"                   => $this->input->post('desc_titulo'),
                        "id_responsavel_tecnico"        => (int)$this->input->post('id_responsavel_tecnico'),
                        "desc_breve_tarefa"             => $this->input->post('desc_breve_tarefa'),
                        "id_solicitante"                => (int)$this->input->post('id_solicitante'),
                        "inicio_tarefa"                 => $this->input->post('inicio_tarefa'),
                    );
       

        // TRATANDO DATA DE ENTREGA DA TAREFA *      
        $aux_entrega_tarefa = explode(" ", $this->input->post('dth_entrega_deseja'));
        // Dia => $aux[0]  Mes => $aux[2] Ano => $aux[4] Hora => $aux[6]
        $data_entrega_tarefa = $aux_entrega_tarefa[2].'-'.mostraMes_mysql($aux_entrega_tarefa[1]).'-'.$aux_entrega_tarefa[0];
        $hora_entrega_tarefa = $aux_entrega_tarefa[4]; 
        // Data de entrega desejada da tarefa
        $data['dth_entrega_deseja'] =  $data_entrega_tarefa;
        // Hora de entrega desejada da tarefa 
        $data['hora_inicio_tarefa'] =  $hora_entrega_tarefa; 
        

        /**
         * Insert ou Update
         */
        $id   = $this->Infra_tarefas_model->insertRow($data , $this->input->get_post( 'id' , true ));
        
        /**
         * Pra verificar se o formalario esta em modo de cadastro ou edição,  basta validar o hidden ID
         * esta NULL. Caso o hidden ID estiver vazio o formulario vai esta em modo de cadastro
         * To verify if the form is in register or edit mode, just validate the hidden ID is NULL. If the 
         * hidden ID is empty the form will be in registration mode
         */    
        if( $this->input->post('id') == NULL)
        {
            /**
             * --- FORMULARIO EM MODO DE CADASTRO --- FORM IN REGISTRATION MODE--- 
             *
             * Variavel auxiliar para criar sessao com mensagem de sucesso 
             * Help variable to create session with message success
             */
            $msg_flasdata = 'cadastro';
            
            /**
             * Definindo mensagem para registro do LOG
             * Setting message for LOG record
             */
            $msg_log      = 'Realizou novo cadastro. Controller: '.$this->modulo.'. ID --> '. $id;
        }
        else
        {
            /**
             * --- FORMULARIO EM MODO DE EDIÇÃO  --- FORM IN EDITING MODE --- 
             *
             * Variavel auxiliar para criar sessao com mensagem sucesso 
             * Help variable to create session with message success update
             */
            $msg_flasdata = 'alteracao'; 
            
            /**
             * Definindo mensagem para registro do LOG
             * Setting message for LOG record
             */
            $msg_log      = 'Realizou alteração de Registro. Controller: '.$this->modulo.'. ID --> '. $id;
        }

        /**
         * Gravando o Log de Atividade
         * Recording the Activity Log
         */
        $this->log_zata->log_activity($msg_log, $msg_flasdata);

        /**
         * [ $url ] Definimos o redirecionamento da aplicacao apos o processamento do registro,
         * essa informaçao vem dos botões de ação do formulario 
         * [ $url ] We define the redirection of the application after the registration processing,
         * this information comes from the action buttons of the form
         */

        switch ($this->input->post('acao'))
        {
            case 'salvar':
                $link_url = $this->url.'infra_solicitacao_servico/cadastrar_tarefa/editar/'.$id; break;
            
            case 'salvar-e-novo':
                $link_url = $this->url.'infra_solicitacao_servico/cadastrar_tarefa/cadastrar'.$this->input->post('token_id_solicitacao_servico');  break;

            case 'salvar-e-fechar':
                $link_url = $this->url.'/gerenciar_solicitacao_servico/'.$this->input->post('token_id_solicitacao_servico');break;      
        }

        /**
         * Criando sessao com mensagem UPDATE SUCESSO na operacao 
         * Creating session with message UPDATE SUCCESS in operation
         */
         $this->session->set_flashdata('msg', $msg_flasdata);
        
        /**
         * Redirecionando depois de finalizada o processamento   
         * Redirecting after processing is complete
         */
        redirect(base_url($link_url));
    } // Fim da Funcao - End of function



    /**
    * Gera Codigo Tarefa
    *
    * Gerar sequncial do numero da ordem de servico 
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    function gera_numero_tarefa(){

        $num_tarefa = $this->model->buscar_num_tarefa();
        
        if ($num_tarefa == '')
        {
            $num_tarefa = 1;
        }
        else
        {
            $num_tarefa++;
        }

        return $num_tarefa;
        
    }

    
   

    



}//FIM DA CLASSE - END OF CLASS
