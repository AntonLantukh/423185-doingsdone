<?php

// Определяем массив для проектов
$categories = ["Все", "Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

// Определяем ассоциативные массивы в рамках двумерного массива
$projects = [
    [
      "task" => "Собеседование в IT компании",
      "date_complete" => "01.06.2018",
      "project" => "Работа",
      "closed" => false,
    ],

    [
      "task" => "Выполнить тестовое задание",
      "date_complete" => "25.05.2018",
      "project" => "Работа",
      "closed" => false,
    ],

    [
      "task" => "Сделать задание первого раздела",
      "date_complete" => "21.04.2018",
      "project" => "Учеба",
      "closed" => true,
    ],

    [
      "task" => "Встреча с другом",
      "date_complete" => "22.04.2018",
      "project" => "Входящие",
      "closed" => false,
    ],

    [
      "task" => "Купить корм для кота",
      "date_complete" => "",
      "project" => "Домашние дела",
      "closed" => false,
    ],

    [
      "task" => "Заказать пиццу",
      "date_complete" => "",
      "project" => "Домашние дела",
      "closed" => false,
    ],
];

// Подключаем функцию-обработчик, где также хранятся другие функции
require_once ('functions.php');

// Собираем значения основного контекта страницы
$page_content = render_template ('templates/index.php', $categories, $projects, ['content' => $page_content, 'title' => 'GifTube - Главная']);

// Добавляем к этому содержание шаппки и футера
$layout_content = render_template('templates/layout.php', $categories, $projects, ['content' => $page_content, 'title' => 'GifTube - Главная']);

// Выводим всю страницу целиком
print $layout_content;
?>
