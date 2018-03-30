<?php if(! defined('ABSPATH')){ return; }
/**
 * This is the template layout for pages.
 *
 * @package  Kallyas
 * @author   Team Hogash
 */

get_header();

WpkPageHelper::zn_get_subheader();

// Check to see if the page has a sidebar or not
$main_class = zn_get_sidebar_class('page_sidebar');
if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-8 col-md-9' : 'col-sm-12';

?>

<!--// Main Content: page content from WP_EDITOR along with the appropriate sidebar if one specified. -->
    <section id="content" class="site-content" >
        <div class="container">
            <div class="row">
                <div class="<?php echo $main_class;?>" <?php echo WpkPageHelper::zn_schema_markup('main'); ?>>
                    <div id="th-content-page">
                        <?php
                        while ( have_posts() ) : the_post();
                            get_template_part( 'inc/page', 'content-view-page.inc' );
                        endwhile;

                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div><!--// #th-content-page -->
                </div><!--// #th-content-page wrapper -->
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section><!--// #content -->

<?php get_footer(); ?>
