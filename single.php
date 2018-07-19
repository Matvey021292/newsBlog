<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LittNews
 */

get_header();

get_sidebar();
?>
<?php
while (have_posts()) :
    the_post();

endwhile;
?>

<div class="content-wrapper" id="article">
    <div class="content-wrapper-analytic content-wrapper-analytic--news page-news">
     <!--  <h3 class="aside-title"><span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span></h3> -->
     <h3 class="aside-title "><span><?php echo the_title(); ?></span></h3>
     <div class="analytic-items">

        <div class="analytic-item" style="margin-top: 10px;">
            <div class="analytic-item-content">
                <div class="analytic-item-other">
                 <!--  <?php echo get_the_post_thumbnail(null, 'full', array('class' => 'float-left')); ?> -->
                 <div class="image_single" style="background-image:url(<?php echo get_the_post_thumbnail_url() ?>)" alt="logo"></div>
             </div>
             <div class="analytic-item-text analytic-item-text--single">
               <span class="date "><i class="fa fa-calendar"> </i> <?php echo get_the_date(); ?></span> 
               <br><br>
               <?php the_content() ?>
           </div>
       </div>

       <?php
       $videoMP4 = CFS()->get('_video_upload_mp4');
       $videoYoutube = CFS()->get('_video_upload_youtube');

       ?>
       <?php if ($videoMP4) { ?>
       <?php echo do_shortcode('[evp_embed_video url=' . $videoMP4 . ']') ?>
       <?php } ?>
       <?php if ($videoYoutube) { ?>
       <?php } ?>
       <div class="uk-container" style="clear: both;">


        <div data-mobile-view="false" data-share-size="40" data-like-text-enable="false"
        data-background-alpha="0.0" data-pid="1756924" data-mode="share"
        data-background-color="#ffffff" data-share-shape="rectangle" data-share-counter-size="13"
        data-icon-color="#ffffff" data-mobile-sn-ids="fb.vk.tw.ok.wh.vb.tm."
        data-text-color="#000000"
        data-buttons-color="#ffffff" data-counter-background-color="#ffffff"
        data-share-counter-type="disable" data-orientation="horizontal"
        data-following-enable="false"
        data-sn-ids="fb.gp.ok.tm.tw.mr.vk." data-preview-mobile="false"
        data-selection-enable="true"
        data-exclude-show-more="true" data-share-style="11" data-counter-background-alpha="1.0"
        data-top-button="false" class="uptolike-buttons"></div>
        <div class="vote-items">
            <?php if (function_exists('the_ratings')) {
                the_ratings();
            } ?>
        </div>
    </div>
    <div class="comment list">
        <?php if ( comments_open() || get_comments_number() ) :
        comments_template();
        endif;?>
    </div>


</div>
</div>
<div class="other-wrapper">
    <?php

    global $post;


    $related_tax = 'category';


    $cats_tags_or_taxes = wp_get_object_terms($post->ID, $related_tax, array('fields' => 'ids'));
    $categories = get_the_category();

    $args = array(
        'posts_per_page' => 6,
        'post__not_in' => array($post->ID),
        'tax_query' => array(
            array(
                'taxonomy' => $related_tax,
                'field' => 'id',
                'include_children' => false,
                'terms' => $cats_tags_or_taxes,
                'operator' => 'IN'
            )
        )
    );
    $query_single = new WP_Query($args);

    if ($query_single->have_posts()) :
        $getcat = get_the_category();
        $cat = $getcat[0]->cat_ID;

        echo ' <h3><a href="' . get_category_link($args[cat]) . '"class="aside-title">Читайте также</a></h3> '; ?>
        <?php

        if (wp_get_cat_postnum($cat) > 4) {

            echo "   <div class=\"news-prev-items other-news-section\">";

        } else {

            echo " <div class=\"news-prev-items  news-prev-items--more-post\">";
        }
        ?>
        <?php

        while ($query_single->have_posts()) :
            $query_single->the_post(); ?>

            <?php if (wp_get_cat_postnum($cat) > 4) { ?>
            <div class="news-prev">
                <div class="news-prev-logo">
                    <a href="<?php echo the_permalink(); ?>"> <img
                        src="<?php echo get_the_post_thumbnail_url() ?>" alt="logo"></a>
                    </div>
                    <div class="news-prev-content">
                        <h2 class="news-prev-content-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php trim_title_words(5, '...'); ?>
                            </a>
                        </h2>
                    </div>
                </div>
                <?php } else { ?>
                <div class="news-prev">
                    <div class="news-prev-logo news-prev-logo-cat">
                        <a href="<?php echo the_permalink(); ?>"> <img
                            src="<?php echo get_the_post_thumbnail_url() ?>" alt="logo"></a>
                        </div>
                        <div class="news-prev-content">
                            <h2 class="news-prev-content-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php trim_title_words(5, '...'); ?>
                                </a>
                            </h2>
                        </div>
                    </div>
                    <?php } ?>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">(function (w, doc) {
    if (!w.__utlWdgt) {
        w.__utlWdgt = true;
        var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
        s.type = 'text/javascript';
        s.charset = 'UTF-8';
        s.async = true;
        s.src = ('https:' == w.location.protocol ? 'https' : 'http') + '://w.uptolike.com/widgets/v1/uptolike.js';
        var h = d[g]('body')[0];
        h.appendChild(s);
    }
})(window, document);
</script>
<?php

get_footer();



