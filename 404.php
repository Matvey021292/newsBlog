<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package LittNews
 */

get_header();

get_sidebar();
?>

    <div class="content-wrapper">
    <div class="content-wrapper-analytic content-wrapper-analytic--news forex--page">
        <h3 class="aside-title" style="margin: 0"><span><?php esc_html_e('Страница не найдена', 'littnews'); ?></span></h3>
        <img class="image_404" src="<?php echo get_template_directory_uri() ?>/img/404.png" alt="">
        <div class="page-content text-center">
            <p class="text-error">Воспользуйтесь поиском</p>
            <?php echo do_shortcode('[wpdreams_ajaxsearchlite]')?>
            <p class="text-error">или перейдите на </p>
            <a class="link_error_400 btn-more button-lit" href="<?php echo get_home_url();?>"> Главную страницу <i class="fa fa-home"></i></a>

        </div><!-- .page-content -->

    </div><!-- #primary -->
    </div>

<?php
get_footer();
