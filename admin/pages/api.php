<?php

/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Git - https://github.com/jade58/sls
@Настройка соеденения с API.
*/

require_once '../config.php'; //Подключаем файл с конфигами
require_once '../admin/a_functions.php'; //Подключаем файл с конфигами

if (isset($_POST['send'])) {
  $new_app_id = $_POST['app_id'];
  $new_secret_key = $_POST['secret_key'];

  api_update($new_app_id,$new_secret_key);


}

?>

<form class="form-horizontal" method="post">
  <fieldset>
    <legend>Основные настройки сайта</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">ID приложения</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="app_id" id="inputEmail" value="<?php echo $app_id; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Секретный ключ</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="secret_key" id="inputEmail" value="<?php echo $secret_key; ?>">
      </div>
    </div>
    <br>

    <div class="form-group">
      <div style="margin-left:5px;" class="col-lg-10 col-lg-offset-2">
        <input type="submit" name="send" class="btn btn-primary" value="Сохранить">
      </div>
    </div>
  </fieldset>
</form>