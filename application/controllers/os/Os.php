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
 * Class Os 
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio. 
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Os extends MY_Controller 
{
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $modulo  = 'os';

    public $url     = 'servicos/ordem-de-servico';

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
        $this->load->model('os/Os_model');
        $this->model = $this->Os_model;

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
        //if($this->access['is_list'] == 0)
       // { 
          // show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!","301","Sem permissão de acesso :[");
       //}

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Ordem de serviço';

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']           = $this->url;

        /**
         * Configuracao do Grid
         * Grid Configuration
         */
        $page_data['tableGrid']     = $this->info['config']['grid'];

        /**
         * Resgatando a lista de registros 
         * Redeeming the list of records
         */
        $page_data['lista']         = $this->model->getAll($this->info['config']['sql_select']); 

        /**
         * View 
         */
        $page_data['page']          = 'os/main-list';

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
        //if($this->access['is_add'] == 0)
        //{ 
           // show_error("Você não tem permissão para acessar esse conteúdo. Entre em contato com o administrador do sistema!","500","Sem permissão de acesso :(");
       // }

        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();
        
        /**
         * Titulo Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Dados da ordem de serviço';
        
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


        $page_data['itens_os_servico'] = array('');

        /**
         * Garantia
         *
         */
        $page_data['tempo_garantia'] = array( 
            "1" => "30 Dias",
            "2" => "3 Meses",
            "3" => "6 Meses",
            "4" => "1 Ano",
            "5" => "Não tem Garantia"
            );

        
        /**
         * View 
         */
        $page_data['page']          = 'os/form';
        
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
        //if($this->access['is_edit'] == 0)
        //{ 
        //    show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!","301","Sem permissão de acesso :[");
       // }

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
            $this->log_zata->log_error('Danger','Acesso indevido: OS->editar() --> Parâmetro ID nao numerico');

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
                 * Busca o nome do cliente
                 * Search for the client's name
                 */
                $page_data['nome_cliente']  = $this->model->nome_cliente( $page_data['show']->id_cf);


                /**
                 * Busca informacoes do cliente - Resumo da OS
                 * Search for customer informations of - Summary OS
                 */
                $query = $this->db->select('*');
                $query = $this->db->where('id_cf', $page_data['show']->id_cf);
                $query = $this->db->get('cli_cliente_fornecedor');
                $page_data['cliente'] = $query->row();
                 /**
                 * Titulo Portlet
                 * Portlet Title
                 */
                 $page_data['title_portlet'] = 'Editar ' . $this->info ['config']['titulo_modulo'];

                /**
                 * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
                 * Auxiliary variable for controller routes. Used only in form in edit mode
                 */
                $page_data['url']           = $this->url;

                 /**
                 * Garantia
                 *
                 */
                 $page_data['tempo_garantia'] = array(            
                    "1" => "30 Dias",
                    "2" => "3 Meses",
                    "3" => "6 Meses",
                    "4" => "1 Ano",
                    "5" => "Não tem Garantia"
                    );

                /**
                 * Busca os itens de serviço da OS
                 */

                $page_data['itens_os_servico']  = $this->model->itens_os_servico( $page_data['show']->id_os);

                /**
                 * Busca os itens de produtos da OS
                 */

                $page_data['itens_os_produto']  = $this->model->itens_os_produto( $page_data['show']->id_os);


                /**
                 * Variavel Auxiliar para validar que o formulario esta no modo de Edição
                 * Help variable to validate that the form is in Edit mode
                 */ 
                $page_data['form_editar']  = true;

                /**
                 * Variavel auxiliar do Botao Excluir no formulario de edição
                 * Help variable Delete in the edit form
                 */
                $page_data['btExcluir']     = $this->url.'/excluir/'.$id;

                /**
                 * View 
                 */
                $page_data['page']          = 'os/form';

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
            "id_os"                          => (int)$this->input->post('id'),
            "tipo_os"                        => $this->input->post('tipo_os'),
            "dth_abertura_os"                => gravaData($this->input->post('dth_abertura_os')),
            "numero_os"                      => $this->gera_numero_ordem_servico($this->input->post('numero_os_2')),
            "descricao"                      => $this->input->post('descricao'),
            "referencia"                     => $this->input->post('referencia'),
            "id_cf"                          => (int)$this->input->post('id_cf'),
            "tecnico"                        => $this->input->post('tecnico'),
            "desc_problema_defeito"          => $this->input->post('desc_problema_defeito'),
            "laudo_tecnico"                  => $this->input->post('laudo_tecnico'),
            "observacoes"                    => $this->input->post('observacoes'),
            "observacoes_internas"           => $this->input->post('observacoes_internas'),
            "dth_realizacao"                 => gravaData($this->input->post('dth_realizacao')),
            "hora_realizacao"                => ($this->input->post('hora_realizacao') == '') ? null : $this->input->post('hora_realizacao'),
            "dth_conclusao_os"               => gravaData($this->input->post('dth_conclusao_os')),
            "garantia"                       => $this->input->post('garantia')

            ); 

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
            $link_url = $this->url.'/editar/'.$id; break;
            
            case 'salvar-e-novo':
            $link_url = $this->url.'/cadastrar';    break;

            case 'salvar-e-fechar':
            $link_url = $this->url.'/listar';       break;        
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
   public function excluir($id) 
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
    function gera_numero_ordem_servico($numero_os){

        if( $numero_os == '')
        {
            $num_os = $this->model->buscar_num_os();
            
            if ($num_os == '')
            {
                $num_os = 1;
            }
            else
            {
                $num_os++;
            }

            return $num_os;
        }
        else
        {
            return $numero_os;
        }     
    }


    /**
    * Auto Complete Cliente
    *
    * Buscar nome do cliente 
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    public function auto_complete_cliente(){

        /**
         * GET['term'] - string de busca
         */
        if (isset($_GET['term']))
        {
            $q = strtolower($_GET['term']);
            
            $this->model->buscar_cliente_autocomplete($q);
        }

    }

    /**
    * Auto Complete Serviço
    *
    * Buscar Serviço 
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    public function auto_complete_servico(){

        /**
         * GET['term'] - string de busca
         */
        if (isset($_GET['term']))
        {
            $q = strtolower($_GET['term']);
            
            $this->model->buscar_servico_autocomplete($q);
        }

    }

    /**
    * Auto Complete Produto
    *
    * Buscar Produto 
    * 
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    public function auto_complete_produto(){

        /**
         * GET['term'] - string de busca
         */
        if (isset($_GET['term']))
        {
            $q = strtolower($_GET['term']);
            
            $this->model->buscar_produto_autocomplete($q);
        }

    }

    
    /**
     * Adicionar Servico
     *
     * Adicionar servicos a uma ordem de servico 
     * 
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function adicionarServico(){

        $data = array(
            'id_os'                  => $this->input->post('idOsServico'),
            'id_proser'              => $this->input->post('idServico'),
            'qtd'                    => $this->input->post('qtd'),
            'valor_unit'             => $this->input->post('precoServico'),
            'valor_total'            => $this->input->post('valor_total_servico'),
            'tipo'                   => 'S',
            'dth_criacao'            => date('Y-m-d H:i:s'),
            'id_usuario_criacao'     => $this->session->userdata('id_usuario'),
            'dth_atualizacao'        => date('Y-m-d H:i:s'),
            'id_usuario_atualizacao' => $this->session->userdata('id_usuario')
            ); 

        if( $this->db->insert('os_itens_proser', $data) == true){

            echo json_encode(array('result'=> true));
        }else{
            echo json_encode(array('result'=> false));
        }

    }

    /**
     * Adicionar Produto
     *
     * Adicionar protudos a uma ordem de servico 
     * 
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function adicionarProduto(){

        $data = array(
            'id_os'                  => $this->input->post('idOsServico'),
            'id_proser'              => $this->input->post('idProduto'),
            'qtd'                    => $this->input->post('qtdProduto'),
            'valor_unit'             => $this->input->post('precoProduto'),
            'valor_total'            => $this->input->post('valor_total_produto'),
            'tipo'                   => 'P',
            'dth_criacao'            => date('Y-m-d H:i:s'),
            'id_usuario_criacao'     => $this->session->userdata('id_usuario'),
            'dth_atualizacao'        => date('Y-m-d H:i:s'),
            'id_usuario_atualizacao' => $this->session->userdata('id_usuario')
            ); 

        if( $this->db->insert('os_itens_proser', $data) == true){

            echo json_encode(array('result'=> true));
        }else{
            echo json_encode(array('result'=> false));
        }

    }

    

    

    /**
     * Excluir Servico
     *
     * Exclui um servico da ordem de servico 
     * Essa funcao somente eh usando com AJAX
     * 
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    function excluirServico(){

            /**
             * Id do servico que sera excluido da ordem de servico
             */
            $id = $this->input->post('idServico');
            
            $this->db->where('id_proser_os',$id);

            /**
             * Excluido 
             */
            if($this->db->delete('os_itens_proser') == true){

                echo json_encode(array('result'=> true));
            }
            else{
                echo json_encode(array('result'=> false));
            }
        }



    /**
     * Excluir Produto
     *
     * Exclui um produto da ordem de servico 
     * Essa funcao somente eh usando com AJAX
     * 
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    function excluirProduto(){

            /**
             * Id do produto que sera excluido da ordem de servico
             */
            $id = $this->input->post('idProduto');
            
            $this->db->where('id_proser_os',$id);

            /**
             * Excluido 
             */
            if($this->db->delete('os_itens_proser') == true){

                echo json_encode(array('result'=> true));
            }
            else{
                echo json_encode(array('result'=> false));
            }
        }




}//FIM DA CLASSE - END OF CLASS
