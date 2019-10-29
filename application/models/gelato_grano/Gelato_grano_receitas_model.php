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
 * Class Model Gelato_grano_receitas 
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
class Gelato_grano_receitas_model extends MY_Model {

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
        $this->table    = "gelato_grano_receitas";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_receita";
        
    }

    /**
     * Listar Receitas de gelato
     * List of gelato recipes
     */
    public function listar_receitas() {
 
        $sql = "
                SELECT
                  r.token_id,
                  r.nome_receita,
                  r.sit_ativo,
                  r.token_company,
                  c.`desc` AS categoria,
                  c.color_label,
                  c.sit_ativo AS ativo_categoria
                FROM
                  gelato_grano_receitas r INNER JOIN
                  gelato_grano_categoria c ON r.id_categoria_gelato = c.id_categoria_gelato
                WHERE
                  r.token_company = '$this->company' AND
                  c.sit_ativo = 'S'
                ORDER BY
                  r.nome_receita
                "; 
        //execultando a consulta
        $query = $this->db->query($sql);
        //retornando dados da consulta para o controller
        return $query->result();
    } 

    /**
     * Listar Categorias de gelato
     * List Categories of gelato
     */
    public function listar_categorias() {
 
        $sql = "
                SELECT
                    c.*
                FROM
                    gelato_grano_categoria as c
                WHERE token_company = '$this->company' AND sit_ativo = 'S' 
                ORDER by
                    c.desc
                ";   
        //execultando a consulta
        $query = $this->db->query($sql);
        //retornando dados da consulta para o controller
        return $query->result();
    }

    /**
     * Listar Itens de Receita
     * 
     */
    public function listar_ingredientes($id_receita) {
 
        $sql = "
                SELECT
                          *
                    FROM
                      gelato_grano_item_receitas
                    WHERE
                      id_receita = $id_receita 
                ";   
        //execultando a consulta
        $query = $this->db->query($sql);
        //retornando dados da consulta para o controller
        return $query->result();
    }

    /**
     * Buscar Produtos Autocomplete 
     *
     * Retorna o nome do produto buscado
     * @param $q String com fragmento buscado.
     * @return array com os dados encontrados
     */
    public function buscar_produto_autocomplete($q){

        /**
         * Montando select
         * Obs: ira buscar em duas colunas, razao_social e nome_fantasia
         */
        $this->db->select('*');
        $this->db->limit(7);
        $this->db->like('nome', $q);
        $this->db->where('sit_ativo', 'S');
        $query = $this->db->get('pro_produtos');

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
                $row_set[] = array('label'=>'Produto: '.$row['nome'] .' - Marca:'. $row['marca'],'id'=>$row['id_produto'], 'nome_item'=>$row['nome'], 'marca'=>$row['marca'], 'codigo'=>$row['codigo']); 

            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            echo json_encode($row_set);
        }
    }

 
 


        




    
}//Fim da classe
