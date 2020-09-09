<footer id="footer">
<!--URLは実際に使うようになったときに設定する-->
Copyright <a href="">○○○○チーム</a>. All Rights Reserved.
</footer>
<script src="js/vendor/jquery-3.4.1.slim.min.js"></script>
<!--本当はbootstrapを追加しなければならない-->
<script>

$(function(){
  var $ftr = $('#footer');
  if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
    $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
  }
});
</script>
</body>
</html>
