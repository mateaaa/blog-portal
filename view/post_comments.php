<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $post->title; ?>
                </h3>
            </div>            
            <div class="panel-body">
                <?php echo $post->text; ?>               
            </div>            
        </div>
        <div class="detailBox">
            <div class="titleBox">
                <label>Comments</label>
            </div>
            <div class="actionBox">
                <ul class="commentList">
                    <?php
                    foreach ($commentList as $comment) {
                        ?>
                        <div class="commentText">
                            <li>
                                <?php echo '<h4><small>'.$comment->created.'</small><i> ' . $comment->username . ':</i></h3>'
                                . $comment->text;
                                ?>
                            </li>
                        </div>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        if (isset($currentUser)) {
            // User je login-an pa može komentirat i vidjet komentare
            ?>
            <form class="form-inline" action="<?php echo __SITE_URL . '/comment/newComment' ?>" role="form" method="POST">
                <div class="form-group">
                    <input name="comment" class="form-control" id="comment" type="text" placeholder="Write comment..." />
                </div>
                <div class="form-group">
                    <input type="hidden" name="postId" value="<?php echo $post->id; ?>" />
                    <button type="submit" class="btn btn-default">
                        Submit
                    </button>
                </div>
            </form>
            <?php }
        ?>
    </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>

