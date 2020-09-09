<?php
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　Tips詳細ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//================================
// 画面処理
//================================

$tips_id = (!empty($_GET['tips_id'])) ? $_GET['tips_id'] : '';
// DBから商品データを取得
$viewData = getTipsOne($tips_id);

if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));

  //変数にユーザー情報を代入
  $cotegoryid = $_POST['cotegoryid'];
  $content = $_POST['content'];
  $deleteflg = (!empty($_POST['deleteflg'])) ? true : false;
  $updateflg = (!empty($_POST['updateflg'])) ? true : false;

  if(empty($err_msg)){
    debug('バリデーションOKです。');
    //アップデートフラグがあった場合は処理に入る
    if($updateflg){
      //例外処理
      try {
        // DBへ接続
        $dbh = dbConnect();
        // SQL文作成
        $sql = 'UPDATE tips  SET cotegoryid = :cotegoryid, content = :content WHERE id = :tips_id';
        $data = array(':cotegoryid' => $cotegoryid , ':content' => $content, ':tips_id' => (int)$tips_id);
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);

        // クエリ成功の場合
        if($stmt){
          $_SESSION['msg_success'] = SUC02;
          debug('マイページへ遷移します。');
          header("Location:mypage.php"); //マイページへ
        }

      } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        $err_msg['common'] = MSG07;
      }
    }elseif($deleteflg){
      try {
        // DBへ接続
        $dbh = dbConnect();
        // SQL文作成
        $sql1 = 'UPDATE tips SET  delete_flg = 1 WHERE id = :tips_id';
        // データ流し込み
        $data = array(':tips_id' => (int)$tips_id);
        // クエリ実行
        $stmt1 = queryPost($dbh, $sql1, $data);

        // クエリ実行成功の場合（最悪userテーブルのみ削除成功していれば良しとする）
      } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        $err_msg['common'] = MSG07;
      }
    }
  }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<!--削除ボタンを押した時にだけ処理されるようにしたい-->
<?php
$siteTitle = 'Tips詳細';
require('head.php');
?>
  <body class="page-passEdit page-2colum page-logined">
    <style>
      .form{
        margin-top: 50px;
      }
    </style>

    <!-- メニュー -->
    <?php
      require('header.php');
    ?>

<div id="contents" class="site-width">
    <h1 class="page-title">Tips変更</h1>
    <!-- Main -->
    <section id="main" >
      <div class="form-container">
        <form action="" method="post" class="form" enctype="multipart/form-data">
          <label class="<?php if(!empty($err_msg['username'])) echo 'err'; ?>">
            カテゴリーID
            <input type="text" name="cotegoryid" value="<?php echo sanitize($viewData['cotegoryid']); ?>">
          </label>
          <label class="<?php if(!empty($err_msg['username'])) echo 'err'; ?>">
            Tips内容
              <input type="text" class="tipsTextArea" name="content" value="<?php echo sanitize($viewData['content']); ?>">
          </label>
          <!--3/22に追加した非表示のformを追加した-->
          <div class="btn-container">
            <input type="submit" class="btn btn-mid" name="updateflg" value="変更する"><br>
            <input type="submit" class="btn btn-mid" name="deleteflg" value="削除">
          </div><!--変更ボタンの閉じタグ-->
      </div><!--フォームコンテイナーの閉じタグ-->
    </section>
    </div>
    <!-- footer -->
    <?php
    require('footer.php');
    ?>
