/* コメント送信 */
// TOOD:要リファクタ
$(".comment_submit").on("click",function(){
    // 理想は、入力したコメント取得し、DBにわたし、画面に表示
    var comment   = $(".comment_form").val();
    var data_name = $(".comment").data("name");
    var add_text  = '<p>' + comment + '</p>';


    // TDOO: 曲ごとの場所を特定しなきゃダメだからここは違う
    // TODO: this からたどる
    $("#comments").append(add_text);



    //$.get('send_comment', {comment: comment,sound_name: data_name}, function(data){
    //     console.log("成功");
    // })

    $(".comment_form").val("");

});