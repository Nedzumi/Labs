<?php 
// Шаблон основного тела страницы
?>
<body>

<!-- Блок для элементов в шапке -->
<header>
    <div id="pl-top"></div>
    <div id="pl-main">
	<!-- Блок логотипа -->
	<div id="logo" class="cadr">
	    <a href="/">
		<img src="/img/logo.jpg" />
		<div id="t1">ИЩУ</div>
		<div id="t2">КИНО</div>
	    </a>
	</div>
	
	<!-- Блок фильтра случайного поиска по параметрам -->
	<div id="genre" class="cadr">
	    <button id="getrandom" class="btn btn-info">Случайный фильм</button>
	    <div class="dropdown">
	        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    Выберите жанры
		    <span class="caret"></span>
		</button>
		<ul id="genres" class="dropdown-menu" aria-labelledby="dropdownMenu1">
		    <?php 
		    // Составляем выпадающий список жанров
		    foreach ($genre->genreData as $g) { ?>
		    <li><input type="checkbox" value="<?php echo $g->genreName;?>"/> <?php echo $g->genreName; ?></li>
		    <?php } ?>
		</ul>
	    </div>
	    <input id="ex2" type="text" class="span2" value="" data-slider-min="1920" data-slider-max="2016" data-slider-step="1" data-slider-value="[1920,2016]"/>
	</div>
	
	<!-- Блок поиска по названию -->
	<div id="search" class="cadr">
	    <form action="/index.php?page=search" method=POST>
		<button type="submit" class="btn btn-info">Найти по названию</button>
    		<input name="keyword" type="text" value="" />
    		<input type="hidden" name="search" value=1>
    	    </form>
	</div>
    </div>
    <div id="pl-bottom"></div>
</header>

<!-- Главный блок страницы -->
<div id="wrap">

<?php
// Роутер для определения подключаемого шаблона страницы из GET-параметра page
// Шаблоны страниц находятся в каталоге /tmpl
if (isset($_GET['page'])) {
    $page = "tmpl/".$_GET['page'].".php";
    if (file_exists($page)) {
	include $page;
    } else {
	include "404.php";
    }
} else {
    include "main.php";
}
?>


</div>

<!-- Блок, в котором отображается значок ожидания поиска, когда пользователь ищет случайный фильм -->
<div id="ninja"></div>

</body>
