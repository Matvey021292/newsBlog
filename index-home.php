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
            <div class=" slider-for slider-for-news">
                <?php
                $do_not_duplicate = array();
                $category = get_categories();
                foreach ($category as $categories) {

                    $args = array(
                        'cat' => $categories->term_id,
                        'post_type' => 'post',
                        'posts_per_page' => '8',
                        'slugs' => $categories->slug,
                        'count' => $categories->count,
                        'post__not_in' => $do_not_duplicate
                    ); ?>

                    <?php $query = new WP_Query($args); ?>

                    <?php while ($query->have_posts()) {
                        $query->the_post();
                        $do_not_duplicate[] = $post->ID;
                        ?>
                        <div class="news-prev ">
                            <div class="news-prev-logo grid">
                             <div class="rating_archive_page rating_archive_page_home">
                             <!--    <?php echo do_shortcode('[gdrts--stars-rating--list--shortcode]')?> -->
                            </div>
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
                    <?php } ?>

                </div>

                <div class="news-prev-items slider-nav slider-nav-news">
                    <?php
                    foreach ($category as $categories) {
                        $args = array(
                            'cat' => $categories->term_id,
                            'post_type' => 'post',
                            'posts_per_page' => '8',
                            'slugs' => $categories->slug,
                            'count' => $categories->count,
                        ); ?>
                        <?php $query = new WP_Query($args); ?>
                        <?php while ($query->have_posts()) {

                            $query->the_post();
                            ?>
                            <div class="news-prev ">
                                <div class="news-prev-logo grid">
                                   <a href="<?php echo the_permalink(); ?>">
                                    <figure class="effect-zoe" >
                                        <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="img25">
                                        <figcaption>
                                            <h2><a href="<?php echo get_category_link($args[cat]); ?>"><?php echo get_cat_name($args[cat]) ?></a></h2>
                                        </figcaption>           
                                    </figure>
                                </a>
                            </div>
                            <div class="news-prev-content">
                                <h2 class="news-prev-content-title">
                                    <a href="<?php echo the_permalink(); ?>"><?php trim_title_words(5, '...'); ?></a>

                                </h2>         
                                <span class="date "><i class="fa fa-calendar"> </i> <?php echo get_the_date(); ?></span> 
                            </div> 
                        </div>
                        <?php wp_reset_postdata(); ?>
                        <?php } ?>
                        <?php }?>
                    </div>
                </div>
                <div class="content-wrapper-analytic content-wrapper-analytic--interest post_page">
                    <h3><a class="aside-title" href="/">Интересное</a></h3>
                    <div class="analytic-items">
                        <?php
                        $args = array(
                            'cat' => $category->term_id,
                            'post_type' => 'post',
                            'posts_per_page' => '8',
                            'slugs' => $category->slug,
                            'count' => $category->count
                        );
                        ?>
                        <?php $query = new WP_Query($args); ?>
                        <?php while ($query->have_posts()) {
                            $query->the_post(); ?>
                            <?php $interset = CFS()->get('_do_interesting'); ?>
                            <?php if ($interset) { ?>
                                <div class="analytic-item">
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
                            <div class="content-wrapper-news content-wrapper-news--video post_page" style="margin-top: 25px;">
                                <a href='#' class="aside-title">Видео</a>
                                <div class=" slider-for slider-for-video">
                                    <?php
                                    foreach ($category as $categories) {
                                        $args = array(
                                            'cat' => $categories->term_id,
                                            'post_type' => 'post',
                                            'posts_per_page' => '8',
                                            'slugs' => $categories->slug,
                                            'count' => $categories->count
                                        ); ?>
                                        <?php $query = new WP_Query($args); ?>
                                        <?php while ($query->have_posts()) {
                                            $query->the_post();
                                            if (get_post_format() == 'video') { ?>
                                                <div class="news-prev">
                                                    <div class="news-prev-logo">
                                                      <div class="rating_archive_page rating_archive_page_home">
                                                       <!--  <?php echo do_shortcode('[ratings]')?> -->
                                                    </div>
                                                    <!--                                    <img src="-->
                                                    <?php //echo get_the_post_thumbnail_url() ?><!--" alt="logo">-->
                                                    <?php $videoMP4 = CFS()->get('_video_upload_mp4'); ?>
                                                    <?php $videoYoutube = CFS()->get('_video_upload_youtube'); ?>
                                                    <?php if ($videoMP4) { ?>
                                                        <?php echo do_shortcode('[evp_embed_video url=' . $videoMP4 . ']') ?>
                                                        <?php } ?>
                                                        <?php if ($videoYoutube) { ?>
                                                            <?php echo $videoYoutube; ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php wp_reset_postdata(); ?>
                                                    <?php } ?>
                                                    <?php }?>
                                                </div>
                                                <div class="news-prev-items slider-nav slider-nav-video">
                                                    <?php
                                                    foreach ($category as $categories) {
                                                        $args = array(
                                                            'cat' => $categories->term_id,
                                                            'post_type' => 'post',
                                                            'posts_per_page' => '8',
                                                            'slugs' => $categories->slug,
                                                            'count' => $categories->count

                                                        ); ?>
                                                        <?php $query = new WP_Query($args); ?>
                                                        <?php while ($query->have_posts()) {
                                                            $query->the_post(); ?>
                                                            <?php if (get_post_format() == 'video') { ?>
                                                                <div class="news-prev ">
                                                                    <div class="news-prev-logo grid">
                                                                       <a href="<?php echo the_permalink(); ?>">
                                                                        <figure class="effect-zoe" >
                                                                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="img25">
                                                                            <figcaption>
                                                                                <h2><a href="<?php echo get_category_link($args[cat]); ?>"><?php echo get_cat_name($args[cat]) ?></a></h2>
                                                                            </figcaption>           
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                                <div class="news-prev-content">
                                                                    <h2 class="news-prev-content-title">
                                                                        <a href="<?php echo the_permalink(); ?>"><?php trim_title_words(5, '...'); ?></a>
                                                                    </h2>         
                                                                    <span class="date "><i class="fa fa-calendar"> </i> <?php echo get_the_date(); ?></span> 
                                                                </div> 
                                                            </div>
                                                            <?php } ?>
                                                            <?php wp_reset_postdata(); ?>
                                                            <?php } ?>
                                                            <?php }?>
                                                        </div>
                                                    </div>



                                                    <div class="content-wrapper-analytic content-wrapper-analytic--news">
                                                        <?php $args = array(
                                                            'cat' => 8,
                                                            'post_type' => 'post',
                                                            'posts_per_page' => '8',
                                                            'slugs' => $category->slug,
                                                            'count' => $category->count
                                                        ); ?>
                                                        <h3><a class="aside-title" href="<?php echo get_category_link($args); ?>">Новости</a></h3>
                                                        <div class="analytic-items">
                                                    <!--         <?php $query = new WP_Query($args); ?>
                                                            <?php while ($query->have_posts()) {
                                                                $query->the_post(); ?>
                                                                <div class="analytic-item">
                                                                    <div class="analytic-item-icon">
                                                                        <a class="analytic-item-icon-link" href="<?php echo the_permalink(); ?>">
                                                                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
                                                                        </a>
                                                                    </div>
                                                                    <div class="analytic-item-content">
                                                                        <a href="<?php echo the_permalink(); ?>" class="analytic-item-title">
                                                                            <?php the_title() ?>
                                                                        </a>
                                                                        <div class="analytic-item-other">
                                                                            <span class="analytic-item-date date"><i
                                                                                class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                                                                <p class="analytic-item-text">
                                                                                    <?php do_excerpt(get_the_excerpt(), 20); ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php wp_reset_postdata(); ?>
                                                                    <?php } ?> -->
                                                                    <?php echo do_shortcode('[feedzy-rss feeds="https://24tv.ua/rss/tag/1792.xml" max="500" feed_title="no" refresh="12_hours" sort="date_desc" meta="yes" summary="yes" ]') ?>
                                                                    <!--    <?php echo do_shortcode('[feedzy-rss feeds="https://24tv.ua/rss/video.xml" max="500" feed_title="no" refresh="12_hours" sort="date_desc" meta="yes" summary="yes" ]') ?> -->
                                                                </div>

                                                            </div>
                                                            <div class="content-wrapper-analytic content-wrapper-analytic--news">
                                                                <?php $args = array(
                                                                    'cat' => 8,
                                                                    'post_type' => 'post',
                                                                    'posts_per_page' => '8',
                                                                    'slugs' => $category->slug,
                                                                    'count' => $category->count
                                                                ); ?>
                                                                <h3><a class="aside-title" href="<?php echo get_category_link($args); ?>">Видео Новости</a></h3>
                                                                <div class="analytic-items">
                                                    <!--         <?php $query = new WP_Query($args); ?>
                                                            <?php while ($query->have_posts()) {
                                                                $query->the_post(); ?>
                                                                <div class="analytic-item">
                                                                    <div class="analytic-item-icon">
                                                                        <a class="analytic-item-icon-link" href="<?php echo the_permalink(); ?>">
                                                                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
                                                                        </a>
                                                                    </div>
                                                                    <div class="analytic-item-content">
                                                                        <a href="<?php echo the_permalink(); ?>" class="analytic-item-title">
                                                                            <?php the_title() ?>
                                                                        </a>
                                                                        <div class="analytic-item-other">
                                                                            <span class="analytic-item-date date"><i
                                                                                class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                                                                <p class="analytic-item-text">
                                                                                    <?php do_excerpt(get_the_excerpt(), 20); ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php wp_reset_postdata(); ?>
                                                                    <?php } ?> -->
                                                                    <!--   <?php echo do_shortcode('[feedzy-rss feeds="https://24tv.ua/rss/tag/1792.xml" max="500" feed_title="no" refresh="12_hours" sort="date_desc" meta="yes" summary="yes" ]') ?> -->
                                                                    <?php echo do_shortcode('[feedzy-rss feeds="https://24tv.ua/rss/video.xml" max="500" feed_title="no" refresh="12_hours" sort="date_desc" meta="yes" summary="yes" ]') ?> 
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- content-wrapper -->

                                                        <?php
                                                        get_footer();