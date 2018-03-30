<div class="cat-box-left">
    <div class="home-box-title">
        <h2>
            <b>
                <a href="<?php echo get_category_link($GLOBALS['bd_cat_id']); ?>">
                    <?php echo get_cat_name($GLOBALS['bd_cat_id']); ?>
                </a>
            </b>
            <div class="home-scroll-nav box-title-more">
                <a class="more-plus" href="<?php echo get_category_link($GLOBALS['bd_cat_id']); ?>"><i class="icon-plus"></i></a>
            </div>
        </h2>
    </div>
    <!-- FIRST POST -->
    <?php query_posts(array('showposts' => 1, 'cat' => $GLOBALS['bd_cat_id']  )); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="half-width-category" id="post-<?php the_ID(); ?>">
            <?php
            $img_w      = 295;
            $img_h      = 160;
            $thumb      = bd_post_image('full');
            $image      = aq_resize( $thumb, $img_w, $img_h, true );
            if($image =='')
            {
                $image = BD_IMG .'default-295-160.png';
            }
            $alt        = get_the_title();
            $link       = get_permalink();
            if (strpos(bd_post_image(), 'youtube'))
            {
                echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'"><img src="'. bd_post_image('full') .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
            }
            elseif (strpos(bd_post_image(), 'vimeo'))
            {
                echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'"><img src="'. bd_post_image('full') .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
            }
            elseif (strpos(bd_post_image(), 'dailymotion'))
            {
                echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'"><img src="'. bd_post_image('full') .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
            }
            else
            {
                if($image) :
                    echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'"><img src="'. $image .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
                endif;
            }
            ?>
            <h2 class="post-title">
                <b><a href="<?php the_permalink();?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></b>
            </h2>
            <div class="details">
                <?php
                global $bd_data;
                echo "<span class='post_meta_date'>\n"; the_time($bd_data['date_format']); echo "</span>\n";
                echo "<span class='post_meta_views'><i class='icon-eye-open'></i>\n"; echo getPostViews(get_the_ID()); echo "</span>\n";
                ?>
                <span class="widget"><?php echo bd_wp_post_rate() ?></span>
            </div>
            <div class="post-entry"><p><?php wp_excerpt('wp_bd2'); ?></p>
                <div class="post-readmore"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'bd'); ?> <?php the_title_attribute(); ?>"  class="btn btn-small"><?php _e('Read more', 'bd'); ?></a></div><!-- .post-readmore/-->
            </div>
        </article>
    <?php endwhile; endif; wp_reset_query(); ?>

    <!-- SMALL POSTS -->
    <div class="cat-box-left-small-posts">
    <?php query_posts(array('showposts' => $GLOBALS['bd_total_posts'],'offset'=>1, 'cat' => $GLOBALS['bd_cat_id']  )); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="post-warpper">
            <div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <?php
                /**
                 *  Post Image
                 */
                $img_w      = 52;
                $img_h      = 50;
                $thumb      = bd_post_image('full');
                $image      = aq_resize( $thumb, $img_w, $img_h, true );
                if($image =='')
                {
                    $image = BD_IMG .'default-52-50.png';
                }
                $alt        = get_the_title();
                $link       = get_permalink();

                if (strpos(bd_post_image(), 'youtube'))
                {
                    echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class=""><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. get_the_title().'" /></a></div><!-- .post-image/-->' ."\n";
                }
                elseif (strpos(bd_post_image(), 'vimeo'))
                {
                    echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class=""><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. get_the_title().'" /></a></div><!-- .post-image/-->' ."\n";
                }
                elseif (strpos(bd_post_image(), 'dailymotion'))
                {
                    echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class=""><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. get_the_title().'" /></a></div><!-- .post-image/-->' ."\n";
                }
                else
                {
                    if($image) :
                        echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class=""><img width="'. $img_w .'" height="'. $img_h .'" src="'. $image .'" alt="'. get_the_title() .'" /></a></div><!-- .post-image/-->' ."\n";
                    endif;
                }
                ?>
                <div class="post-caption">
                    <h2 class="post-title">
                        <b><a href="<?php the_permalink()?>" title="<?php printf(__( '%s', 'bd' ), the_title_attribute( 'echo=0' )); ?>" rel="bookmark"><?php the_title(); ?></a></b>
                    </h2><!-- .post-title/-->
                    <div class="details">
                        <span class="meta-date"><i class="icon-time"></i><?php global $bd_data; the_time($bd_data['date_format']); ?></span>
                        <span class="widget"><?php echo bd_wp_post_rate() ?></span>
                    </div><!-- .post-meta/-->
                </div><!-- .post-caption/-->
            </div><!-- article/-->
        </div>
    <?php endwhile; endif; wp_reset_query(); ?>
    </div>
</div>