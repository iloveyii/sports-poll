<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Backbone JS - Simple Blog</title>
    <link rel="icon" href="/assets/images/favicon.png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/custom.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">

    <script src="/assets/js/lib/modernizr-2.6.2.min.js"></script>
</head>
<body>
<?php
$dirPath = realpath(dirname(dirname(__FILE__)));
include_once "{$dirPath}/layout/navbar.php";
?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <?php
            if($model->hasErrors()) {
                $errors = $model->getErrors();
                $dirPath = realpath(dirname(dirname(__FILE__)));
                include_once "{$dirPath}/layout/errors.php";
            }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form class="form-vertical" id="login-form" action="/user/login" method="post">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <fieldset>
                                <div class="form-group">
                                    <h2>Log In</h2>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-group flat-group">
                                            <input class="form-control" placeholder="Username" name="username" id="username" type="text" value="<?=$model->username?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-group flat-group">
                                            <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="<?=$model->password?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3" style="text-align: right;"></div>
                                    <div class="col-md-9">
                                        <input class="btn btn-success" type="submit" value="Login">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
            </form> <!-- </form> -->
        </div>
    </div>

</div>

<script src="/assets/js/lib/jquery-min.js"></script>
<script src="/assets/js/lib/bootstrap.js"></script>

</body>
</html>
