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
 * Copyright(c) 2015-2018, TRIVEE SERVICES IT
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
 * Class Categorias_solicitacao_servico 
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio. 
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Categorias_solicitacao_servico extends MY_Controller 
{
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $modulo  = 'categorias_solicitacao_servico';

    public $url     = 'solicitacao-servico';

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
        $this->load->model('zata/UserAccount_model');      
        $this->load->model('solicitacao_servico/Categorias_solicitacao_servico_model');
        $this->model = $this->Categorias_solicitacao_servico_model;

         
       
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
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = ' Categorias';

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']           = $this->url;

        /**
         * Resgatando a lista de registros 
         * Redeeming the list of records
         */
        $page_data['lista']         = $this->model->lista_categorias_solicitacao_servico(); 

        if (count($page_data['lista']) >= 1)
        {
            /**
             * View Empty
             */
            $page_data['page'] = 'solicitacao_servico/categorias_solicitacao_servico/main-list';
        }
        else
        {
            /**
             * View 
             */
            $page_data['page'] = 'solicitacao_servico/categorias_solicitacao_servico/index';
        } 

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
        $page_data['title_portlet'] = 'Cadastrar';
        
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
        //$page_data['tableForm']     = $this->info['config']['form']; 

        /**
         * Responsavel Tecnico
         * Technical manager
         */
        $page_data['lista_responsavel_tecnico']  = $this->UserAccount_model->listar_usuarios();

        /**
         * Categoria Pai
         * Category Parent
         */
        $page_data['id_cat_pai']  = null; 

        /**
         * View 
         */
        $page_data['page']          = 'solicitacao_servico/categorias_solicitacao_servico/form';
        
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
    public function editar()
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
                $this->log_zata->log_error('Error','Acesso invalido: Categorias_solicitacao_servico->editar() --> O registro nao foi encontrado no banco de dados. ');

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
                 * Titulo Portlet
                 * Portlet Title
                 */
                $page_data['title_portlet'] = 'Editar';

                /**
                 * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
                 * Auxiliary variable for controller routes. Used only in form in edit mode
                 */
                $page_data['url']                = $this->url;

                /**  SESSAO AUXILIAR PARA UPLOAD DE IMAGEM   **/
                /**
                 * token 
                 */
                $page_data['token_id'] =  $page_data['show']->token_id ;
    
                /**
                 * Tabela 
                 */
                $page_data['tabela_db'] = $this->info ['tabela_db'];

                /**
                 * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
                 * Auxiliary variable for controller routes. Used only in form in edit mode
                 */

                //Coloquei essa variavel dentro do form.php
                $page_data['url_redirect_aux']   = 'solicitacao-servico/'.$this->uri->segment(2).'/editar/'.$id;

                /**
                 * Buscar miniatura de imagem do upload
                 * Search upload image thumbnail
                 */
                // Se existe ja existe alguma imagem, ira exibi-la na miniatura
                if ($page_data['show']->file_name_miniature != ''){
                    // atributo src <img>
                    $page_data['src'] = 'files/uploads/images/'.$page_data['show']->file_name_miniature;
                }
                //Se nao houver vai mostrar no-image
                else{
                    // atributo src <img>
                    $page_data['src'] = 'assets/zata/no-image.png';
                }

                /**  FIM SESSAO AUXILIAR PARA UPLOAD DE IMAGEM   **/ 

                /**
                 * Configuracao do Formulario
                 * Form Settings
                 */ 
                $page_data['tableForm']     = $this->info['config']['form']; 

                /**  
                 * Variavel Auxiliar para validar que o formulario esta no modo de Edição
                 * Help variable to validate that the form is in Edit mode
                 */ 
                $page_data['form_editar']  = true;

                /**
                 * Responsavel Tecnico
                 * Technical manager
                 */
                $page_data['lista_responsavel_tecnico']  = $this->UserAccount_model->listar_usuarios();
            
                /**
                 * Subcategorias de solicitação de serviço
                 * Service Request Subcategories
                 */
                $page_data['lista_subcategorias']         = $this->model->lista_subcategorias_solicitacao_servico($id);

                /**
                 * Busca os problemas da subcategoria
                 * Search for subcategory issues
                 */
               $page_data['problemas']  = $this->model->problemas_subcategoria( $page_data['show']->token_id);

                /**
                 * Prioridade
                 * Priority
                 */
                $page_data['prioridade']  =  $this->db->get('aux_prioridade')->result();

                /**
                 * Variavel auxiliar do Botao Excluir no formulario de edição
                 * Help variable Delete in the edit form
                 */
                $page_data['btExcluir']     = 'solicitacao_servico/categorias_solicitacao_servico/excluir/'.$id;

                /**
                 * Categoria Pai
                 * Category Parent
                 */
                $page_data['id_cat_pai']  = null; 

                /**
                 * View 
                 */
                $page_data['page']          = 'solicitacao_servico/categorias_solicitacao_servico/form';

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
         * Responsável por validar os dados vindos do formulario pelo POST 
         * Responsible for validating the data coming from the form by the POST
         */
        $data = array(
            "desc_cat_solicitacao_servico"   => $this->input->post('desc_cat_solicitacao_servico'),
            "id_responsavel_tecnico"         => (int)$this->input->post('id_responsavel_tecnico'),
        ); 

        /**
         * Verifica o status do registro - ATIVO / INATIVO 
         * Checks the status of the record - ACTIVE / INACTIVE
         */
        $this->input->post('sit_ativo') == 'on' ? $data['sit_ativo'] = 'S' : $data['sit_ativo'] = 'N';

        /**
         * Verifica se existe subcategoria - ATIVO / INATIVO 
         * Check for subcategory - ACTIVE / INACTIVE
         */
        $this->input->post('sit_possui_subcategoria') == 'on' ? $data['sit_possui_subcategoria'] = 'S' : $data['sit_possui_subcategoria'] = null;

        /**
         * Define se existe uma categoria pai
         * Defines whether a parent category exists
         */
        $data['token_id_cat_pai'] = $this->input->post('id_cat_pai') == null ? null : $this->input->post('id_cat_pai');
        
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
        if ($this->input->post('id_cat_pai') != null)
        {
            /**
             * Informações da Categoria ou Subcategoria pai, para determinar o redirecionamento das acoes dos botoes do formulario
             * Category Information or Parent Subcategory to determine the redirection of form button actions
             */
            $sql_cat_pai   = "SELECT * FROM ss_cat_solicitacao_servico WHERE token_id = '".$this->input->post('id_cat_pai')."'";
            $query_cat_pai = $this->db->query($sql_cat_pai);
            $row_cat_pai   = $query_cat_pai->row();

            //var_dump($sql_cat_pai);

            /*
            * Subcategoria PAI
            * subcategory Parent
            */
            switch ($this->input->post('acao'))
            {
                case 'salvar':
                    $link_url = $this->url.'/subcategoria/editar/'.$id; break;
                
                case 'salvar-e-novo':
                    $link_url = $this->url.'/subcategoria/cadastrar/'.$this->input->post('id_cat_pai');    break;

                case 'salvar-e-fechar':

                    if ($row_cat_pai->token_id_cat_pai != null)
                    {
                        $link_url = $this->url.'/subcategoria/editar/'.$row_cat_pai->token_id; break;   
                    }
                    else
                    {
                        $link_url = $this->url.'/categoria/editar/'.$row_cat_pai->token_id; break;   
                    }

            }
        }
        else
        {
            /*
            * Categoria PAI
            * Category Parent
            */
            switch ($this->input->post('acao'))
            {
                case 'salvar':
                      $link_url = $this->url.'/'.$this->input->post('tipo_cat').'/editar/'.$id; break;
                
                case 'salvar-e-novo':
                     $link_url = $this->url.'/'.$this->input->post('tipo_cat').'/cadastrar';    break;

                case 'salvar-e-fechar':
                     $link_url = $this->url.'/'.$this->input->post('tipo_cat').'/listar';       break;        
            }
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
         * Informações da Subcategoria ou da categoria que ira ser excluida
         * Subcategory or category information to be excluded
         */
        $sql = "SELECT * FROM ss_cat_solicitacao_servico WHERE token_id = '$id'";
        $query = $this->db->query($sql);
        $row = $query->row();


            /**
             * Verifindo se existe uma categoria ou subcategoria pai acima dela
             * Checking if there is a parent category or subcategory above it
             */
            $sql_cat_pai   = "SELECT * FROM ss_cat_solicitacao_servico WHERE token_id = '$row->token_id_cat_pai'";
            $query_cat_pai = $this->db->query($sql_cat_pai);
            $row_cat_pai = $query_cat_pai->row();

            /**
             * Se nao houver resultado, vai excluir a categoria e redirecionar para a listagem
             * If there is no result, you will delete the category and redirect to the listing
             */
            if ($row_cat_pai != null)
            {
                

                /**
                 * Se o campo id_cat pai foi igual a NULL, entao assume que o regsitro eh uma subcategoria e sera redirecionado para 
                 * a listagem de subcategorias da categoria pai
                 * If the field id_cat parent was equal to NULL, then assume that the record is a subcategory and will be redirected
                 * to the listing of subcategories of the parent category
                 */
                if ( $row_cat_pai->token_id_cat_pai == null )
                {
                    $link_url = base_url().'solicitacao-servico/categoria/editar/'.$row_cat_pai->token_id; 
                }
                else
                {
                     /**
                      * Se o campo id_cat pai foi diferente a NULL, entao assume que o regsitro eh uma subcategoria e sera
                      * redirecionado para a listagem de subcategorias da subcategoria pai
                      * If the parent id_cat field was other than NULL, then assume that the record is a subcategory and will be
                      * redirected to the subcategory listing of the parent subcategory
                      */
                     $link_url = base_url().'solicitacao-servico/subcategoria/editar/'.$row_cat_pai->token_id; 
                }

            }
            else
            {
                $link_url = base_url().'solicitacao-servico/categoria/listar';   
            }    

        
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
            redirect($link_url);
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
            redirect(base_url('solicitacao-servico/categoria/listar'));
        }
    }// Fim da Funcao - End of function

    /**
     * Adicionar Problema
     *
     * Adicionar problema em uma subcategoria de solicitacao de servico 
     * Essa funcao somente eh usando com AJAX
     * 
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function adicionarProblema(){

        $data = array(
            'token_id_cat_solicitacao_servico'   => $this->input->post('token_id_cat_solicitacao_servico'),
            'desc_problema_solicitacao_servico'  => $this->input->post('descProblema'),
            'token_id'                           => $this->better_token(),
            'id_prioridade'                      => $this->input->post('id_prioridade'),
            'dth_criacao'                        => date('Y-m-d H:i:s'),
            'id_usuario_criacao'                 => $this->session->userdata('id_usuario'),
            'dth_atualizacao'                    => date('Y-m-d H:i:s'),
            'id_usuario_atualizacao'             => $this->session->userdata('id_usuario')
            ); 

        if( $this->db->insert('ss_problema_solicitacao_servico', $data) == true)
        {
            echo json_encode(array('result'=> true));
        }
        else
        {
            echo json_encode(array('result'=> false));
        }

   }// Fim da Funcao - End of function


   /**
     * Excluir Problema
     *
     * Exclui um problema da subcategoria 
     * Essa funcao somente eh usando com AJAX
     * 
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    function excluirProblema(){

            /**
             * Id do problema que sera excluido da subcategoria
             */
            $id = $this->input->post('idProblema');
            
            $this->db->where('id_problema_solicitacao_servico',$id);

            /**
             * Excluindo 
             */
            if($this->db->delete('ss_problema_solicitacao_servico') == true)
            {
                echo json_encode(array('result'=> true));
            }
            else
            {
                echo json_encode(array('result'=> false));
            }
        }// Fim da Funcao - End of function


}//FIM DA CLASSE - END OF CLASS
