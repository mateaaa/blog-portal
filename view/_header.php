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
                            Blog Portal
                        </h1>

                        <div id="menu">
                            <?php
							
                            if (isset($currentUser)) {
                                // User je login-an
									 echo '<div> Welcome, ' . $_SESSION['user']->username . '! </div>';

                            ?>
                                <a href="<?php echo __SITE_URL . '/profile/index' ?>">Home</a>
                                <a href="<?php echo __SITE_URL . '/home/logout' ?>">Logout</a>
                            <?php
                            } else {
								echo '<div> Welcome, guest! </div>';
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

                            <label for="exampleInputUsername1">
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
            
            <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="registermodal-container">

                    <h3>Register</h3>

                    <form role="form" action="<?php echo __SITE_URL . '/home/register' ?>" method="POST">
                        <div class="form-group">

                            <label for="exampleInputUsername1">
                                Username
                            </label>
                            <input name="username" class="form-control" type="text" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                Email
                            </label>
                            <input name="email" class="form-control" type="email" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFirstName1">
                                First name
                            </label>
                            <input name="first_name" class="form-control" type="text" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLastName1">
                                Last name
                            </label>
                            <input name="last_name" class="form-control" type="text" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                Password
                            </label>
                            <input name="password" class="form-control" type="password" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBlogName1">
                                Blog name
                            </label>
                            <input name="blog_name" class="form-control" type="text" />
                        </div>
                        <button type="submit" class="btn btn-default">
                            Submit
                        </button>
                    </form>
                </div>
            </div>






