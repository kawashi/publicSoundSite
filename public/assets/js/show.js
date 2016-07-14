$(function(){
    var play_flag = 0;
    var dl_flag   = 0;
    /* クリックされた回数を DB に記録 */
    var ClickCounter = (function(){
        function ClickCounter(action){
            this.done_count  = false;
            this.action_name = action + "_count";
            this.listener();
        }
        ClickCounter.prototype.count = function(){
            if( !this.done_count ){
                $.get(this.action_name, {name:$(this).data("name")}, function(data){this.done_count = true;});
            }
        }
        ClickCounter.prototype.listener = function(){
            $('.downloads a').on("click", this.count);
        }
    })();

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


    })

    // TODO:ボタンごとにnewすべきだと思う
    dl_count   = new ClickCounter("dl");
    play_count = new ClickCounter("play");

    // 初期化

});
