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
<?php include 'menu.php'; ?>
    <h1>Список задач</h1>
    <div class="form-group">
        <label for="sort">Сортировка</label>
        <select class="form-control" id="sort">
            <option value="name" <?php if($data['sort'] == 'name') echo 'selected' ?>>По имени</option>
            <option value="email" <?php if($data['sort'] == 'email') echo 'selected' ?>>По Email</option>
            <option value="status" <?php if($data['sort'] == 'status') echo 'selected' ?>>По статусу</option>
        </select>
    </div>
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
                    <td><a href="#" ids="<?=$t['id'];?>" class="show_task">Показать</a></td>
                </tr>
            <?php } ?>


        </tbody>
        <!--Table body-->

    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if($data['total_pages'] > 1) : ?>
                <?php for($i = 0; $i < $data['total_pages']; $i++) { ?>
                    <li <?php if($data['page'] == $i) echo 'class="active"'; ?> ><a href="/site/index?page=<?=$i+1;?>&sort=<?=$data['sort'];?>"><?=$i+1;?></a></li>
                <?php } ?>
            <?php endif; ?>
        </ul>
    </nav>
    <!--Table-->
</div>

<!--Модалка для превью -->
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Просмотр задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b>Имя пользователя:</b> <span id="nameContainer"></span><br />
                <b>Email:</b> <span id="emailContainer"></span><br />
                <b>Текст:</b> <span id="textContainer"></span><br />
                <img id="imgContainer" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

</body>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('a.show_task').on('click',function(){
           var task_id = $(this).attr('ids');
           $.ajax({
              url: '/site/get_task',
              type: 'post',
              dataType: 'json',
              data: 'id='+task_id,
              success: function(msg) {
                  if(msg != '')
                  {
                      $('#nameContainer').html(msg.name);
                      $('#emailContainer').html(msg.email);
                      $('#textContainer').html(msg.text);
                      $('#imgContainer').attr('src','/'+msg.image);
                      $('.modal').modal('show');
                  }
                  console.log(msg['name']);
              }
           });
        });
        $('#sort').on('change',function(){
            location.href = '/site/index?sort='+$(this).val()
        });
    });
</script>
</html>