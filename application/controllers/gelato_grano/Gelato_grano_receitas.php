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
 * Class Gelato_grano_receitas 
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio. 
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Gelato_grano_receitas extends MY_Controller 
{
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $modulo  = 'gelato_grano_receitas';

    public $url     = 'receitas-de-gelato';

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
        $this->load->model('gelato_grano/Gelato_grano_receitas_model');
        $this->model = $this->Gelato_grano_receitas_model;
       
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


    /*
        $receitas = $this->db->get('gelato_grano_receitas');

        foreach ($receitas->result() as $key) {

           // $data['token_id']       = $this->better_token();
            $data['token_company']    = '260635a09da31c7fd54.08270071';

            $this->db->where( array( 'id_receita' => $key->id_receita ));

             $this->db->update( 'gelato_grano_receitas' , $data );
            ;
        }

        echo 'FIM';exit;


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
        $page_data['title_portlet'] = 'Receitas de Gelato';

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
         * Resgatando a lista de receitas 
         * Redeeming the list of recipes
         */
        $page_data['lista'] = $this->model->listar_receitas(); 

        if (count($page_data['lista']) >= 1)
        {
            /**
             * View Empty
             */
            $page_data['page']          = 'gelato_grano/gelato_grano_receitas/main-list';
        }
        else
        {
            /**
             * View 
             */
            $page_data['page']              = 'gelato_grano/gelato_grano_receitas/index';
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
         * Titulo Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Cadastrar Receita de Gelato ';
        
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
         * Listar categorias de gelato
         * List categories of gelato 
         */ 
        $page_data['categoria_gelato'] = $this->model->listar_categorias(); 

        $page_data['ingredientes_gelato']  = array('');
        
        /**
         * View 
         */
        $page_data['page']          = 'gelato_grano/gelato_grano_receitas/form';
        
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
        $id = $this->uri->segment(3); 

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
            $this->log_zata->log_error('Danger','Acesso indevido: Gelato_grano_receitas->editar() --> Parâmetro ID nao numerico');

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
                $this->log_zata->log_error('Error','Acesso invalido: Gelato_grano_receitas->editar() --> O registro nao foi encontrado no banco de dados. ');

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
                 * Titulo Portlet
                 * Portlet Title
                 */
                $page_data['title_portlet'] = 'Editar Receita de Gelato';
               
                /**
                 * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
                 * Auxiliary variable for controller routes. Used only in form in edit mode
                 */
                $page_data['url']           = $this->url;

                /**
                 * Configuracao do Formulario
                 * Form Settings
                 */ 
                $page_data['tableForm']     = $this->info['config']['form'];

                /**  SESSAO AUXILIAR PARA UPLOAD DE IMAGEM   **/
                /**
                 * token 
                 */
                $page_data['token_id'] =  $page_data['show']->token_id ;
    
                /**
                 * Tabela 
                 */
                $page_data['tabela_db'] = $this->info ['config']['tabela_db'];

                /**
                 * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
                 * Auxiliary variable for controller routes. Used only in form in edit mode
                 */
                $page_data['url_redirect_aux']   = $this->url.'/editar/'.$id.'#tab_1_3';

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
                 * Origem do produto
                 * Product Origin 
                 */ 
                $page_data['categoria_gelato'] = $this->model->listar_categorias(); 

                /**
                 * 
                 *  
                 */
                $id_receita = (int)$page_data['show']->id_receita;

                $page_data['ingredientes_gelato'] = $this->model->listar_ingredientes($id_receita);

                /**
                 * View 
                 */
                $page_data['page']          = 'gelato_grano/gelato_grano_receitas/form';

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
            "token_id"                 => $this->input->post('id'),
            "nome_receita"             => $this->input->post('nome_receita'),
            "base_receita"             => $this->input->post('base_receita'),
            "modo_preparo"             => $this->input->post('modo_preparo'),
            "id_categoria_gelato"      => $this->input->post('id_categoria_gelato')
        );
 
        /**
         * Verifica o status do registro - ATIVO / INATIVO 
         * Checks the status of the record - ACTIVE / INACTIVE
         */
        $this->input->post('sit_ativo') == 'on' ? $data['sit_ativo'] = 'S' : $data['sit_ativo'] = 'N';

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
            $this->log_zata->log_error('Error', 'Falha ao excluir: Gelato_grano_receitas->excluir() --> Nao foi possivel excluir o registro '. $id);

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
     * Adicionar Ingrediente
     *
     * Adicionar Ingrediente a uma receita 
     * 
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function adicionarIngrediente(){

        /**
         * Verifica se o usuario tem permissao de acesso 
         * Checks whether the user has access permission
         */ 
        if($this->access['is_add'] == 0)
        { 
            show_error("Você não tem permissão para acessar esse conteúdo. Entre em contato com o administrador do sistema!","500","Sem permissão de acesso :(");
        }

        $data = array(
            'id_receita'             => $this->input->post('id'),
            'id_produto'             => $this->input->post('idProduto'),
            'nome_item'              => $this->input->post('nome_item'),
            'codigo'                 => $this->input->post('codigo'),
            'quantidade'             => peso_ajuste($this->input->post('peso')),
            'dth_criacao'            => date('Y-m-d H:i:s'),
            'id_usuario_criacao'     => $this->session->userdata('id_usuario'),
            'dth_atualizacao'        => date('Y-m-d H:i:s'),
            'id_usuario_atualizacao' => $this->session->userdata('id_usuario')
        ); 

        if( $this->db->insert('gelato_grano_item_receitas', $data) == true){

            $this->session->set_flashdata('msg', 'cadastro');

            redirect(base_url('receitas-de-gelato/editar/'.$this->input->post('receita').'#tab_1_2'));
            
        }else{

            $this->session->set_flashdata('msg', 'falha-exclusao-registro');

             redirect(base_url('receitas-de-gelato/editar/'.$this->input->post('receita').'#tab_1_2'));

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
    function excluirIngrediente($id,$idReceita){

        /**
         * Verifica se o usuario tem permissao de acesso 
         * Checks whether the user has access permission
         */ 
        if($this->access['is_remove'] == 0)
        { 
            show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!","301","Sem permissão de acesso :[");
        }
            
            $this->db->where('id_item_receita',$id);

            /**
             * Excluido 
             */
            if($this->db->delete('gelato_grano_item_receitas') == true){
                
                 redirect(base_url('receitas-de-gelato/editar/'.$idReceita.'#tab_1_2'));
            }
            else{
                redirect(base_url('receitas-de-gelato/editar/'.$idReceita.'#tab_1_2'));
            }
    }


}//FIM DA CLASSE - END OF CLASS
