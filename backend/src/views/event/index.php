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
            <h2>List of events</h2>
            <br />
            <h4 id="event"><?=$model[0]['categoryName']?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <br />
            <form action="/events/create" method="post">
                <table class="table table-hover" id="posts-index-table">
                <thead>
                <tr>
                    <th>Event</th>
                    <th>Home Wins</th>
                    <th>Draw</th>
                    <th>Away Wins</th>
                </tr>
                </thead>
                <tbody class="post-index">
                    <?php foreach ($model as $event) : ?>
                    <tr>
                        <td><?=$event['name']?></td>
                        <td><input type="radio" name="radio_<?=$event['id']?>" value="home" <?=isset($event['winner_id']) && $event['winner_id']==1 ? 'checked' : ''?>></td>
                        <td><input type="radio" name="radio_<?=$event['id']?>" value="draw" <?=isset($event['winner_id']) && $event['winner_id']==2 ? 'checked' : ''?>></td>
                        <td><input type="radio" name="radio_<?=$event['id']?>" value="away" <?=isset($event['winner_id']) && $event['winner_id']==3 ? 'checked' : ''?>></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
                <div class="form-group float-right">
                    <input type="submit" value="Poll" class="btn btn-lg btn-success">
                </div>
            </form>
        </div>
    </div>

</div>

<script src="/assets/js/lib/jquery-min.js"></script>
<script src="/assets/js/lib/bootstrap.js"></script>

</body>
</html>
