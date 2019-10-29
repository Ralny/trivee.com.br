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
 * Class Bi_consumo 
 *
 * Camada responsável por controlar o fluxo do software, contem a logica e as
 * regras do negocio. 
 * Layer responsible for controlling the software flow, contains the logic and
 * business rules.
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Bi_consumo extends MY_Controller 
{
    /**
     * Definir variaveis auxiliares 
     * Define auxiliary variables
     */
    public $modulo  = 'bi_consumo';

    public $url     = 'bi_consumo';

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
        $this->load->model('gelato_grano/Bi_consumo_model');
        $this->model = $this->Bi_consumo_model;

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
        $this->dashboard();
        
    }// Fim da Funcao - End of function

    /**
     * Listar - List
     *
     * Metodo responsavel por carregar a view de listagem e seus registros
     * Method responsible for loading the listing view and its records 
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
         * Titulo do Portlet
         * Portlet Title
         */
        $page_data['title_portlet'] = $this->info['config']['titulo_modulo'];

        /**
         * Variavel auxiliar para rotas do controller
         * Auxiliary variable for controller routes
         */
        $page_data['url']           = $this->url;


        //Periodo da pesquisa
        $dth_inicial = gravaData($this->input->post('dth_inicial'));
        $dth_final   = gravaData($this->input->post('dth_final'));

        $page_data['produtos'] = $this->requisicao_x_producao($dth_inicial, $dth_final);

        /**
         * Total de Gelato Produzido 
         */
        $page_data['total_produtos_cadastrados']  = $this->Produtos_model->total_produtos_cadastrados();

        /**
         * Total de Gelato Produzido 
         */
        $page_data['total_requisicoes']  = $this->Requisicao_model->total_requisicoes();

        /**
         * Total de Gelato Produzido 
         */
        $page_data['total_gelato_produzido']  = $this->model->total_gelato_produzido();


        /**
         * View 
         */
        $page_data['page']          = 'gelato_grano/bi_consumo/dashboard';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('tpl/main', $page_data);

    } // Fim da Funcao - End of function


    /**
     * 
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function requisicao_x_producao($dth_inicial, $dth_final)
    { 

        if ($dth_inicial == '')
        {
           $dth_inicial = date("Y/m/01");
        }
        if ($dth_final  == '')
        {
           $dth_final = date("Y/m/t");
        }

        //Listando Produtos Cadastrados
        $listar_produtos = $this->Produtos_model->listar_produtos();

        //Para cada produto cadastrado iremos gerar as informacoes
        foreach ($listar_produtos as $p) 
        {   
            /* Buscando os produtos que tiveram requisicao
             Retorna um array
             array (size=6)
              'nome' => string 'Alla Meringa' (length=12)
              'requisitado' => string '7' (length=1)
              'unidade_medida' => string 'Unidade' (length=7)
              'peso_liquido' => int 2800
              'produzido' => string 'Unidade' (length=7)
              'discrepancia' => string 'Unidade' (length=7)
            */
            $item_requisicao = $this->model->requisicao_de_item($p->id_produto, $dth_inicial, $dth_final);

            if (count($item_requisicao) >= 1)
            {
                // Se existe produto requisitado
                if ($item_requisicao != null)
                {  

                    // Multiplica o peso do produto pela quantidade desse produto requisitado
                    if ($p->peso_liquido > 0)
                    {
                        $total_peso_liquido = $p->peso_liquido * $item_requisicao->requisitado;     
                    }
                    else
                    {
                        $total_peso_liquido = '0';
                    }

                    if ($total_peso_liquido >= 1000)
                    {
                        $peso_liquido = number_format($total_peso_liquido,0,".",","). ' KG';
                    }
                    else
                    {
                        $peso_liquido = $total_peso_liquido. ' G';
                    }



                    // Quantidade do produto produzido - REGISTRADO PELO APP
                    $total_item_produzido = $this->model->consumo_itens_app($p->id_produto)->qtd_produzido; 

                    if ($total_item_produzido > 1000)
                    {
                        $item_produzido = number_format($total_item_produzido,0,".",","). ' KG';
                    }
                    else
                    {
                        $item_produzido = $total_item_produzido. ' G';
                    }



                    // Discrepancia
                    if ($total_peso_liquido <= 0)
                    {
                        $total_discrepancia = 0;
                    }
                    else
                    {
                        $total_discrepancia = $total_peso_liquido - $total_item_produzido;
                    }

                    if ($total_discrepancia > 1000)
                    {
                        $discrepancia = number_format($total_discrepancia,0,".",","). ' KG';
                    }
                    else
                    {
                       $discrepancia = $total_discrepancia. ' G';
                    }




                    $arr_produtos[] = array(
                                        'nome'          => $item_requisicao->nome, 
                                        'requisitado'   => $item_requisicao->requisitado, 
                                        'unidade_medida'=> $item_requisicao->unidade_medida,
                                        'peso_liquido'  => $peso_liquido,
                                        'produzido'     => $item_produzido, 
                                        'discrepancia'  => $discrepancia
                                        );
                }
            }
            else
            {
                $arr_produtos[0] = array(
                                        'nome'          => '', 
                                        'requisitado'   => '', 
                                        'unidade_medida'=> '',
                                        'peso_liquido'  => '',
                                        'produzido'     => '',
                                        'discrepancia'  => '',
                                        );
            } 

              

       }

        //Retorna um array com os dados sintetizado

        return $arr_produtos;     

    }// Fim da Funcao - End of function
    




    





}//FIM DA CLASSE - END OF CLASS
