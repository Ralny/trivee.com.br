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
 * Class Produtos 
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio. 
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Relatorios extends MY_Controller 
{
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $modulo  = 'produtos';

    public $url     = 'produtos';

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
        $this->load->model('produtos/Produtos_model');
        $this->load->model('produtos/Requisicao_model');
        $this->model = $this->Produtos_model;
       
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
    public function requisicao_x_producao()
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
        $page_data['title_portlet'] = '';

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']           = $this->url;

        /**
         * Unidades da Empresa
         * 
         */ 
        $page_data['unidades_empresas'] = $this->model->Requisicao_model->listar_unidades_empresa();


         
        $page_data['page']          = 'produtos/relatorios/requisicao_x_produtos';
        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function   

}//FIM DA CLASSE - END OF CLASS
