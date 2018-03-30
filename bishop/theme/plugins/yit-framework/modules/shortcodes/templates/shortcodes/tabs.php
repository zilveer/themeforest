<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for create a content with tabs
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

$html = '<div class="tabs-container '.esc_attr( $vc_css ).'">' . "\n";
$html .= '    <ul class="tabs">' . "\n";

unset( $atts['content'] );
unset( $atts['other_atts'] );

foreach ( $atts as $tab => $title ) {
    $html .= '<li><h4><a href="javascript:void();" data-tab="' . $tab . '" title="' . $title . '">' . $title . '</a></h4></li>' . PHP_EOL;
}

$html .= '    </ul>' . "\n";

$html .= '<div class="border-box group">' . do_shortcode( $content ) . '</div>';

$html .= '</div>' . "\n";
?>

<?php echo $html; ?>