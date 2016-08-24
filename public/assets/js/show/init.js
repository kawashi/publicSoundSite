// クッキー取得
var get_parameter = function(key){
    var param = location.search.substring(1).split('&');
    for(var i=0 ; i < param.length ; i++ ){
        var value = param[i].split('=');
        if(value[0] === key) return value[1];
    }
    return "";
}

sound_id = get_parameter('sound_id');
if(sound_id !== "") location.href = '#' + sound_id;