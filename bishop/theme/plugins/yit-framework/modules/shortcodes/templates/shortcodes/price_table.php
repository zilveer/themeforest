<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
$type = (isset($type) && $type!="") ? $type : 'no-large';
$content = str_replace( '<ul>', '', $content );
$content = str_replace( '</ul>', '', $content );

/* Empty <p> Fix*/
$content = wpautop(trim($content));
if (strpos($content,'<p>') && !strpos($content,'</p>')){
    $content = str_replace( '<p>', '', $content );
}
/* */

$show_header = ($show_header=="yes");
$class_no_header =  !$show_header ? "no-header" : "";
$show_footer = ($show_footer=="yes");


?>

<div class="pricing_box price-table <?php echo esc_attr( $type." ".$class_no_header." ".$price_table_position . $vc_css ); ?>">

        <div class="head">
                <?php if($show_header): ?>
                    <span class="price"><?php echo $price; ?></span>
                    <span class="title"><?php echo $title; ?></span>
                <?php endif; ?>
        </div>

        <div class="body"><ul><?php echo do_shortcode($content); ?> </ul></div>

        <?php if($show_footer): ?>
            <div class="button-container">
                <?php if ( isset($href) && $href != '' && isset($buttontext) && $buttontext ) : ?>
                    <a class="btn <?php echo ($type=="large") ? "btn-alternative" : "btn-flat"; ?>" href="<?php echo esc_url($href); ?>"><?php echo $buttontext; ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
</div>
