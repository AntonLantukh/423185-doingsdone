<?php
// Подключаем массив с пользователями
require_once ('userdata.php');

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

// Функция для обрабтки шаблонов и подключения их в index.php
function render_template ($template_route, $template_array) {
    $file_check = file_exists ($template_route);
        if (!$file_check) {
            return ("");
        } else {
            ob_start();
            extract ($template_array);
            require_once($template_route);
            session_start ();
            $html = ob_get_clean();
            return ($html);
        }
};

// Функция для поиска пользователя по e-mail
function search_user_by_email($email, $users) {
    $result = false;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return($user);
            break;
        }
    }
};


//Функция для проверки email
function validate_email($value) {
    return filter_var ($value, FILTER_VALIDATE_EMAIL);
};

?>
