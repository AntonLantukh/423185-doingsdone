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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['task'])) {
        $error_invalid_span_task = 'class = "error-massage"';
        $error_invalid_message_task = "Поле заполнено неверно";
        $error_invalid_input_task = 'form__input--error';
    }
    if (empty($_POST['date_complete'])) {
        $error_invalid_span_date = ' class = "error-massage"';
        $error_invalid_message_date = "Поле заполнено неверно";
        $error_invalid_input_date = 'form__input--error';
    }
    if (empty($_POST['project'])) {
        $error_invalid_span_project = ' class = "error-massage"';
        $error_invalid_message_project = "Поле заполнено неверно";
        $error_invalid_input_project = 'form__input--error';
    }
    if (empty($_POST['date_complete']) || empty($_POST['task']) || empty($_POST['project'])) {
        $add_class_in = ' class ="overlay"';
        $task_in = $_POST['task'];
        $date_complete_in = $_POST['date_complete'];
        $project_in = $_POST['project'];
        $page_content = render_template ('templates/index.php', ['projects_count' => $projects_in, 'task_form' => $task_in, 'date_complete' => $date_complete_in, 'project_cat' => $project_in, 'add_class' => $add_class_in, 'id' => $id_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'show_complete_tasks' => $show_complete_tasks_in ]);
        $form_content_in = render_template ('templates/form_task.php', ['error_span_project' => $error_invalid_span_project, 'error_message_project' => $error_invalid_message_project, 'error_input_project' => $error_invalid_input_project, 'error_span_task' => $error_invalid_span_task, 'error_message_task' => $error_invalid_message_task, 'error_input_task' => $error_invalid_input_task, 'error_span_date' => $error_invalid_span_date, 'error_message_date' => $error_invalid_message_date, 'error_input_date' => $error_invalid_input_date, 'task_form' => $task_in, 'date_complete' => $date_complete_in, 'project_cat' => $project_in, 'add_class' => $add_class_in, 'categories' => $categories_in]);
        $layout_content = render_template ('templates/layout.php', ['projects_count' => $projects_in, 'task_form' => $task_in, 'date_complete' => $date_complete_in, 'project_cat' => $project_in, 'add_class' => $add_class_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'form_content' => $form_content_in,  'content' => $page_content, 'title' => 'Дела в порядке!']);
        print $layout_content;
    }
    if (!empty($_POST['date_complete']) && !empty($_POST['task']) && !empty($_POST['project'])) {
        $new_task = $_POST;
        $new_task[closed] = false;
        array_push($category_tasks, $new_task);
    }
};

// Проверка на добавление окна с новой задачей
if (isset($_GET["add"])) {
    $add_class_in = ' class ="overlay"';
    $form_content_in = render_template ('templates/form_task.php', ['task' => $task_in, 'date_complete' => $date_complete_in, 'error_span' => $error_class_in, 'add_class' => $add_class_in, 'error_message' => $error_message_in, 'error_input' => $error_input_in, 'categories' => $categories_in,]);
    } else {
        $add_class_in = '';
};

// Собираем значения основного контекта страницы
$page_content = render_template ('templates/index.php', ['task' => $task_in, 'date_complete' => $date_complete_in, 'error_span' => $error_class_in, 'error_message' => $error_message_in, 'error_input' => $error_input_in, 'add_class' => $add_class_in, 'id' => $id_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'show_complete_tasks' => $show_complete_tasks_in]);

// Добавляем к этому содержание шаппки и футера
$layout_content = render_template ('templates/layout.php', ['projects_count' => $projects_in, 'task' => $task_in, 'date_complete' => $date_complete_in, 'error_span' => $error_class_in, 'error_message' => $error_message_in, 'error_input' => $error_input_in, 'add_class' => $add_class_in, 'projects' => $category_tasks, 'categories' => $categories_in, 'form_content' => $form_content_in,  'content' => $page_content, 'title' => 'Дела в порядке!']);

// Выводим всю страницу целиком
print $layout_content;
