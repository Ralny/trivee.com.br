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
 * Site 
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class App_producao extends MY_Controller 
{

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
         * Carregando Model
         * Loading Model 
         */
        $this->load->model('gelato_grano/App_producao_model');
        $this->model = $this->App_producao_model;

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
         * Origem do produto
         * Product Origin 
         */ 
        $page_data['categorias_gelato'] = $this->db->query("

            Select
                                                  *
            From
            gelato_grano_categoria
            Where 
            sit_ativo = 'S'   

            ")->result();

        /**
         * Origem do produto
         * Product Origin 
         */ 

        $page_data['receitas'] = $this->db->query("

           Select
                      *
           From
           gelato_grano_receitas
           Where 
           sit_ativo = 'S' 

           ")->result();  
        //var_dump( $page_data['receitas'])  ;exit;    

        /**
         * View 
         */
        $page_data['page']              = 'gelato_grano/app_producao/pages/inicial.php';

        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('gelato_grano/app_producao/tpl/main', $page_data);
        
    }// Fim da Funcao - End of function

    /**
     * Index
     *
     * Metodo inicial do controller
     * The controller's initial method
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function cuba()
    { 

        /**
         * View 
         */
        $page_data['page']              = 'gelato_grano/app_producao/pages/cuba.php';


        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('gelato_grano/app_producao/tpl/main', $page_data);
        
    }// Fim da Funcao - End of function

    /**
     * Index
     *
     * Metodo inicial do controller
     * The controller's initial method
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function peso_balanca()
    { 

        /**
         * View 
         */
        $page_data['page']              = 'gelato_grano/app_producao/pages/peso_balanca.php';


        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('gelato_grano/app_producao/tpl/main', $page_data);
        
    }// Fim da Funcao - End of function

    /**
     * Index
     *
     * Metodo inicial do controller
     * The controller's initial method
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     */
    public function receita()
    { 

        $receita     = $this->input->post('receita');
        $peso_total  = $this->input->post('peso');
        $cuba        = $this->input->post('cuba');

        // Dados da receita

        $sql = " SELECT * FROM gelato_grano_receitas WHERE id_receita = $receita  "; 

        $query = $this->db->query($sql);

        $row = $query->row();

        $page_data['row'] =  $row;

        if ($page_data['row']->base_receita == 'A')
        {

            switch ($cuba)
            {
                case '1':
                    $peso_cuba = 520;
                    $volume_total = 3363; 
                    break;

                case '2':
                    $peso_cuba = 665;
                    $volume_total = 5500;
                    break;

                case '3':
                    $peso_cuba = 630;
                    $volume_total = 5454;
                    break;        
            }
        }
        else
        {
            switch ($cuba)
            {
                case '1':
                    $peso_cuba = 520;
                    $volume_total = 4000; 
                    break;

                case '2':
                    $peso_cuba = 665;
                    $volume_total = 6000;
                    break;

                case '3':
                    $peso_cuba = 630;
                    $volume_total = 6000;
                    break;        
            }
        }

        $sobra_gelato = $peso_total - $peso_cuba;

        $produzir = $volume_total - $sobra_gelato;

        // Calculo da Receita

        $ingredientes_gelato = $this->db->query("

            Select
            I.*,
            I.id_receita As id_receita1
            From
            gelato_grano_item_receitas I
            Where
            I.id_receita = $receita

            ")->result();

        //var_dump($ingredientes_gelato);exit;


        $arrayForm = array();

        foreach ($ingredientes_gelato as $val) {

            $arrayForm[] = array(
                'ingrediente' => $val->nome_item, 
                'peso'        => $this->regra_3($val->quantidade, 1000, $produzir)
            ); 

            $dados = array(
                'id_item_receita' => $val->id_item_receita, 
                'id_receita' => $val->id_receita, 
                'id_produto' => $val->id_produto, 
                'nome_item' => $val->nome_item, 
                'peso'        => $this->regra_3($val->quantidade, 1000, $produzir)
            ); 

                /**
                 * Insert ou Update
                 */
                $id   = $this->MY_model->insertRow($dados , '');



            }

            $page_data['formula_ingredientes'] =  $arrayForm;
        /**
         * View 
         */
        $page_data['page']              = 'gelato_grano/app_producao/pages/receita.php';
        /**
         * Carregando tudo na view
         * Loading everything on the view
         */
        $this->load->view('gelato_grano/app_producao/tpl/main', $page_data);
        
    }// Fim da Funcao - End of function

    function regra_3($ingrediente_1kg, $volume_1kg, $produzir){

        // quantos = por
        $v1 = $ingrediente_1kg; /* = */ $v2 = $volume_1kg;
        //            X
        // quantos? = pagando
        $v3 = ""; /* = */ $v4 = $produzir;

        $c1 = $v1 * $v4;
        $c2 = $v2;
        
        $total = $c1/$c2;

        return round(number_format($total, 2, '.', ''));
        //ceil e floor

    }

    



}//FIM DA CLASSE - END OF CLASS
