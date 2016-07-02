<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $title ?>
                </h3>
                <a href="<?php echo __SITE_URL . '/profile/newpost' ?>">Create new post</a>
            </div>
            <?php
            foreach ($postList as $post) {
                ?>
                <div class="panel-body">
                   <?php echo $post->title . 
                           '<br/> ' 
                           . substr( $post->text, 0, 480) ?>                  
                   <a href="<?php echo __SITE_URL . '/profile/edit?pid='.$post->id ?>">Edit</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>