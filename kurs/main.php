<?php
// Шаблон главной страницы сайта 

// задаем метод API на получение фильмов, которые появятся в ближайшее время в кинотеатрах РФ
$api = "/getSoonFilms";
// сохраняем список премьер в переменную
$soon = get_data($api);
?>
<h1>Добро пожаловать на сайт!</h1>
<p>здесь вы можете найти много полезной информации по интересующему вас фильму.</p>

<div class='heading'>СКОРО НА ЭКРАНАХ</div>
<div id="main">
<?php 
$i = 1;
// Запускаем цикл на перебор всех премьер
foreach ($soon->previewFilms as $items) { ?>
    <?php // Так как премьеры в переменной $soon мы получаем в виде массивов по ближайшим неделям, запускаем перебор премьер в подмассивах
    foreach ($items as $item) { 
	// $item - это объект, который включает в себя различные параметры для отборажения фильма (название, год и т.д.)
	// Делаем проверку, если у фильма есть название на русском, то оно будет основным, а название на английском будет второстепенным
	if ($item->nameRU) { $name = $item->nameRU;$name_alt = $item->nameEN; }
	// иначе основным названием будет название на английском
	else {$name = $item->nameEN;$name_alt = "";}
	// следующей проверкой делаем вывод фильмов по 4 в строке и открываем блок, в котором будет 4 фильма
	if($i%4 == 1) { echo "<div class='row'>";}
    ?>
    
	<div class='col-md-3 soon'>
	    <p><?php echo $item->premiereRU ?></p>	    
	    <?php if ($item->posterURL) { ?>
	    <img src='http://st.kp.yandex.net/images/<?php echo str_replace("60_","120_",$item->posterURL)?> ' />
	    <?php } else { ?>
	    <img width=120 src='http://st.kinopoisk.ru/images/no-poster.gif' />
	    <?php } ?>
	    <a href='/index.php?page=film&id=<?php echo $item->id?> '>
	    <h3><?php echo $name ?><br>
	        <span class='alternative'><?php echo $name_alt ?></span>
	    </h3>
	    </a>
	    <p><?php echo $item->genre ?></p>
	</div>
	<?php 
	// следующей проверкой делаем вывод фильмов по 4 в строке и закрываем блок, в котором будет 4 фильма
	if($i%4 == 0) { echo "</div><div class=hr></div>";}
	$i = $i + 1;
    } ?>
<?php } ?>
</div>
