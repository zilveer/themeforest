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
<div class="portfolio-item <?php echo esc_attr($term_slugs); ?>">
    <figure>
        <a href="<?php echo esc_url($images['anchor']) ?>" class="zoom-item<?php echo esc_attr($images['class']); ?>" title="<?php the_title() ?>">
            <img src="<?php echo esc_url($images['img']) ?>" alt="<?php the_title(); ?>">
        </a> 
    </figure>
    <h2 class="portfolio-title">
        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <div class="portfolio-meta-wrapper">
        <span class="portfolio-tags"><?php echo rtrim(implode(", ",$portfolio_tags),', '); ?></span><!-- End .portfolio-tags -->
        <?php $comments_count = wp_count_comments(get_the_ID());
              $total_comments = $comments_count->total_comments;
        ?>
        <a href="#" class="portfolio-comment-link"><?php echo esc_attr($total_comments).' '.(($total_comments=='' || $total_comments >1)?__("Comments","mango"):__("Comment","mango") )?></a>
    </div>
    <?php the_excerpt(); ?>
</div><!-- End .portfolio-item -->