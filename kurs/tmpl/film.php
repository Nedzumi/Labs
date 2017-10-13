<?php
// Шаблон вывода одного фильма
// входные параметры - GET-параметры

// созраняем GET-параметр id в переменную
$id = $_GET['id'];
// формируем API запрос на получение информации о фильме
$api = "/getFilm?filmID=".$id;
// сохраняем полученные данные в переменную
$film = get_data($api);

$prod = $actors = $director = "";

// $film->creators - массив с объектами, каждый объект которого содержит информацию о создателях фильма по категориям : актеры, режиссеры, продюссеры
foreach ($film->creators as $key=>$items) {
    foreach ($items as $item) {
	// если в информации о создателе фильма нет картинки с его лицом, то выводим дефолтную картинку
	if (!$item->posterURL) {$item->posterURL = "no-poster.gif";}
	// делаем проверку по категории создателя (director,actor,producer) -  режиссер, актер, продюссер соотвественно
	switch ($item->professionKey) {
	    case "director":
		$director .= "<div class='creator'>
		    <img src='http://st.kp.yandex.net/images/".$item->posterURL."' height=95 />
		    <p>".$item->nameRU."</p>
		</div>";
		break;
	    case "actor":
                $actors .= "<div class='creator'>
                    <img src='http://st.kp.yandex.net/images/".$item->posterURL."' height=95 />
                    <p>".$item->nameRU."</p>
                </div>";
		break;
	    case "producer":
                $prod .= "<div class='creator'>
            	    <img src='http://st.kp.yandex.net/images/".$item->posterURL."' height=95 />
                    <p>".$item->nameRU."</p>
                </div>";
		break;
	}
    }
} ?>

<!-- Выводим информацию о фильме -->
<h1><?php echo $film->nameRU ?><br>
<span class='alternative'><?php echo $film->nameEN ?></span>
</h1>

<div class='row'>
    <div class='col-md-5'>
	<?php if ($film->posterURL) { ?>
	<img src='http://st.kp.yandex.net/images/<?php echo str_replace("90_","360_",$film->posterURL) ?> ' />
	<?php } else { ?>
	<img width=360 src='http://st.kp.yandex.net/images/movies/poster_none.png' />
	<?php } ?>
    </div>
    <div class='col-md-7'>
	<table class=table>
	    <?php if ($film->year) { ?>
	    <tr>
	    <td>год</td>
	    <td><?php echo $film->year ?></td>
	    </tr>
	    <?php } ?>
	    <?php if ($film->country) { ?>
            <tr>
            <td>страна</td>
            <td><?php echo $film->country ?></td>
            </tr>
            <?php } ?>
            <?php if ($film->slogan) { ?>
            <tr>
            <td>слоган</td>
            <td><?php echo $film->slogan ?></td>
            </tr>
            <?php } ?>
            <?php if ($director) { ?>
            <tr>
            <td>режиссер</td>
            <td><?php echo $director ?></td>
            </tr>
            <?php } ?>
            <?php if ($actors) { ?>
            <tr>
            <td>в главных ролях</td>
            <td><?php echo $actors ?></td>
            </td>
            <?php } ?>
            <?php if ($prod) { ?>
            <tr>
            <td>продюссер</td>
            <td><?php echo $prod ?></td>
            </tr>
            <?php } ?>
            <?php if ($film->genre) { ?>
            <tr>
            <td>жанр</td>
            <td><?php echo $film->genre ?></td>
            </tr>
            <?php } ?>
            <?php if ($film->budgetData->budget) { ?>
            <tr>
            <td>бюджет</td>
            <td><?php echo $film->budgetData->budget ?> $</td>
            </tr>
            <?php } ?>
            <?php if ($film->budgetData->grossUSA) { ?>
            <tr>
            <td>сборы в США</td>
            <td><?php echo $film->budgetData->grossUSA ?> $</td>
            </tr>
            <?php } ?>
            <?php if ($film->budgetData->grossWorld) { ?>
            <tr>
            <td>сборы в мире</td>
            <td><?php echo $film->budgetData->grossWorld ?> $</td>
            </tr>
            <?php } ?>
            <?php if ($film->budgetData->grossRU) { ?>
            <tr>
            <td>сборы в России</td>
            <td><?php echo $film->budgetData->grossRU ?> $</td>
            </tr>
            <?php } ?>
            <?php if ($film->rentData->premiereWorld) { ?>
            <tr>
            <td>премьера (мир)</td>
            <td><?php echo $film->rentData->premiereWorld ?></td>
            </tr>
            <?php } ?>
            <?php if ($film->rentData->premiereRU) { ?>
            <tr>
            <td>премьера (РФ)</td>
            <td><?php echo $film->rentData->premiereRU ?></td>
            </tr>
            <?php } ?>
            <?php if ($film->ratingAgeLimits or $film->ratingMPAA) { ?>
            <tr>
            <td>возраст</td>
            <td><span class='raiting'><?php echo $film->ratingMPAA ?> <span><?php echo $film->ratingAgeLimits ?>+</td>
            </tr>
            <?php } ?>
            <?php if ($film->filmLength) { ?>
            <tr>
            <td>время</td>
            <td><?php echo $film->filmLength ?></td>
            </tr>
	    <?php } ?>
	</table>
    </div>
    <?php if ($film->description) { ?>
    <div class='col-md-12'>
	<div class='heading'>Описание:</div>
	<p><?php echo $film->description;?></p>
	
    </div>
    <?php } ?>

    <?php if ($film->videoURL) { ?>
    <div class='col-md-12'>
	<div class='heading'>Трэйлер:</div>
	<div align="center" class="embed-responsive embed-responsive-16by9">
	    <video autoplay loop class="embed-responsive-item" width=100% controls>
        	<source src="<?php echo $film->videoURL ?> " type="video/mp4">
            </video>
        </div> 
        
	
    </div>
    <?php } ?> 

    <?php if ($film->gallery) { ?>
    <div class='col-md-12 gallery'>
	<?php foreach($film->gallery as $img) { ?>
	    <img src='http://st.kp.yandex.net/images/<?php echo $img->preview ?> ' />
	<?php } ?>
	
    </div>
    <?php } ?>   

    <?php if ($film->triviaData) { ?>
    <div class='col-md-12'>
	<div class='heading'>Знаете ли вы, что:</div>
	<ul id='know'>
	    <?php foreach ($film->triviaData as $li) { ?>
	    <li><?php echo $li ?></li>
	    <?php } ?>
	</ul>
    </div>
    <?php } ?>
</div>

