<?php get_header() ?>

<?php
global $venedor_settings;

$post_layout = $venedor_settings['post-content-layout'];

$post_layout = (isset($_GET['post-layout'])) ? $_GET['post-layout'] : $post_layout;

?>

<div id="content" role="main">

    <?php wp_reset_postdata(); ?>
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
    <?php //query_posts($query_string.'&paged='.$paged); ?>

    <?php if (have_posts()) : the_post(); ?>
    <?php
    $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

        <?php // Post Title and Prev/Next Navigation ?>
        <?php if ($venedor_settings['post-page-nav'] && (get_previous_post_link() || get_next_post_link())) : ?>
        <h1 class="entry-title"><span class="inline-title"><?php _e('Blog Post', 'venedor') ?></span><span class="line"></span></h1>
        <div class="single-nav clearfix">
            <?php previous_post_link('%link', '<span class="prev"></span>'); ?>
            <?php next_post_link('%link', '<span class="next"></span>'); ?>
        </div>
        <?php else : ?>
        <h1 class="entry-title"><?php _e('Blog Post', 'venedor') ?></h1>
        <?php endif; ?>
        
        <?php // Post Slideshow ?>
        <?php if ($post_layout == 'large-alt') get_template_part('slideshow'); ?>
                
        <div class="post-content-wrap">
            <div class="post-info <?php echo $post_layout ?><?php if (!($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true))) echo ' none-slideshow' ?>">
                <div class="post-date">
                    <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
                    <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
                </div>
                <?php 
                $post_format = get_post_format();
                if ($venedor_settings['post-format'] && $post_format) : 
                    $ext_link = '';
                    if ($post_format == 'link') {
                        $ext_link = get_post_meta($post->ID, 'external_url', true);
                        if ($ext_link) : ?>
                            <a href="<?php echo $ext_link ?>">
                        <?php else :
                            $post_format = '';
                        endif;
                    }
                    if ($post_format) : ?>
                        <div class="post-format <?php echo $post_format ?>">
                            <span class="fa fa-<?php
                                switch ($post_format) {
                                    case 'aside': echo 'file-text'; break;
                                    case 'gallery': echo 'camera-retro'; break;
                                    case 'link': echo 'link'; break;
                                    case 'image': echo 'picture-o'; break;
                                    case 'quote': echo 'quote-left'; break;
                                    case 'video': echo 'film'; break;
                                    case 'audio': echo 'music'; break;
                                    case 'chat': echo 'comments'; break;
                                }
                            ?>"></span>
                        </div>
                    <?php endif; 
                    if ($ext_link) echo '</a>';
                    ?>
                <?php endif; ?>
            </div>
            <div class="post-content <?php echo $post_layout ?><?php if (!($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true))) echo ' none-slideshow' ?>">
            
                <?php // Post Slideshow ?>
                <?php if ($post_layout == 'medium-alt') get_template_part('slideshow'); ?>

                <h2 class="entry-title"><?php the_title(); ?></h2>
                
                <div class="entry-meta">
                    <div class="meta-item meta-author"><div class="meta-inner"><span class="fa fa-user"></span> <?php echo __('By', 'venedor'); ?> <?php the_author_posts_link(); ?></div></div>
                    <div class="meta-item meta-comments"><div class="meta-inner"><span class="fa fa-comments"></span> <?php comments_popup_link(__('0 Comments', 'venedor'), __('1 Comment', 'venedor'), '% '.__('Comments', 'venedor')); ?></div></div>
                    <div class="meta-item meta-cats"><div class="meta-inner"><span class="fa fa-folder-open"></span> <?php the_category(', '); ?></div></div>
                </div>
                            
                <div class="entry-content"><?php // addthis buttons
                    $addthis_options = get_option('addthis_settings');
                    if (defined('ADDTHIS_INIT') && $venedor_settings['post-addthis-above'] && !(isset($addthis_options) && isset($addthis_options['addthis_for_wordpress']) && ($addthis_options['addthis_for_wordpress'] == true))) : ?>
                    <div class="entry-addthis-above clearfix">
                        <?php
                        remove_filter('addthis_above_content', 'venedor_addthis_remove', 10);
                        do_action('addthis_widget', get_permalink(), get_the_title(), 'above'); 
                        add_filter('addthis_above_content', 'venedor_addthis_remove', 10, 1);
                        ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php the_content(); ?>
                    
                    <?php if (defined('ADDTHIS_INIT') && $venedor_settings['post-addthis-below'] && !(isset($addthis_options) && isset($addthis_options['addthis_for_wordpress']) && ($addthis_options['addthis_for_wordpress'] == true))) : ?>
                    <div class="entry-addthis-below clearfix">
                        <?php
                        // addthis buttons
                        remove_filter('addthis_below_content', 'venedor_addthis_remove', 10);
                        do_action('addthis_widget', get_permalink(), get_the_title(), 'below'); 
                        add_filter('addthis_below_content', 'venedor_addthis_remove', 10, 1);
                        ?>
                    </div>
                    <?php endif; ?>
                    <?php wp_link_pages(); ?>
                </div>
                
                <?php if ($venedor_settings['post-author']) : ?>
                <div class="entry-author clearfix">
                    <div class="avatar">
                        <?php echo get_avatar(get_the_author_meta('email'), '145'); ?>
                    </div>
                    <div class="author-content">
                        <div class="title"><h3><?php echo __('About the Author:', 'venedor'); ?> <?php the_author_posts_link(); ?></h3></div>
                        <div class="description">
                            <?php the_author_meta("description"); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($venedor_settings['post-comments']) : ?>
                <?php
                    wp_reset_postdata();
                    comments_template();
                ?>
                <?php endif; ?>
            </div>
        </div>
                        
    </div>
    
    <?php if ($venedor_settings['post-related']) : ?>
        <?php $related = get_related_posts($post->ID); ?>
        <?php if ($related->have_posts()) : 
            $count = 0;
            ob_start(); ?>
            <?php while ($related->have_posts()) : $related->the_post();
            global $post; global $previousday; unset($previousday); ?>
                <?php if (has_post_thumbnail()) : $count++; ?>
                <div class="post-item">
                    <div class="inner">
                        <div class="post-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('post-related'); ?></a>
                            <?php if ($venedor_settings['post-zoom']) : ?>
                            <div class="figcaption">
                                <a class="btn btn-inverse zoom-button" href="<?php $thumbs = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $thumbs[0]; ?>"><span class="fa fa-search"></span></a>
                                <a class="btn btn-inverse link-button" href="<?php the_permalink(); ?>"><span class="fa fa-link fa-rotate-90"></span></a>
                            </div>
                            <?php endif; ?>    
                        </div>
                        <div class="post-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
                        </div>
                        <p><?php echo venedor_excerpt(15, false); ?></p>
                        <div class="entry-meta clearfix">
                            <div class="left">
                                <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Read More', 'venedor') ?></a>
                            </div>
                            <div class="right">
                                <span class="meta-date"><?php echo get_the_date('', $post) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>
            
            <?php
            $html = ob_get_contents();
            ob_end_clean();
            
            if ($count) : ?>
                <div class="entry-related related-slider m-t-none m-b-lg">
                    <h2 class="entry-title"><?php echo __('Related Posts', 'venedor'); ?></h2>
                    <div class="row"><div class="post-carousel owl-carousel">
                         <?php echo $html ?>                   
                    </div></div>
                </div>
            <?php endif; ?>
            
        <?php endif; ?>
    <?php endif; ?>
    
    <?php endif; ?>
</div>

<?php get_footer() ?>