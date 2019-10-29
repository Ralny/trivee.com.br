<!-- Page content -->
<!--
    Available classes when #page-content-sidebar is used:

    'inner-sidebar-left'      for a left inner sidebar
    'inner-sidebar-right'     for a right inner sidebar
-->
<div id="page-content">
        <div class="content-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="header-section">
                    <h1>Selecione o tamanho da Cuba</h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-4">
            <a href="<?= base_url() ?>gelato_grano/app_producao/peso_balanca/1/<?= $this->uri->segment(4); ?>" class="widget">
                <div class="widget-image widget-image-sm">
                    <img src="<?= base_url() ?>assets/gelato_grano/app_producao/img/placeholders/photos/photo25.jpg" alt="image">
                    <div class="widget-image-content">
                        <h2 class="widget-heading text-light"><strong>Pequena</strong></h2>
                        <h3 class="widget-heading text-light-op h4"><em>4 kg</em></h3>
                    </div>
                    <i class="gi gi-check"></i>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
             <a href="<?= base_url() ?>gelato_grano/app_producao/peso_balanca/2/<?= $this->uri->segment(4); ?>" class="widget">
                <div class="widget-image widget-image-sm">
                    <img src="<?= base_url() ?>assets/gelato_grano/app_producao/img/placeholders/photos/photo26.jpg" alt="image">
                    <div class="widget-image-content">
                        <h2 class="widget-heading text-light"><strong>Media</strong></h2>
                        <h3 class="widget-heading text-light-op h4"><em>5,5 kg</em></h3>
                    </div>
                    <i class="gi gi-check"></i>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
             <a href="<?= base_url() ?>gelato_grano/app_producao/peso_balanca/3/<?= $this->uri->segment(4); ?>" class="widget">
                <div class="widget-image widget-image-sm">
                    <img src="<?= base_url() ?>assets/gelato_grano/app_producao/img/placeholders/photos/photo27.jpg" alt="image">
                    <div class="widget-image-content">
                        <h2 class="widget-heading text-light"><strong>Grande</strong></h2>
                        <h3 class="widget-heading text-light-op h4"><em>6 kg</em></h3>
                    </div>
                    <i class="gi gi-check"></i>
                </div>
            </a>
        </div>

    </div>
    <!--
     <div class="row">
        <div class="col-xs-4">
            <a href="<?= base_url() ?>gelato_grano/app_producao/peso_balanca/1/<?= $this->uri->segment(4); ?>" class="widget">
                <div class="widget-content themed-background-info text-light-op text-center">
                    <div class="widget-icon">
                        <i class="fa fa-database"></i>
                    </div>
                </div>
                <div class="widget-content text-dark text-center">
                    <h1><strong>Pequena</strong></h1>
                </div>
            </a>
        </div>
        <div class="col-xs-4">
            <a href="<?= base_url() ?>gelato_grano/app_producao/peso_balanca/2/<?= $this->uri->segment(4); ?>" class="widget">
                <div class="widget-content themed-background-info text-light-op text-center">
                    <div class="widget-icon">
                        <i class="fa fa-database"></i>
                    </div>
                </div>
                <div class="widget-content text-dark text-center">
                   <h1><strong>Media</strong></h1>
                </div>
            </a>
        </div>
        <div class="col-xs-4">
            <a href="<?= base_url() ?>gelato_grano/app_producao/peso_balanca/3/<?= $this->uri->segment(4); ?>" class="widget">
                <div class="widget-content themed-background-info text-light-op text-center">
                    <div class="widget-icon">
                        <i class="fa fa-database"></i>
                    </div>
                </div>
                <div class="widget-content text-dark text-center">
                    <h1><strong>Grande</strong></h1>
                </div>
            </a>
        </div>
    </div>
    -->
   
</div>
<!-- END Page Content -->

