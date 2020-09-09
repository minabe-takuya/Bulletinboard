<?php
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//カテゴリをDBから取得したい
$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '';
//カテゴリデータはカテゴリテーブルから取得している
$dbCategoryData = getCategory();
debug('カテゴリーデータ:',print_r($dbCategoryData,true));
//プルダウンで取得したIDは合っていた。
$category = $_GET['category_id'];
$freeWord = $_GET['freeWord'];
//$freeName = $_GET['freeName'];
$dbProductData = getProductList($category);
$dbgetfreewordData = getfreewordList($freeWord);

debug('tipsデータの取得結果:'.$dbProductData);
?>
<?php
$siteTitle = 'マイページ';
require('head.php');
?>


<!-- <body class="page-mypage page-2colum page-logined"> -->
<body class="page-mypage" id ="top">
<!-- メニュー -->
<?php
  require('header.php');
?>

<!-- メインコンテンツ -->
<div id="contents" class="site-width">
  <h1 class="page-title">MYPAGE</h1>
  <div class="form-container">
    <form name="" method="get" class="form">
    <label>
          カテゴリ
      <div class="selectbox">
        <span class="icn_select"></span>
        <select name="category_id" id="">
          <option value="0" <?php if(getFormData('category_id',true) == 0 ){ echo 'selected'; } ?> >選択してください</option>
          <?php
            foreach($dbCategoryData as $key => $val){
          ?>
            <option value="<?php echo $val['id'] ?>" <?php if(getFormData('category_id',true) == $val['id'] ){ echo 'selected'; } ?> >
              <?php echo $val['type']; ?>
            </option>
          <?php
            }
          ?>
        </select>
      </div>
    </label>
    or
    <label>
      フリーワード検索
      <input type="text" placeholder="曖昧検索をかけます" name="freeWord" >
    </label>
      <input type="submit" value="検索">
    </form>
  </div><!--form-container-->
  <!-- Main -->
  <br><br>
  <div class="seachResultn">
    <table>
      <caption>検索結果</caption>
      <tr>
        <th>tipsID</th><th>カテゴリID</th><th>内容</th><th>ユーザーID</th>
      </tr>
      <?php
        if((int)$category !==0){
          var_dump($category);
          foreach($dbProductData['data'] as $key => $val):
      ?>
        <tr>
          <td>
            <a href="tipsDetail.php?tips_id=<?php echo sanitize($val['id']) ?>" class="panel"><?php echo sanitize($val['id']) ?></a>
          </td>
          <td><?php echo sanitize($val['cotegoryid']); ?></td>
          <td><?php echo sanitize($val['content']); ?></td>
          <td><?php echo sanitize($val['user_id']); ?></td>
        </tr>
        <?php
          endforeach;
        }else{
        ?>
        <p>カテゴリで検索してみてください。</p>
        <?php
        }
        ?>
          <!--ここから私が追加したコード-->
        <?php
        if(!empty($freeWord)){
        foreach($dbgetfreewordData['data'] as $key => $val):
        ?>
        <tr>
          <td><a href="tipsDetail.php?tips_id=<?php echo sanitize($val['id']) ?>" class="panel"><?php echo sanitize($val['id']) ?></a></td>
          <td><?php echo sanitize($val['cotegoryid']); ?></td>
          <td><?php echo sanitize($val['content']); ?></td>
          <td><?php echo sanitize($val['user_id']); ?></td>
        </tr>
        <?php
          endforeach;
        }else{
        ?>
        <p>フリーワードで検索してみてください。</p>
        <?php
        }
        ?>

    </table>
    <!--検索結果表示-->

  </div>
  <hr>
    <div class="question">
      <h3>問題Q1</h3>
        ミドルウェアに関しての問題です。<br>
        WEBサーバーソフトウェアの一つで、近年Apacheよりも速くて高負荷に強いと言われているオープンソースソフトウェア(OSS)は何でしょう。<br>
        カタカナでお答えください。
        <input type="text" class="Q1">
      <a href="" class="answer answerArea">Q1回答</a>
    </div><br>
    <div class="question">
      <h3>問題Q2</h3>
        var result = 0;<br>
        function add(num){<br>
          return ++num;<br>
        }<br>
        for(var i = 1; i < 5; i++){<br>
          result += add(i);<br>
        }<br>
        変数resultは最終的にいくつになるでしょうか？<br>
        varは、JavaScriptプログラムで利用する変数を宣言するための命令です。
        このページのconsoleに答えが表示されるようにしています。
        <input type="text" class="Q2">
      <a href="" class="answer2 answerArea">Q2回答</a>
    </div><br>
    <div class="question">
      <h3>問題Q3</h3>
        <img src="img/相対パス.png"><br>
        相対パスの問題です。<br>
        index.htmlのheadタグ内でapp.jsを読み込むように下のように書きました。<br>
        <'script type="text/javascript" src="○○○○"></'script><br>
        scriptタグのsrc属性に入る○○○○部分のパスは何になるでしょうか？
        <input type="text" class="Q3">
      <a href="" class="answer3 answerArea">Q3回答</a>
    </div><br>

  <br>
  <a href="withdraw.php">もうこのサービスを止める</a>
</div><!--site-width-->
<!-- footer -->
<?php
  require('footer.php');
?>
<script src="js/main.js"></script>
