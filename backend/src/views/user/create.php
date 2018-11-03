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
            <h2>User Signup</h2>
            <br />
        </div>
    </div>

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
            <form class="form-group" action="/user/signup" method="post">
                <div class="form-group">
                    <label class="form-control-label" for="title">Username</label>
                    <input type="text" name="username" placeholder="Type username" class="form-control is-valid" id="username" value="<?=$model->username?>">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="description">Password</label>
                    <input type="password" name="password" placeholder="Type password" class="form-control is-valid" id="password" value="<?=$model->password?>">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="description">Verify Password</label>
                    <input type="password" name="verifyPassword" placeholder="Verify password" class="form-control is-valid" id="verifyPassword" value="<?=$model->verifyPassword?>">
                </div>
                <br />
                <button type="submit" class="btn btn-outline-secondary">Sign up</button>
            </form>
        </div>
    </div>


</div>

<script src="/assets/js/lib/jquery-min.js"></script>
<script src="/assets/js/lib/bootstrap.js"></script>

</body>
</html>
