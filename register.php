<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　Tips登録ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');
//カテゴリをDBから取得したい
$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '';
//カテゴリデータはカテゴリテーブルから取得している
$dbCategoryData = getCategory();
debug('カテゴリーデータ:',print_r($dbCategoryData,true));


//post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報:'.print_r($_POST,true));

    //変数にユーザー情報を代入
    $tipsValue = $_POST['tipsValue'];
    $category = $_POST['category_id']; //ここが重要になる

    //未入力チェック
    validRequired($tipsValue, 'tipsValue');

  if(empty($err_msg)){
    //例外処理
    try {
      debug('DB新規登録です。');
      // DBへ接続
      $dbh = dbConnect();
      // SQL文作成
      $sql = 'INSERT INTO tips (content,cotegoryid,create_date,user_id) VALUES(:content,:category, :create_date,:u_id)';
      $data = array(':content' => $tipsValue,':category' => (int)$category, ':create_date' => date('Y-m-d H:i:s'),':u_id' => $_SESSION['user_id']);
      // クエリ実行
      debug('新規登録のSQL:'.$sql);
      debug('新規登録のSQL流し込み:'.print_r($data,true));
      $stmt = queryPost($dbh, $sql, $data);
      // クエリ成功の場合
      if($stmt){
        $_SESSION['msg_success'] = SUC04;
        debug('マイページへ遷移します。');
        header("Location:mypage.php"); //マイページへ
      }


    } catch (Exception $e) {
      error_log('エラー発生:' . $e->getMessage());
      $err_msg['common'] = MSG07;
    }
  }
}
?>
<?php
$siteTitle = 'Tips登録';
require('head.php');
?>

<body class="page-signup page-1colum">

  <!-- ヘッダー -->
  <?php
  require('header.php');
  ?>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <!-- Main -->
    <section id="main" >

      <div class="form-container">

        <form action="" method="post" class="form">
          <h2 class="title">Tips登録</h2>
          <div class="area-msg">
            <?php
            if(!empty($err_msg['common'])) echo $err_msg['common'];
            ?>
          </div>
            <label class="<?php if(!empty($err_msg['category_id'])) echo 'err'; ?>">
              カテゴリ<span class="label-require">必須</span>
              <select name="category_id" id="">
                <?php
                //カテゴリテーブルからidに紐づくtypeを取得している
                  foreach($dbCategoryData as $key => $val){
                ?>
                  <option value="<?php echo $val['id'] ?>" <?php echo 'selected'; ?> >
                    <?php echo $val['type']; ?>
                  </option>
                <?php
                  }
                ?>
              </select>
            </label>
            <div class="area-msg">
              <?php
              if(!empty($err_msg['category_id'])) echo $err_msg['category_id'];
              ?>
            </div>
          <label class="<?php if(!empty($err_msg['tipsValue'])) echo 'err'; ?>">
            Tips<span class="label-require">必須</span>
            <textarea rows="7" cols="50" placeholder ="何でも入力してください" name ="tipsValue"></textarea><br>
          </label>
          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="登録する">
          </div>
        </form>
      </div>

    </section>

  </div>

<!-- footer -->
<?php
require('footer.php');
?>
