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

class UserAccount_model extends MY_Model
{

    //Nome da tabela
    protected $_table = "usu_usuario";
    //Chave primaria
    protected $_primary_key = "id_usuario";
    
    /**
    * Verificando se existe usuario correspondente ao email e senha passados pelo formulario de login
    * @author Ralny Andrade de Oliveira
    * @version 1.0
    * @since 30/09/2015
    */
    public function login($login, $senha)
    {

        //       Observação da consula:
        //       Se sitExclusao = N (Usuario não foi excluido) se sitExclusao = S (Usuario foi "excluido" do sistema. Imporssibilitado de realizar o login)
        $sql = "
                Select
                      *
                    From
                      ".$this->_table."
                    Where
                      email = '".$login."' And
                      senha = '".$senha."'             
                ";


        //execultando a consulta
        $query = $this->db->query($sql);
        //Verifica se existe HUM resultado valido para realização do login
        if (count($query->result()) == 1) {
            //retornando dados da consulta para o controller UserAccount (Vai armazenar dados do usuario na sessao autenticada)
            return $query->row();
        }
        //se não existir nenhum resultado na consulta o login falhou
        return false;
    }

    /**
    * Verificando se existe ja existe usuario cadastrado - Utiliza o numero de CPF
    * @author Ralny Andrade de Oliveira
    * @version 1.0
    * @since 23/02/2016
    */
    public function request_register($cpf)
    {

        //       Observação da consula:
        //       sitRequestRegister = P (Solicitação de Aprovação) se sitRequestRegister = P (Solicitação pendente) se sitRequestRegister = A (Solicitação Aprovada)
        $sql = "
                Select
                      *
                    From
                      ".$this->_table."
                    Where
                      numCPF = '".$cpf."'                 
                ";

        //execultando a consulta
        $query = $this->db->query($sql);
        //Verifica se existe HUM resultado valido para realização do login
        if (count($query) == 1) {
            //retornando dados da consulta para o controller UserAccount
            return $query->row();
        }
        //se não existir nenhum resultado na consulta não existe usuario cadastrado nem solicitação de registro
        return false;
    }

    /**
    * Registrando Logs no Login do Usuario
    */
    public function insertLogLoginUsuario($dados)
    {
        return $this->db->insert('_log_login_usuario', $dados);
    }

    /**
    * Retornando Informações de Usuario
    */
    public function user_data($id)
    {
      
        //       Observação da consula:
        //       Se sitExclusao = N (Usuario não foi excluido) se sitExclusao = S (Usuario foi "excluido" do sistema.)
        $sql = "
                Select
                      *
                    From
                      ".$this->_table."
                    Where
                      id_usuario = '".$id."'
                    And
                      sit_ativo = 'S'                 
                ";


        //execultando a consulta
        $query = $this->db->query($sql);
        //Retorna consulta
        return $query->row();
    }

    /**
    * Insert
    */
    public function insert($dados)
    {
        return $this->db->insert($this->_table, $dados);
    }

    /**
     * Listar Usuarios
     *
     * Retorna lista de locais e instalacoes
     */
    public function listar_usuarios()
    {

        /**
         * Montando select
         */
        $sql = "
                SELECT
                  *
                FROM
                  usu_usuario
                WHERE
                  token_company = '$this->company'
                ORDER BY  
                  nome  
               ";

        $query = $this->db->query($sql);

        return $query->result();
    }
}//Fim da classe
