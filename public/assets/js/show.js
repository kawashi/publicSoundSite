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

// ----- クラス定義 --------
var Comment = (function(){
    // コンストラクタ
    function Comment(obj){
        this.initialized(obj);
        this.listener();
    }
    
    // 変数初期化
    Comment.prototype.initialized = function(obj){
        this.$target       = $(obj);
        this.$sound_dom    = $("#sound-id-" + this.$target.data("id"));
        this.$comment_form = this.$sound_dom.find(".comment_form");
        this.data_id       = this.$target.data("id");
        // コメント数取得
        var self = this;
        $.get('get_comment_count', {data_id: this.data_id}, function(data){
            self.comment_count = data;
        });
    }
    
    // イベントリスナー
    Comment.prototype.listener = function(){
        var self = this;
        this.$target.on('click', function(){
            self.send_message(self.$comment_form.val()); 
            self.show_comment(self.$comment_form.val());
            self.$comment_form.val("");
        });
    }
    
    // コメント送信
    Comment.prototype.send_message = function(comment){
        $.get('send_comment', {
            comment: comment,
            data_id: this.data_id
        });
    }
    
    // コメント表示
    Comment.prototype.show_comment = function(comment){
        var comment       = '<p class="comment_text">' + comment + '</p>';
        if( this.comment_count < 3 ) this.$sound_dom.find(".comments").append(comment);
        else                         this.$sound_dom.find(".show_comment_button").prev().after(comment);
    }
    
    return Comment;
})();


// ------ インスタンス化 ------
$(".comment_submit").each(function(){
    new Comment(this);
});

});