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
 * Class Model Produtos 
 *
 * Camada base de abstração e persistências dos dados da aplicação no banco. 
 * As interações CRUD ocorrem na CORE/MY_model.
 * Nessa classe sao adcionadas somente as funcoes especificas referentes ao controller
 * Base layer of abstraction and persistence of application data in the database.
 * CRUD interactions occur in CORE / MY_model.
 * In this class only the specific functions related to the controller
 *
 * @category  Models
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Produtos_model extends MY_Model {     

   /**
    * Class constructor
    *
    * @return  void
    */
    public function __construct()
    {
        
        parent::__construct();

        /**
         * Definir o nome da tabela
         * Set the table name
         */
        $this->table    = "pro_produtos";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_produto"; 
    } 

    /**
     * Listar produtos
     * List products
     */
    public function listar_produtos() {
 
        $sql = "
                SELECT
                  *
                FROM
                  pro_produtos  
                WHERE token_company = '$this->company' 
                ORDER BY
                nome DESC
                ";   
        //execultando a consulta
        $query = $this->db->query($sql);
        //retornando dados da consulta para o controller
        return $query->result();
    }

    /**
     * Listar produtos
     * List products
     */
    public function get_produto($id) {
 

        /**
         * SQL
         */ 
        $sql = "

                SELECT
                  p.*,
                  n.ncm AS ncm_ncm,
                  n.descricao AS ncm_desc,
                  c.cest AS cest_cest,
                  c.descricao AS cest_desc
                FROM
                  pro_produtos p LEFT JOIN
                  pro_ncm n ON p.id_ncm = n.id_ncm LEFT JOIN
                  pro_cest c ON c.id_cest = p.id_cest
                WHERE
                  p.token_id = '$id' AND
                  p.token_company = '$this->company'

        "; 

        /**
         * Executa a SQL
         * Execute SQL
         */
        $query = $this->db->query($sql);

        /**
         * Verificar se o registro existe no banco de dados
         * Verify that the record exists in the database
         */ 
        $row = $query->row();

        /**
         * Se existir algum registro
         * If there is any record
         */
        if(isset($row))
        {
             /**
              * Retorna o resultado para o controller em forma de um array
              * Returns the result to the controller in the form of an array
              */ 
             return $query->row();
        }
        else
        {
             /**
              * Não retorna nada
              * Does not return anything
              */
             return false;
        }
    }

    /**
     * Listar Fornecedores
     * List Providers
     */
    public function listar_fornecedores() {
 
        $sql = " SELECT * FROM cli_cliente_fornecedor WHERE token_company = '$this->company' AND (tipo_cadastro = 'Fornecedor' OR tipo_cadastro = 'Ambos')";   
        //execultando a consulta
        $query = $this->db->query($sql);
        //retornando dados da consulta para o controller
        return $query->result();
    }

    /**
     * Buscar Produto Autocomplete 
     *
     * Retorna o nome do serviço buscado
     * @param $q String com fragmento buscado.
     * @return array com os dados encontrados
     */
    public function buscar_produto_autocomplete($q){

        $sql = 
                "
                    SELECT
                      p.*,
                        um.unidade_medida
                    FROM
                      pro_produtos p LEFT JOIN
                      pro_unidade_medida um ON p.id_unidade_medida = um.id_unidade_medida
                    WHERE
                      (p.nome LIKE '%$q%' OR
                      p.codigo LIKE '%$q%') AND
                      p.token_company = '$this->company' AND
                      p.sit_ativo = 'S'
                    ORDER BY
                      p.nome
                    LIMIT 10
                ";     

         $query = $this->db->query($sql);        


        /**
         * Se existir resultados
         */
        if ($query->num_rows() > 0)
        {
            /**
             * Listando resultados 
             */
            foreach ($query->result_array() as $row)
            {
                $row_set[] = array('label'=>$row['nome'],'id'=>$row['id_produto'],'unidade_medida'=>$row['unidade_medida'], 'codigo'=>$row['codigo'], 'preco'=>$row['valor_venda'], 'preco_exib'=> moeda($row['valor_venda'])  ); 
            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            echo json_encode($row_set);
        }
    }

    /**
     * Itens Requisicao
     *
     * Retorna lista de itens de uma requisicao
     * @param $id id do cliente.
     * @return nome do cliente
     */
    public function itens_requisicao($id_requisicao_produto){

        /**
         * Montando select
         */
        $sql = "
                SELECT
                    *
                FROM
                  pro_itens_requisicao_produto 
                WHERE
                  id_requisicao_produto = $id_requisicao_produto
               ";

        $query = $this->db->query($sql);

        return $query->result();
        
    }  

    /**
     * Buscar NCM Autocomplete 
     *
     * Retorna o numero do ncm buscado
     * @param $q String com fragmento buscado.
     * @return array com os dados encontrados
     */
    public function buscar_ncm_autocomplete($q){

        /**
         * Montando select
         * Obs: ira buscar em duas colunas, razao_social e nome_fantasia
         */
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('descricao', $q);
        $query = $this->db->get('pro_ncm');

        /**
         * Se existir resultados
         */
        if ($query->num_rows() > 0)
        {
            /**
             * Listando resultados 
             */
            foreach ($query->result_array() as $row)
            {
                $row_set[] = array('label'=>$row['descricao'],'id'=>$row['id_ncm']  ); 
            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            echo json_encode($row_set);
        }
    }


    /**
     * Buscar CEST Autocomplete 
     *
     * Retorna o numero do cest buscado
     * @param $q String com fragmento buscado.
     * @return array com os dados encontrados
     */
    public function buscar_cest_autocomplete($q){

        /**
         * Montando select
         * Obs: ira buscar em duas colunas, razao_social e nome_fantasia
         */
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('descricao', $q);
        $this->db->or_like('cest', $q);
        $query = $this->db->get('pro_cest');

        /**
         * Se existir resultados
         */
        if ($query->num_rows() > 0)
        {
            /**
             * Listando resultados 
             */
            foreach ($query->result_array() as $row)
            {
                $row_set[] = array('label'=>$row['cest'] . ' - ' . $row['descricao'],'id'=>$row['id_cest']  ); 
            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            echo json_encode($row_set);
        }
    }

 
    /**
     *
     *
     * 
     *
     * @return void
     */
    public function total_produtos_cadastrados(){

        $sql    = "SELECT
                      COUNT(p.id_produto) AS total_produtos
                    FROM
                      pro_produtos p
                    WHERE
                      p.token_company = '$this->company'
                    GROUP BY
                      p.token_company";
        
        $query  = $this->db->query($sql);

        if ($query->row()->total_produtos >= 1)
        {
            return $query->row()->total_produtos;
        }
        else
        {
            return 0;
        }
    
    }
 


        




    
}//Fim da classe
