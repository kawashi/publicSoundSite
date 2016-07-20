<div class="modal fade" id="comment-<?php echo $sound_id?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>全てのコメントを見る</h1>
            </div>
            <div class="modal-body">
                <?php 
                    foreach($comments as $comment){
                        if( $comment['sound_id'] === $sound_id ) echo '<p class="comment_modal_text">'.nl2br($comment['message']).'</p>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>  