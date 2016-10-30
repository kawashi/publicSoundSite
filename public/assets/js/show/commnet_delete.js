// ----- クラス定義 ------
var CommentDelete = (function(){
    function CommentDelete(target){
        this.initialized(target);
        this.listener();
    }
    
    // 変数初期化
    CommentDelete.prototype.initialized = function(target){
        this.$target    = $(target);
        this.comment_id = this.$target.data("comment-id");
        this.$comments  = $(".comment-id-" + this.comment_id);
    }
    
    // イベントリスナー
    CommentDelete.prototype.listener = function(){
        var self = this;
        
        this.$target.on('click',function(){
            self.send_delete();
            self.show_delete();
        });
    }
    
    // コメント削除
    CommentDelete.prototype.send_delete = function(){
        $.get('comment_delete', { comment_id: this.comment_id });
    }
    
    // コメント削除
    CommentDelete.prototype.show_delete = function(){
        this.$comments.each(function(){
           this.remove(); 
        });
    }
    
    return CommentDelete;
    
})();

// ----- インスタンス化 ----
$(".comment_delete a").each(function(){
   new CommentDelete(this); 
});