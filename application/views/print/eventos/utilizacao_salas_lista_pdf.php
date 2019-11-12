<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
     <link rel="stylesheet" href="./assets/print/css/print_static.css" type="text/css" />
     <!--<link rel="STYLESHEET" href="../../../assets/print/css/print_static.css?123" type="text/css" />-->
</head>

<body>

     <div id="body">

          <div id="section_header"></div>

          <div id="content">

               <div class="page">

                    <table style="width: 100%;" class="header">
                         <tr>
                              <td>
                                   <h1 style="text-align: left">ZATA - IMPLANTED BY TRIVEE</h1>
                              </td>
                              <td style="text-align: right">
                                  Versão: 0.0.1
                              </td>
                         </tr>
                    </table>

                    <table style="width: 100%;">
                         <tr>
                              <td>TERESINA EMPREENDIMENTOS HOTELEIROS LTDA</td>
                              <td style="text-align: right;">USUÁRIO: <strong>RALNY ANDRADE</strong></td>
                         </tr>

                         <tr>
                              <td>13.492.328/0001-14</td>
                              <td style="text-align: right;">CRIAÇÃO:<strong>04/11/2019 9:28 AM</strong></td>
                         </tr>

                         <tr>
                              <td>AV MARECHAL CASTELO BRANCO, 555 / SALA 15, ILHOTAS</td>
                              <td> </td>
                         </tr>

                         <tr>
                              <td>64.014-058 TERESINA/PI</td>
                              <td></td>
                         </tr>
                    </table>

                    <table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black;">

                         <tr>
                              <td>Modulo: <strong>Eventos</strong></td>
                              <td>Configurações: <strong>Utilização de Sala</strong></td>
                              <td>Tipo de Exportação: <strong>PDF</strong></td>
                              <td>Registros: <strong>20</strong></td>
                         </tr>



                    </table>

                    <h3>LISTAGEM DE UTILIZAÇÃO DE SALAS</h3>

                    <table class="change_order_items">

                         <tbody>
                              <tr>
                                   <th>Utilização de Sala</th>
                                   <th width=20%>Alteração</th>
                                   <th width=20%>Usuário</th>
                              </tr>
                              <?php 
                                   /**
                                    * Listando registros da tabela
                                    * Listing table records
                                    */
                                   $row_zebrada = 1;
                                   foreach ($lista as $linha):
                                        /**
                                         * Tinhas zebradas
                                         */	
                                        $row_zebrada++;
                                        $cor = ($row_zebrada % 2) ? 'even_row' : 'odd_row';           
					        ?>
                              <tr class="<?= $cor ?>">
                                   <td><?= $linha->desc_utilizacao_sala ?></td>
                                   <td><?= data_hora($linha->dth_atualizacao) ?></td>
                                   <td><?= $linha->id_usuario_atualizacao ?></td>
                              </tr>
                              <?php endforeach ?>	
                         </tbody>
                    </table>

               </div>
          </div>
     </div>

     <div class="absolute" style="bottom: 10px; right: 10px;">
          Pagina 1/1
     </div>


</body>

</html>