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
            <h2>Create a post</h2>
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
            <form class="form-group" action="/posts/create" method="post">
                <div class="form-group">
                    <label class="form-control-label" for="title">Title</label>
                    <input type="text" name="title" placeholder="Type title of the post" class="form-control is-valid" id="title" value="<?=$model->title?>">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="description">Description</label>
                    <textarea rows="8" cols="50" name="description" placeholder="Type description" class="form-control is-valid" id="author" > <?=$model->description?> </textarea>
                </div>

                <br />
                <button type="submit" class="btn btn-outline-secondary">Add</button>
            </form>
        </div>
    </div>


</div>

<script src="/assets/js/lib/jquery-min.js"></script>
<script src="/assets/js/lib/bootstrap.js"></script>

</body>
</html>
