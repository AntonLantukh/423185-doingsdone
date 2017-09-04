<?php

// Функция для обрабтки шаблонов и подключения их в index.php
function render_template ($template_route, $template_array) {
    $file_check = file_exists ($template_route);
        if (!$file_check) {
            return ("");
        } else {
            ob_start();
            extract ($template_array);
            require_once($template_route);
            $html = ob_get_clean();
            return ($html);
        }
};
?>
