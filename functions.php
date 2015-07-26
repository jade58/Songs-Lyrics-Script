<?php

/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Git - https://github.com/jade58/sls
@Функции сайта.
*/

require_once 'config.php'; //Подключаем файл с конфигами

  //Функция при помощи которорой мы получаем 
  //acces_token и ID пользователя 

 $user_id = '';

  function get_token ($secret_code,$url) {

    global $app_id,$secret_key,$user_id;

  	 if (!empty($secret_code)) {
         
        $api_url = 'https://oauth.vk.com/access_token?client_id='.$app_id.'&client_secret='.$secret_key.'&code='.$secret_code.'&redirect_uri=http://'.$url.''; 
        $api_qurey = curl_init();

           curl_setopt($api_qurey, CURLOPT_URL, $api_url);
           curl_setopt($api_qurey, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($api_qurey, CURLOPT_HEADER, 0);

        $api_response = curl_exec($api_qurey);
        $api_array = json_decode($api_response,true);
        $user_id = $api_array['user_id'];

        return $api_array['access_token'];

  	 }

  }

  //Функция при помощи которой мы получаем
  //Имя пользователя

  function get_name ($user_id) {

        $api_url = 'https://api.vk.com/method/users.get?user_id='.$user_id.'';

        $api_qurey = curl_init();

           curl_setopt($api_qurey, CURLOPT_URL,$api_url);
           curl_setopt($api_qurey, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($api_qurey, CURLOPT_HEADER, 0);

        $api_response = curl_exec($api_qurey);
        $api_array = json_decode($api_response,true);

        $response_array = $api_array['response'];
        $zero_array = $response_array[0];
        $first_name = $zero_array['first_name'];

        return $first_name;

  }

  //Фунция при помощи котороый мы выходим с сайта
  //При помощи удаления cooikie.

  function logout () {

    global $url;
         
        setcookie ("token", "", time() - 3600);
        setcookie ("user_id", "", time() - 3600); 

        header("Location: http://".$url.""); //Что бы кукисы обновились  

  }

  //Функция при помощи которой получаем список аудиозаписей (массив)

  function get_audio ($query,$access_token) {

    global $url,$audio_num;

        $api_url = 'https://api.vk.com/method/audio.search?q='.$query.'&access_token='.$access_token.'&lyrics=1&count='.$audio_num.'';

        $api_qurey = curl_init();

           curl_setopt($api_qurey, CURLOPT_URL,$api_url);
           curl_setopt($api_qurey, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($api_qurey, CURLOPT_HEADER, 0);

        $api_response = curl_exec($api_qurey);
        $api_array = json_decode($api_response,true);

        if (isset($api_array['response'])) {

            $response_array = $api_array['response'];

            return $response_array;

        } else {

            $response_array = $api_array['error'];

            return $response_array;

        }

  }

  //Данной функцией мы получаем текст аудио.

  function get_lyrics ($access_token,$lyrics_id) {

        $api_url = 'https://api.vk.com/method/audio.getLyrics?lyrics_id='.$lyrics_id.'&access_token='.$access_token.'';

        $api_qurey = curl_init();

           curl_setopt($api_qurey, CURLOPT_URL,$api_url);
           curl_setopt($api_qurey, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($api_qurey, CURLOPT_HEADER, 0);

        $api_response = curl_exec($api_qurey);
        $api_array = json_decode($api_response,true);

        $response_array = $api_array['response'];

        return $response_array['text']; 

  }


?>