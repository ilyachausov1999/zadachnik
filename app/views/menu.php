<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Задачник</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php if($data['active'] == 'index') { echo 'class="active"';} ?>><a href="/">Главная</a></li>
                <li <?php if($data['active'] == 'index_v2') { echo 'class="active"';} ?>><a href="/site/index_v2">Главная v2</a></li>
                <li <?php if($data['active'] == 'add') { echo 'class="active"';} ?>><a href="/site/create">Создать</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin">Админка</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>