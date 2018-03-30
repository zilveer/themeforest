<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * @use \YIT_Feature_Tab_Object $features_tab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

yit_enqueue_script( 'yit-feature-tab', $baseurl . '/assets/js/featurestab.min.js', array( 'jquery' ), '', true );

$features_label = '';
$features_content = '';
$i = 0;

if ( $features_tab->have_posts() ):
    while ( $features_tab->have_posts() ):
        $features_tab->the_post();

        $current = ( $i == 0 ) ? ' current-feature' : '';

        $the_label = '<li class="features-tab-' . $i . $current . '"><h4><a href="javascript:void();">';

        if ( has_post_thumbnail() ) {
            $the_label .= $features_tab->get_image();
        }

        $the_label .= $features_tab->get('title');
        $the_label .= '</a></h4></li>';

        $the_content = '<div class="features-tab-content features-tab-' . $i . ' ' . $current . '">' . apply_filters( 'the_content', $features_tab->get('content') ) . '</div>';

        $features_label .= $the_label;
        $features_content .= $the_content;
        $i ++;

    endwhile;
endif;

$features_tab->reset_query();

 /* gestione sidebar */

/*$sidebar = YIT_Layout()->sidebars;
$sidebar = is_array( $sidebar ) ? $sidebar : array( 'layout' => $sidebar );*/

?>

<div id="features-tab-<?php echo $post_type ?>" class="features-tab-container group">
    <div class="row">

        <?php if(is_rtl()): ?>
            <div class="features-tab-wrapper col-sm-8">
                <?php echo $features_content ?>
            </div>
        <?php endif ?>

        <ul class="features-tab-labels col-sm-4">
            <?php echo $features_label ?>
        </ul>

        <?php if(!is_rtl()): ?>
            <div class="features-tab-wrapper col-sm-8">
                <?php echo $features_content ?>
            </div>
        <?php endif ?>

    </div>
</div>