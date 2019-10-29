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
 * Class Model Eventos_salas 
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
class Eventos_salas_model extends MY_Model {

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
        $this->table    = "eve_salas";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_sala";
        
    } 

    
    /**
     *  Lista Salas 
     *
     * Retorna lista de itens de uma requisicao
     * @param $id id do cliente.
     * @return nome do cliente
     */
    public function lista_salas_combox(){

        /**
         * Montando select
         */
        $sql = "
                SELECT
                    id_sala,
                    nome_sala,
                    token_company,
                    sit_ativo
                FROM
                    eve_salas
                WHERE
                    sit_ativo = 'S' AND token_company =  '$this->company'
                ORDER BY nome_sala
                ";

        $query = $this->db->query($sql);

        return $query->result();
        
    } 
    
    
    /**
     *  Lista arrumações da Sala 
     *
     * Retorna lista de itens de uma requisicao
     * @param $id id do cliente.
     * @return nome do cliente
     */
    public function lista_arrumacao_sala($id_sala){

        /**
         * Montando select
         */
        $sql = "
                SELECT
                    id_arrumacao,
                    f.desc_formato_de_sala,
                    a.num_pax,
                    a.tempo_montagem,
                    a.tempo_desmontagem,
                    a.id_sala
                FROM
                    eve_arrumacao_sala a
                    INNER JOIN eve_formato_de_sala f ON f.id_formato_de_sala = a.id_formato_de_sala
                WHERE
                    a.id_sala = $id_sala
                ORDER BY f.desc_formato_de_sala    
               ";

        $query = $this->db->query($sql);

        return $query->result();
        
    } 

    /**
     * Lista status solicitacao Servicos
     *
     * Retorna lista de status de solicitacao  de servico
     */
    public function get_sala($id_sala){

        /**
         * Montando select
         */
        $sql = "
                SELECT
                   *
                FROM
                    eve_salas
                WHERE
                    token_company = '$this->company' AND
                    id_sala = $id_sala
                ";

        $query = $this->db->query($sql);

        return $query->result();
    
    }
    
    /**
     * Lista status solicitacao Servicos
     *
     * Retorna lista de status de solicitacao  de servico
     */
    public function get_arrumacao($id_formato_de_sala, $id_sala){

        /**
         * Montando select
         */
        $sql = "
                SELECT
                   *
                FROM
                    eve_arrumacao_sala
                WHERE
                    id_formato_de_sala = $id_formato_de_sala AND id_sala = $id_sala
                ";

        $query = $this->db->query($sql);

        return $query->result();
    
    }    
        
    
    
    
 


        




    
}//Fim da classe
