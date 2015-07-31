<?php
/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Git - https://github.com/jade58/sls
@Конфигурационный файл.
*/

//Данные от админ-панели:///////
$admin_login = 'admin';
$admin_password = 'pass';
////////////////////////////////

/* Подключение к серверу MySQL */ 
$link = mysqli_connect( 
            'localhost',  /* Хост, к которому мы подключаемся */ 
            'root',       /* Имя пользователя */ 
            '',   /* Используемый пароль */ 
            'bd');     /* База данных для запросов по умолчанию */ 

if (!$link) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
} 

/* Посылаем запрос серверу */ 
if ($result = mysqli_query($link, 'SELECT name, value FROM config')) { 

    /* Выборка результатов запроса */ 
    while( $row = mysqli_fetch_assoc($result) ){ 

        switch ($row['name']) {

          case 'app_id':
            $app_id = $row['value']; //ID приложения ВК
            break;
          
          case 'secret_key':
            $secret_key = $row['value']; //Секретный ключ
            break;

          case 'audio_num':
            $audio_num = $row['value']; //Кол -во аудиозаписей выдаваемых поиском
            break;

          case 'site_name':
            $site_name = $row['value']; //Имя сайта
            break;

          case 'description':
            $description = $row['value']; //Имя сайта
            break;

          case 'title':
            $title = $row['value']; //Заголовок сайта
            break;

          case 's_method':
            $s_method = $row['value']; //Заголовок сайта
            break;
            
        }
    } 

    /* Освобождаем используемую память */ 
    mysqli_free_result($result); 
} 

/* Закрываем соединение */ 
//mysqli_close($link);

$url = $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']; //URL

?>
