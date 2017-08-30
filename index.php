<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
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
}

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
}

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

?>
<?php
    require_once('functions.php');
    $page_content = renderTemplate('templates/layout.php', $projects);
    print $page_content;
?>
