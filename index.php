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

// Функция для проверки на существование параметра запроса с идентификатором проекта
function parameter_check ($categories, $value) {
    if (isset($_GET["id"])) {
        $id_in = (int)$_GET["id"];
        if ($id_in == 0) {
            return (1);
        }
        if (array_key_exists ($id_in, $categories)) {
                if ($categories[$id_in] == $value) {
                    return (1);
                } else {
                    return (0);
                }
       } else {
           header ("HTTP/1.1 404 Not Found");
       }
   }
};

// Подключаем функцию-обработчик, где также хранятся другие функции
require_once ('functions.php');

// Собираем значения основного контекта страницы
$page_content = render_template ('templates/index.php', ['id' => $id_in, 'projects' => $projects_in, 'categories' => $categories_in, 'show_complete_tasks' => $show_complete_tasks_in]);

// Добавляем к этому содержание шаппки и футера
$layout_content = render_template ('templates/layout.php', ['projects' => $projects_in, 'categories' => $categories_in, 'content' => $page_content, 'title' => 'Дела в порядке!']);

// Выводим всю страницу целиком
print $layout_content;
?>
