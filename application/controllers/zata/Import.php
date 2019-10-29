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

//https://ajuda.rdstation.com.br/hc/pt-br/articles/205623999-Como-eu-crio-um-arquivo-CSV-

/**
 * Class Import 
 *
 * Camada responsável por controlar a importacao de dados 
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Import extends MY_Controller
{

  /**
    * Método construtor
    *
    * @access  public
    * @return  void
    */
  function __construct() 
  {
    parent::__construct();

   /**
    * Carregando model
    *
    */
   $this->load->model('zata/import_model');

    /**
    * Library responsavel pelo controle da importacao
    *
    */
    $this->load->library('csvimport');
  }

  /**
   * Faz a importação do CSV de Produtos
   *
   * @access  public
   * @return  void
   */
  function importar_csv_produtos() 
  {

    // Define as configurações para o upload do CSV
    $config['upload_path'] = './files/import/';
    $config['allowed_types'] = 'csv';
    $config['max_size'] = '2000';

    // Carregando library de upload
    $this->load->library('upload', $config);

    // Se o upload falhar, exibe mensagem de erro na view
    if (!$this->upload->do_upload('csvfile')) 
    {
       /**
        * Criando sessao com mensagem  
        */
      $this->session->set_flashdata('msg','falha-importar');

      redirect(base_url('produtos/listar'));
    }
    else
    {

      $file_data = $this->upload->data();

      $file_path =  './files/import/'.$file_data['file_name'];

      // Chama o método 'get_array', da library csvimport, passando o path do
      // arquivo CSV. Esse método retornará um array.
      $csv_array = $this->csvimport->get_array($file_path);

      if ($csv_array) {

        // Faz a interação no array para poder gravar os dados na tabela 'contatos'
       foreach ($csv_array as $row)
       {

        $data['nome']   = $row['nome'];
        $data['codigo'] = $row['codigo'];

        // Insere os dados na tabela 'contatos'
        $this->import_model->insert_csv($this->input->post('tabela'),$data);

      }

      $this->session->set_flashdata('msg', 'importar-sucesso');

      redirect(base_url('produtos/listar'));
    }
    else
    {

      $data['error'] = "Ocorreu um erro, desculpe!";

      redirect(base_url('produtos/listar'));
    }

  }
}




}