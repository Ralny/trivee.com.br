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

defined('BASEPATH') or exit('Não é permitido acesso direto ao script');

/**
 * Class Eventos_reserva_evento
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio.
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Eventos_reserva_evento extends MY_Controller
{
    /**
     * Definir variaveis auxiliares
     * Define auxiliary variables
     */
    public $modulo  = 'eventos_reserva_evento';

    public $url     = 'eventos/reserva-de-evento';

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
         * Verificando se existe usuario logado
         * Checking if a user is logged in
         */
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
        
        /**
         * Carregando Model
         * Loading Model
         */
        $this->load->model('zata/UserAccount_model');
        $this->load->model('clientes_fornecedores/Clientesfornecedores_model');
        $this->load->model('eventos/Eventos_salas_model');
        $this->load->model('eventos/Eventos_formato_de_salas_model');
        $this->load->model('eventos/Eventos_utilizacao_de_sala_model');
        $this->load->model('eventos/Eventos_equipamentos_model');
        $this->load->model('eventos/Eventos_reserva_evento_model');
        $this->model = $this->Eventos_reserva_evento_model;

       
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
        if ($this->access['is_list'] == 0) {
            show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!", "301", "Sem permissão de acesso :[");
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
        $page_data['page_title'] = 'Eventos / Orçamentos';

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Reserva de evento';

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
        $page_data['lista']         = $this->model->lista_reservas_de_eventos();

        if (empty($page_data['lista'])) {
            /**
            * View Empty
            */
            $page_data['page'] = 'eventos/reserva_evento/index';
        } else {
            /**
            * View
            */
            $page_data['page'] = 'eventos/reserva_evento/main-list';
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
        if ($this->access['is_add'] == 0) {
            show_error("Você não tem permissão para acessar esse conteúdo. Entre em contato com o administrador do sistema!", "500", "Sem permissão de acesso :(");
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
        $page_data['page_title'] = 'Eventos / Orçamento';

        /**
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = 'Informações basicas para reserva de evento';
        
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
        $page_data['tableForm']      = $this->info['config']['form'];

        /**
         * Lista cliente - Combobox
         *
         */
        $page_data['lista_clientes'] = $this->model->Clientesfornecedores_model->listar_clientes();
        
        /**
         * View
         */
        $page_data['page']          = 'eventos/reserva_evento/form';
        
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
        if ($this->access['is_edit'] == 0) {
            show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!", "301", "Sem permissão de acesso :[");
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
        if (!$id) {
            /**
             * Regitrando o log do erro no banco de dados
             * Logging the error log to the database
             */
            $this->log_zata->log_error('Danger', 'Acesso indevido: Eventos_reserva_evento->editar() --> Parâmetro ID nao numerico');

            /**
             * Redirecionando para pagina de erro padrao
             * Redirecting to standard error page
             */
            show_error("Parâmetro que foi informado esta incorreto!", "404", "Acesso indevido :[");
        } else { // Se o parametro esta CORRETO - If the parameter is CORRECT
            /**
             * Verificamos se ele existe no banco de dados
             * Checked whether it exists in the database
             */
            if (!$this->model->getRow($id)) {
                /**
                 * Gravando o Log do erro no banco de dados
                 * Writing the Error Log to the Database
                 */
                $this->log_zata->log_error('Error', 'Acesso invalido: Eventos_reserva_evento->editar() --> O registro nao foi encontrado no banco de dados. ');

                /**
                 * Redirecionando para pagina de erro padrao
                 * Redirecting to standard error page
                 */
                show_error("O registro solicitado nao foi encontrado!", "404", "Acesso invalido :[");
            } else {
                /**
                 * se existir vai carregar as infomações do registro na variavel show
                 * If it exists it will load the registry information in the variable show
                 */
                $page_data['show']          = $this->model->getRow($id);

                /**
                * Titulo Portlet
                * Portlet Title
                */
                $page_data['title_portlet'] = $this->info['config']['titulo_modulo'];
               
                /**
                 * Variavel auxiliar para rotas do controller. Usada somente no formulario em modo de edicao
                 * Auxiliary variable for controller routes. Used only in form in edit mode
                 */
                $page_data['url']           = $this->url;
               
                /**
                 * Titulo do Portlet
                 * Portlet Title
                 */
                $page_data['page_title'] = 'Eventos / Orçamento';

                /**
                 * Titulo do Portlet
                 * Portlet Title
                 */
                $page_data['title_portlet'] = 'Reserva de evento';

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
                 * Lista cliente - Combobox
                 *
                 */
                $page_data['lista_clientes'] = $this->model->Clientesfornecedores_model->listar_clientes();

                /**
                * Informacões de Usuario de Criação e Alteração de Registro
                *
                */
                $data_user = $this->model->UserAccount_model->user_data($page_data['show']->id_usuario_criacao);
                $page_data['usuario_criacao'] = $data_user->nome.' '.$data_user->sobrenome;
                $data_user = $this->model->UserAccount_model->user_data($page_data['show']->id_usuario_atualizacao);
                $page_data['usuario_atualizacao'] = $data_user->nome.' '.$data_user->sobrenome;

                /**
                 * Listar de salas "COMBOBOX"
                 */
                $page_data['lista_salas'] = $this->Eventos_salas_model->lista_salas_combox();
                
                /**
                * Listar formatos de sala
                */
                $page_data['lista_utilizacao_de_sala'] = $this->Eventos_utilizacao_de_sala_model->listar_utilizacao_de_sala();
                
                /**
                 * Listar de salas "COMBOBOX"
                 */
                $page_data['lista_equipamentos'] = $this->Eventos_equipamentos_model->listar_equipamentos();

                /**
                 * Lista Reservas de Sala
                 *
                 */
                $page_data['lista_reserva_salas'] = $this->model->lista_reserva_salas($page_data['show']->id_reserva_evento);
              
                
                /**
                 * View
                 */
                $page_data['page']          = 'eventos/reserva_evento/form';
                

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
            "id_cf"                 => (int)$this->input->post('id_cf'),
            "numero_reserva"        => $this->gera_numero_reserva_evento($this->input->post('numero_reserva')),
            "dth_previsao_inicio"   => gravaData($this->input->post('dth_previsao_inicio')),
            "dth_dead_line"         => gravaData($this->input->post('dth_dead_line')),
            "desc_evento"           => $this->input->post('desc_evento'),
            "num_pax"               => (int)$this->input->post('num_pax'),
            "contato_nome"          => $this->input->post('contato_nome'),
            "contato_telefone"      => $this->input->post('contato_telefone'),
            "contato_email"         => $this->input->post('contato_email')
         );

        /**
         * Verifica o status do registro - ATIVO / INATIVO
         * Checks the status of the record - ACTIVE / INACTIVE
         */
        $this->input->post('sit_ativo') == 'on' ? $data['sit_ativo'] = 'S' : $data['sit_ativo'] = 'N';

        /**
         * Insert ou Update
         */
        $id   = $this->MY_model->insertRow($data, $this->input->get_post('id', true));
        
        /**
         * Pra verificar se o formalario esta em modo de cadastro ou edição,  basta validar o hidden ID
         * esta NULL. Caso o hidden ID estiver vazio o formulario vai esta em modo de cadastro
         * To verify if the form is in register or edit mode, just validate the hidden ID is NULL. If the
         * hidden ID is empty the form will be in registration mode
         */
        if ($this->input->post('id') == null) {
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
        } else {
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
        switch ($this->input->post('acao')) {
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
        if ($this->access['is_remove'] == 0) {
            show_error("Você não tem permissão de acesso para executar essa tarefa. Entre em contato com o administrador do sistema!", "301", "Sem permissão de acesso :[");
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
        if ($this->model->destroy($id) == true) {
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
        } else {
            /**
             * Gravando o log do erro no banco de dados
             * Saving the error log to the database
             */
            $this->log_zata->log_error('Error', 'Falha ao excluir: Eventos_reserva_evento->excluir() --> Nao foi possivel excluir o registro '. $id);

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
    * Gera Numero de Reserva de Evento
    *
    * Gerar sequncial do numero da reserva de evento
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    public function gera_numero_reserva_evento($numero_re)
    {
        if ($numero_re == '') {
            $num_re = $this->model->buscar_num_ultima_reserva_evento();
            
            if ($num_re == '') {
                $num_re = 1;
            } else {
                $num_re ++;
            }

            return $num_re;
        } else {
            return $numero_re;
        }
    }


    /**
    * Ajax_combo_estoque
    *
    * Retorna a lista de estoques de uma unidade em JSON
    *
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    public function ajax_combo_arrumacao($id_sala)
    {
        $lista_arrumacao = $this->Eventos_formato_de_salas_model->listar_formato_de_salas_combo_dinamico($id_sala);
        //Verifica se existe algum registro no banco de dados
        if (empty($lista_arrumacao)) {
            //Deve retornar um array multidimencional pelo JSON, para que ele simule o mesmo tipo de retorno, quando existe registro, assim no formulario poderemos varrer o array e preencher com os registros ou a mensagem
            $lista_arrumacao =  array(
                array("desc_formato_de_sala"=>"Nenhum formato de sala cadastrado")
            );
        }

        echo json_encode($lista_arrumacao);

        return;
    }

    /**
    * Salvar - To save
    *
    * Registrar o cadastro ou atualiza os registros no banco de dados, esses dados vem do formulario
    * Register the registry or update the records in the database, this data comes from the form
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    * @return  void
    */
    public function adicionar_reserva_de_sala()
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
            "id_reserva_evento"    => (int)$this->input->post('id_reserva_evento'),
            "id_sala"              => (int)$this->input->post('id_sala'),
            "id_formato_de_sala"   => (int)$this->input->post('id_arrumacao'),
            "limite_pax_arrumacao" => $this->input->post('limite_pax_arrumacao'),
            "dth_inicio"           => gravaData($this->input->post('dth_inicio')),
            "dth_fim"              => gravaData($this->input->post('dth_fim')),
            "qtd_diarias"          => (int)$this->input->post('qtd_diarias'),
            "id_utilizacao_sala"   => (int)$this->input->post('id_utilizacao_sala'),
            "pax_estimadas"        => (int)$this->input->post('pax_estimadas'),
            "pax_garantidas"       => (int)$this->input->post('pax_garantidas'),
            "tipo_tarifa"          => $this->input->post('tipo_tarifa'),
            "trf_especial"         => $this->input->post('trf_especial'),
            "trf_balcao"           => $this->input->post('trf_balcao'),
            "valor_diaria"         => moeda_ajuste($this->input->post('valor_diaria')),
            "acrescimo"            => moeda_ajuste_2($this->input->post('acrescimo')),
            "desconto"             => moeda_ajuste_2($this->input->post('desconto')),
            "iss"                  => moeda_ajuste_2($this->input->post('iss')),
            "valor_total"          => moeda_ajuste($this->input->post('valor_total')),
            "valor_total_taxas"    => moeda_ajuste($this->input->post('valor_total_taxas')),
            "observacoes_sala"     => $this->input->post('observacoes_sala')
         );

        /**
         * Verifica se a reserva é de periodo integral
         */
        $this->input->post('periodo_integral') == 'on' ? $data['periodo_integral'] = 'S' : $data['periodo_integral'] = 'N';
        $data['hora_inicio']            = $this->input->post('hora_inicio') == null ? '00:00' : $this->input->post('hora_inicio') ;
        $data['hora_fim']               = $this->input->post('hora_fim') == null ? '23:59' : $this->input->post('hora_fim') ;

        $data['token_id'] 		        = $this->better_token();
        $data['token_company'] 		    = $this->session->userdata('token_company');
        $data['dth_criacao'] 	        = date('Y-m-d H:i:s');
        $data['id_usuario_criacao']     = $this->session->userdata('id_usuario');
        $data['dth_atualizacao']        = date('Y-m-d H:i:s');
        $data['id_usuario_atualizacao'] = $this->session->userdata('id_usuario');

        if ($this->db->insert('eve_reserva_salas', $data) == true) {
            echo json_encode(array('result'=> true));
        } else {
            echo json_encode(array('result'=> false));
        }
    } // Fim da Funcao - End of function
    
    /**
    * Excluir Reserva de Sala
    *
    * Essa funcao somente eh usando com AJAX
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    public function excluir_reserva_de_sala()
    {

        /**
         * Id do produto que sera excluido da ordem de servico
         */
        $id = $this->input->post('id_reserva_evento_sala');
        
        $this->db->where('id_reserva_evento_sala', $id);

        /**
         * Excluido
         */
        if ($this->db->delete('eve_reserva_salas') == true) {
            echo json_encode(array('result'=> true));
        } else {
            echo json_encode(array('result'=> false));
        }
    }

    /**
    * Ajax Retorna Reserva de Sala
    *
    * Retorna dados da reserva de sala
    *
    * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
    */
    public function ajax_retorna_reserva_sala($id_reserva_evento_sala)
    {
        $reserva_evento_sala = $this->model->retorna_reserva_sala($id_reserva_evento_sala);
        //Verifica se existe algum registro no banco de dados
        if (empty($reserva_evento_sala)) {
            //Deve retornar um array multidimencional pelo JSON, para que ele simule o mesmo tipo de retorno, quando existe registro, assim no formulario poderemos varrer o array e preencher com os registros ou a mensagem
            $reserva_evento_sala =  array(
                    array("observacoes_sala"=>"Nenhuma sala foi reservada")
                );
        }
    
        echo json_encode($reserva_evento_sala);
    
        return;
    }
}//FIM DA CLASSE - END OF CLASS
