<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="wrapper" class="hfeed">
    <header id="header" role="banner">
   
    <!--   <?php /*
      wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'container_class' => 'top-menu-class'
      ));
      */?> -->


      <nav id="site-navigation" class="main-navigation box" role="navigation">
          <button class="menu-toggle">
              <svg xmlns="http://www.w3.org/2000/svg" height="40" width="40">
                <path d="M6 36v-3h36v3Zm0-10.5v-3h36v3ZM6 15v-3h36v3Z"/>
              </svg>
          </button>
          <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav-menu' ) ); ?>
      </nav>

      <div class="page-logo-container box">
        <a href="<?php echo home_url(); ?>">
          <h2><?php echo get_bloginfo('name'); ?></h2>
        </a>
      </div>

      <div class="icons-nav box">
        <?php if (is_user_logged_in()) : ?>
          <a href="<?php echo site_url('/my-account/'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
              <path d="M24 22.75q-2.5 0-4.125-1.65t-1.625-4.15q0-2.5 1.625-4.125T24 11.2q2.5 0 4.125 1.625t1.625 4.125q0 2.5-1.625 4.15Q26.5 22.75 24 22.75Zm-14 14.5v-2.9q0-1.35.75-2.375t2-1.625q2.95-1.3 5.75-1.975T24 27.7q2.7 0 5.5.675t5.7 1.975q1.3.6 2.05 1.625Q38 33 38 34.35v2.9Zm1.55-1.55h24.9v-1.35q0-.75-.5-1.475-.5-.725-1.4-1.175-2.7-1.3-5.275-1.875T24 29.25q-2.7 0-5.3.575-2.6.575-5.25 1.875-.9.45-1.4 1.175-.5.725-.5 1.475ZM24 21.2q1.8 0 3.025-1.2 1.225-1.2 1.225-3t-1.225-3.025Q25.8 12.75 24 12.75q-1.8 0-3.025 1.225Q19.75 15.2 19.75 17q0 1.8 1.225 3T24 21.2Zm0-4.2Zm0 18.7Z"/>
            </svg>
          </a>
        <?php else : ?>
          <a href="<?php echo site_url('/my-account/'); ?>">Login</a>
        <?php endif; ?>
        <div class="icon-div">
          <a href="<?php echo site_url('/cart/'); ?>">
            <svg width="28" height="37" viewBox="0 0 28 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.67725 37.3055H22.3228C25.3562 37.3055 27.8428 34.9651 27.8428 32.0499V8.892C27.8428 8.4814 27.4753 8.15292 27.0481 8.15292H21.605V6.60907C21.605 2.78227 18.2981 -0.330078 14.2136 -0.330078C10.1292 -0.330078 6.82227 2.78227 6.82227 6.60907V8.15292H0.951905C0.524658 8.15292 0.157227 8.4814 0.157227 8.892V32.0499C0.157227 34.9651 2.65234 37.3055 5.67725 37.3055ZM8.36035 6.60907C8.36035 3.59526 10.9836 1.14808 14.2136 1.14808C17.4436 1.14808 20.0669 3.59526 20.0669 6.60907V8.15292H8.36035V6.60907ZM1.69531 9.63108H6.82227V16.948C6.82227 17.3586 7.16406 17.6871 7.59131 17.6871C8.01855 17.6871 8.36035 17.3586 8.36035 16.948V9.63108H20.0669V16.948C20.0669 17.3586 20.4087 17.6871 20.8359 17.6871C21.2632 17.6871 21.605 17.3586 21.605 16.948V9.63108H26.3047V32.0499C26.3047 34.1439 24.5017 35.8274 22.3228 35.8274H5.67725C3.49829 35.8274 1.69531 34.1521 1.69531 32.0499V9.63108Z" fill="#353434"/>
            </svg>
          </a>
          <a href="<?php echo site_url('/search/'); ?>">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M35.7071 34.2929C36.0976 34.6834 36.0976 35.3166 35.7071 35.7071C35.3166 36.0976 34.6834 36.0976 34.2929 35.7071L23.5248 24.939C23.3273 24.7416 22.992 24.7265 22.7814 24.8984C22.7814 24.8984 22.6176 25.04 22.3298 25.2534C20.0021 26.9792 17.1202 28 14 28C6.26801 28 0 21.732 0 14C0 6.26801 6.26801 0 14 0C21.732 0 28 6.26801 28 14C28 17.0491 27.0252 19.8706 25.3703 22.1698C25.1223 22.5143 24.8986 22.7783 24.8986 22.7783C24.7234 22.9931 24.7387 23.3245 24.939 23.5248L35.7071 34.2929ZM14 26C20.6274 26 26 20.6274 26 14C26 7.37258 20.6274 2 14 2C7.37258 2 2 7.37258 2 14C2 20.6274 7.37258 26 14 26Z" fill="#353434"/>
            </svg>
          </a>
        </div>
      </div> 
    </header>
    <div id="container">
      <main id="content" role="main">