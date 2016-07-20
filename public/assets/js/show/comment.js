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
        this.user_id       = this.get_cookie("user_id");
        
        // コメント数取得
        var self = this;
        $.get('get_comment_count', {data_id: this.data_id}, function(data){
            self.comment_count = data;
        });
    }
    
    // イベントリスナー
    Comment.prototype.listener = function(){
        var self = this;
        
        // ctrl + enter が押されたらコメント送信
        this.$comment_form.on('keyup', function(e){
            if( e.ctrlKey && e.keyCode == 13) self.$target.trigger('click');
        });
        
        // コメントが送信された時の処理
        this.$target.on('click', function(){
            if( !self.$target.hasClass("disabled") ){
                self.send_message(self.$comment_form.val()); 
                self.show_comment(self.$comment_form.val());
                self.$comment_form.val("");
            }
        });
    }
    
    // コメント送信
    Comment.prototype.send_message = function(comment){
        $.get('send_comment', {
            comment: comment,
            data_id: this.data_id,
            user_id: this.user_id
        });
    }
    
    // コメント表示
    Comment.prototype.show_comment = function(comment){
        var comment       = '<p class="comment_text">' + comment + '</p>';
        if( this.comment_count < 3 ) this.$sound_dom.find(".comments").append(comment);
        else                         this.$sound_dom.find(".show_comment_button").prev().after(comment);
    }
    
    // クッキー取得
    Comment.prototype.get_cookie = function(key){
        var cookies = document.cookie.split(";");
        for( var i=0 ; i < cookies.length ; i++ ){
            if( cookies[i].substr(0,key.length) == key ) return cookies[i].split("=")[1];
        }
        return null;
    }
    
    return Comment;
})();


// ------ インスタンス化 ------
$(".comment_submit").each(function(){
    new Comment(this);
});
