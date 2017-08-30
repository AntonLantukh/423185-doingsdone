<?php
function renderTemplate($template_route, $template_array) {
    $file_check = file_exists ($template_route);
        if (!$file_check) {
            return ("");
        } else {
            require_once($template_route);
            $page_content = $html;
            return ($page_content);
        }
};
?>
