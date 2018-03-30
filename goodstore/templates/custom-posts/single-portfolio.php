<?php
while (have_posts()) : the_post();

    $post_meta = get_post_meta(get_the_id(), '');
    if (jwLayout::content_layout() == 'fullwidth_sidebar') {   
        $layout = 'fullwidth';
    } else {
        $layout = 'sidebar';
    }
    $type = '';
    if (isset($post_meta['portfolio_type'][0])) {
        $type = $post_meta['portfolio_type'][0];
    }
    ?>
    <article  <?php post_class($layout . ' ' . $type . ' ' . 'content'.' '. implode(' ', jwLayout::content_width())) ?> id="post-<?php the_ID(); ?>" >

        <!-- Image / video / gallery -->
        <?php
        if (isset($post_meta['portfolio_type'][0])) {
            switch ($post_meta['portfolio_type'][0]) {
                case 'image':
                case 'link':
                    if (isset($post_meta['_portfolio_image'][0])) {
                        $img = json_decode($post_meta['_portfolio_image'][0]);
                        if (isset($img[0]->id)) {
                            $url = wp_get_attachment_image_src($img[0]->id, 'large');
                            $img_small = wp_get_attachment_image_src($img[0]->id, 'lazyload');
                            echo '<a class="post-thumbnail" href="' . $url[0] . '" title="' . get_the_title() . '" rel="prettyPhoto" >';
                            echo '<img class="lazy" data-original="' . $url[0] . '" src="'.$img_small[0].'" width="'.$url[1].'" height="'.$url[2].'" alt="' . get_the_title() . '">';
                            echo '</a>';
                        }
                    }
                    break;
                case 'audio':
                    if (isset($post_meta['_portfolio_image'][0])) {
                        $img = json_decode($post_meta['_portfolio_image'][0]);
                        if (isset($img[0]->id)) {
                            $url = wp_get_attachment_image_src($img[0]->id, 'large');
                            $img_small = wp_get_attachment_image_src($img[0]->id, 'lazyload');
                            echo '<a class="post-thumbnail" href="' . $url[0] . '" title="' . get_the_title() . '" rel="prettyPhoto" >';
                            echo '<img class="lazy" data-original="' . $url[0] . '" src="'.$img_small[0].'" width="'.$url[1].'" height="'.$url[2].'" alt="' . get_the_title() . '">';
                            echo '</a>';
                        }
                    }
                    if (isset($post_meta['_portfolio_sound'][0])) {
                        echo '<iframe id="sc-widget" width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$post_meta['_portfolio_sound'][0].'&show_artwork=true"></iframe>';
                    }
                    break;
                case 'gallery':
                    if (isset($post_meta['_portfolio_gallery'][0])) {
                        $gallery = json_decode($post_meta['_portfolio_gallery'][0]);

                        $gal = array();
                        foreach ($gallery as $key => $value) {
                            $gal[] = $value->id;
                        }
                        echo do_shortcode('[jaw_section size="' . jwLayout::parseColWidth() . '"][jaw_gallery box_size="' . jwLayout::parseColWidth() . '" gallery="' . implode(',', $gal) . '"][/jaw_section]');
                    }
                case 'video':
                    if (isset($post_meta['_portfolio_video_link'][0])) {
                        $video = $post_meta['_portfolio_video_link'][0];
                        $video_info = jwUtils::get_video_info($video);

                        echo do_shortcode('[jaw_section size="' . jwLayout::parseColWidth() . '" bar_type="off"][jaw_'.substr($video_info->domain,0,1).'_video box_size="' . jwLayout::parseColWidth() . '" clip_id="' . $video_info->id . '" height="400"][/jaw_section]');
                    }
                    break;
            }
        }
        ?>

        <header  >
            <h1 class="entry-title"  ><?php the_title(); ?></h1>
        </header>



        <div class="entry-content" >
            <?php if (jwOpt::get_option('post_date', '1') || jwOpt::get_option('post_author', '1')) { ?>
                <div class="meta">
                    <?php
                    if (jwOpt::get_option('post_date', '1')) {
                        echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark"><time class="entry-date" datetime="' . get_the_date('c') . '">' . get_the_date(jwOpt::get_option('element_blog_dateformat', 'F j, Y')) . '</time></a>';
                    }
                    if (jwOpt::get_option('post_author', '1')) {

                        echo '<span class="meta_posted_by">' . __(' by:', 'jawtemplates') . ' </span> <span class="author vcard"><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '"  rel="author">' . get_the_author() . '</a></span> </span>';
                    }
                    ?>
                </div>
            <?php } ?>

            <?php
            if (jwOpt::get_option('banner_posttop_show', '0') == '1') {
                get_template_part('loop', 'top_banner');
            }
            ?> 

            <?php
            if (isset($ratingPosition[0])) {
                if ($ratingPosition[0] == 'top') {
                    get_template_part('loop', 'rating_top');
                }
            }
            ?>
            <div class="perex">
                <?php
                if (strpos(get_the_content(), 'id="more-')) {
                    global $more;
                    $more = 0;       // Set (inside the loop) to display content above the more tag.
                    echo do_shortcode(get_the_content(''));
                    ?>
                </div>

                <div class="clear"></div>

                <div  class="more-text">
                    <?php
                    $more = 1;
                    echo do_shortcode(get_the_content('', true)); // Set to hide content above the more tag.
                } else {
                    echo do_shortcode(get_the_content(''));
                }
                ?>
            </div>
            <?php
            if (jwOpt::get_option('banner_postbottom_show', '0') == '1') {
                get_template_part('loop', 'bottom_banner');
            }


            if (isset($ratingPosition[0])) {
                if ($ratingPosition[0] == 'bottom') {
                    get_template_part('loop', 'rating_bottom');
                }
            }
            ?>


        </div>
        <div class="clear"></div>


        <footer>
            <p><?php the_tags(); ?></p>
        </footer>


        <nav id="nav-single">
            <span class="nav-previous"><?php previous_post_link('%link', '<i class="icon-arrow-slide-left"></i> ' . __('Previous', 'jawtemplates')); ?></span>
            <span class="nav-next"><?php next_post_link('%link', __('Next', 'jawtemplates') . ' <i class="icon-arrow-slide-right"></i>'); ?></span>
        </nav><!-- #nav-single -->
        <div class="clear"></div>


        <?php if (jwOpt::get_option('post_share') == '1') { ?>

            <div class="share_post" role="main">

                <div class="share_hearline">
                    <?php _e("Share IT:", "jawtemplates"); ?>

                </div>

                <?php
                $title = urlencode(get_the_title());
                $link = urlencode(get_permalink());
                $media = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large-size');
                $media = urlencode($media[0]);
                $desc = urlencode($post->post_excerpt);

                $img_pin = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
                // pokud neni featured vem logo stránky
                if ($img_pin == false) {
                    $img_pin[0] = jwOpt::get_option('custom_logo', '');
                }
                ?>
                <ul class="socialshare-icon">
                    <?php if (jwOpt::get_option('post_share_fb') == '1') { ?>
                        <li>
                            <a class="link-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>&t=<?php echo $title; ?>">
                                <span class="icon-facebook4"></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (jwOpt::get_option('post_share_tw') == '1') { ?>
                        <li>
                            <a class="link-twitter" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo $link; ?>&text=<?php echo $title; ?>&url=<?php echo $link; ?>">
                                <span class="icon-twitter3"></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (jwOpt::get_option('post_share_g') == '1') { ?>
                        <li>
                            <a class="link-google" target="_blank" href="https://plus.google.com/share?url=<?php echo $link; ?>">
                                <span class="icon-google-plus4"></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (jwOpt::get_option('post_share_pi') == '1') { ?>
                        <li>
                            <a class="link-pinterest" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo $link; ?>&media=<?php echo $media ?>&description=<?php echo $desc; ?>">
                                <span class="icon-pinterest"></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (jwOpt::get_option('post_share_mail') == '1') { ?>
                        <li>
                            <a class="link-email" target="_blank" href="mailto:youremail@addresshere.com?subject=<?php echo urldecode($title); ?>&body=<?php echo urldecode($desc) . ' ' . $link; ?>">
                                <span class="icon-mail4 "></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="clear"></div>
            </div>

        <?php }
        ?>


    </article>
<?php endwhile; // End the loop 
?>
