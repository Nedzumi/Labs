<?php
// Шаблон для вывода списка фильмов, когда пользователь ищет фильм по названию
// входящие данные приходят как из POST так и из GET запроса
// POST-запрос приходит когда пользователь ввел поисковое слово (ключевое слово) в форме, в шапке сайта и нажал кнопку "найти по названию"
// GET-запрос приходит, когда пользователь переходит по страницам найденных результатов. Страницы расположены после найденных фильмов

// переписывем данные POST запроса в переменную
// POST-запрос содержит слово, по которому был произведен поиск
$data = $_POST;
// если данных в POST-запросе и GET-запросе нет, то возвращаем на страницу соответсвующий текст
if ($data == NULL and $_GET['keyword'] == NULL) {
    $html = "<p>Нет совпадений</p>";
// иначе формируем html-данные
} else {
    // если ключевое слово есть в POST-запросе, то сохраняем ключевое слово в переменную key
    if ($data['keyword']) { $key = $data['keyword'];}
    // иначе в переменную key записывем ключевое слово из GET-запроса
    else {$key = $_GET['keyword'];}
    // если в GET-запросе нет параметра p, отвечающего за номер страницы, то в переменную $p записываем 1, т.е. 1-я страница
    if ($_GET['p'] == NULL) {$p = 1;}
    // иначе записываем номер страницы из GET-запроса
    else {$p = $_GET['p'];}    

    // формируем API запрос на получение фильмов по ключевому слову, а также указывая номер страницы.
    // API сервис кинопоиска работает таким образом, что выдает не более 20 фильмов за запрос. 
    // Если найденных фильмов больше 20, то он также возвращает данные о том, сколько страниц найдено.
    $api = "/searchFilms?keyword=".$key."&page=".$p;
    $items = get_data($api);
    $html = "";
    
    // получаем количество страниц найденных фильмов
    $pages = $items->pagesCount;
    // формируем пагинацию (разбиение на страницы)
    $pagi = "<nav><ul id='pagi'>";
    // запускаем циклс начальным значением 1 и шагом +1, который закончится когда наш шаг $i будет больше количества полученных страниц
    for ($i=1;$i<=$pages;$i++) {
	// формируем для каждого $i ссылку на соответсвующую страницу
	$pagi .= "<li>
	    <a href='/index.php?page=search&p=".$i."&keyword=".$key."'>".$i."</a>
	</li>";
    }
    // закрываем тэг <ul> для блока пагинации
    $pagi .= "</ul></nav>";
    
    // перебираем все найденые на соответсвующей странице фильмы, и формируем html-блок с данными о фильме
    // все фильмы выводятся по одному в ряд
    foreach ($items->searchFilms as $item) {
	if ($item->posterURL) { $img = "<img src='http://st.kp.yandex.net/images/".str_replace("60_","120_",$item->posterURL)."' />"  ;} 
	else { $img = "<img width=120 src='http://st.kinopoisk.ru/images/no-poster.gif' />";}

	if ($item->nameRU) { $name = $item->nameRU;$name_alt = $item->nameEN; }
	else {$name = $item->nameEN;$name_alt = "";}
	
	$year = $length = $desc = $genre = "не указано";
	if ($item->genre) {$genre = $item->genre;}
	if ($item->description) {$desc = $item->description;}
	if ($item->filmLength) {$length = $item->filmLength;}
	if ($item->year) {$year = $item->year;}
	
	// сохраняем html-блок с данными о фильме в общей переменной для вывода на страницу
	$html .= "<div class='row film'>
	    <div class='col-md-2'>".$img."</div>
	    <div class='col-md-10'>
		<a href='/index.php?page=film&id=".$item->id."'>
		<h2>".$name."<br>
		    <span class='alternative'>".$name_alt."</span>
		</h2>
		</a>
		<p><span class='orange'>Год</span>: ".$year."</p>
		<p><span class='orange'>Длительность</span>: ".$length."</p>
		<p><span class='orange'>Жанр</span>: ".$genre."</p>
		<p><span class='orange'>Описание</span>: ".$desc."</p>
		<p><a href='/index.php?page=film&id=".$item->id."'>подробнее</a></p>
	    </div>
	</div>";
    }    
    // после цикла, в котором мы перебирали все фильмы для вывода их на страницу, мы добавляем пагинацию (ссылки на другие страницы)
    $html .= $pagi;
}
?>

<h1>Результаты поиска:</h1>
<?php 
// выводим html-блок на странице
echo $html; 
?>
