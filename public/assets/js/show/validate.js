// ------ クラス定義 -------
var Validate = (function(){
    // コンストラクタ
    function Validate(target){
        this.initialized(target);
        this.listener();
    }
    
    // 変数初期化
    Validate.prototype.initialized = function(target){
        this.$target    = $(target);
        this.$sound_dom = $("#sound-id-" + this.$target.data("id"));
        this.$submit    = this.$sound_dom.find(".comment_submit");
        this.data_id    = this.$target.data("id");
        
        // バリデーションパターン
        this.validates  = {
            empty: "",
            space: /( |　)/
        }
    }
    
    // イベントリスナー
    Validate.prototype.listener = function(){
        var self = this;
        
        // フォーカスあたったらバリデーション発火
        this.$target.on('focus', function(){
           self.$target.trigger('keyup'); 
        });
        
        // フォーカス外れたらフォームの縁を元の色に戻す
        this.$target.on('focusout', function(){
           self.$target.parent().removeClass("has-error"); 
        });
        
        // キーが上がったらバリデーション実行
        this.$target.on('keyup', function(){
            self.check();
        });
    }
    
    // 全てのバリデーション実行
    Validate.prototype.check = function(){
        // 将来増えることを見越して for..in してる
        for( key in this.validates ){
            this[key](this.$target.val()) ? this.valid() : this.invalid();
        }
    }
        
    // 文字が入力されているか
    Validate.prototype.empty = function(data){
        return data != this.validates.empty;
    }
    
    // スペースだけではないか
    Validate.prototype.space = function(data){
        for( var i=0 ; i<data.length ; i++ ){
            if(!data[i].match(this.validates.space)){
                return true;  
            }
        }
        return false;
    }
    
    // 有効
    Validate.prototype.valid = function(){
        this.$submit.removeClass("disabled");
        this.$target.parent().removeClass("has-error");
    }
    
    // 無効
    Validate.prototype.invalid = function(){
        this.$submit.addClass("disabled");
        this.$target.parent().addClass("has-error");
    }
    
    return Validate;
})();


// ----- インスタンス化 -------
$(".comment_form").each(function(){
    new Validate(this);
});
