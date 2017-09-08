<!--модальное окно добавления задачи-->
<?php
    $error_class = 'form__input--error';
    $default_error_text = 'Поле не заполнено или заполнено неверно';
?>

<div class="modal">
  <button class="modal__close" type="button" name="button">Закрыть</button>

  <h2 class="modal__heading">Добавление задачи</h2>

  <form class="form" action="/../index.php" method="POST" enctype="multipart/form-data">
    <div class="form__row">
      <label class="form__label" for="task">Название <sup>*</sup></label>
      <span class='error-massage'><?=in_array('task', $errors_form) ? $default_error_text : ''?></span>
      <input class="form__input <?=in_array('task', $errors_form) ? $error_class : ''?>" type="text" name="task" id="task" value="<?=htmlspecialchars($_POST['task'])?>" placeholder="Введите название">
    </div>

    <div class="form__row">
      <label class="form__label" for="project">Проект<sup>*</sup></label>
      <span class='error-massage'><span class='form__error'><?=in_array('project', $errors_form) ? $default_error_text : ''?></span>
      <select class="form__input form__input--select <?=in_array('project', $errors_form) ? $error_class : ''?>" name="project" id="project" value='<?php print (htmlspecialchars($_POST['project'])) ?>'>

        <?php foreach ($categories as $key => $value) : ?>
        <?php if ($value != 'Все' ) : ?>
            <<option value="<?=$value?>" <?=$_POST['project'] == $value ? 'selected' : ''?>><?=$value?></option>
        <?php endif ; ?>
        <?php endforeach ; ?>

      </select>
    </div>

    <div class="form__row">
      <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>
      <span  class='error-massage'><?=in_array('date_complete', $errors_form) ? $default_error_text : ''?></span>
      <input class="form__input form__input--date <?=in_array('date_complete', $errors_form) ? $error_class : ''?>" type="text" name="date_complete" id="date" value="<?=htmlspecialchars($_POST['date_complete'])?>"< placeholder="Введите дату в формате ДД.ММ.ГГГГ">
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
      <input class="button" type="submit" name="submit" value="Добавить">
    </div>
  </form>
</div>
