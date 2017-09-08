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

// Обработка запросов POST
$errors = [];
// Проверка на ошибки
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST)) {
        $fields = [
            'task',
            'date_complete',
            'project'
        ];
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = $field;
            } else {
                if ($field == 'date_complete') {
                    if ($_POST[$field] !== date ('d.m.Y', strtotime ($_POST[$field]))) {
                        $errors[] = $field;
                    }
                }
            }
        }
        if (empty($errors)) {
            if ($_FILES[$preview]['error'] == UPLOAD_ERR_OK) {
                $file_name = $_FILES['preview']['name'];
                $file_path = __DIR__ . '/';
                $file_transfer - move_uploaded_file ($_FILES['preview']['tmp_name'], $file_path . $file_name);
            }
            $new_task = [
                'task' => $_POST['task'],
                'date_complete' => $_POST['date_complete'],
                'project'=> $_POST['project'],
                'closed'=> false
            ];
            array_unshift($projects_in, $new_task);
        }
    }
};

// Подключаем функцию-обработчик, где также хранятся другие функции
require_once ('functions.php');

if (isset($_GET["add"]) || !empty($errors)) {
	$form_content = render_template('templates/form_task.php',['categories' => $categories_in, 'errors_form' => $errors]);
    } else {
	$form_content = '';
};

// Фильтруем задачи под каждую категорию
foreach ($projects_in as $key => $value) {
    if ($categories_in[$category_id] == 'Все' || $categories_in[$category_id] == $value['project']) {
        $category_tasks[] = $value;
    }
};
var_dump($projects_in);

// Собираем значения основного контекта страницы
$page_content = render_template ('templates/index.php', ['id' => $id_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'show_complete_tasks' => $show_complete_tasks_in]);
// Добавляем к этому содержание шаппки и футера
$layout_content = render_template ('templates/layout.php', ['form_content' => $form_content, 'projects' => $projects_in, 'categories' => $categories_in, 'content' => $page_content, 'title' => 'Дела в порядке!']);

// Выводим всю страницу целиком
print $layout_content;
