<!DOCTYPE html>
<html class="no-js">
<?php
$dirPath = realpath(dirname(dirname(__FILE__)));
include_once "{$dirPath}/layout/head.php";
?>
<body>
<?php
include_once "{$dirPath}/layout/navbar.php";
?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <?php
            if($model->hasErrors()) {
                $errors = $model->getErrors();
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
