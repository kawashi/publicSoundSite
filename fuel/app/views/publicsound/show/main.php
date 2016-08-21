<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>楽曲配布サイト</title>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <?php echo html_tag('link',
                        array(
                            'rel' => 'icon',
                            'type' => 'image/jpg',
                            'href' => Asset::get_file('favicon.png', 'img'),
                        )
                       ); ?>
    <?php echo Asset::CSS('public_sound.css', array("class" => "test")); ?>
    <?php echo Asset::JS('show.js'); ?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container text-center">
        <div class="page_title">
            <h1>―　John's Sound　―</h1>
            <p>自作音楽を投稿しています。</p>
        </div>
        <div class="update_history">
            <h1>更新履歴</h1>
            <div class="history_box text-left">
                <?php foreach( $historys as $history ): ?>
                    <p><?php echo $history["date"]; ?>：<?php echo $history["message"]; ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php
            // TODO: 用リファクタ必要性
            // ・each はタグ前か後か
            // ・PHP コードはもっと短く出来ないか(ヘルパーや省略記法等)
            // ・html を分割する
            // ・クラス名 ID は適切か
            // ・とりあえずはコメントが正常に表示出来れば公開出来るが、終わったらすぐに手を付ける
        ?>
        <div class="main_contents">
            <h1>楽曲一覧</h1>
            <?php foreach( $sounds as $sound ): ?>
                
                <?php /* 楽曲 */ ?>
                <div class="sound row" id="sound-id-<?php echo $sound['id']; ?>" data-id="<?php echo $sound["id"]; ?>">
                   
                    <?php /* 曲名・ジャンル名表示 */ ?>
                    <div class="left_box col-xs-6">
                        <div class="title">
                            <p> <?php echo $sound["title"]; ?> </p>
                        </div>
                        <div class="jenre">
                            <p> <?php echo $sound["genre"]; ?> </p>
                        </div>
                    </div>
                    <div class="right_box col-xs-6">
                       
                        <?php /* 楽曲再生 */ ?>
                        <div class="play">
                            <audio preload="metadata"  class="audio" data-id="<?php echo $sound["id"]; ?>" controls>
                                <source src="<?php echo Asset::get_file($sound['data'].'.mp3','sound',$sound['data']); ?>" type="audio/mpeg"></source>
                                <source src="<?php echo Asset::get_file($sound['data'].'.ogg','sound',$sound['data']); ?>" type="audio/ogg"></source>
                                <p>ブラウザ非対応</p>
                            </audio>
                        </div>
                        
                        <?php /* ダウンロードボタン */ ?>
                        <div class="downloads row">
                            <div class="btn-group col-xs-12 downloads" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle btn-block" data-toggle="dropdown" aria-expanded="false"><b>Download</b><span class="caret"></span></button>
                                <ul class="dropdown-menu right" role="menu">
                                    <li>
                                        <a href="<?php echo Asset::get_file($sound['data'].'.mp3','sound',$sound['data']); ?>" download="<?php echo $sound['data']; ?>.mp3" data-id="<?php echo $sound["id"]; ?>" class="download-button">MP3</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Asset::get_file($sound['data'].'.ogg','sound',$sound['data']); ?>" download="<?php echo $sound['data']; ?>.ogg" data-id="<?php echo $sound["id"]; ?>" class="download-button">OGG</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <?php /* 楽曲説明文 */ ?>
                    <div class="message col-xs-12">
                        <?php echo nl2br($sound["message"]); ?>
                    </div>
                    
                    <div class="comment col-xs-12" data-id="<?php echo $sound["id"]; ?>">
                        <?php /* コメント入力欄 */ ?>
                        <?php // TODO: 非常に汚いので <form> 等を入れてリファクタ ?>
                        <div class="form-group" data-id="<?php echo $sound["id"]; ?>">
                            <div class="col-xs-8">
                                <?php echo Form::textarea('message','',array(
                                            'class'       =>'comment_form form-control',
                                            // 'placeholder' => 'Ctrl + Enter でコメント',
                                            'data-id'     => $sound["id"]
                                        ));
                                ?>
                            </div>
                            <?php  echo Form::submit('submit','コメントする',array(
                                            'class'   => 'btn btn-primary comment_submit col-xs-2 disabled',
                                            'data-id' => $sound["id"]
                                        )); 
                            ?>
                        </div>
                        
                        <?php /* 再生数・DL数表示 */ ?>
                        <div class = "col-xs-2 row view_count">
                            <div class = "col-xs-6">
                                <p class = "count"><?php echo $sound['play_count'] ?></p>
                                <p>再生数</p>
                            </div>
                            <div class = "col-xs-6">
                                <p class = "count"><?php echo $sound['dl_count'] ?></p>
                                <p>DL数</p>
                            </div>
                        </div>
                    </div>
                    
                    <?php /* コメント表示 */ ?>
                    <div class="comment_list col-xs-12">
                        <?php if( $sound['comment_count'] != 0 ):
                            echo '<h2>コメント</h2>';
                        endif; ?>
                        <div class="message text-left comments">
                            <?php 
                            $i = 0;
                            foreach($comments as $comment):
                                if( $comment['sound_id'] == $sound['id'] ):
                                    $i++;
                                    if($i <= 3): ?>
                                        <div class="comment_field row comment-id-<?php echo $comment["id"]; ?>">
                                            <div class="comment_text col-xs-9">
                                                <p><?php echo nl2br($comment["message"]); ?></p>
                                            </div>
                                            <?php if(Cookie::get('user_id') == $comment["user_id"]): ?>
                                                <div class="comment_delete col-xs-3 text-right">
                                                    <a data-comment-id="<?php echo $comment["id"]; ?>">削除</a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else:
                                        echo '<button class="btn btn-default btn-block all-comment show_comment_button" data-toggle="modal" data-target="#comment-'.$sound["id"].'">コメント一覧</button>';
                                        echo View::forge('publicsound/show/comment_modal', array("comments" => $comments, "sound_id" => $sound["id"]))->render();          
                                        break;
                                    endif;
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="profiles text-center">
        <h1>― ジョンについて ―</h1>
        <ul class="list-unstyled">
            <li class="no1">
                <p>ジョン(John,1997年5月7日 - )とは、日本のDTMer。</p>
                <p>高校を卒業後フリーターになり、仕事にするのを目標に本格的にDTMを始める。</p>
                <p>哀愁漂う曲調と、打楽器の経験を活かした情熱的なドラムが特徴。</p>
                <p>ジャンルに拘らず、様々な楽曲を書いている。</p>
            </li>
            <li class="no2">
                <p>TwitterIDは <a href="https://twitter.com/k_t_mejohn">@k_t_mejohn</a></p>
                <p>ブログは <a href="http://jooohn.hateblo.jp/">http://jooohn.hateblo.jp/</a></p>
                <p>ニコニコ動画は <a href="http://www.nicovideo.jp/user/58961182 ">http://www.nicovideo.jp/user/58961182 </a></p>
                <p>楽曲制作依頼は aisatu_nomahou@yahoo.co.jp</p>
            </li>
        </ul>
    </div>

<footer class="text-center">Copyright © 2016 John All Rights Reserved.</footer>

    <!-- Bootstrap および　JQuery -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
        ga('create', 'UA-80120610-2', 'auto');
        ga('send', 'pageview');
    </script>
    
</body>
</html>
