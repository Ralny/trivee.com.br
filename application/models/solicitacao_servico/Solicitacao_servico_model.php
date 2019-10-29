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
 * Class Model Infra_solicitacao_servico 
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
class Infra_solicitacao_servico_model extends MY_Model {

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
        $this->table    = "ss_solicitacao_servico";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_solicitacao_servico";
        
    }


    /**
     * Lista solicitacoes Recebidas 
     *
     * Lists unanalyzed requests
     *
     * @return void
     */
    public function lista_solicitacoes_recebidas($status_solicitacao){


        // Nao analizada
        if ($status_solicitacao == 1)
        {
            $sql = '
                       Select
                        s.dth_abertura_solicitacao,
                        s.token_id,
                        s.id_prioridade AS prioridade,
                        t.desc_status_solicitacao AS status,
                        u.id_usuario,
                        u.nome,
                        u.sobrenome,
                        a.desc_area_instalacao AS area,
                        p.desc_problema_solicitacao_servico AS problema,
                        subcat.desc_cat_solicitacao_servico AS subcategoria,
                        cat.desc_cat_solicitacao_servico AS categoria,
                        t.id_status_solicitacao,
                        s.id_responsavel_tecnico,
                        s.id_solicitante,
                        ap.sla
                      From
                        infra_solicitacao_servico s
                        Left Join infra_status_solicitacao t ON t.id_status_solicitacao = s.id_status_solicitacao
                        Left Join usu_usuario u ON u.id_usuario = s.id_responsavel_tecnico
                        Left Join infra_areas_e_instalacoes a ON a.id_area_instalacao = s.id_area_instalacao
                        Left Join infra_problema_solicitacao_servico p ON s.token_id_problema_solicitacao_servico = p.token_id
                        Left Join infra_cat_solicitacao_servico subcat ON subcat.token_id = p.token_id_cat_solicitacao_servico
                        Left Join infra_cat_solicitacao_servico cat ON cat.token_id = subcat.token_id_cat_pai
                        Left Join aux_prioridade ap ON ap.id_prioridade = s.id_prioridade
                      Where
                        t.id_status_solicitacao = '.$status_solicitacao.' AND
                        s.id_responsavel_tecnico = '.$this->session->userdata('id_usuario').'
                      Order by
                        prioridade
                  ';       
        }
        // Analizada
        else
        {
            $sql = ' 
                    Select
                      s.dth_abertura_solicitacao,
                      s.token_id,
                      s.id_prioridade AS prioridade,
                      t.desc_status_solicitacao AS status,
                      u.id_usuario,
                      u.nome,
                      u.sobrenome,
                      a.desc_area_instalacao AS area,
                      p.desc_problema_solicitacao_servico AS problema,
                      subcat.desc_cat_solicitacao_servico AS subcategoria,
                      cat.desc_cat_solicitacao_servico AS categoria,
                      t.id_status_solicitacao,
                      s.id_responsavel_tecnico,
                      s.id_solicitante,
                      aux_prioridade.sla
                    From
                      infra_solicitacao_servico s
                      Left Join infra_status_solicitacao t ON t.id_status_solicitacao = s.id_status_solicitacao
                      Left Join usu_usuario u ON u.id_usuario = s.id_responsavel_tecnico
                      Left Join infra_areas_e_instalacoes a ON a.id_area_instalacao = s.id_area_instalacao
                      Left Join infra_problema_solicitacao_servico p ON s.token_id_problema_solicitacao_servico = p.token_id
                      Left Join infra_cat_solicitacao_servico subcat ON subcat.token_id = p.token_id_cat_solicitacao_servico
                      Left Join infra_cat_solicitacao_servico cat ON cat.token_id = subcat.token_id_cat_pai
                      Left Join aux_prioridade ON aux_prioridade.id_prioridade = s.id_prioridade
                    Where
                      t.id_status_solicitacao Not in (1, 100, 300) AND
                      s.id_responsavel_tecnico = '.$this->session->userdata('id_usuario').' AND
                      t.id_status_solicitacao <> 200
                     Order by
                      prioridade 
                  ';    

        }    
        
        $query  = $this->db->query($sql);

        return $query->result();     
    }

    /**
     * Lista solicitacoes Recebidas 
     *
     * Lists unanalyzed requests
     *
     * @return void
     */
    public function lista_solicitacoes_solicitadas($status_solicitacao){

        // Nao analizada
        if ($status_solicitacao == 1)
        {
            $sql = '
                       Select
                        s.dth_abertura_solicitacao,
                        s.token_id,
                        s.id_prioridade AS prioridade,
                        t.desc_status_solicitacao AS status,
                        u.id_usuario,
                        u.nome,
                        u.sobrenome,
                        a.desc_area_instalacao AS area,
                        p.desc_problema_solicitacao_servico AS problema,
                        subcat.desc_cat_solicitacao_servico AS subcategoria,
                        cat.desc_cat_solicitacao_servico AS categoria,
                        t.id_status_solicitacao,
                        s.id_responsavel_tecnico,
                        s.id_solicitante,
                        ap.sla
                      From
                        infra_solicitacao_servico s
                        Left Join infra_status_solicitacao t ON t.id_status_solicitacao = s.id_status_solicitacao
                        Left Join usu_usuario u ON u.id_usuario = s.id_responsavel_tecnico
                        Left Join infra_areas_e_instalacoes a ON a.id_area_instalacao = s.id_area_instalacao
                        Left Join infra_problema_solicitacao_servico p ON s.token_id_problema_solicitacao_servico = p.token_id
                        Left Join infra_cat_solicitacao_servico subcat ON subcat.token_id = p.token_id_cat_solicitacao_servico
                        Left Join infra_cat_solicitacao_servico cat ON cat.token_id = subcat.token_id_cat_pai
                        Left Join aux_prioridade ap ON ap.id_prioridade = s.id_prioridade
                      Where
                        t.id_status_solicitacao = '.$status_solicitacao.' AND
                        s.id_solicitante = '.$this->session->userdata('id_usuario').'
                      Order by
                        prioridade
                  ';            
        }
        // Analizada
        else
        {
            $sql = ' 
                    Select
                      s.dth_abertura_solicitacao,
                      s.token_id,
                      s.id_prioridade AS prioridade,
                      t.desc_status_solicitacao AS status,
                      u.id_usuario,
                      u.nome,
                      u.sobrenome,
                      a.desc_area_instalacao AS area,
                      p.desc_problema_solicitacao_servico AS problema,
                      subcat.desc_cat_solicitacao_servico AS subcategoria,
                      cat.desc_cat_solicitacao_servico AS categoria,
                      t.id_status_solicitacao,
                      s.id_responsavel_tecnico,
                      s.id_solicitante,
                      aux_prioridade.sla
                    From
                      infra_solicitacao_servico s
                      Left Join infra_status_solicitacao t ON t.id_status_solicitacao = s.id_status_solicitacao
                      Left Join usu_usuario u ON u.id_usuario = s.id_responsavel_tecnico
                      Left Join infra_areas_e_instalacoes a ON a.id_area_instalacao = s.id_area_instalacao
                      Left Join infra_problema_solicitacao_servico p ON s.token_id_problema_solicitacao_servico = p.token_id
                      Left Join infra_cat_solicitacao_servico subcat ON subcat.token_id = p.token_id_cat_solicitacao_servico
                      Left Join infra_cat_solicitacao_servico cat ON cat.token_id = subcat.token_id_cat_pai
                      Left Join aux_prioridade ON aux_prioridade.id_prioridade = s.id_prioridade
                    Where
                      t.id_status_solicitacao Not in (1, 100, 300) AND
                      s.id_solicitante = '.$this->session->userdata('id_usuario').' AND
                      t.id_status_solicitacao <> 200
                     Order by
                      prioridade 
                  ';      
        }    
        
        $query  = $this->db->query($sql);

        return $query->result();     
    }
 

    /**
     * Buscar Num SS 
     *
     * Retorna o ultimo numero da solicitacao de servico
     *
     * @return void
     */
    public function buscar_num_ss(){

        $sql    = "SELECT MAX(numero_solicitacao) AS ultima_ss FROM infra_solicitacao_servico WHERE token_company = '$this->company'";
        
        $query  = $this->db->query($sql);

        $num_ss = $query->row();

        return $num_ss->ultima_ss;  
    
    }

    /**
     * Lista status solicitacao Servicos
     *
     * Retorna lista de status de solicitacao  de servico
     */
    public function lista_status_solicitacao_servico(){

        /**
         * Montando select
         */
        $sql = "Select
                  *
                From
                  infra_status_solicitacao
                ";

        $query = $this->db->query($sql);

        return $query->result();
        
    }

    /**
     * Prioridade Solicitacao Servico 
     *
     * Retorna a prioridade do problema da solicitacao de servico
     *
     * @return void
     */
    public function prioridade_solicitacao_servico($problema){

        $sql    = "
                    Select
                      p.id_prioridade As prioridade
                    From
                      infra_problema_solicitacao_servico p
                    Where
                      p.token_id = '$problema'
                    ";
        
        $query  = $this->db->query($sql);

        $row = $query->row();

        return $row->prioridade;  
    
    }

    /**
     * Define Responsavel Tecnico 
     *
     * Retorna quem eh o responsavel tecnico pelo da Solicitacao de Servico
     *
     * @return void
     */
    public function retorna_responsavel_tecnico_solicitacao_servico($problema){

        $sql    = "
                    Select
                      p.desc_problema_solicitacao_servico,
                      p.token_id,
                      c.desc_cat_solicitacao_servico,
                      u.nome,
                      u.sobrenome,
                      u.id_usuario
                    From
                      zata.infra_problema_solicitacao_servico p
                      Inner Join zata.infra_cat_solicitacao_servico c ON c.token_id = p.token_id_cat_solicitacao_servico
                      Inner Join zata.usu_usuario u ON u.id_usuario = c.id_responsavel_tecnico
                    Where
                      p.token_id = '$problema'
                    ";
        
        $query  = $this->db->query($sql);

        $row = $query->row();

        return $row->id_usuario;  
    
    }


    /**
     * Buscar Numero da Tarefa 
     *
     * Retorna o ultimo numero da tarefa
     *
     * @return void
     */
    public function buscar_num_tarefa(){

        $sql    = 'SELECT MAX(numero_tarefa) AS ultima_tarefa FROM tar_tarefa';
        
        $query  = $this->db->query($sql);

        $num = $query->row();

        return $num->ultima_tarefa;  
    
    }

    
 


        




    
}//Fim da classe
