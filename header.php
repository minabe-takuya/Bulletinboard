<header>
  <div class="site-width">
    <h1><a href="mypage.php">Tips集</a></h1>
    <nav id="top-nav">
      <ul>
        <?php
          if(empty($_SESSION['user_id'])){
        ?>
            <li><a href="signup.php" class="btn btn-primary">ユーザー登録</a></li>
            <li><a href="login.php">ログイン</a></li>
        <?php
          }else{
        ?>
            <li><a href="logout.php">ログアウト</a></li>
            <li><a href="mypage.php">マイページ</a></li>
            <li><a href="register.php">Tips登録</a></li>
        <?php
          }
        ?>
      </ul>
    </nav>
  </div>
</header>
