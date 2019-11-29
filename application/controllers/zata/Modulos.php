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
 * Class Modulos 
 *
 * É responsável pela grande parte das funcionalidades de criacao e manutencao da ferramenta de automacao ZATA. 
 * It is responsible for most of the creation and maintenance of the ZATA automation tool. 
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Modulos extends MY_Controller {
    
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $url     = 'zata/modulos';

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
        $this->load->model('zata/Modulos_model');
        $this->model = $this->Modulos_model;

        $this->load->dbforge();
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
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']              = $this->url;
        
        /**
         * Resgatando a lista de registros 
         * Redeeming the list of records
         */
        $sql = 'SELECT * FROM zata_modulos ORDER BY nome_modulo'; 
        $page_data['lista']            = $this->model->getAll($sql);  
        
        /**
         * View 
         */
        $page_data['page']             = 'zata/modulos/main-list';
        
        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function

    /**
     * Criar Novo Modulo
     *
     * Metodo reponsavel por carregar o formulario de criacao de novo modulo junto com suas dependencias basicas
     * Method responsible for loading the form of creation of a new module together with its basic dependencies
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */    
    public function criar()
    {
        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */
        $this->log_zata->log_step_by_step();

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']              = $this->url;

        /**
         * Combobox - Tabelas do Banco de Dados 
         * Combobox - Database Tables
         */
        $page_data['tabelas']          = $this->db->list_tables();

		/**
         * Variavel auxiliar no combox de tabelas
         * Help variable in table combox
         */
        $page_data['select']           = '';

         /**
         * Informacoes do usuario e permissoes de acesso 
         * User information and access permissions
         * 
         * Nota: Essa variavel somente sera usada no metodo construir()
         * Note: This variable will only be used in the construir() method
         */
        $page_data['access']           = array();      
        

        /**
         * View 
         */ 
        $page_data['page']             = 'zata/modulos/form';
        
        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    }// Fim da Funcao - End of function

     
    /**
     * Save Create
     * 
     * Metodo reponsavel por cadastrar um novo modulo
     * Method responsible for registering a new module
     *
     * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @internal A variavel $json_data[], contem todas as informacoes que vao ser criptografadas antes de ser armazenada no banco de dados
     * @internal The variable $ json_data [], contains all the information that will be encrypted before being stored in the database 
     */    
    public function save_create()
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */ 
        $this->log_zata->log_step_by_step();

        /** 
         * Recebendo dados do formulario
         * Receiving Form Data
         */
        $json_data['nome_modulo']       = $this->input->post('nome_modulo');
        $json_data['titulo_modulo']     = $this->input->post('titulo_modulo');
        $json_data['desc_modulo']       = $this->input->post('desc_modulo');
        $json_data['nome_controller']   = $this->input->post('nome_controller');     
        $json_data['tabela_db']         = $this->input->post('tabela_db');
        $json_data['Pkey_tabela_db']    = $this->procurar_primary_key($this->input->post('tabela_db'));
        $json_data['sql_select']        = $this->input->post('sql_select');
        $json_data['token_id']          = $this->better_token();
        $json_data['token_comapny']     = $this->session->userdata('token_company');



		         /** 
		         * Verificando se a tabela existe no banco de dados
		         * Verifying that the table exists in the database
		         */
		        if ($this->db->table_exists($json_data['tabela_db'] ))
		        {
		            /** 
		             * Verificando se as colunas [token_id], [token_company],[id_usuario_criacao], [dth_criacao], [id_usuario_atualizacao],
		             * [id_usuario_atualizacao], [dth_atualizacao], [sit_ativo] existem na tebela, caso contrario ira criar essas colunas
		             * Checking whether the columns [user_user_creation], [dth_creation], [update_user_id],
		             * [Id_user_add], [dth_update], [sit_active] exist in the tab, otherwise it will create these columns
		             */
                    if (!$this->db->field_exists('token_id', $json_data['tabela_db']))
                    {
                        
                        $fields = array('token_id' => array('type' => 'VARCHAR', 'constraint' => '32'));

                        $this->dbforge->add_column($json_data['tabela_db'], $fields);     
                    } 

                    if (!$this->db->field_exists('token_company', $json_data['tabela_db']))
                    {
                        
                        $fields = array('token_company' => array('type' => 'VARCHAR', 'constraint' => '32'));

                        $this->dbforge->add_column($json_data['tabela_db'], $fields);     
                    } 
		            if (!$this->db->field_exists('id_usuario_criacao', $json_data['tabela_db']))
		            {

		                $fields = array('id_usuario_criacao' => array('type' => 'INT', 'constraint' => '11'));
		                
		                $this->dbforge->add_column($json_data['tabela_db'], $fields);              
		            }

		             if (!$this->db->field_exists('dth_criacao', $json_data['tabela_db']))
		            {
		               
		                $fields = array('dth_criacao' => array('type' => 'DATETIME'));
		                
		                $this->dbforge->add_column($json_data['tabela_db'], $fields);     
		            }

		             if (!$this->db->field_exists('id_usuario_atualizacao', $json_data['tabela_db']))
		            {
		                
		                $fields = array('id_usuario_atualizacao' => array('type' => 'INT', 'constraint' => '11'));

		                $this->dbforge->add_column($json_data['tabela_db'], $fields);       
		            }

		             if (!$this->db->field_exists('dth_atualizacao', $json_data['tabela_db']))
		            {
		               
		                $fields = array('dth_atualizacao' => array('type' => 'DATETIME'));

		                $this->dbforge->add_column($json_data['tabela_db'], $fields);                   
		            }

		            if (!$this->db->field_exists('sit_ativo', $json_data['tabela_db']))
                    {
                        
                        $fields = array('sit_ativo' => array('type' => 'CHAR', 'constraint' => '1'));

                        $this->dbforge->add_column($json_data['tabela_db'], $fields);     
                    }

		        }
		        else
		        {

		            /**
		             * Regitrando o log do erro no banco de dados 
		             * Inserts the error log into the database
		             */
		            $this->log_zata->log_error('ERROR',': Falha na aplicacao: Modulos->save_create() --> Tabela nao encontrada no banco de dados');

		            /**
		             * Redirecionando para pagina de erro padrao
		             * Redirecting to standard error page
		             */
		            show_error("O nome da tabela informada nao foi encontrada no banco de dados!","404","Acesso indevido :[");

		        }

        /** 
         * Definindo variavel como array 
         * Defining array variable
         */  
        $columns = array();
        
        /** 
         * Buscando informacoes na tabela e retornando os valores das colunas na variavel 
         * Searching for information in the table and returning the values of the columns in the variable
         */    
        $columns = $this->db->query("SHOW COLUMNS FROM ".$this->input->post('tabela_db'))->result();
       
        /** 
         * iterando o array das informacoes de cada coluna
         * Iterating the information array of each column
         */   
        foreach($columns as $column)
        {

        	/** 
         	 * Verifica se a coluna eh chave primaria, se for, ira definir o tipo como HIDDEN
         	 * Checks whether the column is primary key, if it is, will define the type as HIDDEN
         	 */ 
            if($column->Key == 'PRI') $column->Type = 'hidden';     
              
                /** 
         	 	 * Define a configuracao da coluna no GRID
         	 	 * Sets the column configuration in GRID
         	 	 */ 
            	$rowGrid[] = $this->configGrid($column->Field, $column->Field, $column->Type);
            	/** 
         	 	 * Define a configuracao da coluna no formulario
         	 	 * Sets the column configuration in the form
         	 	 */
            	$rowForm[] = $this->configForm($column->Field, $column->Field, $column->Type);   
                          
        }
        
        $json_data['grid']           = $rowGrid;

        $json_data['form']           = $rowForm;
       
        /** 
         * Estruturando os dados para serem inseridos no banco de dados
         * Structuring the data to be inserted into the database
         */
        $dados = array(
            "nome_modulo"            => $json_data['nome_modulo'],
            "desc_modulo"            => $json_data['desc_modulo'],
            "nome_controller"        => ucfirst(strtolower($json_data['nome_controller'])),
            "tabela_db"              => $json_data['tabela_db'],
            "key_tabela_db"          => $json_data['Pkey_tabela_db'],
            "config_modulo"          => SiteHelpers::GM_encode_json($json_data),
            /** 
         	 * Default
         	 */
            "token_id"               => $json_data['token_id'],
            "token_company"          => $json_data['token_comapny'],
            "dth_criacao"            => date('Y-m-d H:i:s'),
            "id_usuario_criacao"     => $this->session->userdata('id_usuario'),
            "dth_atualizacao"        => date('Y-m-d H:i:s'),
            "id_usuario_atualizacao" => $this->session->userdata('id_usuario')
        ); 

        
        /** 
         * Inserindo no banco de dados
         * Insert into the database
         */  
        $this->db->insert('zata_modulos',$dados);

        /** 
         * Id do novo modulo
         * Id of the new module
         * Retorna o TokenID apartir do ID real
         */
        $id = $this->db->insert_id(); 
        $id = $this->model->getRowPrimaryKey($id);
        $id = $id->token_id;
         
        /** 
         * Criando sessao com mensagem SUCESSO na operacao 
         * Creating session with message SUCCESS in operation
         */           
        $this->session->set_flashdata('msg', 'cadastro');
        
        /** 
         * Redirecionando depois de finalizada o processamento  
         * Redirecting after processing is complete
         */         
        redirect(base_url('zata/modulos/reconstruir/'.$id)); 

    }// Fim da Funcao - End of function
    

    /**
     * Construir - Build
     * 
     * Metodo reponsavel criar e os arquivos do novo modulo (Controller, Model, Views)
     * Method responsible to create and the files of the new module (Controller, Model, Views)
     *
     * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @internal A variavel $json_data[], contem todas as informacoes que vao ser criptografadas antes de ser armazenada no banco de dados
     * @internal The variable $ json_data [], contains all the information that will be encrypted before being stored in the database 
     */    
     function construir( $id = 0)
     {


        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */ 
        $this->log_zata->log_step_by_step();
        
        /** 
         * Pega o ID do registro que esta sendo gerenciado diretamente da URL
         * Get the ID of the record being managed directly from the URL
         */ 
        $id = $this->uri->segment(4);

        /** 
         * Verfica se exite e se o ID capturado eh um numero, se nao estiver correto, ira redirecionar para a pagina de erro.
         * Check if it exists and if the captured ID is a number, if it is not correct, it will redirect to the error page. 
         */ 
        if(!$id){

            /**
             * Regitrando o log do erro no banco de dados 
             * Inserts the error log into the database
             */
            $this->log_zata->log_error('Danger','Acesso indevido: Modulos->construir() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
            
        }
        else // Se o ID for um numero - If the ID is a number
        {
            /**
             * Verificamos se o ID nao existe no banco de dados
             * We checked that the ID does not exist in the database
             */
            if (!$this->Modulos_model->getRow($id))
            {
                /**
                 * Regitrando o log do erro no banco de dados 
                 * Inserts the error log into the database
                 */
                $this->log_zata->log_error('Error','Acesso invalido: Modulos->construir() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");

            }
            else // se o ID existir no banco de dados - If the ID exists in the database
            {
                
                /**
                 * Carregar as infomações do modulo na variavel $show
                 * Load the module information into the $show variable
                 */
                $page_data['show']          = $this->Modulos_model->getRow($id);
               
                /**
                 * Combobox - Tabelas do Banco de Dados 
                 * Combobox - Database Tables
                 */
                $page_data['tabelas']       = $this->db->list_tables();

                /**
                 * Variavel auxiliar para rotas do controller
                 * Auxiliary variable for controller routes
                 */
                $page_data['url']           = $this->url;

                /**
                 * Descriptografando as configurações do módulo
                 * Decrypting Module Settings
                 */
                $config                     = SiteHelpers::GM_decode_json( $page_data['show']->config_modulo);

                /**
                 * Titulo do Portlet
                 * Portlet Title
                 */
                $page_data['titulo_modulo'] = $config['titulo_modulo']; 

                /**
                 * SQL Select 
                 */
                $page_data['sql_select']    = $config['sql_select']; 

                /**
                 * Campos que compõem o GRID
                 * Fields that compose the GRID
                 */
                $page_data['fields_grid']   = $config['grid'];

                /**
                 * Campos que compõem o formulario
                 * Fields that compose the form
                 */
                $page_data['fields_form']   = $config['form'];

                /**
                 * Permissoes basicas de acesso de usuario
                 * Basic user access permissions
                 */
                $tasks = array(
                               'is_list'          => 'Listar',
                               'is_add'           => 'Cadastrar ',
                               'is_edit'          => 'Editar ',
                               'is_remove'        => 'Excluir '    
                                ); 

                $page_data['tasks'] = $tasks;                          

                /**
                 * Lista de usuarios que podem receber permissoes de acesso
                 * List of users who can receive access permissions
                 */
                $page_data['usuarios']   =   $this->db->get('usu_usuario')->result();


                $access = array();

                /**
                 * Buscando permissoes de acessos dos usuarios
                 * List of users who can receive access permissions
                 */    
                foreach($page_data['usuarios'] as $r)        
                {

                    $usuario = ($r->id_usuario !=null ? "and id_usuario ='".$r->id_usuario."'" : "" );

                    $GA = $this->db->query("SELECT * FROM usu_usuario_access where id_modulo ='".$page_data['show']->token_id."' $usuario")->row();

                    if(is_countable($GA) >=1 ){
                        $GA = $GA;
                    }
                    
                    $access_data = (isset($GA->access_data) ? json_decode($GA->access_data,true) : array());
                     
                    $rows = array();

                    $rows['id_usuario'] = $r->id_usuario;

                    $rows['nome_usuario'] = $r->nome;
  
                    foreach($tasks as $item => $val)
                    {
                        $rows[$item] = (isset($access_data[$item]) && $access_data[$item] ==1  ? 1 : 0);
                    }

                    $access[$r->nome] = $rows;
                    
                
                }
                
                /**
                 * Informacoes do usuario e permissoes de acesso
                 * User information, module and access permissions
                 */
                $page_data['access']  = $access;      

                /**
                 * Informacoes do usuario, modulo e permissoes de acesso
                 * User information, module and access permissions
                 */
                $page_data['usuarios_access'] =$this->db->query("select * from usu_usuario_access where id_modulo ='".$page_data['show']->id_modulo."'")->result();

                /**
                 * Combobox - Configuracaoes do campo. Editar o tipo 
                 * Combobox - Field settings. Edit type
                 */
                $page_data['field_type_opt']   = array(
                                                        'text'              => 'Text' ,
                                                        'text_date'         => 'Date',
                                                        'text_datetime'     => 'Date & Time',
                                                        'textarea'          => 'Textarea',
                                                        'textarea_editor'   => 'Textarea With Editor ',
                                                        'select'            => 'Select Option',
                                                        'radio'             => 'Radio' ,
                                                        'checkbox'          => 'Checkbox',
                                                        'file'              => 'Upload File',            
                                                        'hidden'            => 'Hidden'
                                                       );


                /**
                 * Variavel Auxiliar utilizada para validar se o formulario esta no modo de edição
                 * Help variable used to validate if the form is in edit mode
                 */
                $page_data['form_editar'] = true;

                /**
                 * View 
                 */
                $page_data['page']             = 'zata/modulos/form';

                /**
                 * Carregando tudo na view
                 * Loading everything on the view
                 */
                $this->load->view('tpl/main', $page_data);
            }

        } 





    } // Fim da Funcao - End of function


    /**
     * Reconstruir - rebuild
     * 
     * Metodo reponsavel criar e os arquivos do novo modulo (Controller, Model, Views)
     * Method responsible to create and the files of the new module (Controller, Model, Views)
     *
     * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @internal A variavel $json_data[], contem todas as informacoes que vao ser criptografadas antes de ser armazenada no banco de dados
     * @internal The variable $ json_data [], contains all the information that will be encrypted before being stored in the database 
     */    
     function reconstruir( $id = 0)
     {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */ 
        $this->log_zata->log_step_by_step();
        
        /** 
         * Pega o ID do registro que esta sendo gerenciado diretamente da URL
         * Get the ID of the record being managed directly from the URL
         */ 
        $id = $this->uri->segment(4);

        /** 
         * Verfica se exite e se o ID capturado eh um numero, se nao estiver correto, ira redirecionar para a pagina de erro.
         * Check if it exists and if the captured ID is a number, if it is not correct, it will redirect to the error page. 
         */ 
        if(!$id){

            /**
             * Regitrando o log do erro no banco de dados 
             * Inserts the error log into the database
             */
            $this->log_zata->log_error('Danger','Acesso indevido: Modulos->reconstruir() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
            
        }
        else // Se o ID for um numero - If the ID is a number
        {
            /**
             * Verificamos se o ID nao existe no banco de dados
             * We checked that the ID does not exist in the database
             */
            if (!$this->Modulos_model->getRow($id))
            {
                /**
                 * Regitrando o log do erro no banco de dados 
                 * Inserts the error log into the database
                 */
                $this->log_zata->log_error('Error','Acesso invalido: Modulos->construir() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");

            }
            else // se o ID existir no banco de dados - If the ID exists in the database
            {
                
                /**
                 * Carregar as infomações do modulo na variavel $show
                 * Load the module information into the $show variable
                 */
                $page_data['show']          = $this->Modulos_model->getRow($id);

                /**
                 * Descriptografando as configurações do módulo
                 * Decrypting Module Settings
                 */
                $config                     = SiteHelpers::GM_decode_json( $page_data['show']->config_modulo);

                $row                      = $page_data['show'] ;

                $class                    = ucfirst($row->nome_controller);

                $module = ($row->nome_controller);
                
                $folder_view = strtolower($row->nome_controller);  

                $req = ''; 

                $fields = '';            
                
                $codes = array(
                    'controller'        => ucwords($class),
                    'url_modulo'        => strtolower($class),
                    'class'             => $class,
                    'folder_view'       => $folder_view,
                    'fields'            => $fields,
                    'required'          => $req,
                    'table'             => $row->tabela_db ,
                    'title'             => $row->nome_modulo ,
                    'note'              => $row->desc_modulo ,
                    'key'               => $row->key_tabela_db,
                    'sql_select'        => $config['sql_select']
                );

                $codes['form_entry'] = SiteHelpers::toForm($config['form']);
                $codes['grid_entry'] = SiteHelpers::toGrid($config['grid']);

               	$controller = file_get_contents('application/views/zata/modulos/template/code_dinamic/controller.tpl');
                $model      = file_get_contents('application/views/zata/modulos/template/code_dinamic/model.tpl');

                if($this->input->get('a') =='e')
                {
                	$grid       = file_get_contents('application/views/zata/modulos/template/code_static/main-list.tpl');
                	$form       = file_get_contents('application/views/zata/modulos/template/code_static/form.tpl');

                }else{

                	$grid       = file_get_contents('application/views/zata/modulos/template/code_dinamic/main-list.tpl');
                	$form       = file_get_contents('application/views/zata/modulos/template/code_dinamic/form.tpl');

                }

                $build_controller = $this->blend($controller,$codes);       
                $build_model      = $this->blend($model,$codes);
                $build_grid       = $this->blend($grid,$codes);     
                $build_form       = $this->blend($form,$codes);


                if(!is_dir("application/views/{$folder_view}"))
                {

                       mkdir( "application/views/{$folder_view}" ,0777 );            
                
                }     

                if($this->input->get('rebuild') != '')
                {

                    // rebuild spesific files
                    if($this->input->get('c') =='y')
                    {
                    
                            file_put_contents( "application/controllers/{$class}.php" , $build_controller) ;   
                            
                    }
                    
                    if($this->input->get('m') =='y')
                    {
                    
                        file_put_contents(  "application/models/{$class}_model.php" , $build_model) ;
                            
                    }    
                        
                    if($this->input->get('g') =='y'){
                    
                            file_put_contents(  "application/views/{$class}/main-list.php" , $build_grid) ;
                    
                    }    
                               
                    if($this->input->get('f') =='y')
                    {

                        file_put_contents(  "application/views/{$class}/form.php" , $build_form) ;
                    }
                    
                }
                else
                {

                    file_put_contents("application/controllers/{$class}.php",  $build_controller);  
                    file_put_contents("application/models/{$class}_model.php", $build_model);
                    file_put_contents("application/views/{$class}/main-list.php", $build_grid);
                    file_put_contents("application/views/{$class}/form.php", $build_form);        

                } 

                /**
                 * Redirecionando depois de finalizada o processamento   
                 * Redirecting after processing is complete
                 */
                redirect(base_url('zata/modulos/construir/'. $id));
              
            }

        } 

    }

    function dobuild ($id){

        $a = $_POST['tipoArquivo'];
        $c = (isset($_POST['controller']) ? 'y' : 'n');
        $m = (isset($_POST['model']) ? 'y' : 'n');
        $g = (isset($_POST['grid']) ? 'y' : 'n');
        $f = (isset($_POST['form']) ? 'y' : 'n');
     
        $url ='zata/modulos/reconstruir/'.$id."?rebuild=y&a={$a}&c={$c}&m={$m}&g={$g}&f={$f}";
        
        redirect(base_url($url)); 
    }


    /**
     * Save Sql
     * 
     * Responsavel por salvar as alteracoes da consulta SQL do Grid 
     * Responsible for saving changes to the Grid SQL query
     *
     * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */     
    function save_sql()
    {

        /** 
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */ 
        $this->log_zata->log_step_by_step();

        /** 
         * Pega o ID do registro que esta sendo gerenciado diretamente da URL
         * Get the ID of the record being managed directly from the URL
         */ 
        $id = $this->uri->segment(4);

        /**
         * Verfica se exite e se a variavel capturada diretamente da URL é um numero, 
         * Se o paremetro nao estiver correto, ira redirecionar para a pagina de erro.
         * Check if it exists and if the variable captured directly from the URL is a number, 
         * If the parameter is not correct, it will redirect to the error page.
         */
        if(!$id){

            /**
             * Regitrando o log do erro no banco de dados
             * Logging the error log to the database
             */ 
            $this->log_zata->log_error('Danger','Acesso indevido: Modulos->save_sql() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
            
        }
        else // Se o ID for um numero - If the ID is a number
        {
      
            /**
             * Verificamos se ele existe no banco de dados
             * Checked whether it exists in the database
             */
            if (!$this->Modulos_model->getRow($id))
            {

                /**
                 * Gravando o Log do erro no banco de dados
                 * Writing the Error Log to the Database
                 */
                $this->log_zata->log_error('Error','Acesso invalido: Modulos->save_sql() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */ 
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");

            }
            else
            {
                /*
                 * se existir, vamos salvar a nova SQL Select
                 * If it exists, we will save the new SQL Select
                 */
                $select     = $this->input->post( 'sql_select', true);

                /*
                 * Carregar as infomações do registro na variavel show
                 * Load the registry information in the variable show
                 */
                $page_data['show']          = $this->model->getRow($id);
               
                /** 
                 * Carregar as configuracoes do modulo
                 * Load module settings
                 */ 
                $config     = SiteHelpers::GM_decode_json( $row->config_modulo );

                /** 
                 * Remover o select antigo
                 * Remove the old select
                 */ 
                unset($config["sql_select"]); 

                /** 
                 * Inserir o novo Select
                 * Insert the new Select
                 */ 
                $new_config = array( "sql_select" => $select );

                /** 
                 * Mesclar os arrays
                 * Merge the arrays
                 */ 
                $config     = array_merge($config,$new_config); 

                /** 
                 * Definir qual módulo sofrerá às alterações
                 * Define which module will undergo changes
                 */ 
                $this->db->where( array( 'id_modulo'=> $row->id_modulo ));

                /** 
                 * Realizar a atualização do registro
                 * Perform the registry update
                 */ 
                $this->db->update('zata_modulos', array('config_modulo' => SiteHelpers::GM_encode_json($config)));

                /**
                 * Criando sessao com mensagem UPDATE SUCESSO na operacao 
                 * Creating session with message UPDATE SUCCESS in operation
                 */
                $this->session->set_flashdata('msg', 'alteracao');
                
                /**
                 * Redirecionando depois de finalizada o processamento   
                 * Redirecting after processing is complete
                 */ 
                redirect(base_url('zata/modulos/construir/'.$id.'#tab_1_2')); 
            }

        } 
    }// Fim da Funcao - End Function


 /**
     * Save Sql
     * 
     * Responsavel por salvar as alteracoes do GRIG 
     * Responsible for saving changes to the Grid
     *
     * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */     
     function save_grid()
    {

        /**
         * Responsável por registrar o acesso do usuario no metodo do controller 
         * Responsible for registering user access in controller method
         */ 
        $this->log_zata->log_step_by_step();

        // Pega o identificado do registro que vai ser editado diretamente da URL
        $id = $this->uri->segment(4);

        /**
         * Verfica se exite e se a variavel capturada diretamente da URL é um numero, 
         * Se o paremetro nao estiver correto, ira redirecionar para a pagina de erro.
         * Check if it exists and if the variable captured directly from the URL is a number, 
         * If the parameter is not correct, it will redirect to the error page.
         */ 
        if(!$id){

            /**
             * Regitrando o log do erro no banco de dados
             * Logging the error log to the database
             */ 
            $this->log_zata->log_error('Danger','Acesso indevido: Modulos->save_sql() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
            
        }
        else // Se o ID for um numero - If the ID is a number
        {
      
            /**
             * Verificamos se ele existe no banco de dados
             * Checked whether it exists in the database
             */
            if (!$this->Modulos_model->getRow($id))
            {

                /**
                 * Gravando o Log do erro no banco de dados
                 * Writing the Error Log to the Database
                 */
                $this->log_zata->log_error('Error','Acesso invalido: Modulos->save_grid() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");

            }
            else
            {
                
                /**
                 * se existir vai carregar as infomações do registro na variavel $row
                 * If it exists it will load the registry information in the variable $row
                 */
                $row        = $this->Modulos_model->getRow($id);
               
                /**
                 * Descriptografando as configurações do módulo
                 * Decrypting Module Settings
                 */
                $config     = SiteHelpers::GM_decode_json( $row->config_modulo);

                /**
                 * $grid vai receberar as alteracoes no grid
                 * $grid will receive the changes on the grid
                 */
                $grid       = array();

                /**
                 * Total de campos 
                 * Total fields
                 */
                $total      = count($_POST['field']);

                /**
                 * Extraindo POST
                 * Extracting POST
                 */
                extract($_POST);

                /**
                 * Estruturando a configuracao dos campos na alteracao do Grid
                 * Structuring the configuration of fields in Grid change
                 */
                for($i = 1; $i <= $total ;$i++) {    

                    $grid[] = array(
                                    "field"      => $field[$i],
                                    "alias"      => $alias[$i],
                                    "type"       => $type[$i],
                                    "label"      => $label[$i],
                                    "download"   => (isset($download[$i]) ? 1 : 0 ) ,
                                    "show"       => (isset($show[$i]) ? 1 : 0 ) ,
                                    'hidden'     => (isset($hidden[$i]) ? 1 : 0 )                   
                                    );
                }

                /** 
                 * Remover o GRID antigo
                 * Remove the old GRID
                 */ 
                unset($config["grid"]);

                /** 
                 * Mesclar os arrays
                 * Merge the arrays
                 */ 
                $new_config  = array_merge($config,array("grid" => $grid));

                /** 
                 * Realizar a criptografia do registro
                 * Perform registry encryption
                 */ 
                $data['config_modulo'] = SiteHelpers::GM_encode_json($new_config);

                /** 
                 * Definir qual módulo sofrerá às alterações
                 * Define which module will undergo changes
                 */ 
                $this->db->where( array( 'id_modulo'=> $row->id_modulo ));

                /** 
                 * Realizar a atualização do registro
                 * Perform the registry update
                 */ 
                $this->db->update('zata_modulos', array('config_modulo' => SiteHelpers::GM_encode_json($new_config)));

                /**
                 * Criando sessao com mensagem UPDATE SUCESSO na operacao 
                 * Creating session with message UPDATE SUCCESS in operation
                 */
                $this->session->set_flashdata('msg', 'alteracao');
                
                /**
                 * Redirecionando depois de finalizada o processamento   
                 * Redirecting after processing is complete
                 */
                redirect(base_url('zata/modulos/construir/'.$id.'#tab_1_3')); 
            }

        } 
    }// Fim da Funcao - End function


   /**
    * Save Form
    * 
    * Responsavel por salvar as alteracoes do FORM
    * Responsible for saving FORM changes
    *
    * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */  
    function save_form()
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
        if(!$id){

            /**
             * Regitrando o log do erro no banco de dados
             * Logging the error log to the database
             */  
            $this->log_zata->log_error('Danger','Acesso indevido: Modulos->save_form() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
            
        }
        else // Se o ID for um numero - If the ID is a number
        {
      
            /**
             * Verificamos se ele existe no banco de dados
             * Checked whether it exists in the database
             */
            if (!$this->Modulos_model->getRow($id))
            {

                /**
                 * Gravando o Log do erro no banco de dados
                 * Writing the Error Log to the Database
                 */
                $this->log_zata->log_error('Error','Acesso invalido: Modulos->save_form() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */ 
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");

            }
            else
            {
                
                /*
                 * se existir vai carregar as infomações do registro na variavel row
                 * If it exists it will load the registry information in the variable row
                 */
                $row        = $this->model->getRow($id);
               
                /**
                 * Descriptografando as configurações do módulo
                 * Decrypting Module Settings
                 */
                $config     = SiteHelpers::GM_decode_json( $row->config_modulo);

                /**
                 * $form vai receberar as alteracoes no formulario
                 * $form will receive the changes on the form
                 */
                $form       = array();

                /**
                 * Total de campos 
                 * Total fields
                 */
                $total      = count($_POST['field']);

                /**
                 * Extraindo POST
                 * Extracting POST
                 */
                extract($_POST);

                /**
                 * Estruturando a configuracao dos campos na alteracao do formulario
                 * Structuring the configuration of fields in Form change
                 */
                for($i = 1; $i <= $total ;$i++) {    

                    $form[] = array(
                                    "field"        => $field[$i],
                                    "alias"        => $alias[$i],
                                    "type"         => $type[$i],
                                    "label"        => $label[$i],
                                    "show"         => (isset($show[$i]) ? 1 : 0 ) ,
                                    'required'     => (isset($required[$i]) ? $required[$i] : 0 ),                 
                                    );
                    
                }

                /** 
                 * Remover o Formulario antigo
                 * Remove the old Form
                 */ 
                unset($config["form"]);

                /** 
                 * Mesclar os arrays
                 * Merge the arrays
                 */ 
                $new_config            = array_merge($config,array("form" => $form));

                /** 
                 * Realizar a criptografia do registro
                 * Perform registry encryption
                 */ 
                $data['config_modulo'] = SiteHelpers::GM_encode_json($new_config);

                /** 
                 * Definir qual módulo sofrerá às alterações
                 * Define which module will undergo changes
                 */ 
                $this->db->where( array( 'id_modulo'=> $row->id_modulo ));

                /** 
                 * Realizar a atualização do registro
                 * Perform the registry update
                 */ 
                $this->db->update('zata_modulos', array('config_modulo' => SiteHelpers::GM_encode_json($new_config)));

                /**
                 * Criando sessao com mensagem UPDATE SUCESSO na operacao 
                 * Creating session with message UPDATE SUCCESS in operation
                 */
                $this->session->set_flashdata('msg', 'alteracao');
                
                /**
                 * Redirecionando depois de finalizada o processamento   
                 * Redirecting after processing is complete
                 */  
                redirect(base_url('zata/modulos/construir/'.$id.'#tab_1_4')); 
            }

        }

    }// Fim da Funcao - End function 


   /**
    * Save Field
    * 
    * Responsavel por salvar as alteracoes de um Field
    * Method responsible to create and the files of the new module (Controller, Model, Views)
    *
    * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */  
    function save_field()
    {

        // Responsável por registrar o acesso do usuario no metodo do controller 
        $this->log_zata->log_step_by_step();

        // Pega o identificado do registro que vai ser editado diretamente da URL
        $id = $this->uri->segment(4);

        /* Verfica se exite e se a variavel capturada diretamente da URL eh um numero, 
         * Se o paremetro nao estiver correto, ira redirecionar para a pagina de erro. 
         */ 
        if(!$id){

            // Regitrando o log do erro no banco de dados 
            //$this->log_zata->log_error('Danger','Acesso indevido: Modulos->save_sql() --> Parâmetro ID nao numerico');

            // Redirecionando para pagina de erro padrao
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
            
        }
        else // Estando o parametro CORRETO
        {
      
            // Verificamos se ele existe no banco de dados
            if (!$this->Modulos_model->getRow($id))
            {

                // Gravando o Log do erro no banco de dados
                //$this->log_zata->log_error('Error','Acesso invalido: Modulos->save_form() --> O registro nao foi encontrado no banco de dados. ');

                // Redirecionando para pagina de erro padrao
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");

            
}            else
            {
                
                // Carregar as infomações do modulo na variavel row
                $row        = $this->Modulos_model->getRow($id);
               
                // Configuracoes do Modulo
                $config     = SiteHelpers::GM_decode_json( $row->config_modulo);
            

                $new_field = array(
                                "field"        => $this->input->post('field'),
                                "alias"        => $this->input->post('alias'),
                                "type"         => $this->input->post('type'),
                                "label"        => $this->input->post('label'),
                                "show"         => $this->input->post('show'),
                                'required'     => $this->input->post('required')                 
                                );
                
            

                /** 
                 * Remover o Formulario antigo
                 * Remove the old Form
                 */ 
                unset($config["form"]);

                /** 
                 * Mesclar os arrays
                 * Merge the arrays
                 */ 
                $new_config            = array_merge($config,array("form" => $form));

                /** 
                 * Realizar a criptografia do registro
                 * Perform registry encryption
                 */ 
                $data['config_modulo'] = SiteHelpers::GM_encode_json($new_config);

                /** 
                 * Definir qual módulo sofrerá às alterações
                 * Define which module will undergo changes
                 */ 
                $this->db->where( array( 'id_modulo'=> $row->id_modulo ));

                /** 
                 * Realizar a atualização do registro
                 * Perform the registry update
                 */ 
                $this->db->update('zata_modulos', array('config_modulo' => SiteHelpers::GM_encode_json($new_config)));

                /**
                 * Criando sessao com mensagem UPDATE SUCESSO na operacao 
                 * Creating session with message UPDATE SUCCESS in operation
                 */
                $this->session->set_flashdata('msg', 'alteracao');
                
                /**
                 * Redirecionando depois de finalizada o processamento   
                 * Redirecting after processing is complete
                 */  
                redirect(base_url('zata/modulos/construir/'.$id.'#tab_1_4')); 
            }

        } 
    }// Fim da Funcao - End Function


    /**
    * Save Permission
    * 
    * Responsavel por salvar as permissoes basicas (CRUD) de usuarios ao acessar o modulo
    * Responsible for saving the basic permissions (CRUD) of users when accessing the module
    *
    * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */  
    function save_permission()
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
        if(!$id){

            /**
             * Regitrando o log do erro no banco de dados
             * Logging the error log to the database
             */  
            $this->log_zata->log_error('Danger','Acesso indevido: Modulos->save_permission() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!","404","Acesso indevido :[");
            
        }
        else // Se o ID for um numero - If the ID is a number
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
                $this->log_zata->log_error('Error','Acesso invalido: Modulos->save_permission() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */ 
                show_error("O registro solicitado nao foi encontrado!","404","Acesso invalido :[");

            }
            else
            {
                

                /**
                 * Permissoes basicas de acesso de usuario
                 * Basic user access permissions
                 */
                $tasks = array(
                               'is_list'          => 'Listar',
                               'is_add'           => 'Cadastrar ',
                               'is_edit'          => 'Editar ',
                               'is_remove'        => 'Excluir '    
                                );                 

                $permission = array();

                /**
                 * Apagar permissões anteriores
                 * Delete previous permissions
                 */    
                $this->db->where('id_modulo',$id);
                $this->db->delete('usu_usuario_access');  

                /**
                 * Inserir novas permissões
                 * Insert new permissions
                 */ 
                $usuarioID = $this->input->post('id_usuario');

                for( $i = 0; $i < count($usuarioID); $i++)  
                {
                     
                    $id_usuario = $usuarioID[$i];

                    $arr = array();

                    $idUser = $usuarioID[$i];

                    foreach($tasks as $t=>$v)            
                    {
                        $arr[$t] = (isset($_POST[$t][$idUser]) ? "1" : "0" );
                    
                    }

                    $permissions = json_encode($arr); 
                    
                    $data = array
                    (
                        "access_data"    => $permissions,
                        "id_modulo"      => $id,                
                        "id_usuario"     => $usuarioID[$i],
                    );


                    $this->db->insert('usu_usuario_access',$data);    
                }

                /**
                 * Criando sessao com mensagem UPDATE SUCESSO na operacao 
                 * Creating session with message UPDATE SUCCESS in operation
                 */
                $this->session->set_flashdata('msg', 'alteracao');
                
                /**
                 * Redirecionando depois de finalizada o processamento   
                 * Redirecting after processing is complete
                 */  
                redirect(base_url('zata/modulos/construir/'.$id.'#tab_1_5')); 
            }

        }

    }// Fim da Funcao - End function 


   
   /**
    * Procurar Primary Key
    *
    * Retornar o nome da chave primaria de um tabela
    * Return the primary key name of a table
    *
    * @author Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @param  $table
    * @return $primaryKey
    */    
    function procurar_primary_key( $table = '')
    {
        $query      = "SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'";
        
        $primaryKey = '';
        
 
        $row        = $this->db->query("SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'")->row();
        
        if(empty($row))
        {
            $primaryKey = $row->Column_name;
        }

        return  $primaryKey;

    } // Fim da Funcao - End Function

 
   /**
    * Blend
    *
    * Responsavel por substituir as variaveis do arquivo template
    * Responsible for replacing template file variables
    *
    * @author Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @param  $str
    * @param  $data
    * @return $res
    */  
    public static function blend($str,$data) 
    {

        $src = $rep = array();
        
        foreach($data as $k=>$v)
        {
            $src[] = "{".$k."}";

            $rep[] = $v;
        }
        
        if(is_array($str))
        {
            foreach($str as $st )
            {
                $res[] = trim(str_ireplace($src,$rep,$st));
            }
        }
        else
        {
            $res = str_ireplace($src,$rep,$str);
        }
        
        return $res;   

    }// Fim da Funcao - End Function

  
   /**
    * Config Grid
    *
    * Retorna as configuracao de um campo no grid
    * Returns the configuration of a field in the grid
    *
    * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @param $field
    * @param $alias
    * @param $type
    * @return $grid
    */  
    function configGrid ( $field , $alias, $type) {

        $grid = array ( 
                        "field"        => $field,
                        "alias"        => $alias,
                        "type"         => $type,
                        "label"        => ucwords(str_replace('_',' ',$field)),
                        "download"     => '1' ,
                        "show"         => '1' ,
                        'hidden'       => '0',                       
                    );

        return $grid;
    
    }    
 
   /**
    * Config Form
    *
    * Retorna as configuracao de um campo no formulario
    * Returns the configuration of a field in the form
    *
    * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @param $field
    * @param $alias
    * @param $type
    * @return $grid
    */  
    function configForm ( $field , $alias, $type) {

        $form = array ( 
                        "field"        => $field,
                        "alias"        => $alias,
                        "type"         => self::configFieldType($type),
                        "label"        => ucwords(str_replace('_',' ',$field)),
                        'show'         => '1',
                        'required'     => '0'                                        
                    );

        return $form;
    
    }  

   /**
    * Config Field Type
    *
    * Responsavel por definir os campos no fomulario de acordo com o tipo do dado na tabela no banco de dados
    * Responsible for defining the fields in the form according to the type of data in the table in the database
    *
    * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @param $type
    * @return $type
    */   
    function configFieldType( $type )
    {
        switch($type)
        {
            default:          $type = 'text';          break;
            case 'timestamp'; $type = 'text_datetime'; break;
            case 'datetime';  $type = 'text_datetime'; break;
            case 'string';    $type = 'text';          break;
            case 'int';       $type = 'text';          break;
            case 'text';      $type = 'textarea';      break;
            case 'blob';      $type = 'textarea';      break;
            case 'select';    $type = 'select';        break;
        }
        return $type;
    
    }

    /**
    * jsonFieldsTable
    *
    * Retorna os campos de uma tabela em JSON 
    * Returns the fields of a table in JSON
    *
    * @author   Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @param $tabela_db
    */ 
    // Função para retornar os campos de uma tabela em JSON 
    public function jsonFieldsTable($tabela_db){

        $listaFields = $this->db->query("SHOW COLUMNS FROM ".$tabela_db)->result();

        if ( empty ( $listaFields ) )
            //Deve retornar um array multidimencional pelo JSON, para que ele simule o mesmo tipo de retorno, quando existe registro, assim no formulario poderemos varrer o array e preencher com os registros ou a mensagem
            $listaFields =  array (
                                        array("Field"=>"Nenhuma Unidade encontrada")
                                     );

        echo json_encode($listaFields);

        return;

    }


}//FIM DA CLASSE
