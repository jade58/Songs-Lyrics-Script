<?php

/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Настройки скрипта.
*/

require_once '../config.php'; //Подключаем файл с конфигами
require_once '../admin/a_functions.php'; //Подключаем файл с конфигами

if (isset($_POST['send'])) {
  $new_site_name = $_POST['site_name'];
  $new_title_name = $_POST['site_title'];
  $new_des = $_POST['description'];

  general_update($new_site_name,$new_title_name,$new_des);


}

?>

<form class="form-horizontal" method="post">
  <fieldset>
    <legend>Основные настройки сайта</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Название сайта</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="site_name" id="inputEmail" value="<?php echo $site_name; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Заголовок сайта</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="site_title" id="inputEmail" value="<?php echo $title; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Описание сайта</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="5" name="description" id="textArea"><?php echo $description; ?></textarea>
        
      </div>
    </div>
    <div class="form-group">
     
      <div class="col-lg-10">
        
        <div class="form-group">
          <div style="margin-left:5px;" class="col-lg-10 col-lg-offset-2">
            <input type="submit" name="send" class="btn btn-primary" value="Сохранить">
          </div>
        </div>
      </fieldset>
    </form>