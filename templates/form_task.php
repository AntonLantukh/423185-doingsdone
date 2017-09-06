<!--модальное окно добавления задачи-->
<div class="modal">
  <button class="modal__close" type="button" name="button">Закрыть</button>

  <h2 class="modal__heading">Добавление задачи</h2>

  <form class="form" action="/../index.php" method="POST" enctype="multipart/form-data">
    <div class="form__row">
      <label class="form__label" for="task">Название <sup>*</sup></label>
      <span <?php print $error_span_task ?>><?php print $error_message_task ?></span>
      <input class="form__input <?php print $error_input_task ?>" type="text" name="task" id="task" value="<?php print (htmlspecialchars($task_form)) ?>" placeholder="Введите название">
    </div>

    <div class="form__row">
      <label class="form__label" for="project">Проект <sup>*</sup></label>
      <span <?php print $error_span_project ?>><?php print $error_message_project ?></span>
      <select class="form__input form__input--select <?php print $error_input_project ?>" name="project" id="project" value='<?php print (htmlspecialchars($project_cat)) ?>'>

        <?php foreach ($categories as $key => $value) : ?>
        <?php if ($value != 'Все' ) : ?>
            <option><?php print $value ?></option>
        <?php endif ; ?>
        <?php endforeach ; ?>

      </select>
    </div>

    <div class="form__row">
      <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>
      <span <?php print $error_span_date ?>><?php print $error_message_date ?></span>
      <input class="form__input form__input--date <?php print $error_input_date ?>" type="text" name="date_complete" id="date" value="<?php print (htmlspecialchars($date_complete)) ?>"< placeholder="Введите дату в формате ДД.ММ.ГГГГ">
    </div>

    <div class="form__row">
      <label class="form__label">Файл</label>

      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="preview" id="preview" value="">

        <label class="button button--transparent" for="preview">
            <span>Выберите файл</span>
        </label>
      </div>
    </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="send" value="Добавить">
    </div>
  </form>
</div>
