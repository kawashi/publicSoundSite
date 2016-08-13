<div class="modal fade" id="comment-<?php echo $sound_id?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1>全てのコメントを見る</h1>
            </div>
            <div class="modal-body">
                <?php 
                foreach($comments as $comment):
                    if( $comment['sound_id'] === $sound_id ): ?>
                        <div class="comment_modal_text comment_field row comment-id-<?php echo $comment["id"]; ?>">
                            <div class="col-md-9">
                                <p><?php echo nl2br($comment['message']); ?></p>
                            </div>
                            <?php if(Cookie::get('user_id') == $comment['user_id']): ?>
                                <div class="comment_delete col-md-3 text-right">
                                    <a data-comment-id="<?php echo $comment["id"]; ?>">削除</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>  