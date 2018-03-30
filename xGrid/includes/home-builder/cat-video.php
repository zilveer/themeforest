<?php
global $bd_count;
$count = 0;
?>
<div class="clearfix"></div>
<div class="cat-box-video">
    <div class="home-box-title">
        <h2>
            <b><?php echo $GLOBALS['v']['title']; ?></b>
            <div class="home-scroll-nav box-title-more">
                <a class="more-plus" href="<?php echo get_category_link($GLOBALS['bd_cat_id']); ?>"><i class="icon-plus"></i></a>
            </div>
        </h2>
    </div>
    <?php
        query_posts(array('showposts' => $GLOBALS['bd_total_posts'], 'cat' => $GLOBALS['bd_cat_id']  ));
    ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); if (has_post_format('video')):  ?>
        <?php $bd_count++; ?>
        <article class="blog-two half-width-category <?php if( $bd_count == 2 ) { echo 'last-column'; $bd_count= 0; } ?>" id="post-<?php the_ID(); ?>">
            <?php
                $img_w          = '100%';
                $img_h          = 220;
                $type           = get_post_meta(get_the_ID(), 'bd_video_type', true);
                $id             = get_post_meta(get_the_ID(), 'bd_video_url', true);
                $embed          = get_post_meta(get_the_ID(), 'bd_embed_code', true);

                if($type == 'youtube')
                {
                    echo '<div class="post-image video-box" style="width: '. $img_w .'px;"><iframe width="'. $img_w .'" height="'. $img_h .'" src="http://www.youtube.com/embed/'. $id .'?rel=0" frameborder="0" allowfullscreen></iframe></div>'."\n";
                }
                elseif($type == 'vimeo')
                {
                    echo '<div class="post-image video-box" style="width: '. $img_w .'px;"><iframe src="http://player.vimeo.com/video/'. $id .'?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="'. $img_w .'" height="'. $img_h .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'."\n";
                }
                elseif($type == 'daily')
                {
                    echo '<div class="post-image video-box" style="width: '. $img_w .'px;"><iframe frameborder="0" width="'. $img_w .'" height="'. $img_h .'" src="http://www.dailymotion.com/embed/video/'. $id .'?logo=0"></iframe></div>'."\n";
                }
                elseif($type == 'embed')
                {
                    $embed_code = $get_meta["bd_embed_code"][0];
                    $video_code = htmlspecialchars_decode($embed_code);
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
        </article>
    <?php
    else :
        ?>
        <article class="blog-two half-width-category" id="post-<?php the_ID(); ?>">
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
        <?php
    endif;

    endwhile;
    endif;
    wp_reset_query(); ?>
</div>
<div class="clearfix"></div>