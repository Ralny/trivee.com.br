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
 * Class Model Requisicao 
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
class Requisicao_model extends MY_Model {

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
        $this->table    = "pro_requisicao_produto";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_requisicao_produto";
        
    }

    /**
     * Listar Requisicoes
     * 
     */
    public function listar_requisicoes() {
 
        $sql = "
                SELECT
                  r.num_requisicao,
                  r.tipo_destino,
                  r.data_emissao,
                  r.data_necessidade_entrega,
                  r.sit_status_requisicao,
                  r.token_id,
                  r.token_company,
                  oe.nome_estoque AS origem,
                  de.nome_estoque AS destino,
                  du.apelido AS unidade_destino,
                  ou.apelido AS unidade_origem
                FROM
                  pro_requisicao_produto r INNER JOIN
                  emp_estoque oe ON r.id_origem_estoque = oe.id_estoque INNER JOIN
                  emp_estoque de ON r.id_destino_estoque = de.id_estoque INNER JOIN
                  emp_unidade du ON de.id_unidade = du.id_unidade INNER JOIN
                  emp_unidade ou ON oe.id_unidade = ou.id_unidade
                WHERE
                  r.token_company = '$this->company'
                ORDER BY
                  r.data_necessidade_entrega
                "; 

        //execultando a consulta
        $query = $this->db->query($sql);

        //retornando dados da consulta para o controller
        return $query->result();
    }

    /**
     * Listar Unidade da Empresa
     * 
     */
    public function listar_unidades_empresa() {
 
        $sql = "
                SELECT
                    *
                FROM
                    emp_unidade  
                WHERE 
                    token_company = '$this->company' 
                ORDER BY
                    nome_fantasia DESC
                "; 

        //execultando a consulta
        $query = $this->db->query($sql);

        //retornando dados da consulta para o controller
        return $query->result();
    }

    /**
     * Listar Estoques de uma Unidade da Empresa
     * 
     */
    public function listar_estoques_unidade($id_unidade) {
 
        $sql = "
                SELECT
                    *
                FROM
                    emp_estoque  
                WHERE 
                    id_unidade = '$id_unidade' 
                ORDER BY
                    nome_estoque DESC
                "; 

        //execultando a consulta
        $query = $this->db->query($sql);

        //retornando dados da consulta para o controller
        return $query->result();
    }

    

    /**
     * Buscar Num Requisicao
     *
     * Retorna o ultimo numero da ordem de servico
     *
     * @return void
     */
    public function buscar_num_requisicao(){

        $sql    = "SELECT MAX(num_requisicao) AS ultimo_num_requisicao FROM pro_requisicao_produto WHERE token_company = '$this->company' ";
        
        $query  = $this->db->query($sql);

        $num_os = $query->row();

        return $num_os->ultimo_num_requisicao;  
    
    }


    /**
     *
     *
     * 
     *
     * @return void
     */
    public function total_requisicoes(){

        $sql    = "SELECT
                      COUNT(r.id_requisicao_produto) AS total_requisicoes
                    FROM
                      pro_requisicao_produto r
                    WHERE
                      r.token_company = '$this->company'
                    GROUP BY
                      r.token_company";
        
        $query  = $this->db->query($sql);

        if ($query->result())
        {
            return $query->row()->total_requisicoes;
        }
        else
        {
             return 0;
        }    
    }
 
 


        


   

    
}//Fim da classe
