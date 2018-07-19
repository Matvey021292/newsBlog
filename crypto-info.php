<?php
/**
 * Template name: Крипто страница
 *
 */

get_header();


get_sidebar();

?>
<div id="article" class="content-wrapper">

    <?php if (have_posts()): ?>
        <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <?php  
            $vidget = CFS()->get('_get_vidget');
            $get_crypto_informtion = CFS()->get('_get_crypto_informtion');
            $_get_crypto_creator = CFS()->get('_get_crypto_creator');
            $_get_crypto_features = CFS()->get('_get_crypto_features');

            ?>
            <h3 class="aside-title"><span>курс <?php the_title();?></span></h3>
            <div class="graph-widget-section">

                <div class="widget">
                    <?php if($vidget){echo  $vidget;}?>
                </div>

            </div>
            <div class="tab-info-section">
                <h3 class="aside-title"><span>Что такое <?php the_title();?></span></h3>
                <div class="panel-group" id="accordion">
                    <?php if($get_crypto_informtion){?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
                                    Криптовалюта  <?php the_title();?></a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse in" id="collapse0">
                                <div class="panel-body">
                                  <?php echo $get_crypto_informtion;?>
                              </div>
                          </div>
                      </div>
                      <?php }?>
                      <?php if($_get_crypto_creator){?>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    Кто создал  <?php the_title();?>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse1">
                            <div class="panel-body">
                                <?php echo $_get_crypto_creator;?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($_get_crypto_features){?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Особенности</a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse2">
                            <div class="panel-body">
                                <?php echo $_get_crypto_features;?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="content-wrapper-analytic content-wrapper-analytic--news">
                <?php $categories = get_categories();?>
                <?php $args = array(
                    'cat' => 8,
                    'post_type' => 'post',
                    'posts_per_page' => '8',
                    'slugs' => $categories->slug,
                    'count' => $categories->count
                    ); ?>
                    <h3 class="aside-title"><span>Новости Криптовалюты</span></h3>
                    <div class="analytic-items">
                        <?php $query = new WP_Query($args); ?>
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
                                <?php } ?>
                            </div>
                        </div>
                        <?php echo the_content(); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php
            get_footer();