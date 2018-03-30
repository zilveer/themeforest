<?php get_header() ?>

<?php
global $venedor_settings;

$portfolio_layout = $venedor_settings['portfolio-content-layout'];

$portfolio_layout = (isset($_GET['portfolio-layout'])) ? $_GET['portfolio-layout'] : $portfolio_layout;
?>

<div id="content" role="main">
    <?php wp_reset_postdata(); ?>
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
    <?php //query_posts($query_string.'&paged='.$paged); ?>

    <?php if (have_posts()) : the_post(); ?>
    <?php
    $slideshow_type = get_post_meta($post->ID, 'slideshow_type', true);
    global $venedor_layout, $venedor_sidebar;
    global $previousday; unset($previousday);
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
        <?php // Post Title and Prev/Next Navigation ?>
        <?php if ($venedor_settings['portfolio-page-nav'] && (get_previous_post_link() || get_next_post_link())) : ?>
        <h1 class="entry-title"><span class="inline-title"><a href="<?php if (get_post_meta($post->ID, 'portfolio_link', true)) echo get_post_meta($post->ID, 'portfolio_link', true); else the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span><span class="line"></span></h1>
        <div class="single-nav clearfix">
            <?php previous_post_link('%link', '<span class="prev"></span>'); ?>
            <?php next_post_link('%link', '<span class="next"></span>'); ?>
        </div>
        <?php else : ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>
        
        <?php // Post Slideshow ?>
        <?php if ($portfolio_layout == 'large-alt') get_template_part('slideshow-portfolio'); ?>
                
        <div class="portfolio-content-wrap">
            <div class="portfolio-content <?php echo $portfolio_layout ?>">
                <div class="sub-content row">
                    <?php
                    $classes1 = '';
                    $classes2 = '';
                    if (($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar) {
                        $classes1 = 'col-md-7 col-sm-12';
                        $classes2 = 'col-md-5 col-sm-12';
                    } else {
                        $classes1 = 'col-md-8 col-sm-7';
                        $classes2 = 'col-md-4 col-sm-5';
                    }
                    if ($portfolio_layout == 'medium-alt' && !(($slideshow_type == 'images' && has_post_thumbnail()) || ($slideshow_type == 'video' && get_post_meta($post->ID, 'video_code', true)))) {
                        $classes1 = 'col-sm-12';
                        $classes2 = '';
                    } ?>
                    <div class="<?php echo $classes1 ?>">
                        <?php if ($portfolio_layout == 'medium-alt') get_template_part('slideshow-portfolio'); ?>
                        <?php if ($portfolio_layout == 'large-alt') : ?>
                        <div class="entry-content">
                            <?php 
                            the_content(); 
                            wp_link_pages();
                            ?>
                        </div>
                        <?php endif; ?>
                    <?php if ($classes2 != '') : ?>
                    </div>
                    <div class="<?php echo $classes2 ?>">
                    <?php endif; ?>
                        <?php if ($portfolio_layout == 'medium-alt') : ?>
                        <div class="entry-content">
                            <?php 
                            the_content(); 
                            wp_link_pages();
                            ?>
                        </div>
                        <?php endif; ?>
                        <div class="entry-meta">
                            <div class="meta-item meta-date"><div class="meta-inner"><span class="meta-title"><?php _e('Date:', 'venedor') ?></span> <?php the_date() ?> <?php the_time(); ?></div></div>
                            <div class="meta-item meta-cat"><div class="meta-inner"><span class="meta-title"><?php _e('Categories:', 'venedor') ?></span> <?php echo get_the_term_list($post->ID, 'portfolio_cat', '', ', ', ''); ?></div></div>
                            <div class="meta-item meta-skill"><div class="meta-inner"><span class="meta-title"><?php _e('Skills:', 'venedor') ?></span> <?php echo get_the_term_list($post->ID, 'portfolio_skills', '', ', ', ''); ?></div></div>
                            <?php if (get_post_meta($post->ID, 'portfolio_link', true)) : ?>
                            <div class="meta-item meta-link"><div class="meta-inner"><span class="meta-title"><?php _e('Link:', 'venedor') ?></span> <a href="<?php echo get_post_meta($post->ID, 'portfolio_link', true); ?>"><?php echo get_post_meta($post->ID, 'portfolio_link', true); ?></a></div></div>
                            <?php endif; ?>
                        </div>
                        <?php $addthis_options = get_option('addthis_settings'); // addthis buttons
                        if (defined('ADDTHIS_INIT') && $venedor_settings['portfolio-addthis'] && !(isset($addthis_options) && isset($addthis_options['addthis_for_wordpress']) && ($addthis_options['addthis_for_wordpress'] == true))) : ?>
                        <div class="entry-addthis clearfix">
                            <?php
                            // addthis buttons
                            remove_filter('addthis_below_content', 'venedor_addthis_remove', 10);
                            do_action('addthis_widget', get_permalink(), get_the_title(), 'below'); 
                            add_filter('addthis_below_content', 'venedor_addthis_remove', 10, 1);
                            ?>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                
                <?php if ($venedor_settings['portfolio-related']) : ?>
                    <?php $related = get_related_portfolios($post->ID); ?>
                    <?php if ($related->have_posts()) : 
                        $count = 0;
                        ob_start(); ?>
                        <?php while ($related->have_posts()) : $related->the_post();
                        global $post; global $previousday; unset($previousday);?>
                            <?php if (has_post_thumbnail()) : $count++; ?>
                            <div class="post-item">
                                <div class="inner">
                                    <div class="post-image">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('portfolio-related'); ?></a>
                                        <?php if ($venedor_settings['portfolio-zoom']) : ?>
                                        <div class="figcaption">
                                            <a class="btn btn-inverse zoom-button" href="<?php $thumbs = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $thumbs[0]; ?>"><span class="fa fa-search"></span></a>
                                            <a class="btn btn-inverse link-button" href="<?php the_permalink(); ?>"><span class="fa fa-link fa-rotate-90"></span></a>
                                        </div>
                                        <?php endif; ?>    
                                    </div>
                                    <div class="portfolio-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
                                    <div class="portfolio-cats"><?php echo get_the_term_list($post->ID, 'portfolio_cat', '', ', ', ''); ?></div>
                                </div>
                            </div>
                            <?php endif; ?>                            
                        <?php endwhile; ?>
                        
                        <?php
                        $html = ob_get_contents();
                        ob_end_clean();
                        
                        if ($count) : ?>
                            <div class="entry-related product-slider m-b-none">
                                <h2 class="entry-title"><?php echo __('Related Projects', 'venedor'); ?></h2>
                                <div class="row"><div class="product-carousel owl-carousel post-carousel">
                                    <?php echo $html ?>
                                </div></div>
                            </div>
                        <?php endif; ?>
                        
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
                        
    </div>
    <?php endif; ?>
</div>

<?php get_footer() ?>