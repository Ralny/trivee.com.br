<!-- Page content -->
<div id="page-content">
    <!-- Invoice Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="header-section">
                    <h1>Receita de <?= $row->nome_receita ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- END Invoice Header -->

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
            <!-- Invoice Block -->
            <div class="block">
                <!-- Invoice Info -->
                <div class="row block-section">
                    <!-- Company Info -->
                    <div class="col-xs-12 col-lg-3">
                       <div class="widget-image">

                        <?php 
                        if ($row->file_name_miniature == null){
                            $img = base_url().'assets/zata/no-image.png';
                        }else{
                            $img = base_url().'files/uploads/images/'.$row->file_name_miniature;
                        }
                        ?>
                        <img src="<?= $img ?>" alt="image">
                    </div>

                </div>
                <!-- END Company Info -->
            </div>
            <!-- END Invoice Info -->
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 50%;">INGREDIENTE</th>
                            <th class="text-center">PESO (g)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                                /**
                                 * Listando registros da tabela
                                 * Listing table records
                                 */
                                //var_dump($formula_ingredientes);exit;

                                $total = 0;
                                foreach ($formula_ingredientes as $row):
                                    /**
                                     * Listar registros da tabela
                                     * Change Active Label
                                     */ 
                                    $total = $total + $row['peso'];                     
                                    ?>  
                                    <tr>
                                        <td>
                                            <h3><strong><?= $row['ingrediente'] ?></strong></h3>
                                        </td>
                                        <td class="text-right">
                                            <h3><strong><?= $row['peso'] ?> g</strong></h3>
                                        </td>
                                    </tr>
                                <?php endforeach ?> 
                                                                                              
                                <tr>
                                    <td colspan="1" class="text-right"><span class="h2"><strong>Peso Total</strong></span></td>
                                    <td class="text-right"><span class="h2"><strong><?= round(number_format($total, 2, '.', '')); ?> g</strong></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END Table -->
                </div>
                <!-- END Invoice Block -->
            </div>
        </div>
    </div>
<!-- END Page Content -->