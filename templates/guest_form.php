<?php
    $error_class = 'form__input--error';
    $default_error_text = 'Поле не заполнено или заполнено неверно';
?>

  <div class="modal">
    <button class="modal__close" type="button" name="button">Закрыть</button>

    <h2 class="modal__heading">Вход на сайт</h2>

    <form class="form" class="" action="/../index.php" method="POST" enctype="application/x-www-form-urlencoded">
      <div class="form__row">
        <label class="form__label" for="email">E-mail <sup>*</sup></label>

        <input class="form__input <?=in_array('email', $errors_form) ? $error_class : ''?>" type="text" name="email" id="email" value="<?=htmlspecialchars($_POST['email'])?>" placeholder="Введите e-mail">

        <p class="form__message"><?=in_array('email', $errors_form) ? $default_error_text : ''?></p>
      </div>

      <div class="form__row">
        <label class="form__label" for="password">Пароль <sup>*</sup></label>

        <input class="form__input <?=in_array('password', $errors_form) ? $error_class : ''?>" type="password" name="password" id="password" value="<?=htmlspecialchars($_POST['password'])?>" placeholder="Введите пароль">

        <p class="form__message"><?=in_array('password', $errors_form) ? $default_error_text : ''?></p>
      </div>

      <div class="form__row">
        <label class="checkbox">
          <input class="checkbox__input visually-hidden" type="checkbox" checked>
          <span class="checkbox__text">Запомнить меня</span>
        </label>
      </div>

      <div class="form__row form__row--controls">
        <input class="button" type="submit" name="send" value="Войти">
      </div>
    </form>
  </div>
