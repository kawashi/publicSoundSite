$(function(){
// ----- クラス定義 -----
var ClickCounter = (function(){
    // コンストラクタ
    function ClickCounter(obj, event, api_url){
        this.initialized(obj, event, api_url);
        this.listener();
    }
    
    // 変数初期化
    ClickCounter.prototype.initialized = function(obj, event, api_url){
        this.alredy_count = false;
        this.$target      = $(obj);
        this.event        = event;
        this.api          = {
            url:  api_url, 
            data: this.$target.data("id")
        };
    }
    
    // イベント監視
    ClickCounter.prototype.listener = function(){
        var self = this;
        this.$target.on(this.event, function(){
            self.count(this);
        });
    }
    
    // API 叩いて回数をカウント
    ClickCounter.prototype.count = function(){
        if(this.alredy_count) return 0;
        this.alredy_count = true;
        $.get(this.api.url, {id: this.api.data});
    }
    
    return ClickCounter;
})();

/* ダウンロードカウンタ */
var DlCounter = (function(){
    var DlCounter = function(obj){
        ClickCounter.call(this, obj, 'click', 'dl_count');
    }
    return DlCounter;
})();

/* 再生数カウンタ */
var PlayCounter = (function(){
   var PlayCounter = function(obj){
       ClickCounter.call(this, obj, 'play', 'play_count');
   }
   return PlayCounter;
})();

/* カウンタクラス継承 */
Object.setPrototypeOf(DlCounter.prototype,   ClickCounter.prototype);
Object.setPrototypeOf(PlayCounter.prototype, ClickCounter.prototype);


// ------ インスタンス化 ---------
$(".downloads a").each(function(){
    new DlCounter(this);
});

$(".audio").each(function(){
    new PlayCounter(this); 
});

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
});