<?php

// Определяем массив для проектов
$categories_in = ["Все", "Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

// Определяем ассоциативные массивы в рамках двумерного массива
$projects_in = [
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

// Проверка корректности параметра запроса id
if (isset($_GET['id']) && !array_key_exists (intval($_GET[id]), $categories_in)) {
    header ("HTTP/1.1 404 Not Found");
}

// Задаем массив для каждой категории задач
$category_id = intval($_GET['id']);
$category_tasks = [];

foreach ($projects_in as $key => $value) {
    if ($categories_in[$category_id] == 'Все' || $categories_in[$category_id] == $value['project']) {
        $category_tasks[] = $value;
    }
};
var_dump($category_tasks);
// Подключаем функцию-обработчик, где также хранятся другие функции
require_once ('functions.php');

// Собираем значения основного контекта страницы
$page_content = render_template ('templates/index.php', ['id' => $id_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'show_complete_tasks' => $show_complete_tasks_in]);

// Добавляем к этому содержание шаппки и футера
$layout_content = render_template ('templates/layout.php', ['projects' => $projects_in, 'categories' => $categories_in, 'content' => $page_content, 'title' => 'Дела в порядке!']);

// Выводим всю страницу целиком
print $layout_content;
?>
