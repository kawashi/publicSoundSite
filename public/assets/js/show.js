var play_flag = 0;
var dl_flag   = 0;

$(function(){
    /* ダウンロード数カウント */
    $(".downloads a").on("click",function(){
        if( dl_flag === 0 ){
            dl_flag = 1;
            $.get('dl_count',{name:$(this).data("name")},function(data){
                console.log("ダウンロードカウントアップ");
            });
        }
    });
    
    /* 再生数カウント */
    $(".audio").on("play",function(){
        if( play_flag === 0 ){
            play_flag = 1;
            $.get('play_count',{name:$(this).data("name")},function(data){
               console.log(data); 
            });
        }        
    });
    
    /* コメント送信 */
    // TOOD:要リファクタ
    $(".comment_submit").on("click",function(){
        var $comment_group = $(this).parent();
        console.log($comment_group);
        var $text_area     = $comment_group.children("div").children();    
        console.log($text_area);
        
        var comment = $text_area.val();
        var name    = $(this).closest('.comment').data('name');
        
        // コメント表示
        var $parent = $(this).closest(".sound");
        $comment_list = $parent.children('.comment_list');
        $comment_list.append("<div></div");
        var text = '<p>' + comment + '</p>';
        var $child  = $comment_list.children("div:last-child");
        $child.attr({class: 'message'}).append(text);
        
        
        // フォームリセット
        $(".comment_form").val("");
        
        $.get('send_comment',{comment:comment,sound_name:name},function(data){   
            console.log("成功");
        })
    })
    
});
