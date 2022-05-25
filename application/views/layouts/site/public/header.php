

<!DOCTYPE html>
<!--[if lt IE 7]>      
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
   <![endif]-->
   <!--[if IE 7]>         
   <html class="no-js lt-ie9 lt-ie8">
      <![endif]-->
      <!--[if IE 8]>         
      <html class="no-js lt-ie9">
         <![endif]-->
         <!--[if gt IE 8]><!--> 
         <html class="no-js">
            <!--<![endif]-->
            <head>
               <meta charset="utf-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <title><?=$pageTitle;?></title>
               <meta name="description" content="Slider Revolution Example" />
               <meta name="keywords" content="fullscreen image, grid layout, flexbox grid, transition" />
               <meta name="author" content="ThemePunch" />
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/site/css/bootstrap.css">
               <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/site/css/custom.css">
               <link rel="stylesheet" type="text/css" href="fonts/pe-icon-7-stroke/<?=base_url();?>assets/site/css/pe-icon-7-stroke.css">
               <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
               <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/site/css/settings.css">
               <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/site/css/layers.css">
               <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/site/css/navigation.css">
               <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url();?>assets/site/images/favicon/apple-icon-57x57.png">
                <link rel="apple-touch-icon" sizes="60x60" href="<?=base_url();?>assets/site/images/favicon/apple-icon-60x60.png">
                <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url();?>assets/site/images/favicon/apple-icon-72x72.png">
                <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url();?>assets/site/images/favicon/apple-icon-76x76.png">
                <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url();?>assets/site/images/favicon/apple-icon-114x114.png">
                <link rel="apple-touch-icon" sizes="120x120" href="<?=base_url();?>assets/site/images/favicon/apple-icon-120x120.png">
                <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url();?>assets/site/images/favicon/apple-icon-144x144.png">
                <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url();?>assets/site/images/favicon/apple-icon-152x152.png">
                <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>assets/site/images/favicon/apple-icon-180x180.png">
                <link rel="icon" type="image/png" sizes="192x192"  href="<?=base_url();?>assets/site/images/favicon/android-icon-192x192.png">
                <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>assets/site/images/favicon/favicon-32x32.png">
                <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url();?>assets/site/images/favicon/favicon-96x96.png">
                <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/site/images/favicon/favicon-16x16.png">
                <link rel="manifest" href="<?=base_url();?>assets/site/images/favicon/manifest.json">
               <!-- LOAD JQUERY LIBRARY -->
               <script src="<?=base_url();?>assets/site/js/jquery.min.js"></script>
               <script src="<?=base_url();?>assets/site/js/owl.carousel.min.js"></script>
               <!-- REVOLUTION JS FILES -->
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/jquery.themepunch.tools.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/jquery.themepunch.revolution.min.js"></script>
               <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading)-->
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.actions.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.carousel.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.kenburn.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.layeranimation.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.migration.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.navigation.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.parallax.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.slideanims.min.js"></script>
               <script type="text/javascript" src="<?=base_url();?>assets/site/js/extensions/revolution.extension.video.min.js"></script>
            </head>
            <body >
               <!-- start header -->
               <header id="header-1">
                  <div id="overlay"><i class="far fa-times-circle"></i></div>
                  <!-- start nav -->
                  <nav class="navbar navbar-expand-md fixed-top bg-light ">
            <div class="container clearfix">
                <div id="header-container">
                    <a href="#" id="header-logo-sm"><img src="images/logo.png" alt="" /></a>
                    <span  id="nav-btn" >
                        <i class="fas fa-bars "></i>
                    </span>
                    <div  id="navbarcollapse" class="clearfix">
                        <div id="main-nav">
                            <?=$menubar;?>
                        </div>
                        <a href="#" id="header-logo"><img src="<?=base_url();?>assets/site/images/logo.png" alt="" /></a>
                        <div  id="second-nav">
                            <ul class="nav navbar-nav float-left">
                                <li>
                                    <a  href="#" >درباره ما</a>
                                </li>
                                <li >
                                    <a  href="#" >تماس با ما</a>
                                </li>
                                <li >
                                    <a  href="#" >نقشه</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

                  <!-- end nav -->
               </header>

