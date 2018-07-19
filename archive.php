<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LittNews
 */

get_header();
get_sidebar();
?>


    <div class="content-wrapper" id="article">
    <div class="content-wrapper-analytic content-wrapper-analytic--news forex--page">

        <!-- <h3 class="aside-title">Новости фондовых рынков</h3>

        </div> -->


        <?php if (have_posts()) : ?>


        <?php
        the_archive_title('<h3 class="aside-title"><span>', '</span></h3>');
        the_archive_description('<div class="archive-description">', '</div>');
        ?>

        <div class="analytic-items">
            <?php
            /* Start the Loop */

            while (have_posts()) :
                the_post();

                ?>
                <div class="analytic-item">
                    <div class="analytic-item-icon">
                        <a class="analytic-item-icon-link" href="/">
                            <!-- 	<img src="img/icon1.png" alt=""> -->
                            <?php echo get_the_post_thumbnail(); ?>
                        </a>

                    </div>
                    <div class="analytic-item-content">
                        <a href="<?php echo the_permalink(); ?>" class="analytic-item-title">
                            <?php the_title(); ?>
                        </a>
                        <div class="rating_archive_page">
                            <?php echo do_shortcode('[ratings]')?>
                        </div>
                        <div class="analytic-item-other">

                            <span class="analytic-item-date"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                            <p class="analytic-item-text"><?php do_excerpt(get_the_excerpt(), 30); ?></p>
                        </div>
                    </div>

                </div>

            <?
            endwhile;

//            the_posts_navigation();
          echo  get_the_posts_pagination();
            else : ?>
                <div class="content-wrapper-analytic content-wrapper-analytic--news forex--page">
<!--                    <h3 class="aside-title" style="margin: 0">Страница не найдена</h3>-->
<!--                    <h3>Воспользуйтесь поиском</h3>-->
<!--                        --><?php //echo do_shortcode('[wpdreams_ajaxsearchlite]')?>
<!--                    <h3>или перейдите на <a href="--><?php //echo get_home_url();?><!--">Главную страницу</a></h3>-->
                    <h3 class="aside-title" style="margin: 0"><span><?php esc_html_e('Страница не существует', 'littnews'); ?></span></h3>

                    <div class="page-content text-center">
                        <p class="text-error">Воспользуйтесь поиском</p>
                        <?php echo do_shortcode('[wpdreams_ajaxsearchlite]')?>
                        <p class="text-error">или перейдите на </p>
                        <a class="link_error_400 btn-more button-lit" href="<?php echo get_home_url();?>"> Главную страницу <i class="fa fa-home"></i></a>
                    </div>
                     <?php  endif; ?>
                </div>


        </div>
    </div><!-- #primary -->

<?php

get_footer();
