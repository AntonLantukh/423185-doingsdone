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

// Подключаем функцию-обработчик, где также хранятся другие функции
require_once ('functions.php');

// Обработка файлов
if (isset($_FILES['preview'])) {
            if ($_FILES['preview']['error'] == UPLOAD_ERR_OK) {
                $file_name = $_FILES['preview']['name'];
                $file_path = __DIR__ . '/';
                $file_transfer = move_uploaded_file ($_FILES['preview']['tmp_name'], $file_path . $file_name);
            } else {
                $error = $_FILES['preview']['error'];
            }
};

// Обработка запросов POST
$required = ['task', 'date_complete'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if (in_array($key, $required) && $value == '') {
            $errors[] = $key;
            $error_input_in = 'form__input--error';
            $error_message_in = 'Поле не должны быть пустым';
            header('Location: /index.php?add=1');
        } else {
            $new_task = $_POST;
            $new_task ["closed"] = false;
            array_push ($projects_in, $new_task);
        }
    }
};
var_dump ($_POST);

//if (!count($errors)) {

// Данные для созхранения значений в форме
$task = $_POST['task'] ?? '';
$date_complete = $_POST['date_complete'] ?? '';
$error_input_in = 'form__input--error' ?? '';
$error_message_in = 'Поле не должны быть пустым' ?? '';
$error_class_in = 'error-massage'

// Проверка на добавление окна с новой задачей
if (isset($_GET["add"])) {
    $add_class_in = ' class ="overlay"';
    $form_content_in = render_template ('templates/form_task.php', ['add_class' => $add_class_in, 'error_message' => $error_message_in, 'error_input' => $error_input_in]);
    } else {
        $add_class_in = '';
};

// Собираем значения основного контекта страницы
$page_content = render_template ('templates/index.php', ['error_message' => $error_message_in, 'error_input' => $error_input_in, 'add_class' => $add_class_in, 'id' => $id_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'show_complete_tasks' => $show_complete_tasks_in]);

// Добавляем к этому содержание шаппки и футера
$layout_content = render_template ('templates/layout.php', ['error_message' => $error_message_in, 'error_input' => $error_input_in, 'add_class' => $add_class_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'form_content' => $form_content_in,  'content' => $page_content, 'title' => 'Дела в порядке!']);

// Выводим всю страницу целиком
print $layout_content;
