<?php
get_header();
    global $wp_query;

    $ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
    $ext_portfolio_settings = $ext_portfolio_instance->get_settings();

    $taxonomy        = $ext_portfolio_settings['taxonomy_name'];
    $post_type        = $ext_portfolio_settings['post_type'];
    $term            = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
    $term_id         = ( ! empty( $term->term_id ) ) ? $term->term_id : 0;
    //get all terms
    $all_terms = get_terms(array($taxonomy), array("fields" => "all"));
?>
<?php
    $subtitle = ''; $portf_view = 'view1'; $breadcrumbs = 'no'; $portf_columns = '2';
    $title = $term->name;

    //get inner banner
    $banner = fw_get_db_settings_option('portf_banner');

    if ($banner['enable-portf-banner'] == 'yes') {
        $portf_subtile = fw_get_db_term_option($term_id, $taxonomy, 'portf-subtitle');
        $subtitle = (!empty($portf_subtile)) ? $portf_subtile : $banner['yes']['portf-subtitle'];
        $breadcrumbs = $banner['yes']['enable-portf-breadcrumbs'];
    }

    //get portfolio view type
    $portf_view = fw_get_db_settings_option('portf_view');
    //portfolio columns
    $portf_columns = fw_get_db_settings_option('portf_columns');

    //show inner banner
    fw_show_inner_banner($banner['enable-portf-banner'], $title, $subtitle, $breadcrumbs);
?>

<section class="w-section section">
    <div class="w-container">
    <?php if(!empty($all_terms)):?>
        <div class="filters">
            <ul class="w-list-unstyled filter-ul">
                <?php foreach($all_terms as $one_term): ?>
                    <li class="filter <?php echo ($one_term->term_id == $term_id) ? 'active' : ''; ?>">
                        <a class="flt-lnk" href="<?php echo get_term_link( $one_term, $taxonomy ) ;?>">
                            <?php echo esc_html($one_term->name) ;?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

        <?php if ( have_posts() ) : ?>

            <?php
            if($portf_view == 'view2')
            {
                // Start the Loop.
                while ( have_posts() ) : the_post(); global $post;
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
                while ( have_posts() ) : the_post(); global $post;
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

        endif; ?>
    </div>
    <section class="portfolio_pagination">
        <?php fw_theme_paging_nav(); ?>
    </section>
</section>

<?php
    //call to action settings
    $call_to_action = fw_get_db_settings_option('portf_action');

    if($call_to_action['enable-portf-action'] == 'yes')
        fw_show_call_to_action($call_to_action['yes']);
?>
<?php get_footer();
