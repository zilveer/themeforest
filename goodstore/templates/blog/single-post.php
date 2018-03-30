<?php
/* Start loop */
global $content_width;
?>
<?php
while (have_posts()) : the_post();

    $post_meta = get_post_meta(get_the_id(), '');

    $review = false;
    if (isset($post_meta['fw_rating_position']) && implode($post_meta['fw_rating_position']) == '1') {
        $review = true;
    } else {
        $review = false;
    }
    if (jwLayout::content_layout() == 'fullwidth_sidebar') {
        $layout = 'fullwidth';
    } else {
        $layout = 'sidebar';
    }
    ?>
    <article  <?php post_class($layout . ' ' . 'content' . ' ' . implode(' ', jwLayout::content_width())) ?> id="post-<?php the_ID(); ?>" <?php if ($review) { ?> itemscope itemtype="http://schema.org/Review" <?php } ?> >
        <!-- Image / video / gallery -->
        <?php
        if (!isset($post_meta['_use_featured'][0])) {
            $featured_img = jwOpt::get_option('post_use_featured', '1');
        } else if (isset($post_meta['_use_featured'][0])) {
            if ($post_meta['_use_featured'][0] == '-1') {
                $featured_img = jwOpt::get_option('post_use_featured', '1');
            } else {
                $featured_img = $post_meta['_use_featured'][0];
            }
        }
        if ($featured_img == '1') {

            $post_format = get_post_format(get_the_ID());

            if ($post_format == 'gallery') {
                if (isset($post_meta['_post_gallery'][0])) {
                    $gallery = json_decode($post_meta['_post_gallery'][0]);

                    $gal = array();
                    foreach ($gallery as $key => $value) {
                        $gal[] = $value->id;
                    }
                    echo do_shortcode('[jaw_section size="' . jwLayout::parseColWidth() . '"][jaw_gallery box_size="8" gallery="' . implode(',', $gal) . '"][/jaw_section]');
                }
            } else if ($post_format == 'video') {
                echo jwRender::get_video_player($post_meta['_post_video_link'][0], $content_width);
            } else if (has_post_thumbnail()) {
                echo '<span class="post-thumbnail" rel="media:thumbnail">';
                $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                $img_small = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'lazyload');
                echo '<img class="lazy" data-original="' . $img[0] . '" src="' . $img_small[0] . '" width="' . $img[1] . '" height="' . $img[2] . '" alt="' . get_the_title() . '" />';
                echo '</span>';
            }
        }

        if (jwOpt::get_option('banner_posttop_show', '0') == '1') {
            echo jaw_get_template_part('banner_posttop', 'blog');
        }
        ?>

        <header  >
            <h1 class="entry-title"  ><?php the_title(); ?></h1>
        </header>

        <div class="entry-content" >

            <?php
            if ((jwOpt::get_option('post_author', '1') == '1') ||
                    (jwOpt::get_option('post_date', '1') == '1') ||
                    (jwOpt::get_option('post_ratings', '1') == '1') ||
                    (jwOpt::get_option('post_type_icon', '1') == '1') ||
                    (jwOpt::get_option('post_comments_count', '1') == '1') ||
                    (jwOpt::get_option('post_category', '1') == '1')) {
                ?>
                <ul class="blog-meta-info-top">

                    <?php if (jwOpt::get_option('post_type_icon', '1') == '1') { ?>
                        <?php
                        $post_icon = jwRender::get_meta_icon();
                        ?>
                        <?php if (strlen($post_icon) > 0) { ?>
                            <li class="post-meta-post-icon">
                                <?php
                                echo jwRender::get_meta_icon();
                                ?>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if (jwOpt::get_option('post_category', '1') == '1') { ?>
                        <li class="post-meta-category">
                            <span><?php _e('Posted in: ', 'jawtemplates'); ?></span>
                            <?php echo jwRender::get_meta_category(); ?>
                        </li>
                    <?php } ?>

                    <?php if (jwOpt::get_option('post_date', '1') == '1' || (jwOpt::get_option('post_author', '1') == '1')) { ?>
                        <li class="post-meta-author-date">
                            <?php if (jwOpt::get_option('post_author', '1') == '1') { ?>
                                <?php echo _e('Posted by: ', 'jawtemplates'); ?>
                                <?php echo jwRender::get_meta_author(); ?>
                            <?php } ?>
                            <?php if (jwOpt::get_option('post_date', '1') == '1') { ?>
                                <span class="date">
                                    <?php echo jwRender::get_meta_date(); ?>
                                </span>
                            <?php } ?>
                        </li>
                    <?php } ?>

                    <?php if (jwOpt::get_option('post_ratings', '1') == '1') { ?>    
                        <li class="post-meta-ratings">
                            <div class="post-meta-rating rating">
                                <?php echo jwRender::metaRating(); ?>  <!-- RATING -->
                                <div class="clear"></div>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if (jwOpt::get_option('post_comments_count', '1') == '1') { ?>  
                        <li class="post-meta-comments">
                            <?php echo jwRender::get_meta_comments(); ?>
                        </li>    
                    <?php } ?>
                    <?php edit_post_link(__('Edit', 'jawtemplates'), '<li class="post-meta-edit">', '</li>'); ?>
                </ul>
            <?php } ?>


            <div class="perex">
                <?php
                if (strpos(get_the_content(), 'id="more-')) {
                    global $more;
                    $more = 0;       // Set (inside the loop) to display content above the more tag.
                    echo get_the_content('', true);
                    ?>
                </div>

                <div class="clear"></div>

                <div  class="more-text">
                    <?php
                    $more = 1;
                    echo do_shortcode(get_the_content('', true)); // Set to hide content above the more tag.
                } else {
                    the_content('');
                }
                ?>  
            </div>
        </div>
        <div class="clear"></div>
        <?php wp_link_pages(array('before' => '<div id="page-nav">', 'after' => '</div>', 'link_before' => '<span class="post_page">', 'link_after' => '</span>')); ?>

        <?php
        if (isset($review) && $review) {
            echo jaw_get_template_part('rating_bottom', 'blog');
        }
        ?>
        <div class="clear"></div>

        <div class="tagcloud">
            <p><?php the_tags(null, ' '); ?></p>
        </div>      
        <?php
        if (jwOpt::get_option('banner_postbottom_show', '0') == '1') {
            echo jaw_get_template_part('banner_postbottom', 'blog');
        }
        ?>
        <div class="clear"></div>

        <?php if (jwOpt::get_option('post_share') == '1') { ?>

            <div class="share_post" role="main">

                <div class="share_hearline">
                    <?php _e("Share IT:", "jawtemplates"); ?>

                </div>

                <?php
                $title = htmlentities(urlencode(get_the_title()));
                $link = urlencode(get_permalink());
                $media = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large-size');
                $media = urlencode($media[0]);
                $desc = urlencode($post->post_excerpt);
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
                            <a class="link-email" target="_blank" href="mailto:<?php echo jwOpt::get_option('post_share_mail_content', 'youremail@addresshere.com'); ?>?subject=<?php echo $title; ?>&body=<?php echo urldecode($desc) . ' ' . $link; ?>">
                                <span class="icon-mail4 "></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="clear"></div>
            </div>
        <?php } ?>


        <?php if (jwOpt::get_option('blog_author') == '1') { ?>
            <div id="admin_info" role="main">
                <div class="about_author" itemtype="http://schema.org/Person" itemscope itemprop="author">
                    <h3 class="author_name"  itemprop="name"><?php echo get_the_author(); ?></h3>
                    <div class="author_link"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php _e('About the author', 'jawtemplates'); ?></a></div>                    
                </div>

                <div class="author_info">
                    <div class="author_image">
                        <?php echo get_avatar(get_the_author_meta('ID')); ?>
                    </div>
                    <div class="author_desc">
                        <p><?php echo get_the_author_meta("description"); ?></p>
                        <?php
                        if (get_the_author_meta('facebook') ||
                                get_the_author_meta('twitter') ||
                                get_the_author_meta('google') ||
                                get_the_author_meta('youtube') ||
                                get_the_author_meta('linkedin') ||
                                get_the_author_meta('vimeo') ||
                                get_the_author_meta('pinterest') ||
                                get_the_author_meta('instagram') ||
                                get_the_author_meta('flickr')) {
                            ?>
                            <div class="share_post" role="main">
                                <ul class="socialshare-icon">
                                    <li>
                                        <span class="follow-me-title">
                                            <?php _e("Follow me on:", "jawtemplates"); ?>
                                        </span>
                                    </li>
                                    <?php if (get_the_author_meta('facebook')) { ?>
                                        <li>
                                            <a class="link-facebook" target="_blank" href="<?php echo get_the_author_meta('facebook') ?>">
                                                <span class="icon-facebook4"></span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if (get_the_author_meta('twitter')) { ?>
                                        <li>
                                            <a class="link-twitter" target="_blank" href="<?php echo get_the_author_meta('twitter') ?>">
                                                <span class="icon-twitter3"></span>
                                            </a>
                                        </li>
                                    <?php } ?>                            
                                    <?php if (get_the_author_meta('google')) { ?>
                                        <li>
                                            <a class="link-google" target="_blank" href="<?php echo get_the_author_meta('google') ?>">
                                                <span class="icon-google-plus4"></span>
                                            </a>
                                        </li>
                                    <?php } ?>

                                    <?php if (get_the_author_meta('youtube')) { ?>
                                        <li>
                                            <a class="link-youtube" target="_blank" href="<?php echo get_the_author_meta('youtube'); ?>">
                                                <span class="icon-youtube"></span>
                                            </a>
                                        </li>
                                    <?php } ?>

                                    <?php if (get_the_author_meta('linkedin')) { ?>
                                        <li>
                                            <a class="link-linkedin" target="_blank" href="<?php echo get_the_author_meta('linkedin'); ?>">
                                                <span class="icon-linkedin"></span>
                                            </a>
                                        </li>
                                    <?php } ?> 

                                    <?php if (get_the_author_meta('vimeo')) { ?>
                                        <li>
                                            <a class="link-vimeo" target="_blank" href="<?php echo get_the_author_meta('vimeo'); ?>">
                                                <span class="icon-vimeo3"></span>
                                            </a>
                                        </li>
                                    <?php } ?>  

                                    <?php if (get_the_author_meta('flickr')) { ?>
                                        <li>
                                            <a class="link-flickr" target="_blank" href="<?php echo get_the_author_meta('flickr'); ?>">
                                                <span class="icon-flickr4"></span>
                                            </a>
                                        </li>
                                    <?php } ?>  

                                    <?php if (get_the_author_meta('pinterest')) { ?>
                                        <li>
                                            <a class="link-pinterest" target="_blank" href="<?php echo get_the_author_meta('pinterest'); ?>">
                                                <span class="icon-pinterest"></span>
                                            </a>
                                        </li>
                                    <?php } ?>  
                                    <?php if (get_the_author_meta('instagram')) { ?>
                                        <li>
                                            <a class="link-instagram" target="_blank" href="<?php echo get_the_author_meta('instagram'); ?>">
                                                <span class="icon-instagram"></span>
                                            </a>
                                        </li>
                                    <?php } ?>  

                                </ul>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div><!-- End Content row -->

        <?php } ?>

        <nav id="nav-single">
            <span class="nav-previous"><?php previous_post_link('%link', '<i class="icon-arrow-slide-left"></i> ' . __('Previous', 'jawtemplates')); ?></span>
            <span class="nav-next"><?php next_post_link('%link', __('Next', 'jawtemplates') . ' <i class="icon-arrow-slide-right"></i>'); ?></span>
        </nav><!-- #nav-single -->
        <div class="clear"></div>

        <?php get_template_part('woocommerce/single-product/related'); ?>  
        <?php echo jaw_get_template_part('related-post', 'blog'); ?>
        <?php
        if (jwOpt::get_option('show_comments', '1') == '1') {
            comments_template();
        }
        ?>
    </article>
    <?php
endwhile;
