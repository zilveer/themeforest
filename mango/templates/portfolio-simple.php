<?php global $mango_settings, $portfolio_settings, $post; ?>
<?php
$terms = get_the_terms($post->ID, 'portfolio-category' );
$portfolio_tags = array();
if ( $terms && ! is_wp_error( $terms )) {
    $term_slugs ='';
    foreach ($terms as $term) {
        $term_slugs.= ' category-'.$term->term_id;
        $term_link = get_term_link( $term );
        $portfolio_tags[] = "<a href='".esc_url($term_link)."'>".$term->name."</a>";
    }
}
$images = mango_portfolio_img_src(get_the_ID());
?>
<div class="portfolio-item portfolio-simple <?php echo esc_attr($term_slugs); ?>">
    <figure>
        <img src="<?php echo esc_url($images['img']) ?>" alt="<?php the_title(); ?>">
    </figure>

    <div class="portfolio-meta">
        <div class="portfolio-content">
            <h2 class="portfolio-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="portfolio-tags"><?php echo rtrim(implode(", ",$portfolio_tags),', '); ?></div><!-- End .portfolio-tags -->
            <a href="<?php echo esc_url($images['anchor']) ?>" class="portfolio-btn zoom-item<?php echo esc_attr($images['class']); ?>" title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
            <a href="<?php the_permalink(); ?>" class="portfolio-btn"><i class="fa fa-link"></i></a>
        </div><!-- End .portfolio-content -->
    </div><!-- End .portfolio-meta -->
</div><!-- End .portfolio-item -->