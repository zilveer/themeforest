<div class="clear"></div>
<?php
    query_posts(array('showposts' => $GLOBALS['bd_total_posts'], 'cat' => implode(',',$GLOBALS['bd_cat_id']) ));
?>
<div class="home-scroll" id="home-scroll-<?php echo $GLOBALS['k']; ?>">
    <div class="home-box-title">
        <h2><b><?php echo $GLOBALS['v']['title']; ?></b>
            <div class="home-scroll-nav box-title-more">
                <a class="prev" id="home-scroll<?php echo $GLOBALS['k']; ?>-prev" href="#"><i class="icon-chevron-left"></i></a>
                <a class="nxt" id="home-scroll<?php echo $GLOBALS['k']; ?>-nxt" href="#"><i class="icon-chevron-right"></i></a>
            </div>
        </h2>
    </div>
    <div class="post-warpper">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <?php
                $img_w      = 186;
                $img_h      = 186;
                $thumb      = bd_post_image('full');
                $image      = aq_resize( $thumb, $img_w, $img_h, true );
                if($image =='')
                {
                    $image = BD_IMG .'default-186-186.png';
                }
                $alt        = get_the_title();
                //$link       = get_permalink();
                if (has_post_format('video'))
                {
                    global $post;
                    $type           = get_post_meta($post->ID, 'bd_video_type', true);
                    $id             = get_post_meta($post->ID, 'bd_video_url', true);

                    if($type == 'youtube')
                    {
                        $link       = 'http://www.youtube.com/watch?v='. stripslashes($id) .'';
                    }
                    elseif($type == 'vimeo')
                    {
                        $link       = 'http://www.vimeo.com/'. stripslashes($id) .'';
                    }
                    elseif($type == 'daily')
                    {
                        $link       = 'http://www.dailymotion.com/video/'. stripslashes($id) .'';
                    }
                    else
                    {
                        $link       = bd_post_image('full');
                    }
                }
                else
                {
                    $link       = bd_post_image('full');
                }

                if (strpos(bd_post_image(), 'youtube'))
                {
                    echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'" class="lightbox"><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
                }
                elseif (strpos(bd_post_image(), 'vimeo'))
                {
                    echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'" class="lightbox"><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
                }
                elseif (strpos(bd_post_image(), 'dailymotion'))
                {
                    echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'" class="lightbox"><img width="'. $img_w .'" height="'. $img_h .'"  src="'. bd_post_image('full').'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
                }
                else
                {
                    if($image) :
                        echo '<div class="post-image"><a href="'. $link .'" title="'. $alt .'" class="lightbox"><img width="'. $img_w .'" height="'. $img_h .'" src="'. $image .'" alt="'. $alt .'" /></a></div><!-- .post-image/-->' ."\n";
                    endif;
                }
                ?>
                <div class="post-caption">
                    <h3 class="post-title">
                        <a href="<?php the_permalink()?>" title="<?php printf(__( '%s', 'bd' ), the_title_attribute( 'echo=0' )); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h3><!-- .post-title/-->
                    <div class="post-meta">
                        <span class="meta-date"><i class="icon-time"></i><?php global $bd_data; the_time($bd_data['date_format']); ?></span>
                    </div><!-- .post-meta/-->
                </div><!-- .post-caption/-->
            </div>
        <?php endwhile; endif; wp_reset_query(); ?>
    </div>

</div>
<script type="text/javascript">
    jQuery(document).ready(function()
    {
        var vids = jQuery("#home-scroll-<?php echo $GLOBALS['k']; ?> .post-item");
        for(var i = 0; i < vids.length; i+=3)
        {
            vids.slice(i, i+3).wrapAll('<div class="post-items"></div>');
        }
        jQuery(function()
        {
            jQuery('#home-scroll-<?php echo $GLOBALS['k']; ?>').cycle(
                {
                    fx              : 'scrollHorz',
                    easing          : 'swing', //easeInOutBack
                    timeout         : 5555,
                    speed           : 600,
                    slideExpr       : '.post-items',
                    prev            : '#home-scroll<?php echo $GLOBALS['k']; ?>-prev',
                    next            : '#home-scroll<?php echo $GLOBALS['k']; ?>-nxt',
                    pause           : false
                });
        });
    });
</script>
<div class="clear"></div>