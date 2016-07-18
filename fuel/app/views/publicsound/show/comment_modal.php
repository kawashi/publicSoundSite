<div class="modal fade" id="comment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>全てのコメントを見る</h1>
            </div>
            <div class="modal-body">
                <?php foreach($comments as $comment): ?>
                    <?php if( $comment['sound_id'] == $sound["id"] ): ?>
                        <p class="comment_modal_text"><?php echo nl2br($comment['message']); ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>  