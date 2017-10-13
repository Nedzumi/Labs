<?php
// Функция для отладки - выводим дамп переменной в html тэге <pre>, для удобного отображения
function pre($s) {
    echo "<pre>";
    var_dump($s);
    echo "</pre>";
}

// Функция отправки API-запроса на сервис http://api.kinopoisk.cf/, для получения нужной информации
function get_data($api) {
    // выполняем запрос с передаваемым значением $api и сохраняем ответ в переменную
    $html = file_get_contents('http://api.kinopoisk.cf/'.$api);
    // приводим json-формат к структуре объекта и возвращаем
    return json_decode($html);
}

// Функция случайного перемешивания данных в массиве
function shuffle_assoc( $array ) { 
    // переписываем ключи входящего массива в переменную
    $keys = array_keys( $array ); 
    // перемешиваем ключи в разном порядке
    shuffle( $keys ); 
    // возвращаем входящий массив с перемешанными ключами
    return array_merge( array_flip( $keys ) , $array ); 
}
