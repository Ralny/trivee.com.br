<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <?php $this->load->view('prizon/tpl/head') ?>
</head>

<body>

<!-- start loading -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
        </div>
    </div>
</div>
<!-- end loading -->

<?php $this->load->view('prizon/tpl/menu') ?>

<?php

/**
 * Inicio do conteudo
 */

$this->load->view($page);

/**
 * Fim do Conteudo
 */
?>

<?php $this->load->view('prizon/tpl/footer') ?>

<!-- start scroll top -->
<div id="scroll-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- theme js files -->
<?php $this->load->view('prizon/tpl/js') ?>

</body>

</html>