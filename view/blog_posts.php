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
            $uvjet_za_edit_i_delete = (isset($currentUser) && ($currentUser->is_admin));

            foreach ($postList as $post) {
                ?>
                <div class="panel-body">
                    <?php echo $post->title . '<br/> ' . substr($post->text, 0, 480) ?>           
                    <a href="<?php echo __SITE_URL . '/comment/index?pid=' . $post->id . '&pTitle=' . $post->title; ?>">Show more...</a>
                </div>
                <?php
                // ovaj dio prikaži samo ako je ulogirani korisnik administrator
                if ($uvjet_za_edit_i_delete) {
                    ?>
                    <form class="form-inline" action="<?php echo __SITE_URL . '/blog/DeleteEditPost?uid=' . $post->user_id; ?>" role="form" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="postId" value="<?php echo $post->id; ?>" />
                            <button type="submit" name="delete_button" class="btn btn-default">
                                delete
                            </button>
                            <button type="submit" name="edit_button" class="btn btn-default">
                                edit
                            </button>
                        </div>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>