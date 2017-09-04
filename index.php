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

// показывать или нет выполненные задачи
$show_complete_tasks_in = rand(0, 1);

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// Функция для расчета количества дней до дедлайна
function is_deadline_overdue ($deadline) {
    if (empty ($deadline)) {
        return (false);
    } else {
        $current_ts = strtotime('now midnight');
        $task_deadline_ts = strtotime($deadline);
        $days_until_deadline = floor (($task_deadline_ts - $current_ts) / 86400);

        if ($days_until_deadline <= 0) {
          return (true);
        } else {
            return (false);
        }
    }
};

// Функция для подсчета количества задач под каждой категорией
function task_count ($tasks_array, $project_name) {
    $cnt = 0;
    if ($project_name == "Все") {
        $cnt = count ($tasks_array);
    } else {
        foreach ($tasks_array as $key => $value) {
            if ($project_name == $value["project"]) {
                $cnt++;
            }
        }
    }
    return ($cnt);
};

// Функця проверки корректности параметра запроса id
function project_check ($categories_in) {
    if (isset($_GET["id"])) {
        $id_in = (int)$_GET["id"];
            if (!array_key_exists ($id_in, $categories_in)) {
                header ("HTTP/1.1 404 Not Found");
            }
    }
};

// Функция для отображения проектов в соответствии с идентификатором
function project_count ($categories, $value) {
    $id_in = (int)$_GET["id"];
        if ($id_in == 0) {
            return(1);
        }
        elseif ($categories[$id_in] == $value) {
            return (1);
        } else {
            return (0);
        }
};

// Подключаем функцию-обработчик, где также хранятся другие функции
require_once ('functions.php');

// Подключаем функцию проверки корректности параметра запроса id
project_check ($categories_in);

// Собираем значения основного контекта страницы
$page_content = render_template ('templates/index.php', ['id' => $id_in, 'projects' => $projects_in, 'categories' => $categories_in, 'show_complete_tasks' => $show_complete_tasks_in]);

// Добавляем к этому содержание шаппки и футера
$layout_content = render_template ('templates/layout.php', ['projects' => $projects_in, 'categories' => $categories_in, 'content' => $page_content, 'title' => 'Дела в порядке!']);

// Выводим всю страницу целиком
print $layout_content;
?>
