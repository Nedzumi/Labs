<?php 
// подключаем файл с функциями
include "func.php";

// Задаем API метод
$api = '/getGenres';
// Получаем список жанров
$genre = get_data($api);
?>

<html>
<?php
// подключаем шаблон <head> страницы
include "head.php";
// подключаем шаблон <body> страницы
include "body.php";
?>
</html>
