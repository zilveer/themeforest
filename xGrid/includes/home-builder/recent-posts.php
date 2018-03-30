<?php
global $bd_count;
$count = 0;

?>
<div class="clear"></div>
<?php
    query_posts(array('showposts' => $GLOBALS['bd_total_posts'], 'cat' => implode(',',$GLOBALS['bd_cat_id']) ));
    $display = $GLOBALS['v']['display'];
?>
<div class="recent-box <?php echo $display ?>">
    <div class="home-box-title"><h2><b><?php echo $GLOBALS['v']['title']; ?></b></h2></div>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $bd_count++; ?>
    <?php if( $display == 'recent_box_list' ): ?>
        <article class="recent-box-list">
            <?php
            $img_w      = 82;
            $img_h      = 82;
            $thumb      = bd_post_image('full');
            $image      = aq_resize( $thumb, $img_w, $img_h, true );
            if($image =='')
            {
                $image = BD_IMG .'default-82-82.png';
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
            <div class="recent-box-list-content">
                <h2>
                    <b><a href="<?php the_permalink();?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></b>
                </h2>
                <p>
                    <?php wp_excerpt('wp_bd2'); ?>
                </p>
                <div class="details">
                    <?php
                    global $bd_data;
                    echo "<span class='post_meta_date'>\n"; the_time($bd_data['date_format']); echo "</span>\n";
                    echo "<span class='post_meta_views'><i class='icon-eye-open'></i>\n"; echo getPostViews(get_the_ID()); echo "</span>\n";
                    ?>
                    <span class="widget"><?php echo bd_wp_post_rate() ?></span>
                </div>
            </div>
        </article>
    <?php else: ?>
            <article class="blog-two half-width-category <?php if( $bd_count == 2 ) { echo 'last-column'; $bd_count= 0; } ?>" id="post-<?php the_ID(); ?>">
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
                <div class="post-entry"><p><?php wp_excerpt('wp_bd6'); ?></p></div>
                <div class="post-readmore"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'bd'); ?> <?php the_title_attribute(); ?>"  class="btn btn-small"><?php _e('Read more', 'bd'); ?></a></div><!-- .post-readmore/-->
            </article>
    <?php endif; ?>
    <?php endwhile; endif; wp_reset_query(); ?>
    <div class="clear"></div>
</div><!-- .recent-post-box/-->
<div class="clear"></div>