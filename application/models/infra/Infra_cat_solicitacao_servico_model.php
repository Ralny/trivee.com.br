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
 * Class Model Infra_cat_solicitacao_servico 
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
class Infra_cat_solicitacao_servico_model extends MY_Model {

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
        $this->table    = "infra_cat_solicitacao_servico";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_cat_solicitacao_servico";
        
    }

    /**
     * Lista status solicitacao Servicos
     *
     * Retorna lista de status de solicitacao  de servico
     */
    public function lista_categorias_solicitacao_servico(){

        /**
         * Montando select
         */
        $sql = "
                    Select
                      c.desc_cat_solicitacao_servico,
                      c.token_id_cat_pai,
                      c.token_company,
                      c.token_id,
                      c.sit_ativo
                    From
                      infra_cat_solicitacao_servico c
                    Where
                      c.token_company = '$this->company' And
                      c.token_id_cat_pai IS NULL
                    Order BY
                      c.desc_cat_solicitacao_servico   
                ";

        $query = $this->db->query($sql);

        return $query->result();
        
    } 

    /**
     * Lista status solicitacao Servicos
     *
     * Retorna lista de status de solicitacao  de servico
     */
    public function lista_subcategorias_solicitacao_servico($id_cat_pai){

        /**
         * Montando select
         */
        $sql = "
                    SELECT 
                      c.desc_cat_solicitacao_servico,
                      c.token_id_cat_pai,
                      c.token_company,
                      c.token_id
                    FROM
                      ss_cat_solicitacao_servico c
                    WHERE
                      c.token_id_cat_pai = '$id_cat_pai' AND
                      c.token_company = '$this->company'
                ";      

        $query = $this->db->query($sql);

        return $query->result();
        
    } 


    /**
     * Problemas da subcategoria
     *
     * Retorna lista de problemas da subcategoria
     * @param $id id da subcategoria.
     */
    public function problemas_subcategoria($id){

        /**
         * Montando select
         */
        $sql = "
                Select
                  i.*,
                  a.*
                From
                  ss_problema_solicitacao_servico i Left Join
                  aux_prioridade a On i.id_prioridade = a.id_prioridade
                Where
                  i.token_id_cat_solicitacao_servico = '$id'
                ";  

        $query = $this->db->query($sql);

        return $query->result();
        
    } 


    /**
     * Lista status solicitacao Servicos
     *
     * Retorna lista de status de solicitacao  de servico
     */
    public function categorias_solicitacao_servico($categoria = ''){


        if ($categoria == '') {
             /**
             * Montando select
             */
            $sql = "
                        SELECT
                            *
                        FROM
                            infra_cat_solicitacao_servico 
                        WHERE    
                             sit_ativo = 'S' AND token_company = '$this->company'  AND token_id_cat_pai IS NULL   
                        ORDER BY 
                            desc_cat_solicitacao_servico     
                    ";
        }
        else
        {
             /**
             * Montando select
             */
            $sql = "
                        SELECT
                            *
                        FROM
                            infra_cat_solicitacao_servico 
                        WHERE    
                             sit_ativo = 'S' AND token_company = '$this->company'  AND token_id_cat_pai = '$categoria'   
                        ORDER BY 
                            desc_cat_solicitacao_servico     
                    ";

        }


        $query = $this->db->query($sql);

        return $query->result();
        
    } 


    /**
     * Problemas categoria solicitacao Servicos
     *
     * Retorna lista de todos os problema de uma categoria/subcategoria
     */
    public function problemas_categorias_solicitacao_servico($id_categoria){


        $sql = "
                    SELECT 
                        *
                    FROM 
                        infra_problema_solicitacao_servico 
                    WHERE 
                        token_id_cat_solicitacao_servico = '$id_categoria'
                    ORDER BY 
                        id_problema_solicitacao_servico        
                ";
   

        $query = $this->db->query($sql);

        return $query->result();
        
    } 

     /**
     * Problema solicitacao Servicos
     *
     * Retorna linha com problema de solicitacao  de servico
     * @param id_problema
     */
    public function problema_solicitacao_servico($id_problema){


        $sql = "
                    SELECT 
                        *
                    FROM 
                        infra_problema_solicitacao_servico 
                    WHERE 
                        token_id =  '$id_problema'
                    ORDER BY
                        id_problema_solicitacao_servico       
                ";
   

        $query = $this->db->query($sql);

        $row = $query->row();
        
        return $row;  

    }

     /**
     * Cat solicitacao de Servicos
     *
     * Retorna linha com categoria de solicitacao  de servico
     */
    public function cat_solicitacao_servico($categoria){


        $sql = "
                SELECT * FROM infra_cat_solicitacao_servico WHERE token_id =  '$categoria'   
               "; 

        $query = $this->db->query($sql);

        $row = $query->row();
        
        return $row;  

    }

    
 


        




    
}//Fim da classe
