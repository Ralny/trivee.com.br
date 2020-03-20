<?php
/**
 * Configurações auxiliares para a impressão PDF do Relatorio
 */
include('./application/views/print/templates/tpl_header.php');
include('./application/views/print/templates/tpl_info_companny_user.php');
include('./application/views/print/templates/tpl_rodape.php');

/**
 * Paginação - Utilizado pra indicar a paginção. Por exemplo: Pagina: 1/3
 */
$total_paginas = ceil($total_registros / $num_registro_pagina);

/**
 * Difinindo o tabela de configurações
 */
$info_table_exportacao = '
                         <table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size:9pt;">
                              <tr>
                                   <td>Modulo: <strong>'. $desc_modulo .'</strong></td>
                                   <td>Configurações: <strong>'. $desc_configuracoes .'</strong></td>
                                   <td>Tipo de Exportação: <strong>'. $tipo_exportacao. '</strong></td>
                                   <td>Registros: <strong>'. $total_registros. '</strong></td>
                              </tr>
                         </table>
                         ';

/**
 * Titulo do Relatorio
 */
$desc_relatorio = ' <h3 style="font-size:10pt">'.$descricao_principal.'</h3>';

/**
 * Define as colunas do grid
 */
$table_itens = '
               <table class="change_order_items">
                    <tbody>
                         <tr>
                              <th width=20%>Sala</th>
                              <th>Dimensões</th>
                              <th>Área</th>
                              <th>Pé direito</th>
                              <th>Tarifa balcão</th>
                              <th>Tarifa especial</th>
                         </tr>
               ';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="stylesheet" href="./assets/print/css/print_static.css" type="text/css" />
    <link rel="STYLESHEET" href="../../assets/print/css/print_static.css?12345" type="text/css" />
</head>

<body>
     <!-- Informações do ZATA-->                    
     <?= $header ?>
          <!-- Informações da empresa que o usuario esta logado--> 
          <?= $tpl_info_companny_user ?>
          <!-- Informações secundarias da exportação--> 
          <?= $info_table_exportacao ?>
          <!-- Titulo do relatorio--> 
          <?= $desc_relatorio ?>
          <!-- Cabeçalho do grid --> 
          <?= $table_itens ?>

                    <?php
                         
                         /**
                          * Auxiliar para definir a quantidade de registros por pagina
                          */
                         $contador = 1;

                         /**
                          * Auxiliar para Iniciar a contagem de paginas
                          */
                         $pagina   = 1;

                         /**
                          * Auxiliar para linha zebrada do grid
                          */
                         $row_zebrada = 1;

                         /**
                          * Listando registros da tabela
                          * Listing table records
                          */
                         foreach ($lista as $linha):
                              /**
                               * Incrementa Linhas zebradas
                               */
                              $row_zebrada++;
                              
                              /**
                               * Defini linha clara e linha escura
                               */
                              $cor = ($row_zebrada % 2) ? 'even_row' : 'odd_row';
                              
                              /**
                               * Faz a quebra de pagina ?
                               */
                              if ($contador == $num_registro_pagina) {
                                  /**
                                   * Se quebrar a pagina a contagem de registros inicia novamente
                                   */
                                  $contador = 1;
                                   
                                  /**
                                   * Faz o fechamento da tabela e insere no rodapé a paginação
                                   */
                                  echo
                                   '
                                        </tbody>
                                   </table>

                                   <div class="absolute" style="width: 100%; border-top: 1px solid black; text-align: right; bottom: 0px; right: 0px;">
         
                                        <table style="width: 100%; border-top: 1px solid black; text-align: right">
                                             <tr>
                                                  <td>Pagina: <strong>'.$pagina.'/'.$total_paginas.'</strong></td>
                                             </tr>
                                        </table>

                                   </div>  

                                   
                                   '. $rodape .'

                                   '. $header .'

                                   '. $tpl_info_companny_user .'

                                   '. $info_table_exportacao .'

                                   '. $desc_relatorio .'

                                   '. $table_itens .'

                                   ';

                                  $pagina++;
                              }

                    ?>
                    <!--Exibir as linhas do grid-->
                    <tr class="<?= $cor ?>">
                         <td><?= $linha->nome_sala ?></td>
                         <td><?= $linha->dimensoes ?></td>
                         <td><?= $linha->area ?></td>
                         <td><?= $linha->pe_direito ?></td>
                         <td><?= moeda($linha->valor_diaria_trf_balcao) ?></td>
                         <td><?= moeda($linha->valor_diaria_trf_especial_iss) ?></td>
                    </tr>
                    <?php $contador++; endforeach ?>	
               </tbody>
          </table>
          <!-- Rodapé final -->
          <div class="absolute" style="width: 100%; border-top: 1px solid black; text-align: right; bottom: 0px; right: 0px;">
         
               <table style="width: 100%; border-top: 1px solid black; text-align: right">
                    <tr>
                         <td>Pagina: <strong><?= $pagina ?>/<?= $total_paginas ?></strong></td>
                    </tr>
               </table>

               <?= $rodape ?>
          </div>                   

</body>

</html>