<?php if (!empty($comments)) {?>
    <?php foreach ($comments as $comment) { ?>
        <div class="bottom-comment"><!--bottom comment-->

            <div class="comment-text">
                <a href="#" class="replay btn pull-right"> Replay</a>
                <h5><?= $comment->user->name;?></h5>

                <p class="comment-date">
                    <?= $comment->getDate();?>
                </p>


                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php if (!Yii::$app->user->isGuest) { ?>
    <div class="leave-comment"><!--leave comment-->
        <h4>Leave a reply</h4>

        <?php if (Yii::$app->session->getFlash('comment')) { ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('comment'); ?>
            </div>
        <?php } ?>

        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['site/comment', 'id'=>$article->id],
            'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']
        ])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentsForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Write Massage'])->label(false) ?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Comment</button>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div><!--end leave comment-->
<?php } ?>