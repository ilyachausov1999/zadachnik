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
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/admin/logout">Выход</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
    <table class="table">
        <!--Table head-->
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</a></th>
            <th>E-mail</th>
            <th>Файл</th>
            <th>Статус</th>
            <th>Дата</th>
            <th>#</th>
        </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody>
        <?php foreach($data['tasks'] as $t) { ?>
            <tr>
                <td><?=$t['id'];?></td>
                <td><?=$t['name'];?></td>
                <td><?=$t['email'];?></td>
                <td><?=$t['image'];?></td>
                <td><?=($t['status'] == 'new') ? 'Новая' : 'Завершена';?></td>
                <td><?=$t['created'];?></td>
                <td><a href="/admin/edit?id=<?=$t['id'];?>" class="show_task">Редактировать</a></td>
            </tr>
        <?php } ?>
        </tbody>
        <!--Table body-->

    </table>
</body>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>

</html>