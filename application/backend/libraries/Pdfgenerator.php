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


Use Dompdf\Dompdf;

require "../vendor/autoload.php";

/**
 * Class Pdfgenerator 
 *
 * Livbrary responsavel por fazer a interface com o DomPdf 
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Pdfgenerator
{

    public function generate($html, $filename = '', $stream = TRUE, $paper = 'A4', $orientation = "portrait")
    {
        $dompdf = new DOMPDF(["enable_remote" => true]);

        $dompdf->load_html($html);
 
        $dompdf->set_paper($paper, $orientation);

        $dompdf->render();

        if ($stream)
        {
            $dompdf->stream($filename . ".pdf", array("Attachment" => true)); // Attachment" => true vai baixar o arquivo direto
        }
        else
        {
            return $dompdf->output();
        }
    }

    
}
