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

header("Content-Type: text/html; charset=utf-8",true);

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

	/** https://github.com/bcit-ci/CodeIgniter/wiki/Export-to-Excel-2013
     *  https://www.w3school.info/2016/02/08/convert-html-to-pdf-in-codeigniter-using-mpdf/
	 * Método construtor
	 *
	 * @access  public
	 * @return  void
	 */
	function __construct()
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
		$this->load->model('zata/export_model');
	}

	function index(){
		echo 'aqui';
	}


	/**
	 * Faz a importação PDF de Produtos
	 *
	 * @access  public
	 * @return  void
	 */
	function get_pdf_produtos()
	{

		//load mPDF library
		$this->load->library('m_pdf');
		//load mPDF library


		//now pass the data//
		$this->data['title_portlet']     = "MY PDF TITLE 1.";
		$this->data['unidades_empresas'] = array();

		//now pass the data //


		$html = $this->load->view('relatorios/produtos/requisicao/print_requisicao/2189B11809FDCED8777F0BACD5DF16DC', $this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.

		//this the the PDF filename that user will get to download
		$pdfFilePath = "mypdfName-" . time() . "-download.pdf";


		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html, 2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");
	} //End Function

	/**
	 * Faz a importação PDF de Produtos
	 *
	 * @access  public
	 * @return  void
	 * https://www.studytutorial.in/how-to-export-data-from-database-to-excel-sheet-xls-using-codeigniter-php-tutorial
	 */
	function get_excel_produtos()
	{

		$this->load->model('zata/export_model');
		//$this->load->helper(array('form', 'url'));
		//$this->load->helper('download');
		//$this->load->library('PHPReport');

		// get data from databse
		$data = $this->export_model->produtos_excel();

		// var_dump($data);exit;

		$template = 'export_list_produtos.xlsx';
		//set absolute path to directory with template files
		$templateDir = './files/export/';

		//set config for report
		$config = array(
			'template' => $template,
			'templateDir' => $templateDir
		);


		//load template
		$R = new PHPReport($config);

		$R->load(
			array(
				'id' => 'pro_produtos',
				'repeat' => TRUE,
				'data' => $data
			)
		);

		// define output directoy 
		$output_file_dir = "./files/temp/";


		$output_file_excel = $output_file_dir  . "Myexcel.xlsx";
		//download excel sheet with data in /tmp folder
		$result = $R->render('excel', $output_file_excel);

		force_download($output_file_excel, NULL);
	} //End Function

	/**
	 * get_csv_eventos_utilizacao_de_salas
	 * Faz a exportacao de utilização de salas em .CSV
	 *
	 * @access  public
	 * @return  void
	 */
	function get_csv_eventos_utilizacao_de_salas()
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
		$query = $this->export_model->eventos_utilizacao_de_salas_csv();

		/**
		 * Configurações
		 */
		$delimiter = ",";
		$newline = "\r\n";
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
		$data = mb_convert_encoding($data , "UTF-8", "UTF-8, ISO-8859-1, ISO-8859-15");
   
	    force_download($file_name, $data);
	   
	}//End Function



	/**
	 * exportExcelData
	 * Função auxiliar para exportação em xls
	 * 
	 * @access  public
	 * @return  void
	 */
	public function exportExcelData($records)	{
	 	$heading = false;
		    if (!empty($records))
			 	foreach ($records as $row) {
					if (!$heading) {
					   // Exibe os nomes dos campos/colunas na primeira linha
					   echo implode("\t", array_keys($row)) . "\n";
					   $heading = true;
				    }
				    echo implode("\t", ($row)) . "\n";
			    }
	}

	/**
	 * get_xls_eventos_utilizacao_de_salas
	 * Faz a exportacao de utilização de salas em .XLS
	 *
	 * @access  public
	 * @return  void
	 */
	public function get_xls_eventos_utilizacao_de_salas(){

		$data = $this->export_model->eventos_utilizacao_de_salas_xls();

	 	$dataToExports = [];
		 
		foreach ($data as $row) {
	        $arrangeData['Utilizacao de Sala'] = mb_convert_encoding($row['desc_utilizacao_sala'],'utf-16','utf-8');
			$arrangeData['Definicao'] 		   = mb_convert_encoding($row['desc_definicao'],'utf-16','utf-8');
	  		$dataToExports[]	 			   = $arrangeData;
		 }
		 		 
		// set header
	 	$filename = "tpl_exp_Eventos_utilizacao_salas.xls";
		header("Content-Type: application/vnd.ms-excel;charset = UTF-8");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Pragma: no-cache");
		header("Expires: 0");
		 
		$this->exportExcelData($dataToExports);
	}

	/**
	 * Faz a importação PDF de Produtos
	 *
	 * @access  public
	 * @return  void
	 */
	function get_pdf_eventos_utilizacao_de_salas()
	{

		$html = $this->load->view('print/main_a4', [], true);

		$filename = 'report_';
		
		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');

	 } //End Function




}//End Class
