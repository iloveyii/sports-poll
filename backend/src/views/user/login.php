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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Simple Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/events/index">Index <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/events/create">Create</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <br />
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
                                            <input class="form-control" placeholder="Username" name="username" id="username" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="control-group flat-group">
                                            <input class="form-control" placeholder="Password" name="password" id="password" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3" style="text-align: right;"></div>
                                    <div class="col-md-9">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-sign-in fa-fw"></i>Log in</button>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- </form> -->
                        </div>
                        <br>
                    </div>
            </form>
        </div>
    </div>

</div>

<script src="/assets/js/lib/jquery-min.js"></script>
<script src="/assets/js/lib/bootstrap.js"></script>

</body>
</html>
