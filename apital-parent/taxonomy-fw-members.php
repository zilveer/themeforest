<?php
/**
 * The template for displaying Members Archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();?>
<?php
    $taxonomy = 'fw-members';
    //get all terms
    $all_terms = get_terms(array($taxonomy), array("fields" => "all"));
    $term            = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
    $term_id         = ( ! empty( $term->term_id ) ) ? $term->term_id : 0;

    $subtitle = ''; $breadcrumbs = 'no';
    $title = $term->name;
    if(defined('FW'))
    {
        //get inner banner
        $banner = fw_get_db_settings_option('members_banner');

        if($banner['enable-members-banner'] == 'yes')
        {
            $subtitle = $banner['yes']['members-subtitle'];
            $breadcrumbs = $banner['yes']['enable-members-breadcrumbs'];
        }

        //show inner banner
        fw_show_inner_banner($banner['enable-members-banner'], $title, $subtitle, $breadcrumbs);
    }
?>
<!-- MEET THE TEAM -->
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

        <div class="w-clearfix team-members grid">
            <?php if ( have_posts() ) : ?>

                <?php
                // Start the Loop.
                while ( have_posts() ) : the_post();
                    get_template_part( 'listing', 'members' );
                endwhile;
            else :
                // If no content, include the "No posts found" template.
                get_template_part( 'content', 'none' );

            endif; ?>
        </div>
    </div>
    <section class="portfolio_pagination">
        <?php fw_theme_paging_nav(); ?>
    </section>
</section>
<?php
    //call to action settings
    if(defined('FW'))
    {
        $call_to_action = fw_get_db_settings_option('members_action');

        if($call_to_action['enable-members-action'] == 'yes')
            fw_show_call_to_action($call_to_action['yes']);
    }
?>
<?php
get_footer();