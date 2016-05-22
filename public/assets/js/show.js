var play_flag = 0;
var dl_flag   = 0;

$(function(){
    /* ダウンロード数カウント */
    $(".downloads a").on("click",function(){
        if( dl_flag === 0 ){
            dl_flag = 1;
            $.get('dl_count',{},function(data){
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
    
});
