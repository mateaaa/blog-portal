<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Popis svih blogova
                </h3>
            </div>
            <?php
            foreach ($userList as $user) {
                if ($user->blog_name != NULL) {
                    ?>
                    <div class="panel-body">
                        <a href="<?php echo __SITE_URL . '/blog/index?uid='.$user->id; ?>"><?php echo $user->blog_name . '</a>' . ' - <i><small>'. $user->username . '</small></i>'?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>