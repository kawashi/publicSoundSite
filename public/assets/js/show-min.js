$(function(){var a=function(){function a(a,b,c){this.initialized(a,b,c),this.listener()}return a.prototype.initialized=function(a,b,c){this.alredy_count=!1,this.$target=$(a),this.event=b,this.api={url:c,data:this.$target.data("id")}},a.prototype.listener=function(){var a=this;this.$target.on(this.event,function(){a.count(this)})},a.prototype.count=function(){return this.alredy_count?0:(this.alredy_count=!0,void $.get(this.api.url,{id:this.api.data}))},a}(),b=function(){var b=function(b){a.call(this,b,"click","dl_count")};return b}(),c=function(){var b=function(b){a.call(this,b,"play","play_count")};return b}();Object.setPrototypeOf(b.prototype,a.prototype),Object.setPrototypeOf(c.prototype,a.prototype),$(".downloads a").each(function(){new b(this)}),$(".audio").each(function(){new c(this)});var d=function(){function a(a){this.initialized(a),this.listener()}return a.prototype.initialized=function(a){this.$target=$(a),this.$sound_dom=$("#sound-id-"+this.$target.data("id")),this.$comment_form=this.$sound_dom.find(".comment_form"),this.data_id=this.$target.data("id"),this.user_id=this.get_cookie("user_id");var b=this;$.get("get_comment_count",{data_id:this.data_id},function(a){b.comment_count=a})},a.prototype.listener=function(){var a=this;this.$comment_form.on("keyup",function(b){b.ctrlKey&&13==b.keyCode&&a.$target.trigger("click")}),this.$target.on("click",function(){a.$target.hasClass("disabled")||a.send_message(a.$comment_form.val())})},a.prototype.send_message=function(a){var b=this,a=this.trim_space_and_br(a);$.get("send_comment",{comment:a,data_id:this.data_id,user_id:this.user_id},function(c){b.comment_id=c,b.show_comment(a),b.$comment_form.val(""),b.$target.addClass("disabled")})},a.prototype.trim_space_and_br=function(a){return a.replace(/(^\s+|\s+$)|(^\n+|\n+$)|(^　+|　+$)/g,"")},a.prototype.show_comment=function(a){var a='<div class="comment_field row comment-id-'+this.comment_id+'"><div class="comment_text col-md-9"><p>'+a+'</p></div><div class="comment_delete col-md-3 text-right"><a data-comment-id='+this.comment_id+">削除</a></div></div>";this.$sound_dom.find(".comments").prepend(a),new e($(".comment-id-"+this.comment_id+" .comment_delete a"))},a.prototype.get_cookie=function(a){for(var b=document.cookie.split(";"),c=0;c<b.length;c++)if(b[c].substr(0,a.length)==a)return b[c].split("=")[1];return null},a}();$(".comment_submit").each(function(){new d(this)});var e=function(){function a(a){this.initialized(a),this.listener()}return a.prototype.initialized=function(a){this.$target=$(a),this.comment_id=this.$target.data("comment-id"),this.$comments=$(".comment-id-"+this.comment_id)},a.prototype.listener=function(){var a=this;this.$target.on("click",function(){a.send_delete(),a.show_delete()})},a.prototype.send_delete=function(){$.get("comment_delete",{comment_id:this.comment_id})},a.prototype.show_delete=function(){this.$comments.each(function(){this.remove()})},a}();$(".comment_delete a").each(function(){new e(this)});var f=function(){function a(a){this.initialized(a),this.listener()}return a.prototype.initialized=function(a){this.$target=$(a),this.$sound_dom=$("#sound-id-"+this.$target.data("id")),this.$submit=this.$sound_dom.find(".comment_submit"),this.data_id=this.$target.data("id"),this.validates={min_length:"",max_length:400,invalid_str:/( |　|\n)/}},a.prototype.listener=function(){var a=this;this.$target.on("focus",function(){a.$target.trigger("keyup")}),this.$target.on("focusout",function(){a.$target.parent().removeClass("has-error")}),this.$target.on("keyup",function(){a.check()})},a.prototype.check=function(){for(key in this.validates)if(!this[key](this.$target.val(),key))return this.invalid();this.valid()},a.prototype.min_length=function(a,b){return a!=this.validates[b]},a.prototype.max_length=function(a,b){return a.length<this.validates[b]},a.prototype.invalid_str=function(a,b){for(var c=0;c<a.length;c++)if(!a[c].match(this.validates[b]))return!0;return!1},a.prototype.valid=function(){this.$submit.removeClass("disabled"),this.$target.parent().removeClass("has-error")},a.prototype.invalid=function(){this.$submit.addClass("disabled"),this.$target.parent().addClass("has-error")},a}();$(".comment_form").each(function(){new f(this)})});