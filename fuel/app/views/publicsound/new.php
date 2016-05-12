<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php echo Asset::CSS('new.css'); ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>管理者ページ</title>
</head>
<body>
    <div class="container">
       <div class="row">
            <div class="uploader col-md-6 col-md-offset-3">
                <h1 class="text-center">We can change the world!</h1>
                
                <?php if( Input::get('flag') ): ?>
                    <div class="success bg-success text-success text-center">
                        <p>Success</p>
                    </div>
                <?php endif; ?>
                
                <?php echo Form::open(array('action'=>'publicsound/create','enctype'=>'multipart/form-data','method'=>'post')); ?>
                
                    <div class="item title">
                        <?php echo Form::label('Title','title'); ?>
                        <?php echo Form::input('title',''); ?>
                    </div>
                    
                    <div class="item genre">
                        <?php echo Form::label('Genre','genre'); ?>
                        <?php echo Form::input('genre',''); ?>
                    </div>
                
                    <div class="item message">
                        <?php echo Form::label('Message','message'); ?>
                        <?php echo Form::textarea('message',''); ?>
                    </div>
            
                    <div class="item data">    
                        <?php echo Form::label('Data (OGG MP3 WAV)','data'); ?>
                        <?php echo Form::file('data',array('class' => 'file')); ?>
                        <?php //echo Form::file('data',array('class' => 'file')); ?>
                        <?php //echo Form::file('data',array('class' => 'file')); ?>
                    </div>
                                    
                    <div class="submit">
                        <?php echo Form::submit('submit','Upload Now!',array('class' => 'btn btn-primary')); ?>
                    </div>
                
                <?php echo Form::close(); ?>
            </div>
        </div>
        <div class="message text-center">
                <p>※著作権はかわしぃに帰属</p>
        </div>
        
    </div>
    <!-- Bootstrap および　JQuery -->
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>