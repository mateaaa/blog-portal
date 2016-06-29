<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $blogName ?>
                </h3>
            </div>
            <?php
            foreach ($postList as $post) {
                ?>
                <div class="panel-body">
                   <?php echo $post->title . '<br/> ' . $post->text; ?>                  
                   <a href="<?php echo __SITE_URL . '/comment/index?pid='.$post->id  . '&pTitle='.$post->title; ?>">Show more...</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>