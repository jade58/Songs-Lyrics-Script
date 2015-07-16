<?php

/* 
@Author - JadeWizard
@Blog - Jade-Wizard.ru
@Name - Songs Lyrics Search
@Version - 0.3.1
@Git - https://github.com/jade58/sls
@Главная страница.
*/

ini_set('display_errors', 1); //Отображение ошибок
error_reporting(E_ALL);  //Отображение ошибок

require_once 'functions.php'; //Подключаем файл с функциями
require_once 'config.php'; //Подключаем файл с конфигами

$url = $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']; //URL

if ((!isset($_COOKIE['token'])) and isset($_GET['code'])) {
$token = get_token($_GET['code'],$url); //Запиешм результат работы функции GET_TOKEN

setcookie('token', $token, time() + 3600);
setcookie('user_id', $user_id, time() + 3600);

header("Location: http://".$url.""); //Что бы кукисы обновились

} else if (isset($_COOKIE['token'])) {

  $token = $_COOKIE['token']; 
  $user_id = $_COOKIE['user_id'];

}

if (isset($_GET['logout'])) {
logout (); //Выходим
}

if (isset($_GET['send'])) {
    $query = urlencode($_GET['query']); //Поисковый запрос
  } else if(isset($_GET['query'])) {
    $query = $_GET['query']; 
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

    <title><?php echo $title; ?></title>

    <link rel="shortcut icon" href="images/favicon.png" />


    <!-- Google Web Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- Style Sheet-->
    <link rel="stylesheet" href="style.css"/>
    <link rel='stylesheet' id='bootstrap-css-css'  href='css/bootstrap.css%3Fver=1.0.css' type='text/css' media='all' />
    <link rel='stylesheet' id='responsive-css-css'  href='css/responsive.css%3Fver=1.0.css' type='text/css' media='all' />
    <link rel='stylesheet' id='pretty-photo-css-css'  href='js/prettyphoto/prettyPhoto.css%3Fver=3.1.4.css' type='text/css' media='all' />
    <link rel='stylesheet' id='main-css-css'  href='css/main.css%3Fver=1.0.css' type='text/css' media='all' />

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
                  <div class="logo"><?php echo $site_name; ?></div>
                </a>

              </div>


              <!-- Start of Main Navigation -->
              <nav class="main-nav">
                <div class="menu-top-menu-container">
                  <ul id="menu-top-menu" class="clearfix">
                    <li class="current-menu-item"><a href="index.html">Главная</a></li>
                    <li><a href="home-categories-description.html">О сайте</a></li>
                    <li><a href="home-categories-articles.html">Правообладателям</a></li>
                    <li><a href="#">|</a></li>

                    <?php if (!isset($_COOKIE['token'])) { ?>

                      <li><a href="https://oauth.vk.com/authorize?client_id=<?php echo $app_id; ?>&scope=8&redirect_uri=http://<?php echo $url; ?>&response_type=code">Авторизация</a></li>

                    <?php } else { ?>

                      <li><a href="#"><b>Привет, <?php echo get_name($user_id); ?> </b></a></li>

                      <li><a href="http://<?php echo $url; ?>?logout=1">Выход</a></li>

                    <?php } ?>
                  </ul>
                </div>
              </nav>
              <!-- End of Main Navigation -->

            </div>
          </header>
        </div>
        <!-- End of Header -->

        <!-- Start of Search Wrapper -->
        <div class="search-area-wrapper">
          <div class="search-area container">
            <h3 class="search-header">Поиск текстов песен</h3>
            <p class="search-tag-line">введите название песни или её исполнителя</p>

            <form id="search-form" class="search-form clearfix" method="get" action="http://<?php echo $url; ?>">
              <input class="search-term required" type="text" id="s" name="query" placeholder="Название песни" title="* Введите поисковый запрос" />
              <input class="search-btn" type="submit" value="Искать" />
              <input type="hidden" name="send" value="1">
              <div id="search-error-container"></div>
            </form>
          </div>
        </div>
        <!-- End of Search Wrapper -->

        <!-- Start of Page Container -->
        <div class="page-container">
          <div class="container">
            <div class="row">

              <!-- start of page content -->
              <?php if (isset($_COOKIE['token'])) { 
                if (isset($_GET['query'])) { ?>        

                <div class="span5 page-content">
                  <div class="list-group">

                    <?php get_audio ($query,$token); ?>

                  </div> 
                </div> 

                <div class="span5 page-content">

                  <div class="panel panel-default">
                    <div class="panel-body">

                     <?php if (isset($_GET['lyrics'])) {
                        echo nl2br(get_lyrics($token)); 
                      ?>

                      <?php } else { ?>
                        Выберете песню
                      <?php } ?>

                    </div>
                  </div>

                </div>

                <?php } elseif (!isset($_GET['query'])) { ?>

                <div class="span10 page-content">
                  <div class="list-group"><div class="list-group-item">
                    <h4 class="list-group-item-heading">Введите свой поисоковый запрос</h4>
                    <p class="list-group-item-text">в строку выше.</p>
                  </div>
                </div>
              </div>

              <?php } ?>

              <?php } else { ?>

              <div class="span10 page-content">
                <div class="list-group"><div class="list-group-item">
                 <h4 class="list-group-item-heading">Авторизируйтесь</h4>
                 <p class="list-group-item-text">прежде чем начать поиск.</p>
               </div>
             </div>
           </div>

           <?php } ?> 

           <!-- end of page content -->
         </div>
       </div>
     </div>
     <!-- End of Page Container -->



     <!-- Footer Bottom -->
     <div id="footer-bottom-wrapper">
      <div id="footer-bottom" class="container">
        <div class="row">
          <div class="span6">
            <p class="copyright">
              Footer.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Footer Bottom -->

  </footer>
  <!-- End of Footer -->

  <a href="index.html#top" id="scroll-top"></a>

  <!-- script -->
  <script type='text/javascript' src='js/jquery-1.8.3.min.js'></script>
  <script type='text/javascript' src='js/custom.js'></script>

</body>
</html>