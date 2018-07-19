<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LittNews
 */

if ( dynamic_sidebar( 'sidebar-1' ) ) {
	return;
}
?>


<div class="aside-wrapper navigation-wrapper" id="aside1">
    <nav id="primary-menu" class="navigation-wrapper--section">
        <h3 class="aside-title"><span>РАЗДЕЛЫ</span></h3>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
            "items_wrap" => '<nav id="%1$s" class="%2$s">%3$s</nav>'

        ) );
        ?>
    </nav>
     


</div>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
<!-- navigation-conteiner -->

<!-- navigation-conteiner -->
