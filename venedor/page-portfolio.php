<?php
// Template Name: Portfolio
get_header(); 
global $venedor_settings;
?>
	<div id="content" class="portfolio-page-content" role="main">
        <?php /* The loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>

                    <?php if (get_post_meta(get_the_ID(), 'title', true) != 'title') : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php endif; ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'venedor' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                </div><!-- .entry-content -->

                <footer class="entry-meta">
                    <?php edit_post_link( __( 'Edit', 'venedor' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-meta -->
            </article><!-- #post -->

        <?php endwhile; ?>
    
        <?php $current_page_id = $post->ID; ?>
        <?php
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
        $cols = get_post_meta(get_the_ID(), 'portfolio_columns', true);
        $args = array(
            'post_type' => 'portfolio',
            'paged' => $paged,
            'posts_per_page' => $venedor_settings['portfolio-items'],
        );
        $cats = get_post_meta(get_the_ID(), 'portfolio_cat', true);
        $cats = explode(',', $cats);
        if ($cats && in_array(0, $cats)) {
            $cats = false;
        }
        
        if ($cats) {
            $args['tax_query'][] = array(
                'taxonomy' => 'portfolio_cat',
                'field' => 'ID',
                'terms' => $cats
            );
        }
        $portfolios = new WP_Query($args);
        $portfolio_taxs = array();
        if (is_array($portfolios->posts) && !empty($portfolios->posts)) {
            foreach ($portfolios->posts as $portfolio) {
                $post_taxs = wp_get_post_terms($portfolio->ID, 'portfolio_cat', array("fields" => "all"));
                if (is_array($post_taxs) && !empty($post_taxs)) {
                    foreach ($post_taxs as $post_tax) {
                        if (is_array($cats) && !empty($cats) && in_array($post_tax->term_id, $cats)) {
                            $portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                        }

                        if (empty($cats) || !isset($cats)) {
                            $portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                        }
                    }
                }
            }
        }
        if (is_array($portfolio_taxs)) {
            asort($portfolio_taxs);
        }
        ?>
        <div class="<?php if (get_post_meta($current_page_id, 'infinite_scroll', true)) echo 'infinite-content' ?> clearfix">
            <?php if (is_array($portfolio_taxs) && !empty($portfolio_taxs) && get_post_meta($current_page_id, 'portfolio_filters', true)) : ?>
            <ul class="portfolio-filter clearfix">
                <li><a class="active" data-filter="*" href="#"><?php echo __('All', 'venedor'); ?></a></li>
                <?php foreach ($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name) : ?>
                <li><a data-filter=".<?php echo $portfolio_tax_slug; ?>" href="#"><?php echo $portfolio_tax_name; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            
            <div class="<?php if (get_post_meta($current_page_id, 'infinite_scroll', true)) echo 'posts-infinite' ?> portfolio-wrapper grid-layout row">
                <?php
                while ($portfolios->have_posts()): $portfolios->the_post();
                    $item_classes = '';
                    $item_cats = get_the_terms($post->ID, 'portfolio_cat');
                    if ($item_cats):
                        foreach ($item_cats as $item_cat) {
                            $item_classes .= urldecode($item_cat->slug) . ' ';
                        }
                    endif;
                    switch ($cols) {
                        case 2: $item_classes .= 'col-xs-6'; break;
                        case 3: $item_classes .= 'col-xs-6 col-md-4'; break;
                        default: $cols = 4; $item_classes .= 'col-xs-6 col-md-4 col-lg-3'; break;
                    }
                    ?>
                    <div class="post-item <?php echo $item_classes; ?>">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="post-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('portfolio-grid'.$cols); ?></a>
                            <?php if ($venedor_settings['portfolio-zoom']) : ?>
                            <div class="figcaption">
                                <a class="btn btn-inverse zoom-button" href="<?php $thumbs = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $thumbs[0]; ?>"><span class="fa fa-search"></span></a>
                                <a class="btn btn-inverse link-button" href="<?php the_permalink(); ?>"><span class="fa fa-link fa-rotate-90"></span></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php else: ?>
                            <?php if (get_post_meta($post->ID, 'slideshow_type', true) == 'video' && get_post_meta($post->ID, 'video_code', true)): ?>
                            <div class="fit-video"><?php echo get_post_meta($post->ID, 'video_code', true) ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <h3 class="portfolio-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                        <div class="portfolio-cats"><?php echo get_the_term_list($post->ID, 'portfolio_cat', '', ', ', ''); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <?php venedor_pagination($portfolios->max_num_pages, $range = 2);
            wp_reset_postdata(); ?>
            
        </div>
    </div>
	
<?php get_footer(); ?>