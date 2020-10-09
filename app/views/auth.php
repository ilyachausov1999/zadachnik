<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$data['title'];?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            <div id="auth-form" class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Auth Form</h3>
                </div>
                <form class="panel-body" action="/admin/login" method="post">
                    <div class="input-group">
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-user"></span>
          </span>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Login">
                    </div>
                    <div class="input-group">
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-lock"></span>
          </span>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
            <div class="col-lg-4"></div>

        </div>
        </div>
</body>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>

</html>