<?php

/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Git - https://github.com/jade58/sls
@Админка.
*/

ini_set('display_errors', 1); //Отображаем ошибки
error_reporting(E_ALL);  //Отображение ошибок

require_once '../config.php'; //Подключаем файл с конфигами
require_once 'a_functions.php'; //Подключаем файл с конфигами

if (isset($_POST['send'])) {

  if ((!empty($_POST['login'])) and !empty($_POST['password'])) {

    $u_login = $_POST['login'];
    $u_pass = $_POST['password'];

    $a_token = token_generation(); //Копируем токен

    admin_login($u_login,$u_pass,$a_token); //Вызыаем функцию авторизации

    header("Location: http://".$url); //Обновляем страницу

 }

}

if ((isset($_GET['mod'])) and ($_GET['mod'] == 'logout')) {

    admin_logout(); //Выход
    header("Location: http://".$url); //Обновляем страницу

}

?>

<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="ru-RU"> <!--<![endif]-->
<head>
  <!-- META TAGS -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo $title;?> | панель управления</title>

  <link rel="shortcut icon" href="images/favicon.png" />


  <!-- Google Web Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

  <!-- Style Sheet-->
  <link rel="stylesheet" href="../style.css"/>
  <link rel='stylesheet' id='bootstrap-css-css'  href='../css/bootstrap.css' type='text/css' media='all' />
  <link rel='stylesheet' id='responsive-css-css'  href='../css/responsive.css' type='text/css' media='all' />
  <link rel='stylesheet' id='main-css-css'  href='../css/main.css' type='text/css' media='all' />

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
      <![endif]-->

    </head>

    <body>

      <!-- Start of Header -->
      <div class="header-wrapper">
        <header>
          <div class="container">


            <div class="logo-container">
              <!-- Website Logo -->
              <a href="/sls/"  title="Главная">
                <div class="logo">Панель администратора</div>
              </a>

            </div>


            <!-- Start of Main Navigation -->
            <nav class="main-nav">
              <div class="menu-top-menu-container">
                <ul id="menu-top-menu" class="clearfix">
                  <li class="current-menu-item"><a href="http://<?php echo $url;?>?mod=logout">Выход</a></li>
                  <li class="current-menu-item"><a href="index.html">Просмотр сайта</a></li>


                </ul>
              </div>
            </nav>
            <!-- End of Main Navigation -->

          </div>
        </header>
      </div>
      <!-- End of Header -->

      <!-- Start of Search Wrapper -->
      
      <!-- End of Search Wrapper -->

      <!-- Start of Page Container -->
      <div class="page-container">
        <div class="container">
          <div class="row">
            <?php if (isset($_COOKIE['a_token'])) {?>
            <!-- start of page content -->
            <div class="well">
              <ul class="nav nav-pills">
                <li><a href="http://<?php echo $url; ?>?mod=general">Основные настройки</a></li>
                <li><a href="http://<?php echo $url; ?>?mod=search">Настройки поиска</a></li>
                <li><a href="http://<?php echo $url; ?>?mod=api">Подключение к API</a></li>
              </ul>
            </div> 


            <div class="well">
              <?php 

              if (isset($_GET['mod'])) {

                switch ($_GET['mod']) {
                  case 'general':
                  include 'pages/general.php';
                  break;
                  case 'search':
                  include 'pages/search.php';
                  break;
                  case 'api':
                  include 'pages/api.php';
                  break;
                }

              } else {
                echo "Добро пожаловать в панель управления сайтом.";
              }

              ?>
            </div> 

            <?php } else {?> 

            <div class="well">
              <form class="form-horizontal" method="post">
                <fieldset>
                  <legend>Авторизация</legend>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Ваш логин:</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="login" id="inputEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Ваш пароль:</label>
                    <div class="col-lg-10">
                      <input type="password" class="form-control" name="password" id="inputEmail">
                    </div>
                  </div>
                     <div class="form-group">
                        <div style="" class="col-lg-10 col-lg-offset-2">
                          <input type="submit" name="send" class="btn btn-primary" value="Авторизация">
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>

                <?php } ?>



                <!-- end of page content -->
              </div>
            </div>
          </div>
          <!-- End of Page Container -->




        </footer>
        <!-- End of Footer -->

        <a href="index.html#top" id="scroll-top"></a>

        <!-- script -->
        <script type='text/javascript' src='../js/jquery-1.8.3.min.js'></script>
        <script type='text/javascript' src='../js/jquery.easing.1.3.js'></script>
        <script type='text/javascript' src='../js/prettyphoto/jquery.prettyPhoto.js'></script>
        <script type='text/javascript' src='../js/jflickrfeed.js'></script>
        <script type='text/javascript' src='../js/jquery.liveSearch.js'></script>
        <script type='text/javascript' src='../js/jquery.form.js'></script>
        <script type='text/javascript' src='../js/jquery.validate.min.js'></script>
        <script type='text/javascript' src="../js/jquery-twitterFetcher.js"></script>
        <script type='text/javascript' src='../js/custom.js'></script>

      </body>
      </html>