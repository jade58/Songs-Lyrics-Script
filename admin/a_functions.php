<?php
/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Git - https://github.com/jade58/sls
@Функции админ-панели.
*/

ini_set('display_errors', 1); //Отображение ошибок
error_reporting(E_ALL);  //Отображение ошибок

require_once '../config.php'; //Подключаем файл с конфигами

$redirect_url = $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING']; //URL

function general_update($new_site_name,$new_title,$new_description) {

      global $link,$site_name,$description,$title,$redirect_url;

             if ($new_site_name != $site_name) {

               $result = mysqli_query($link, "UPDATE config SET value = '$new_site_name' WHERE name='site_name'");

             }

            if ($new_description != $description) {

               $result = mysqli_query($link, "UPDATE config SET value = '$new_description' WHERE name='description'");

            }

           if ($title != $new_title) {

               $result = mysqli_query($link, "UPDATE config SET value = '$new_title' WHERE name='title'");

           }

header("Location: http://".$redirect_url.""); //Обновляем страницу

}

function search_update($new_audio_num,$new_type) {
 
  global $link,$audio_num,$redirect_url,$s_method;

  if ($new_audio_num != $audio_num) {

    $result = mysqli_query($link, "UPDATE config SET value = '$new_audio_num' WHERE name='audio_num'");

  }

  if ($new_type != $s_method) {

    $result = mysqli_query($link, "UPDATE config SET value = '$new_type' WHERE name='s_method'");
    
  }

  header("Location: http://".$redirect_url.""); //Обновляем страницу

}

function api_update($new_app_id,$new_secret_key) {
  
  global $link,$app_id,$secret_key,$redirect_url;

  if ($new_app_id != $app_id) {

    $result = mysqli_query($link, "UPDATE config SET value = '$new_app_id' WHERE name='app_id'");

  }

  if ($new_secret_key != $secret_key) {

    $result = mysqli_query($link, "UPDATE config SET value = '$new_secret_key' WHERE name='secret_key'");

  }

  header("Location: http://".$redirect_url."?"); //Обновляем страницу

}

function token_generation() {

  return time(); //Токен это текущая дата и время в UNIX формате.

}

function admin_login ($login,$password,$token) {

  global $admin_login,$admin_password;

  if (($login == $admin_login) and ($password == $admin_password)) {

    setcookie('a_token', $token, time() + 3600); //Записываем куки.

  }

}

function admin_logout() {

  setcookie('a_token', "", time() - 3600); //Записываем куки

}
?>