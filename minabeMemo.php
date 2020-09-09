<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　三鍋メモ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//================================
// ログイン画面処理
//================================
// post送信されていた場合
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
$siteTitle = 'ログイン';
require('head.php');
?>
<style>
iframe[src$=".pdf"]{
    width:100%;
    height:80vh;
}
</style>

  <body class="page-login page-1colum">

    <!-- ヘッダー -->
    <?php
      require('header.php');
    ?>

    <!-- メインコンテンツ -->
    <div id="contents" class="site-width">
<!-- Main -->
<section id="main" >

      <!-- Main -->
      <iframe src="img/三鍋メモ.pdf" width="100%" height="100%"></iframe>
      <iframe src="img/マニュアルと感想.pdf" width="100%" height="100%"></iframe>
      <br><br>ログインページは<a href="login.php">コチラ</a>
    </div>
</section>
    <!-- footer -->
    <?php
    require('footer.php');
    ?>
