<?php
global $bd_count;
$count = 0;
?>
<div class="clear clearfix"></div>
<div class="cat-grid">
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
    <?php query_posts(array('showposts' => $GLOBALS['bd_total_posts'], 'cat' => $GLOBALS['bd_cat_id']  )); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $bd_count++; ?>
        <?php
            $img_w      = 67;
            $img_h      = 67;
            $thumb      = bd_post_image('full');
            $image      = aq_resize( $thumb, $img_w, $img_h, true );
            if($image =='')
            {
                $image = BD_IMG .'default-67-67.png';
            }
            $alt        = get_the_title();
            $link       = get_permalink();

            if (strpos(bd_post_image(), 'youtube'))
            {
                echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class="ttip"><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. get_the_title().'" /></a></div><!-- .post-image/-->' ."\n";
            }
            elseif (strpos(bd_post_image(), 'vimeo'))
            {
                echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class="ttip"><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. get_the_title().'" /></a></div><!-- .post-image/-->' ."\n";
            }
            elseif (strpos(bd_post_image(), 'dailymotion'))
            {
                echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class="ttip"><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. get_the_title().'" /></a></div><!-- .post-image/-->' ."\n";
            }
            else
            {
                if($image) :
                    echo '<div class="post-image"><a href="'. $link .'" title="'. get_the_title() .'" class="ttip"><img width="'. $img_w .'" height="'. $img_h .'" src="'. $image .'" alt="'. get_the_title() .'" /></a></div><!-- .post-image/-->' ."\n";
                endif;
            }
        ?>
    <?php endwhile; endif; wp_reset_query(); ?>
</div>
<div class="clear clearfix"></div>