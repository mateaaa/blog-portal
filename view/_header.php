<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8">
        <link rel="stylesheet" href="<?php echo __SITE_URL . '/css/style.css' ?>">
        <link href="<?php echo __SITE_URL . '/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
        <title>Blog Portal - <?php echo $title ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo __SITE_URL . '/bootstrap/js/bootstrap.min.js' ?>"></script>
    </head>


    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>
                            Blog Portal<small>ma piši brate...</small>
                        </h1>

                        <div id="menu">
                            <?php
                            if (isset($currentUser)) {
                                // User je login-an
                                
                            ?>
                                <a href="<?php echo __SITE_URL . '/home/index' ?>">Home</a>
                                <a href="<?php echo __SITE_URL . '/home/logout' ?>">Logout</a>
                            <?php
                            } else {
                            ?>
                                <a href="#" id="login" data-toggle="modal" data-target="#login-modal">Login</a>
                                <a href="#" id="register" data-toggle="modal" data-target="#register-modal">Register</a>
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>

                </div>
            </div>

            <?php
            if (isset($errorMessage)) {
                echo '<h3>' . $errorMessage . '</h3>';
            }
            ?>

            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="loginmodal-container">

                    <h3>Login</h3>

                    <form role="form" action="<?php echo __SITE_URL . '/home/login' ?>" method="POST">
                        <div class="form-group">

                            <label for="exampleInputEmail1">
                                Username
                            </label>
                            <input name="username" class="form-control" type="text" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                Password
                            </label>
                            <input name="password" class="form-control" type="password" />
                        </div>
                        <button type="submit" class="btn btn-default">
                            Submit
                        </button>
                    </form>
                </div>
            </div>





