<?php
/**
 * The Template Part for displaying the Prefooter Theme Area.
 *
 * The prefooter is a widget-ready theme area below the content and above the footer.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
/* Executes a custom hook.
 * If you want to add some content before the g1-prefooter,
 * hook into 'g1_prefooter_before' action.
 */
do_action( 'g1_prefooter_before' );
?>
<!-- BEGIN #g1-prefooter -->
<aside id="g1-prefooter" class="g1-prefooter">
    <?php
        /* Executes a custom hook.
        * If you want to add some content before the g1-prefooter-widget-area,
        * hook into 'g1_prefooter_begin' action.
        */
        do_action( 'g1_prefooter_begin' );
    ?>
        <?php
        $g1_mapping = array(
            '1/1'	=> 'g1-max',
            '1/2'	=> 'g1-one-half',
            '1/3'	=> 'g1-one-third',
            '1/4'	=> 'g1-one-fourth',
            '3/4'	=> 'g1-three-fourths',
        );

        $g1_composition = g1_get_theme_option( 'ta_prefooter', 'composition', '1/3+1/3+1/3' );
        $g1_composition = 'none' === $g1_composition ? '' : $g1_composition;
        $g1_rows = strlen( $g1_composition ) ? explode( '_', $g1_composition ) : array();
        $g1_index = 1;
        ?>

        <?php if( count( $g1_rows ) ): ?>
        <!-- BEGIN #g1-prefooter-widget-area -->
        <div  id="g1-prefooter-widget-area" class="g1-layout-inner">
            <?php foreach( $g1_rows as $g1_row ): ?>
            <div class="g1-grid">
                <?php
                $g1_columns = strlen( $g1_row ) ? explode( '+', $g1_row ) : array();
                ?>
                <?php foreach( $g1_columns as $g1_column ): ?>
                <div class="g1-column <?php echo $g1_mapping[ $g1_column ]?>">
                    <?php g1_sidebar_render( 'prefooter-' . ( $g1_index++ ) ); ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- END #g1-prefooter-widget-area -->
        <?php endif; ?>

        <?php
        /* Executes a custom hook.
         * If you want to add some content after the g1-prefooter-widget-area,
         * hook into 'g1_prefooter_end.
         */
        do_action( 'g1_prefooter_end' );
        ?>
    <?php get_template_part( 'template-parts/g1_background', 'prefooter' ); ?>
</aside>
<!-- END #g1-prefooter -->
<?php
/* Executes a custom hook.
 * If you want to add some content after the g1-prefooter,
 * hook into 'g1_prefooter_after' action.
 */
do_action( 'g1_prefooter_after' );
?>