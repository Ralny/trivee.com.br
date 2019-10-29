<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Requisição de Produtos</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/paper-css/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/paper-css/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }</style>
  <style type="text/css">

  body {
      -webkit-print-color-adjust: exact;
  }

  
  .tg  {
      border-collapse:collapse;
      border-spacing:0;
      border-color:#ccc;
      margin:0px auto;
  }
  .tg td{
      font-family:Arial, sans-serif;
      font-size:12px;
      padding:6px 5px;
      border-style:solid;
      border-width:0px;
      overflow:hidden;
      word-break:normal;
      border-color:#000;
      color:#333;
      background-color:#fff;
      border-top-width:1px;
      border-bottom-width:1px;
  }
  .tg th{
      font-family:Tahoma, sans-serif;
      font-size:12px;
      font-weight:normal;
      padding:10px 5px;
      border-style:solid;
      border-width:0px;
      overflow:hidden;
      word-break:normal;
      border-color:#000;
      color:#333;
      background-color:#f0f0f0;
      border-top-width:1px;
      border-bottom-width:1px;
  }
  .tg .tg-titulo{
      font-size:16px;
      text-align:center;
      vertical-align:top;
      /*font-weight:bold;*/
  }
  .tg .tg-empresa{
      font-size:12px;
      vertical-align:top;
      font-weight:bold;
      border-bottom-width:0px;
  }
  .tg .tg-baqh{
      text-align:center;
      vertical-align:top;
  }
  .tg .tg-yw4l{
      vertical-align:top;
      border-style:solid;
      border-top-width:1px;
      border-bottom-width:1px;
  }
  .tg .tg-lqy3{
      font-size:12px;
      vertical-align:top;
      border-top-width:0px;
      border-bottom-width:0px;
      padding:5px 5px;

  }
  .tg .tg-lqy6{
      vertical-align:top;
  }

  #footer{
      font-family:Tahoma, sans-serif;
      font-size:12px;
      font-weight:normal;
      padding:10px 5px;
      position:absolute;
      bottom:0;
      width:100%;
  }

/*CSS para impressão*/
@media print {
}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->

  <?php $this->load->view($page) ?>

</body>

</html>



