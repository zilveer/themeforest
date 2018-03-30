<?php
// Template Name: FAQ
get_header(); 
global $venedor_settings;
?>
	<div id="content" class="faq-page-content" role="main">
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
        $args = array(
            'post_type' => 'faq',
            'nopaging' => true
        );
        $cats = get_post_meta(get_the_ID(), 'faq_cat', true);
        $cats = explode(',', $cats);
        if ($cats && in_array(0, $cats)) {
            $cats = false;
        }
        
        if ($cats) {
            $args['tax_query'][] = array(
                'taxonomy' => 'faq_cat',
                'field' => 'ID',
                'terms' => $cats
            );
        }
        $faqs = new WP_Query($args);
        $faq_taxs = array();
        if (is_array($faqs->posts) && !empty($faqs->posts)) {
            foreach ($faqs->posts as $faq) {
                $post_taxs = wp_get_post_terms($faq->ID, 'faq_cat', array("fields" => "all"));
                if (is_array($post_taxs) && !empty($post_taxs)) {
                    foreach ($post_taxs as $post_tax) {
                        if (is_array($cats) && !empty($cats) && in_array($post_tax->term_id, $cats)) {
                            $faq_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                        }

                        if (empty($cats) || !isset($cats)) {
                            $faq_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                        }
                    }
                }
            }
        }
        if (is_array($faq_taxs)) {
            asort($faq_taxs);
        } 
        if (is_array($faq_taxs) && !empty($faq_taxs) && get_post_meta($current_page_id, 'faq_filters', true)) : ?>
        <ul class="faq-filter clearfix">
            <li><a class="active" data-filter="*" href="#"><?php echo __('All', 'venedor'); ?></a></li>
            <?php foreach ($faq_taxs as $faq_tax_slug => $faq_tax_name) : ?>
            <li><a data-filter=".<?php echo $faq_tax_slug; ?>" href="#"><?php echo $faq_tax_name; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        
        <div class="faq-wrapper panel-group" id="faqs">
            <?php
            while ($faqs->have_posts()): $faqs->the_post();
                $item_classes = '';
                $item_cats = get_the_terms($post->ID, 'faq_cat');
                if ($item_cats):
                    foreach ($item_cats as $item_cat) {
                        $item_classes .= urldecode($item_cat->slug) . ' ';
                    }
                endif;
                ?>
                <div class="post-item <?php echo $item_classes; ?> panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#faqs" href="#collapse<?php the_ID() ?>"><span class="faq-icon"><span class="fa"></span></span> <?php the_title(); ?></a>
                        </h4>
                    </div>
                    <div id="collapse<?php the_ID() ?>" class="panel-collapse collapse">
                        <div class="panel-body"><?php the_content() ?></div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
	
<?php get_footer(); ?>