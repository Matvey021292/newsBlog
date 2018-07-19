<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LittNews
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id"
    content="507101349739-6g5hj7cnaveek10tl8h7rjudlf9d6f2t.apps.googleusercontent.com">


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
   <!--  <header class="header">
        <div class="container-fluid">
            <div class="header-container">
                <div class="header-wrap header-wrap--left">
                    <div class="header-logo">
                        <div class="header-logo__img">
                            <a class="link_header" href="<?php echo get_home_url(); ?>">

                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-wrap header-wrap--right">
                    <div class="header-elements">

                        <div class="header-elements__bottom">
                            <nav class="header-navigation">
                                <a href="" class="mobile-logo"><img
                                    src="<?php echo get_template_directory_uri() ?>/img/LittInvestlogo.png" alt=""></a>
                                <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'menu-2',
                                    'menu_id'        => 'header-menu',
                                    "items_wrap" => '<ul id="%1$s " class="%2$s header-navigation__items">%3$s</ul>'

                                ) );
                                ?>
                                </ul>
                                <div class="header-buttons__item header-buttons__item--block">
                                    <button class="button-lit button-lit--bg"><i class="fa fa-google-plus fa-2x"></i> <a
                                        class="gplus g-signin2" data-onsuccess="onSignIn"></a>Google+
                                    </button>
                                    <button class="button-lit button-lit--subscribe" type='button' data-toggle="modal" data-target=".main-modal">
                                        Подписаться
                                    </button>
                                </div>

                            </nav>
                            <div id="nav-icon3">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="header-elements__top">
                            <div class="header-buttons">
                                <div class="header-buttons__item">
                                    <button class="button-lit button-lit--bg button-lit__google"><i class="fa fa-google-plus fa-2x"></i> <a
                                        class="gplus g-signin2" data-onsuccess="onSignIn"></a>
                                    </button>
                                    <button class="button-lit open-form button-lit--subscribe" type='button' data-toggle="modal"
                                    data-target=".main-modal">Подписаться
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
-->
<main>


    <div class="slideshow owl-carousel owl-theme">
        <?php // задаем нужные нам критерии выборки данных из БД
        $args = array(
            'posts_per_page' => 3,
            'orderby' => 'comment_count'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();?>
                <div class="slide item">
                 <div class="slide__img" style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>)"></div>
                 <div class="slide__title-wrap">
                    <h3 class="slide__title"><div class="slide__box"></div><span class="slide__title-inner"><?php the_title();?></span></h3>
                    <h4 class="slide__subtitle"><div class="slide__box"></div><span class="slide__subtitle-inner"><?php the_author(); ?></span></h4>
                    <a class="slide__explore"><span class="slide__explore-inner">Explore</span></a>
                </div>
            </div>
            <?php  }
        } else {
        }
        wp_reset_postdata();?>
    </div>
    <div class="slick-dotsContainer">   
 <?php // задаем нужные нам критерии выборки данных из БД
 $args = array(
    'posts_per_page' => 3,
    'orderby' => 'comment_count'
);
 $query = new WP_Query( $args );
 if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();?>
        <div class="owl-arrow-post">
            <div>   
             <h3 class="owl-arrow-title"><?php the_title();?></h3>
             <p class="owl-arrow-text"><?php do_excerpt(get_the_excerpt(), 20); ?></p>
         </div>
         <button class="owl-dot">

         </button>   
     </div>
     <?php  }
 } else {
 }
 wp_reset_postdata();?>
</div>


</main>
<div class="loader">
    <div class="loader__inner"></div>
</div>

<div class="container-fluid">

    <div class="breadcrumb">
        <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(); ?>

    </div>
    <div class="wrapper">


