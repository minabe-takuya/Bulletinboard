$(function(){
    const MSG_TEXT_ERROR ="正しい値を入力してください。"
    const MSG_TEXT_TRUE ="正解です。"
    //前提としてマイページが読み込まれていることを前提にする
    if ( window.document.body.id === 'top' ) {
    //Q2
    $('.Q1').change(function(){
            var text = $(this).val();
            var str = text.replace(/[A-Za-z0-9]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) + 65248);
        });
    $(this).val(str);
    });
    $('.answer').click(function(){
        if($(".Q1").val() == "エンジンエックス"){
            alert(MSG_TEXT_TRUE);
        }
        else{
            alert(MSG_TEXT_ERROR);
        }
    });//Q1
    //Q2
    $('.Q2').change(function(){
        var text = $(this).val();
        var str = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
          return String.fromCharCode(s.charCodeAt(0) - 65248);
        });
      $(this).val(str);
      });
      $('.answer2').click(function(){
    if($(".Q2").val() == "14"){
        alert(MSG_TEXT_TRUE);
    }
    else{
        alert(MSG_TEXT_ERROR);
    }
});//Q2
    //Q3
    $('.Q3').change(function(){
        var text = $(this).val();
        var str = text.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) - 65248);
    });
$(this).val(str);
});
$('.answer3').click(function(){
    if($(".Q3").val() == "assets/js/app.js"){
        alert(MSG_TEXT_TRUE);
    }
    else{
        alert(MSG_TEXT_ERROR);
    }
});//Q3
}
});

var result = 0;
function add(num){
  return ++num;
}
for(var i = 1; i < 5; i++){
  result += add(i);
}
console.log("Q2の答えです"+result);
