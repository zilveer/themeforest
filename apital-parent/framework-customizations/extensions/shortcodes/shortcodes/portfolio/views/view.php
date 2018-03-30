<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$posts_per_page = $atts['posts_per_page'];

$the_query = new WP_Query(array(
    'posts_per_page' => $posts_per_page,
    'post_type' => 'fw-portfolio'
));

//get portfolio view type
$portf_view = $atts['portf_view'];
//portfolio columns
$portf_columns = $atts['portf_columns'];

$taxonomy = 'fw-portfolio-category';
$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();
?>
<!--show filter if enabled-->
<?php if($atts['filter'] == 'yes'):?>

    <?php $all_terms = get_terms(array($taxonomy), array("fields" => "all"));?>
    <?php if(!empty($all_terms)):?>
        <div class="filters">
            <ul class="w-list-unstyled filter-ul">
                <li class="filter active" data-filter="all">
                    <a class="flt-lnk" href="#"><?php _e('All','fw');?></a>
                </li>
                <?php foreach($all_terms as $one_term): ?>
                    <li class="filter" data-filter=".<?php echo esc_attr($one_term->slug);?>">
                        <a class="flt-lnk" href="#">
                            <?php echo esc_attr($one_term->name) ;?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="w-clearfix grid portfolio-shortcode" <?php echo ($atts['filter'] == 'yes') ? 'id="Grid"' : ''?>>
    <?php if ( $the_query->have_posts() ) : ?>

    <?php
    if($portf_view == 'view2')
    {
        // Start the Loop.
        while ( $the_query->have_posts() ) : $the_query->the_post(); global $post;
            //get post terms to make the sort
            $sort_terms = wp_get_post_terms( $post->ID, $taxonomy, array('fields' => 'slugs') );
            $sort_terms = !empty($sort_terms) ? implode(' ', $sort_terms) : '';
            ?>
            <article class="mix mix-no-content mix-<?php echo esc_attr($portf_columns);?> <?php echo esc_attr($sort_terms);?>" data-ix="show-portfolio-overlay-full">
                <?php get_template_part( 'framework-customizations/extensions' . $ext_portfolio_instance->get_rel_path() . '/views/loop', 'item-wide' );?>
            </article>
        <?php endwhile;
    }
    else
    {
        // Start the Loop.
        while ( $the_query->have_posts() ) : $the_query->the_post(); global $post;
            //get post terms to make the sort
            $sort_terms = wp_get_post_terms( $post->ID, $taxonomy, array('fields' => 'slugs') );
            $sort_terms = !empty($sort_terms) ? implode(' ', $sort_terms) : '';
            ?>
            <article class="mix mix-<?php echo esc_attr($portf_columns);?> <?php echo esc_attr($sort_terms);?>" data-ix="show-portfolio-overlay">
                <?php get_template_part( 'framework-customizations/extensions' . $ext_portfolio_instance->get_rel_path() . '/views/loop', 'item' );?>
            </article>
        <?php endwhile;
    }
else :
    // If no content, include the "No posts found" template.
    get_template_part( 'content', 'none' );

endif; wp_reset_postdata(); ?>
</div>