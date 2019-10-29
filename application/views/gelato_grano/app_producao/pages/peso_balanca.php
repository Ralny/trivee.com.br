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
                    <h1>Qual o peso da Cuba?</h1>
                </div>
            </div>
        </div>
    </div>

     <div class="row text-center">
        <div class="col-md-4 col-md-offset-4">
            <form action="<?= base_url() ?>gelato_grano/app_producao/receita" method="post" class="push">
                <div class="input-group input-group-lg">
                    <input type="number" style="padding:0px;" id="peso" name="peso" class="form-control" onkeyup="somenteNumeros(this);">
                    <input type="hidden" name="cuba" value="<?= $this->uri->segment(4); ?>" >
                    <input type="hidden" name="receita" value="<?= $this->uri->segment(5); ?>">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-effect-ripple btn-primary"><i class="gi gi-table"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Page Content -->

<!-- VALIDAÇÃO -->
<script>
    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
          campo.value = "";
        }
    }
 </script>




