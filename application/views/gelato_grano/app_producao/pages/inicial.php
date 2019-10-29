<!-- Page content -->
<div id="page-content">
    <!-- Gallery Header -->
    <div class="content-header">
        <!-- Gallery Filter Links -->
        <div class="header-section text-center" >
            <div class="btn-group gallery-filter">
                <a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary active" data-category="all" style="font-size:20px">Todos</a>
                <?php 
                foreach ($categorias_gelato as $row):
                    ?>
                <a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary" data-category="<?= $row->id_categoria_gelato?>" style="font-size:20px"><?= $row->desc?></a>

            <?php endforeach ?>

        </div>
    </div>
    <!-- END Gallery Filter Links -->
</div>
<!-- END Gallery Header -->

<!-- Gallery Items -->
<div class="row gallery">
    <?php 
    foreach ($receitas as $row)
    {
        if ($row->file_name_miniature == null){
            $img = base_url().'assets/zata/no-image.png';
        }else{
            $img = base_url().'files/uploads/images/'.$row->file_name_miniature;
        }
    ?>
            <div class="col-sm-4">
                <div class="gallery-image-container animation-fadeInQuick2" data-category="<?=  isset($row->id_categoria_gelato) ? $row->id_categoria_gelato : null ;?>">
                    <a href="<?= base_url() ?>gelato_grano/app_producao/cuba/<?= $row->id_receita ?>">
                    <img src="<?= $img ?>">
                        <div class="widget-image-content">
                            <!--<div class="pull-right text-light-op"><strong>OFFER!</strong></div>-->
                            <h2 class="widget-heading text-light"><strong><?=  isset($row->nome_receita) ? strtoupper($row->nome_receita) : null ;?></strong></h2>
                        </div>
                    </a>
                </div>
            </div>
            <?php 
        } 
        ?>

    </div>
    <!-- END Gallery Items -->
</div>
<!-- END Page Content -->
