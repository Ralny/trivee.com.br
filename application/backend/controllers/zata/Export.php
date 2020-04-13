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

header("Content-Type: text/html; charset=utf-8", true);

defined('BASEPATH') or exit('Não é permitido acesso direto ao script');

/**
 * Class Export
 *
 * Camada responsável por controlar a exportação de dados
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Export extends MY_Controller
{
    /**
     * Método construtor
     *
     * @access  public
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();

        /**
         * Identificador da empresa de origem do registro
         * Company identifier of record source
         */
        $this->company = $this->session->userdata('token_company');

        /**
         * Carregando model
         *
         */
        $this->load->model('zata/Export_model');
        $this->load->model('zata/Empresas_model');
        $this->load->model('zata/Useraccount_model');
    }

    /**
     * exportExcelData
     * Função auxiliar para exportação em xls
     */
    public function exportExcelData($records)
    {
        $heading = false;
        if (!empty($records)) {
            foreach ($records as $row) {
                if (!$heading) {
                    // Exibe os nomes dos campos/colunas na primeira linha
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", ($row)) . "\n";
            }
        }
    }//End Function

    /**
     * get_csv_eventos_utilizacao_de_salas
     *
     * Faz a exportacao de utilização de salas em .CSV
     */
    public function get_csv_eventos_utilizacao_de_salas()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_utilizacao_de_sala_'.date("Y-m-d h:i:s").'.csv';
        
        /**
         * Definiçaõ do header
         */
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$file_name.'"');

        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_utilizacao_de_salas('csv');

        /**
         * Configurações
         */
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");
   
        force_download($file_name, $data);
    }//End Function

    /**
     * get_xml_eventos_utilizacao_de_salas
     *
     * Faz a exportacao de utilização de salas em .XML
     */
    public function get_xml_eventos_utilizacao_de_salas()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_utilizacao_de_sala_'.time().'.xml';
        
        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_utilizacao_de_salas('xml');

        
        $config = array($config = array(
                                'root'     => 'root',
                                'element'  => 'element',
                                'newline'  => "\n",
                                'tab'           => "\t" )
                            );
                    

        $data = $this->dbutil->xml_from_result($query, $config);

        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");

        force_download($file_name, $data);
    }//End Function

    /**
     * get_xls_eventos_utilizacao_de_salas
     *
     * Faz a exportacao de utilização de salas em .XLS
     */
    public function get_xls_eventos_utilizacao_de_salas()
    {

        /**
         * Model dos dados que irão ser exportados
         */
        $data = $this->Export_model->eventos_utilizacao_de_salas('xls');

        $dataToExports = [];

        foreach ($data as $row) {
            $arrangeData['Utilizacao de Sala'] = mb_convert_encoding($row['desc_utilizacao_sala'], 'utf-16', 'utf-8');
            $arrangeData['Definicao'] 		   = mb_convert_encoding($row['desc_definicao'], 'utf-16', 'utf-8');
            $dataToExports[]	 			   = $arrangeData;
        }
        
        /***
         * Definir o nome do arquivo
         */
        $filename = "tpl_exp_Eventos_utilizacao_salas.xls";
        
        /**
         * Definiçaõ do header
         */
        header("Content-Type: application/vnd.ms-excel;charset = UTF-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
         
        /**
         * exportExcelData
         * Função auxiliar para exportação em xls
         *
         */
        $this->exportExcelData($dataToExports);
    }

    /**
     * Faz a exportação PDF da listagem de utilização de salas
     *
     * $preview_type - [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
     *                  [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
     */
    public function get_pdf_eventos_utilizacao_de_salas()
    {
        /*
         * $preview_type
         * [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
         * [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
         */
        $preview_type = 'pdf';

        /**
         * Dados da Empresa que o usuario esta logado
         */
        $company_data = $this->Empresas_model->company_data($this->session->userdata('token_company'));
        
        /**
         * Dados do usuario que esta gerando relatorio
         */
        $user_data = $this->Useraccount_model->user_data($this->session->userdata('id_usuario'));


        /**
         * Configurações Basicas
         */

        $page_data = array(
            "desc_modulo"           => 'EVENTOS',
            "desc_configuracoes"    => 'UTILIZAÇÃO DE SALA',
            "tipo_exportacao"       => 'PDF',
            "total_registros"       => count($this->Export_model->eventos_utilizacao_de_salas()),
            "lista"                 => $this->Export_model->eventos_utilizacao_de_salas(),
            "num_registro_pagina"   => 22,
            "descricao_principal"   => 'LISTAGEM DE UTILIZAÇÃO DE SALAS',
            "nome_usuario"          => strtoupper($user_data->nome.' '.$user_data->sobrenome),
            "dth_criacao_relatorio" => strtoupper(data_extenso(date("Y-m-d h:i:s"))),
            "nome_empresa_cnpj"     => strtoupper($company_data->razao_social.' - '.$company_data->numCNPJ),
            "endereco_empresa"      => strtoupper($company_data->endereco.','. $company_data->numero .'/'. $company_data->complemento.','.
                                                  $company_data->bairro .'-'. $company_data->cep .' '.  $company_data->cidade.'/'. $company_data->uf),
            
         );

        
        /**
         * Em produção, passar o parametro [pdf], em desenvolvimento  utilizar o parametro [html]
         */
        if ($preview_type == 'pdf') {
            
            /***
             * Carregando a view
             */
            $html = $this->load->view('print/eventos/utilizacao_salas_lista_pdf', $page_data, true);

            /***
             * Definir o nome do arquivo
             */
            $filename = "utilizacao_salas_lista-" . time();

            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */
            $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
        } else {
            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */
            $this->load->view('print/eventos/utilizacao_salas_lista_pdf', $page_data);
        }
    } //End Function

    /**
     * get_csv_eventos_formatos_de_salas
     *
     * Faz a exportacao de formato de salas em .CSV
     */
    public function get_csv_eventos_formatos_de_salas()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_formato_de_sala_'.date("Y-m-d h:i:s").'.csv';
        
        /**
         * Definiçaõ do header
         */
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$file_name.'"');

        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_formatos_de_salas('csv');

        /**
         * Configurações
         */
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");
   
        force_download($file_name, $data);
    }//End Function

    /**
     * get_xml_eventos_formatos_de_salas
     *
     * Faz a exportacao de formatos de salas em .XML
     */
    public function get_xml_eventos_formatos_de_salas()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_utilizacao_de_sala_'.time().'.xml';
        
        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_formatos_de_salas('xml');

        
        $config = array($config = array(
                                'root'     => 'root',
                                'element'  => 'element',
                                'newline'  => "\n",
                                'tab'           => "\t" )
                            );
                    

        $data = $this->dbutil->xml_from_result($query, $config);

        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");

        force_download($file_name, $data);
    }//End Function

     /**
     * get_xls_eventos_formatos_de_salas
     *
     * Faz a exportacao de formatos de salas em .XLS
     */
    public function get_xls_eventos_formatos_de_salas()
    {
        /**
         * Model dos dados que irão ser exportados
         */
        $data = $this->Export_model->eventos_formatos_de_salas('xls');

        $dataToExports = [];

        foreach ($data as $row) {
            $arrangeData['Formatos de Sala'] = mb_convert_encoding($row['desc_formato_de_sala'], 'utf-16', 'utf-8');
            $dataToExports[]	 			   = $arrangeData;
        }
        
        /***
         * Definir o nome do arquivo
         */
        $filename = "tpl_exp_Eventos_formatos_salas.xls";
        
        /**
         * Definiçaõ do header
         */
        header("Content-Type: application/vnd.ms-excel;charset = UTF-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
         
        /**
         * exportExcelData
         * Função auxiliar para exportação em xls
         *
         */
        $this->exportExcelData($dataToExports);
    }

    /**
     * Faz a exportação PDF de formatos de salas
     *
     * $preview_type - [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
     *                  [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
     */
    public function get_pdf_eventos_formatos_de_salas()
    {
        /*
         * $preview_type
         * [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
         * [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
         */
        $preview_type = 'pdf';

        /**
         * Dados da Empresa que o usuario esta logado
         */
        $company_data = $this->Empresas_model->company_data($this->session->userdata('token_company'));
        
        /**
         * Dados do usuario que esta gerando relatorio
         */
        $user_data = $this->Useraccount_model->user_data($this->session->userdata('id_usuario'));


        /**
         * Configurações Basicas
         */

        $page_data = array(
            "desc_modulo"           => 'EVENTOS',
            "desc_configuracoes"    => 'FORMATOS DE SALA',
            "tipo_exportacao"       => 'PDF',
            "total_registros"       => count($this->Export_model->eventos_formatos_de_salas()),
            "lista"                 => $this->Export_model->eventos_formatos_de_salas(),
            "num_registro_pagina"   => 22,
            "descricao_principal"   => 'LISTAGEM DE FORMATOS DE SALAS',
            "nome_usuario"          => strtoupper($user_data->nome.' '.$user_data->sobrenome),
            "dth_criacao_relatorio" => strtoupper(data_extenso(date("Y-md h:i:s"))),
            "nome_empresa_cnpj"     => strtoupper($company_data->razao_social.' - '.$company_data->numCNPJ),
            "endereco_empresa"      => strtoupper($company_data->endereco.','. $company_data->numero .'/'. $company_data->complemento.','.
                                                  $company_data->bairro .'-'. $company_data->cep .' '.  $company_data->cidade.'/'. $company_data->uf),
            
         );
        
        /**
         * Em produção, passar o parametro [pdf], em desenvolvimento  utilizar o parametro [html]
         */
        if ($preview_type == 'pdf') {
            
            /***
             * Carregando a view
             */
            $html = $this->load->view('print/eventos/formatos_de_salas_lista_pdf', $page_data, true);

            /***
             * Definir o nome do arquivo
             */
            $filename = "formatos_de_salas_lista-" . time();

            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */

            $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
        } else {
            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */
            $this->load->view('print/eventos/formatos_de_salas_lista_pdf', $page_data);
        }
    } //End Function

    /**
    * get_csv_eventos_salas
    *
    * Faz a exportacao de salas de eventos em .CSV
    */
    public function get_csv_eventos_salas()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_salas_'.date("Y-m-d h:i:s").'.csv';
        
        /**
         * Definiçaõ do header
         */
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$file_name.'"');

        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_salas('csv');

        /**
         * Configurações
         */
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");
   
        force_download($file_name, $data);
    }//End Function

    /**
    * get_xml_eventos_salas
    *
    * Faz a exportacao de salas em .XML
    */
    public function get_xml_eventos_salas()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_salas_'.time().'.xml';
        
        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_salas('xml');
        
        $config = array($config = array(
                                'root'     => 'root',
                                'element'  => 'element',
                                'newline'  => "\n",
                                'tab'           => "\t" )
                            );
                    

        $data = $this->dbutil->xml_from_result($query, $config);

        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");

        force_download($file_name, $data);
    }//End Function

     /**
     * get_xls_eventos_salas
     *
     * Faz a exportacao de salas em .XLS
     */
    public function get_xls_eventos_salas()
    {
        /**
         * Model dos dados que irão ser exportados
         */
        $data = $this->Export_model->eventos_salas('xls');

        $dataToExports = [];

        foreach ($data as $row) {
            $arrangeData['Formatos de Sala'] = mb_convert_encoding($row['nome_sala'], 'utf-16', 'utf-8');
            $arrangeData['Formatos de Sala'] = mb_convert_encoding($row['dimensoes'], 'utf-16', 'utf-8');
            $arrangeData['Formatos de Sala'] = mb_convert_encoding($row['area'], 'utf-16', 'utf-8');
            $arrangeData['Formatos de Sala'] = mb_convert_encoding($row['pe_direito'], 'utf-16', 'utf-8');
            $arrangeData['Formatos de Sala'] = mb_convert_encoding($row['valor_diaria_trf_balcao'], 'utf-16', 'utf-8');
            $arrangeData['Formatos de Sala'] = mb_convert_encoding($row['valor_diaria_trf_especial_iss'], 'utf-16', 'utf-8');
            $dataToExports[]	 			 = $arrangeData;
        }
        
        /***
         * Definir o nome do arquivo
         */
        $filename = "tpl_exp_Eventos_salas.xls";
        
        /**
         * Definiçaõ do header
         */
        header("Content-Type: application/vnd.ms-excel;charset = UTF-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
         
        /**
         * exportExcelData
         * Função auxiliar para exportação em xls
         *
         */
        $this->exportExcelData($dataToExports);
    }

    /**
     * Faz a exportação PDF de salas
     *
     * $preview_type - [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
     *                  [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
     */
    public function get_pdf_eventos_salas()
    {
        /*
         * $preview_type
         * [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
         * [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
         */
        $preview_type = 'pdf';

        /**
         * Dados da Empresa que o usuario esta logado
         */
        $company_data = $this->Empresas_model->company_data($this->session->userdata('token_company'));
        
        /**
         * Dados do usuario que esta gerando relatorio
         */
        $user_data = $this->Useraccount_model->user_data($this->session->userdata('id_usuario'));

        /**
         * Configurações Basicas
         */
        $page_data = array(
            "desc_modulo"           => 'EVENTOS',
            "desc_configuracoes"    => 'SALAS',
            "tipo_exportacao"       => 'PDF',
            "total_registros"       => count($this->Export_model->eventos_salas()),
            "lista"                 => $this->Export_model->eventos_salas(),
            "num_registro_pagina"   => 22,
            "descricao_principal"   => 'LISTAGEM DE SALAS',
            "nome_usuario"          => strtoupper($user_data->nome.' '.$user_data->sobrenome),
            "dth_criacao_relatorio" => strtoupper(data_extenso(date("Y-m-d h:i:s"))),
            "nome_empresa_cnpj"     => strtoupper($company_data->razao_social.' - '.$company_data->numCNPJ),
            "endereco_empresa"      => strtoupper($company_data->endereco.','. $company_data->numero .'/'. $company_data->complemento.','.
                                                  $company_data->bairro .'-'. $company_data->cep .' '.  $company_data->cidade.'/'. $company_data->uf)            
         );

        /**
         * Em produção, passar o parametro [pdf], em desenvolvimento  utilizar o parametro [html]
         */
        if ($preview_type == 'pdf') {
            
            /***
             * Carregando a view
             */
            $html = $this->load->view('print/eventos/salas_lista_pdf', $page_data, true);

            /***
             * Definir o nome do arquivo
             */
            $filename = "Eventos_salas_lista-" . time();

            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */
            $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
        } else {
            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */
            $this->load->view('print/eventos/salas_lista_pdf', $page_data);
        }
    } //End Function

    /**
     * get_csv_eventos_utilizacao_de_salas
     *
     * Faz a exportacao de utilização de salas em .CSV
     */
    public function get_csv_eventos_equipamentos()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_equipamentos_'.date("Y-m-d h:i:s").'.csv';
        
        /**
         * Definiçaõ do header
         */
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$file_name.'"');

        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_equipamentos('csv');

        /**
         * Configurações
         */
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");
   
        force_download($file_name, $data);
    }//End Function

    /**
     * get_xml_eventos_utilizacao_de_salas
     *
     * Faz a exportacao de utilização de salas em .XML
     */
    public function get_xml_eventos_equipamentos()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_EVENTOS_equipamentos_'.time().'.xml';
        
        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->eventos_equipamentos('xml');

        
        $config = array($config = array(
                                'root'     => 'root',
                                'element'  => 'element',
                                'newline'  => "\n",
                                'tab'           => "\t" )
                            );
                    

        $data = $this->dbutil->xml_from_result($query, $config);

        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");

        force_download($file_name, $data);
    }//End Function

     /**
     * get_xls_eventos_utilizacao_de_salas
     *
     * Faz a exportacao de utilização de salas em .XLS
     */
    public function get_xls_eventos_equipamentos()
    {

        /**
         * Model dos dados que irão ser exportados
         */
        $data = $this->Export_model->eventos_equipamentos('xls');

        $dataToExports = [];

        foreach ($data as $row) {
            $arrangeData['Equipamento']     = mb_convert_encoding($row['desc_equipamento'], 'utf-16', 'utf-8');
            $arrangeData['Quantidade'] 		= mb_convert_encoding($row['qtd_equipamento'], 'utf-16', 'utf-8');
            $arrangeData['Valor / dia'] 	= mb_convert_encoding($row['valor_diaria'], 'utf-16', 'utf-8');
            $arrangeData['Observacoes'] 	= mb_convert_encoding($row['observacoes'], 'utf-16', 'utf-8');
            $dataToExports[]	 			= $arrangeData;
        }
        
        /***
         * Definir o nome do arquivo
         */
        $filename = "tpl_exp_Eventos_equipamentos.xls";
        
        /**
         * Definiçaõ do header
         */
        header("Content-Type: application/vnd.ms-excel;charset = UTF-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
         
        /**
         * exportExcelData
         * Função auxiliar para exportação em xls
         *
         */
        $this->exportExcelData($dataToExports);
    }

    /**
     * Faz a exportação PDF da listagem de equipamentos
     *
     * $preview_type - [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
     *                  [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
     */
    public function get_pdf_eventos_equipamentos()
    {
        /*
         * $preview_type
         * [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
         * [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
         */
        $preview_type = 'pdf';

        /**
         * Dados da Empresa que o usuario esta logado
         */
        $company_data = $this->Empresas_model->company_data($this->session->userdata('token_company'));
        
        /**
         * Dados do usuario que esta gerando relatorio
         */
        $user_data = $this->Useraccount_model->user_data($this->session->userdata('id_usuario'));

        /**
         * Configurações Basicas
         */
        $page_data = array(
            "desc_modulo"           => 'EVENTOS',
            "desc_configuracoes"    => 'EQUIPAMENTOS',
            "tipo_exportacao"       => 'PDF',
            "total_registros"       => count($this->Export_model->eventos_equipamentos()),
            "lista"                 => $this->Export_model->eventos_equipamentos(),
            "num_registro_pagina"   => 13,
            "descricao_principal"   => 'LISTAGEM DE EQUIPAMENTOS',
            "nome_usuario"          => strtoupper($user_data->nome.' '.$user_data->sobrenome),
            "dth_criacao_relatorio" => strtoupper(data_extenso(date("Y-m-d h:i:s"))),
            "nome_empresa_cnpj"     => strtoupper($company_data->razao_social.' - '.$company_data->numCNPJ),
            "endereco_empresa"      => strtoupper($company_data->endereco.','. $company_data->numero .'/'. $company_data->complemento.','.
                                                  $company_data->bairro .'-'. $company_data->cep .' '.  $company_data->cidade.'/'. $company_data->uf),
            
         );
        
        /**
         * Em produção, passar o parametro [pdf], em desenvolvimento  utilizar o parametro [html]
         */
        if ($preview_type == 'pdf') {
            
            /***
             * Carregando a view
             */
            $html = $this->load->view('print/eventos/equipamentos_lista_pdf', $page_data, true);

            /***
             * Definir o nome do arquivo
             */
            $filename = "Eventos_equipamentos-" . time();

            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */
            $this->pdfgenerator->generate($html, $filename, true, 'A4', 'landscape');
        } else {
            /***
             * Metodo responsavel por renderizar um pagina html ou php em PDF
             */
            $this->load->view('print/eventos/equipamentos_lista_pdf', $page_data);
        }
    } //End Function

    /**
     * get_csv_patrimonio_grupos_de_bens
     *
     * Faz a exportacao de patrimonio / grupos de bens em .CSV
     */
    public function get_csv_patrimonio_grupos_de_bens()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_PATRIMONIO_grupos_de_bens_'.date("Y-m-d h:i:s").'.csv';
        
        /**
         * Definiçaõ do header
         */
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$file_name.'"');

        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->patrimonio_grupos_de_bens('csv');

        /**
         * Configurações
         */
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");
   
        force_download($file_name, $data);

    }//End Function

    /**
     * get_xml_patrimonio_grupos_de_bens
     *
     * Faz a exportacao de patrimonio / grupos de bens em .XML
     */
    public function get_xml_patrimonio_grupos_de_bens()
    {
        /**
         * Nome do Arquivo
         */
        $file_name = 'ZATA_PATRIMONIO_grupos_de_bens_'.time().'.xml';
        
        /**
         * Dados que vão ser exportados
         */
        $query = $this->Export_model->patrimonio_grupos_de_bens('xml');

        
        $config = array($config = array(
                                'root'     => 'root',
                                'element'  => 'element',
                                'newline'  => "\n",
                                'tab'           => "\t" )
                            );
                    

        $data = $this->dbutil->xml_from_result($query, $config);

        $data = mb_convert_encoding($data, "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");

        force_download($file_name, $data);

    }//End Function

     /**
     * get_xls_patrimonio_grupos_de_bens
     *
     * Faz a exportacao de patrimonio / grupos de bens em .XLS
     */
    public function get_xls_patrimonio_grupos_de_bens()
    {

        /**
         * Model dos dados que irão ser exportados
         */
        $data = $this->Export_model->patrimonio_grupos_de_bens('xls');

        $dataToExports = [];

        foreach ($data as $row) {
            $arrangeData['Grupo de Bem']      = mb_convert_encoding($row['desc_grupo_bem'], 'utf-16', 'utf-8');
            $arrangeData['Depreciacao Anual'] = mb_convert_encoding($row['depreciacao_anual'], 'utf-16', 'utf-8');
            $arrangeData['Observacoes'] 	  = mb_convert_encoding($row['obsv_grupo_bem'], 'utf-16', 'utf-8');
            $dataToExports[]	 			  = $arrangeData;
        }
        
        /***
         * Definir o nome do arquivo
         */
        $filename = "tpl_exp_Patrimonio_grupos_de_bens.xls";
        
        /**
         * Definiçaõ do header
         */
        header("Content-Type: application/vnd.ms-excel;charset = UTF-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
         
        /**
         * exportExcelData
         * Função auxiliar para exportação em xls
         */
        $this->exportExcelData($dataToExports);
    }

    /**
     * get_pdf_patrimonio_grupos_de_bens
     * 
     * Faz a exportação PDF de patrimonio / grupos de bens
     *
     * $preview_type - [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
     *                  [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
     */
    public function get_pdf_patrimonio_grupos_de_bens()
    {
        /*
         * $preview_type
         * [html] utilizar em desenvolvimento para auxiliar a criação do arquivo que vai ser exportado em pdf
         * [pdf] utilizar esse quando o desenvolvimento for concluido e liberar para produção
         */
        $preview_type = 'pdf';

        /**
         * Dados da Empresa que o usuario esta logado
         */
        $company_data = $this->Empresas_model->company_data($this->session->userdata('token_company'));
        
        /**
         * Dados do usuario que esta gerando relatorio
         */
        $user_data = $this->Useraccount_model->user_data($this->session->userdata('id_usuario'));

        /**
         * Configurações Basicas
         */
        $page_data = array(
            "desc_modulo"           => 'PATRIMONIO',
            "desc_configuracoes"    => 'GRUPOS DE BENS',
            "tipo_exportacao"       => 'PDF',
            "total_registros"       => count($this->Export_model->patrimonio_grupos_de_bens()),
            "lista"                 => $this->Export_model->patrimonio_grupos_de_bens(),
            "num_registro_pagina"   => 13,
            "descricao_principal"   => 'LISTAGEM DE GRUPOS DE BENS',
            "nome_usuario"          => strtoupper($user_data->nome.' '.$user_data->sobrenome),
            "dth_criacao_relatorio" => strtoupper(data_extenso(date("Y-m-d h:i:s"))),
            "nome_empresa_cnpj"     => strtoupper($company_data->razao_social.' - '.$company_data->numCNPJ),
            "endereco_empresa"      => strtoupper($company_data->endereco.','. $company_data->numero .'/'. $company_data->complemento.','.
                                                  $company_data->bairro .'-'. $company_data->cep .' '.  $company_data->cidade.'/'. $company_data->uf)
         );
        
        /**
         * Em produção, passar o parametro [pdf], em desenvolvimento  utilizar o parametro [html]
         */
        if ($preview_type == 'pdf') {
            
            /***
             * Carregando a view
             */
            $html = $this->load->view('print/patrimonio/grupos_de_bens_pdf', $page_data, true);

            /***
             * Definir o nome do arquivo
             */
            $filename = "patrimonio_grupos_de_bens-" . time();

            /***
             * Metodo responsavel por renderizar um pagina html ou PDF
             */
            $this->pdfgenerator->generate($html, $filename, true, 'A4', 'landscape');
        } else {
            /***
             * Metodo responsavel por renderizar um pagina html ou PDF
             */
            $this->load->view('print/patrimonio/grupos_de_bens_pdf', $page_data);
        }
    } //End Function







}//End Class
