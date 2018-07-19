    <?php
    /**
     * Template name: Главная страница
     *
     */
    get_header();
    get_sidebar();

    ?>
    <!-- content-wrapper -->
    <div class="content-wrapper" id="article">
        <div class="content-wrapper-news post_page">
            <h3 class="aside-title"><span>НОВОСТИ</span></h3>
            <div id="first-slider" class="slider-for-news owl-carousel owl-theme">
                <?php
                $args = array(
                    'cat' => 7,
                    'post_type' => 'post',
                    'posts_per_page' => '4',

                ); ?>

                <?php $query = new WP_Query($args); ?>

                <?php while ($query->have_posts()) {
                    $query->the_post();

                    ?>
                    <div class="news-prev item">
                        <div class="news-prev-logo grid">
                            <a href="<?php echo the_permalink(); ?>">
                                <figure class="effect-zoe">
                                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="img25">
                                    <figcaption>
                                        <h2><a href="<?php echo get_category_link($args[cat]); ?>"><?php echo get_cat_name($args[cat]) ?></a></h2>
                                        <p class="icon-links">
                                            <a href="#"><span class="date floatRight"> <?php echo get_the_date(); ?> <i class="fa fa-calendar"></i></span> </a>
                                        </p>
                                    </figcaption>           
                                </figure>
                            </a>
                        </div>
                        <div class="news-prev-content">
                            <h2 class="news-prev-content-title news-prev-content-title-home ">
                                <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="news-prev-content-text">
                                <?php do_excerpt(get_the_excerpt(), 30); ?>
                            </p>
                            <a href="<?php echo the_permalink(); ?>" class="btn-more button-lit">Подробнее</a>

                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php wp_reset_postdata(); ?>
                </div>
                <div id="dot-show-slider" class="news-prev-items slider-nav slider-nav-news">

                   <?php

                   $args = array(
                       'cat' => 7,
                       'post_type' => 'post',
                       'posts_per_page' => '4',
                   ); ?>
                   <?php $query = new WP_Query($args); ?>
                   <?php while ($query->have_posts()) {

                    $query->the_post();
                    ?>
                    <div class="news-prev ">
                       <button class="owl-dot"></button>   
                       <div class="news-prev-logo ">
                        <figure class=" slider-post-arrow" >
                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="img25">
                            <h2 class="news-prev-content-title news-prev-content-title-home ">
                                <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>        
                        </figure>
                    </div>

                </div>

                <?php } ?>
                <?php wp_reset_postdata(); ?>

            </div>
        </div>
        <div class="content-wrapper-analytic content-wrapper-analytic--interest post_page">
            <h3><a class="aside-title" href="/">Интересное</a></h3>
            <div class="analytic-items">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => '8',
                );
                ?>
                <?php $query = new WP_Query($args); ?>
                <?php while ($query->have_posts()) {
                    $query->the_post(); ?>
                    <?php $interset = CFS()->get('_do_interesting'); ?>
                    <?php if ($interset) { ?>
                        <div class="analytic-item max-width-">
                            <div class="analytic-item-icon">
                                <a class="analytic-item-icon-link" href="<?php echo the_permalink(); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="logo">
                                </a>
                            </div>
                            <div class="analytic-item-content">
                                <a href='<?php echo the_permalink(); ?>' class="analytic-item-title">
                                    <?php trim_title_words(5, '...'); ?>
                                </a>
                                <div class="analytic-item-other">
                                    <span class="analytic-item-date date"><i
                                        class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php wp_reset_postdata(); ?>
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>

                <!-- content-wrapper -->

                <?php
                get_footer();