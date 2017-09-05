<h2 class="content__main-heading">Список задач</h2>

   <form class="search-form" action="index.php" method="post">
       <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

       <input class="search-form__submit" type="submit" name="" value="Искать">
   </form>

   <div class="tasks-controls">
       <div class="radio-button-group">
           <label class="radio-button">
               <input class="radio-button__input visually-hidden" type="radio" name="radio" checked="">
               <span class="radio-button__text">Все задачи</span>
           </label>

           <label class="radio-button">
               <input class="radio-button__input visually-hidden" type="radio" name="radio">
               <span class="radio-button__text">Повестка дня</span>
           </label>

           <label class="radio-button">
               <input class="radio-button__input visually-hidden" type="radio" name="radio">
               <span class="radio-button__text">Завтра</span>
           </label>

           <label class="radio-button">
               <input class="radio-button__input visually-hidden" type="radio" name="radio">
               <span class="radio-button__text">Просроченные</span>
           </label>
       </div>

       <label class="checkbox">
           <?php if ($show_complete_tasks == 1) : ?>
             <input id="show-complete-tasks" class="checkbox__input visually-hidden" type="checkbox" checked>
             <span class="checkbox__text">Показывать выполненные</span>
           <?php else : ?>
             <input id="show-complete-tasks" class="checkbox__input visually-hidden" type="checkbox">
             <span class="checkbox__text">Показывать выполненные</span>
           <?php endif ; ?>
       </label>
   </div>
   <table class="tasks">

       <?php foreach ($projects as $key => $value) : ?>

             <?php if (!$value["closed"] || $show_complete_tasks == 1) : ?> <!-- Учитываем условие показа по чекбоксу -->

                <?php $extra_class = "";
                if ($value["closed"]) {  // Учитываем условие выполнения задачи
                       $extra_class = "task--completed";
                    } else {
                       if (is_deadline_overdue (htmlspecialchars ($value["date_complete"]))) { // Учитываем условие истечения дедлайна
                         $extra_class = "task--important";
                       }
                    }
                 ?>

                <tr class="tasks__item task <?php print $extra_class ?>">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden" type="checkbox">
                            <span class="checkbox__text"><?php print (htmlspecialchars ($value["task"])) ?></span>
                        </label>
                    </td>
                    <td class="task__date">
                      <!--выведите здесь дату выполнения задачи-->
                       <?php print (htmlspecialchars(!empty($value['date_complete']) ? $value['date_complete'] : "Нет")) ?>
                    </td>
                    <td class="task__controls">
                        <button class="expand-control" type="button" name="button"><?php print (htmlspecialchars ($value["task"])) ?></button>
                        <ul class="expand-list hidden">
                            <li class="expand-list__item">
                                <a href="#">Выполнить</a>
                            </li>
                            <li class="expand-list__item">
                                <a href="#">Удалить</a>
                            </li>
                        </ul>
                    </td>
                </tr>
             <?php endif ; ?>
      <?php endforeach ?>
</table>
