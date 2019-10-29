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
 * @copyright TRIVEE SERVICES IT MEI | Copyright (c) 2015 - 2018
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      http://www.trivee.com.br
 * @since     Versão 1.0.0 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class UserAccount 
 *
 * É responsável pela grande parte das funcionalidades de criacao e manutencao da ferramenta de automacao ZATA. 
 * It is responsible for most of the creation and maintenance of the ZATA automation tool. 
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 * @since 28/09/2015
 * http://jeromejaglale.com/doc/php/codeigniter_404
 */
class UserAccount extends CI_Controller {

    /**
     * Constructor
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @return    void
     */
    function __construct() {

        parent::__construct();

        /**    
         * Carregando Model
         * Loading Model 
         */
        $this->load->model('zata/UserAccount_model');
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
         * Carregando o metodo page_login() como default do controller
         * Loading the method page_login() as controller default
         */
        $this->page_login();

    }// Fim da Funcao - End of function

    /**
     * Page_login
     *
     * Metodo responsavel por carregar a view de login
     * Method responsible for loading login view
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function page_login()
    {

        /**
         * Carregando o view
         * Loading view
         */
        $this->load->view('zata/user/login-view.php');

    }// Fim da Funcao - End of function

    /**
     * Exec_login
     *
     * Metodo inicial do controller
     * The controller's initial method
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @since 30/09/2015
     */
    public function exec_login()
    {
        /**
         * Recebendo e-mail e senha do formulario de login
         * Receiving login form email and password
         *
         * trim         => Retira espaço no ínicio e final de uma string | Exit space at the beginning and end of a string
         * preg_replace => Realiza uma pesquisa por uma expressão regular e a substitui | Performs a search for a regular expression and replaces it.
         * preg_replace('/\s\s+/','',) => Remove espaços em branco | Remove whitespace 
         */
        $login = trim($this->input->post('username'));
        $senha = preg_replace('/\s\s+/','', trim($this->input->post('password')));
        
        /**
         * Verifica se existe alguma conta
         * Check if there is an account
         */        
        if ($query = $this->UserAccount_model->login($login, $senha)){
       
                /**
                 * Resgatamos às informações do usuário para criar uma nova sessão de login
                 * We rescued user information to create a new login session
                 */ 
                $id_usuario                = $query->id_usuario;
                $nome                      = $query->nome;
                $sobrenome                 = $query->sobrenome;
                $token_company             = $query->token_company;
                $id_perfil                 = $query->id_perfil;

                        //Existe a possibilidade em que o usuario pode ter sido bloqueado, entao ele não ira poder 
                        //realizar o login no sistema, O usuario bloqueado deverá entrar em contato com o supervisor.
//                        if($sitBloqueado == 'S'){
                                //registrando log 
//                                $this->registrarLoginLogin($login, 'B');
                                //mensagem informando que o usuario esta bloqueado
//                                $this->session->set_flashdata('msg', 'usuario-bloqueado');
                                //redirecionando para pagina de login
//                               redirect(base_url('login'));      
//                        }

            //Se o e-mail e senha for valido e o usuario não estiver bloqueado damos sequencia ao login


            /**
             * Informações do usuario para criação de uma nova session
             * User information for creating a new session
             */             
            $data = array(
                            'token_company'        => $token_company,
                            'id_usuario'           => $id_usuario,
                            'id_perfil'            => $id_perfil,
                            /**
                             * Usuario está logado
                             * User is online
                             */  
                            'is_logged_in'         => true,    
                         );

            /**
             * Registrando Login
             * Registering Login
             */ 
            $this->registrarLoginLogin($login, 'L');
            /**
             * Setando os dados na sessao
             * Setting the data in the session
             */ 
            $this->session->set_userdata($data);
            /**
             * Redirecionando para o dashboard do sistema
             * Redirecting to the system dashboard
             */ 
            //redirect(base_url('./'));
            redirect(base_url('solicitacao-servico/minhas-solicitacoes/eu-recebi'));
        }
        /**
         * Se não existe correspondentes de email e senha, o login falhou
         * If there are no email and password correspondents, login failed
         */
        else
        {
            /**
             * Registrando Login
             * Registering Login
             */ 
            $this->registrarLoginLogin($login, 'F');
            /**
             * Criando sessao com mensagem de erro
             * Creating session with error message
             */ 
            $this->session->set_flashdata('msg', 'usuario-nao-encontrado');
            /**
             * Redirecionando para pagina de login
             * Redirecting to login page
             */ 
            redirect(base_url('login'));     
        }      
    }// Fim da Funcao - End of function

    /**
     * Signout
     *
     * Metodo responsavel por fazer o logout da conta
     * Method responsible for logging out the account
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @since 30/09/2015
     */  
    public function signout(){
        /**
         * Limpando dados da sessao 
         * Clearing session data
         */           
        $data = array( 
            'token_company'        => '',
            'id_usuario'           => '',
             /**
              * Usuario está desconectado
              * User is offline
              */  
            'is_logged_in'  => false,    
        );

        $this->session->unset_userdata($data);

        /**
         * Limpando qualquer sessão 
         * Clearing any session
         */
        $this->session->sess_destroy();

        /**
         * redirecionando para a pagina de login
         * redirecting to login page
         */
        redirect(base_url('login'));
    }// Fim da Funcao - End of function

    /**
     * Request_account
     *
     * Metodo responsavel por fazer a solicitacao de criacao de conta
     * Method responsible for making account creation request
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @since 30/09/2015
     */ 
    public function request_account(){
        
        /**
         * Verificando se já existe uma conta registrada com e mail informado
         * Checking if an account already registered with an informed email already exists
         */
         if ($query = $this->UserAccount_model->request_register($this->input->post('email')))
         {
                
                //Verifica se ja esta cadastrado ou se existe solicitação de registro
                //sitRequestRegister (Solicitação de Aprovação) se sitRequestRegister = P (Solicitação pendente) se sitRequestRegister = A (Solicitação Aprovada)  
                $sitRequestRegister = $query->sitRequestRegister;
                        //Solicitação Pendente
                        if($sitRequestRegister == 'P'){
                                //mensagem informando que ja existe solicitação de registro e que a mesma esta pendente de aprovação
                                $this->session->set_flashdata('msg', 'solicitacao-registro-pendente');
                                //redirecionando para pagina de login
                                redirect(base_url('login'));      
                        }
                        //Solicitação Aprovada - Usuario ja esta ativo!
                        if($sitRequestRegister == 'A'){
                                //mensagem informando que a solicitação de registro ja foi aprovada
                                $this->session->set_flashdata('msg', 'solicitacao-registro-aprovada');
                                //redirecionando para pagina de login
                                redirect(base_url('login'));      
                        }else{
                                //Se sitRequestRegister for diferente de 'P' ou 'A', exite falha na aplicação ou no banco de dados - mensagem de erro: entrar em contato com o suporte tecnico
                                $this->session->set_flashdata('msg', 'falha-suporte-tecnico');
                                //redirecionando para pagina de login
                                redirect(base_url('login'));    
                        }
        }

        //se não existe nenhuma conta com o numero do cpf
        else{

            //registrando solicitação de Registro 
             $dados = array(
                "sitRequestRegister"    => 'P',
                "nome"                  => $this->input->post('nome'), 
                "sobrenome"             => $this->input->post('sobrenome'),
                "email"                 => $this->input->post('email'),
                "celular"               => $this->input->post('fone'),
                "numCPF"                => $this->input->post('cpf'),
                //Default
                "dthRequestRegister"    => date('Y-m-d H:i:s')
            );
            //Inserindo
            if ($this->UserAccount_model->insert($dados)){        
                //Criando sessao com mensagem de erro
                $this->session->set_flashdata('msg', 'solicitacao-registro-aprovada');
                //redirecionando para pagina de login
                redirect(base_url('login'));
            }else{
                //Criando sessao com mensagem de erro
                $this->session->set_flashdata('msg', 'falha-salvar-solicitacao');
                //redirecionando para pagina de login     
                redirect(base_url($url_redirect));
            }     
        }      

     
    }

    /**
     * RegistrarLoginLogin
     *
     * Registrando Logs no momento do Login do Usuario (A proposta é que seja analizada as tentativas de acesso não autorizadas
     * no sistema, e os erros comuns a entrada do sistema)
     * Registering Logs at the time of User Login (The proposal is to analyze unauthorized access attempts
     * in system, and common system input errors)
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @since 04/10/2015
     */ 
    public function registrarLoginLogin($login, $sit_status)
    {
            $data = array(
                            'dthLoginUsuario'   => date('Y-m-d H:i:s'),
                            'login'             => $login,
                            'ip_address'        => $this->input->ip_address(),
                            'sit_status'        => $sit_status,
                            'dispositivo'       => $this->detectaDispositivo(),
                            'about_browser'     => $_SERVER['HTTP_USER_AGENT']
                         );
            $query = $this->UserAccount_model->insertLogLoginUsuario($data);
    }


    /**
     * DetectaDispositivo
     *
     * Detecta o dispositivo que esta acessando o sistema
     * Detects the device accessing the system
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @since 04/10/2015
     */ 
    public function detectaDispositivo()
    {

       $mobile = FALSE;
       /**
        * Tipo de dispositivos
        * Type of devices
        */     
       $user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric");
        
       /**
        * Usando a variavel $_SERVER['HTTP_USER_AGENT'] para comparar com os tipo de dispositivos
        * Using the variable $ _SERVER ['HTTP_USER_AGENT'] to compare with the type of devices
        */   
       foreach($user_agents as $user_agent)
       {
            if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) 
            {
                $mobile = TRUE;
                $modelo = $user_agent;
                break;
            }
       }
     
       if ($mobile)
       {

          return $modelo;
       
       }
       else
       {

          return "Área de Trabalho";
       
       }
       
    }





    



}//FIM DA CLASSE
