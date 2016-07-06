<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>楽曲配布サイト</title>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <?php echo Asset::CSS('public_sound.css'); ?>
    <?php echo Asset::JS('show.js'); ?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="test">
    <div class="container text-center">
        <div class="page_title">
            <h1>フリー音楽配布サイト</h1>
            <p>自由にダウンロードできる音楽を配布しております。</p>
        </div>
        <div class="update_history">
            <h1>更新履歴</h1>
            <div class="history_box text-left">
                <?php foreach( $historys as $history ): ?>
                    <p><?php echo $history["date"]; ?>：<?php echo $history["message"]; ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="main_contents">
            <h1>楽曲一覧</h1>
            <?php foreach( $sounds as $sound ): ?>
                <div class="sound row" data-name="<?php echo str_replace(' ','_',$sound['data']); ?>">
                    <?php /* 曲名・ジャンル名表示 */ ?>
                    <div class="left_box col-md-6">
                        <div class="title">
                            <p> <?php echo $sound["title"]; ?> </p>
                        </div>
                        <div class="jenre">
                            <p> <?php echo $sound["genre"]; ?> </p>
                        </div>
                    </div>
                    <div class="right_box col-md-6">
                        <?php /* 楽曲再生 */ ?>
                        <div class="play">
                            <audio preload="metadata"  class="audio" data-name="<?php echo str_replace(' ','_',$sound['data']); ?>" controls>
                                <source src="<?php echo Asset::get_file($sound['data'].'.mp3','sound',$sound['data']); ?>" type="audio/mpeg"></source>
                                <source src="<?php echo Asset::get_file($sound['data'].'.ogg','sound',$sound['data']); ?>" type="audio/ogg"></source>
                                <p>ブラウザ非対応</p>
                            </audio>
                        </div>
                        <?php /* ダウンロードボタン */ ?>
                        <div class="downloads row">
                            <div class="btn-group col-md-12 downloads" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle btn-block" data-toggle="dropdown" aria-expanded="false">Download<span class="caret"></span></button>
                                <ul class="dropdown-menu right" role="menu">
                                    <li>
                                        <a href="<?php echo Asset::get_file($sound['data'].'.mp3','sound',$sound['data']); ?>" download="<?php echo $sound['data']; ?>.mp3" data-name="<?1php echo str_replace(' ','_',$sound['data']); ?>">MP3</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Asset::get_file($sound['data'].'.ogg','sound',$sound['data']); ?>" download="<?php echo $sound['data']; ?>.ogg" data-name="<?php echo str_replace(' ','_',$sound['data']); ?>">OGG</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php /* 楽曲説明文 */ ?>
                    <div class="message col-md-12">
                        <?php echo nl2br($sound["message"]); ?>
                    </div>
                    <?php /* コメント入力欄 */ ?>
                    <div class="comment col-md-12" data-name="<?php echo str_replace(' ','_',$sound['data']); ?>">
                        <div class="form-group">
                            <div class="col-md-8">
                                <?php echo Form::textarea('message','',array('class'=>'comment_form form-control')); ?>
                            </div>
                            <?php  echo Form::submit('submit','Comment',array('class'=>'btn btn-primary comment_submit col-md-2')); ?>
                        </div>
                        <div class = "col-md-2 row view_count">
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
                    <div class="comment_list col-md-12">
                        <h2>コメント</h2>
                        <?php foreach($comments as $comment): ?>
                            <?php if( $comment['sound_id'] == $sound['id'] ): ?>
                                <div class="message">
                                    <p><?php echo nl2br($comment['message']); ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="profiles text-center">
        <h1>― 焼きそばメロンパンについて ―</h1>
        <ul class="list-unstyled">
            <li class="no1">
                <p>焼きそばメロンパンはハンドルネームであり、好物である。</p>
                <p>高校時代に趣味で始めたDTMに取り憑かれ、今ではプロを目指して作曲をしている。</p>
                <p>好きなジャンルはスピードコア、特徴的なスネアドラムのメロディが幻想的だ。</p>
                <p>得意ジャンルはバロック時代、パイプオルガンを使えば右に出るのはバッハくらいだろう。</p>
            </li>
            <li class="no2">
                <p>好きな食べ物は無い</p>
                <p>趣味も特に無い</p>
                <p>高校中退後はやることも見当たらない。</p>
                <p>まさに自由人である。</p>
            </li>
            <li class="no3">
                <p>TwitterIDは<a href="#">@ice_arr</a></p>
                <p>基本的には意味の無いつぶやきばかり。</p>
                <p>ただ、興味があればフォローしていただけるとありがたい。</p>
            </li>
            <li class="no4">
                <p>楽曲製作の依頼や公開楽曲の感想などがあれば下記まで。</p>
                <p>aisatu_nomahou@yahoo.co.jp</p>
                <p>最後になるが、このサイトを見てくれてありがとう。</p>
                <p>これからも焼きそばメロンパンを応援してください。</p>
            </li>
        </ul>
    </div>

    <footer class="text-center">著作権はかわしぃに帰属</footer>

    <!-- Bootstrap および　JQuery -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
