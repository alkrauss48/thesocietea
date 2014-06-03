<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package the_societea
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!DOCTYPE html>
  <!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
  <!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimal-ui">

    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/images/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/images/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/images/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="/assets/images/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="/assets/images/favicon/browserconfig.xml">

    <!-- <link href='http://fonts.googleapis.com/css?family=Merriweather:400,700,900,300' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/screen.css">
    <script src="assets/js/lib/modernizr-2.7.1.min.js"></script>
    <!--[if lt IE 9]>
      <script src="assets/js/min/ie.min.js"></script>
    <![endif]-->
  </head>
  <body <?php body_class(); ?>>
    <!--[if lt IE 8]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <header class="spanner sticky">
      <div class="container-padding">
        <div class="container">
          <a href="/"><img src="/assets/images/dist/ak_logo_trimmed.png" alt="" /></a>
          <div class="nav-wrapper" id="navigation">
            <nav class="nav">
              <?php wp_nav_menu(array(
                'menu' => 'Main Menu',
                ));
              ?>
              <!-- <ul> -->
              <!--   <li><a href="#">About</a></li> -->
              <!--   <li><a href="#">Blog</a></li> -->
              <!--   <li><a href="#">Projects</a></li> -->
              <!--   <li><a href="#">Resume</a></li> -->
              <!--   <li><a href="#" class="nav&#45;call&#45;action">Hire Me</a></li> -->
              <!-- </ul> -->
            </nav>
          </div>
          <div class="nav-wrapper" id="mobile-navigation">
            <nav class="nav">
              <ul>
                <li><a class="icon2-list" id="responsive-menu-icon"></a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
