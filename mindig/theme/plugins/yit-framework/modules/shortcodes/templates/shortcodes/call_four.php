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
 * Template file for shows a box with an banner, text and button
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

$image = ( isset($background_image_url) ) ? esc_url($background_image_url) : '';
$href = ( isset($href) ) ? esc_url($href) : '';
$nolink_class = ($href == '' ? 'no-link' : '');
$nobutton_class = ($label_button == '' ? 'no-button' : '');
$slogan = ( isset($slogan) ) ? $slogan : '';
$subslogan = ( isset($subslogan) ) ? $subslogan : '';

$exclude_element_class = $nolink_class . ' ' . $nobutton_class;

?>

<style>
    .call-4-background:hover{
        background: <?php echo $hover_color; ?>;
    }
</style>

<div class="call-to-action-four" <?php if( $image !='' ) : ?>style="background: url(<?php echo $image ?>) center no-repeat; <?php endif; ?> <?php echo esc_attr( $vc_css ) ?>">

    <div class="call-4-content <?php echo $exclude_element_class ?>">

        <?php if($href != '' && $label_button != '')  : ?>
            <a href="<?php echo $href ?>" class="button hidden-phone">
                <?php echo $label_button; ?>
            </a>
        <?php endif; ?>

        <div class="">
           <span class="call-4-slogan"><?php echo $slogan ?></span>
            <?php echo $subslogan ?>
        </div>

    </div>

    <?php if($href != '') : ?>
        <a href="<?php echo $href ?>">
            <div class="call-4-background"></div>
        </a>
    <?php endif; ?>

</div>