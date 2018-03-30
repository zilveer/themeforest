<div class="clear"></div>
<?php
    query_posts(array('showposts' => $GLOBALS['bd_total_posts'], 'cat' => implode(',',$GLOBALS['bd_cat_id']) ));
?>
<div class="gallery-box">
    <div class="home-box-title"><h2><b><?php echo $GLOBALS['v']['title']; ?></b></h2></div>
    <div id="gallery-box" class="gallery-items grid">
        <ul id="list">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <li class="item block">
            <?php
                $img_w      = 204;
                $img_h      = 160;
                $thumb      = bd_post_image('full');
                $image      = aq_resize( $thumb, $img_w, $img_h, true );
                $alt        = get_the_title();
                $link       = get_permalink();
                if (strpos(bd_post_image(), 'youtube'))
                {
                    echo '<div class="post-image"><a href="'. bd_post_image('full') .'" title="'. $alt .'" class="lightbox"><img src="'. bd_post_image('full') .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /><span class="gallery-icon"><i class="icon-picture"></i></span></a></div><!-- .post-image/-->' ."\n";
                }
                elseif (strpos(bd_post_image(), 'vimeo'))
                {
                    echo '<div class="post-image"><a href="'. bd_post_image('full') .'" title="'. $alt .'" class="lightbox"><img src="'. bd_post_image('full') .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /><span class="gallery-icon"><i class="icon-picture"></i></span></a></div><!-- .post-image/-->' ."\n";
                }
                elseif (strpos(bd_post_image(), 'dailymotion'))
                {
                    echo '<div class="post-image"><a href="'. bd_post_image('full') .'" title="'. $alt .'" class="lightbox"><img src="'. bd_post_image('full') .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /><span class="gallery-icon"><i class="icon-picture"></i></span></a></div><!-- .post-image/-->' ."\n";
                }
                else
                {
                    if($image) :
                        echo '<div class="post-image"><a href="'. $thumb .'" title="'. $alt .'" class="lightbox"><img src="'. $image .'" width="'. $img_w .'" height="'. $img_h .'" alt="'. $alt .'" /><span class="gallery-icon"><i class="icon-picture"></i></span></a></div><!-- .post-image/-->' ."\n";
                    endif;
                }
            ?>

                <div class="caption">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'bd' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                </div>
            </li>
        <?php endwhile; endif; wp_reset_query(); ?>
        </ul>
    </div>
</div>
<div class="clear"></div>

<script>
    jQuery(document).ready(function(){


    });
</script>