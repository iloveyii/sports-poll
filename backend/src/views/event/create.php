<!DOCTYPE html>
<html class="no-js">
<?php
$dirPath = realpath(dirname(dirname(__FILE__)));
include_once "{$dirPath}/layout/head.php";
?>
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
