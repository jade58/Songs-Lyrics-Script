<?php

/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Git - https://github.com/jade58/sls
@Настройка поиска.
*/

require_once '../config.php'; //Подключаем файл с конфигами
require_once '../admin/a_functions.php'; //Подключаем файл с конфигами

if (isset($_POST['send'])) {

	$new_audio_num = $_POST['audio_num'];
  $new_method = $_POST['smethod'];

	search_update($new_audio_num,$new_method);

}

?>

<form class="form-horizontal" method="post">
  <fieldset>
    <legend>Настройки поиска</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Кол-во результатов</label>
      <div class="col-lg-2">
        <input type="text" class="form-control" name="audio_num" id="inputEmail" value="<?php echo $audio_num; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Способ вывода</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="smethod" id="optionsRadios1" value="1">
            Название снизу, исполнитель сверху.
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="smethod" id="optionsRadios2" value="2">
            Название сверху, исполнитель снизу.
          </label>
        </div>
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
      </div>
    </div>



    </form>