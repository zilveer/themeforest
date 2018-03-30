<?php
/**
 * The Template Part for displaying the Preheader Theme Area.
 * 
 * The preheader is a collapsible, widget-ready theme area above the header.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package     G1_Framework
 * @subpackage  G1_Theme01
 * @since       G1_Theme01 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php 
	$g1_mapping = array(
		'1/1'	=> 'g1-max',
		'1/2'	=> 'g1-one-half',
		'1/3'	=> 'g1-one-third',
		'1/4'	=> 'g1-one-fourth',
		'3/4'	=> 'g1-three-fourth',
	);

	$g1_composition = g1_get_theme_option( 'ta_preheader', 'composition', '1/3+1/3+1/3' );
    $g1_composition = 'none' === $g1_composition ? '' : $g1_composition;

	$g1_rows = strlen( $g1_composition ) ? explode( '_', $g1_composition ) : array();
    $g1_index = 1;
?>
<?php
    /* Executes a custom hook.
     * If you want to add some content before the g1-preheader,
     * hook into 'g1_preheader_before' action.
     */
    do_action( 'g1_preheader_before' );
?>

	<!-- BEGIN #g1-preheader -->
	<aside id="g1-preheader" class="g1-preheader">
        <div class="g1-layout-inner">
            <?php
                /* Executes a custom hook.
                 * If you want to add some content before the g1-preheader-widget-area,
                 * hook into 'g1_preheader_begin' action.
                 */
                do_action( 'g1_preheader_begin' );
            ?>

            <!-- BEGIN #g1-preheader-bar -->
            <div id="g1-preheader-bar" class="g1-meta">
                <?php if ( has_nav_menu( 'secondary_nav' ) ): ?>
                <nav id="g1-secondary-nav">
                    <a id="g1-secondary-nav-switch" href="#"></a>
                    <?php
                    wp_nav_menu( array(
                        'theme_location'	=> 'secondary_nav',
                        'container'			=> '',
                        'menu_id'			=> 'g1-secondary-nav-menu',
                        'menu_class'		=> null,
                        'depth'				=> 0
                    ));
                    ?>
                </nav>
                <?php endif; ?>

                <?php
                    // WPML language selector
                    do_action( 'icl_language_selector' );
                ?>

                <?php
                    $g1_value = g1_get_theme_option( 'ta_preheader', 'searchform' );
                    $g1_layout = g1_get_theme_option( 'ta_preheader', 'layout', 'semi-standard' );

                    $g1_class = array(
                        'g1-searchbox',
                        'g1-searchbox--' . $g1_value,
                        'g1-searchbox--' . $g1_layout
                    );
                ?>
                <?php if ( 'none' !== $g1_value && !is_404() ): ?>
                <div class="<?php echo  sanitize_html_classes( $g1_class ); ?>">
                    <a class="g1-searchbox__switch" href="#">
                        <div class="g1-searchbox__arrow"></div>
                        <strong><?php _ex( '&nbsp;', 'searchbox switch label',  'g1_theme' ); ?></strong>
                    </a>
                    <?php get_search_form(); ?>
                </div>
                <?php endif; ?>

                <?php
                // Render feeds
                if ( shortcode_exists( 'g1_social_icons') ) {
                    $g1_social_icons_size = g1_get_theme_option( 'ta_preheader', 'g1_social_icons' );
                    if ( is_numeric( $g1_social_icons_size ) ) {
                        $g1_social_icons_size = intval( $g1_social_icons_size );
                        echo do_shortcode('[g1_social_icons template="list-horizontal" size="'. $g1_social_icons_size . '" hide="label, caption"]');
                    }
                }
                ?>
            </div>
            <!-- END #g1-preheader-bar -->

            <?php if ( count( $g1_rows ) ): ?>
            <!-- BEGIN #g1-preheader-widget-area -->
            <div id="g1-preheader-widget-area">
                <?php foreach( $g1_rows as $g1_row ): ?>
                <div class="g1-grid">
                    <?php
                        $g1_columns = strlen( $g1_row ) ? explode( '+', $g1_row ) : array();
                    ?>
                    <?php foreach( $g1_columns as $g1_column ): ?>
                        <div class="g1-column <?php echo $g1_mapping[ $g1_column ]?>">
                            <?php g1_sidebar_render( 'preheader-' . ( $g1_index++ ) ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- END #g1-preheader-widget-area -->
            <?php endif; ?>

            <?php
                /* Executes a custom hook.
                 * If you want to add some content after the g1-preheader-widget-area,
                 * hook into 'g1_preheader_end' action.
                 */
                do_action( 'g1_preheader_end' );
            ?>
        </div><!-- .g1-inner -->

        <?php get_template_part( 'template-parts/g1_background', 'preheader' ); ?>
	</aside>
	<!-- END #g1-preheader -->	
	
	<?php 
		/* Executes a custom hook.
		 * If you want to add some content after the g1-preheader,
		 * hook into 'g1_preheader_after' action.
		 */	
		do_action( 'g1_preheader_after' );
	?>