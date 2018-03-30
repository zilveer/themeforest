<?php
/**
 * Size chart modal
 */
global $post;

$show = yit_get_post_meta($post->ID, '_modal_window');
$img  = yit_get_post_meta($post->ID, '_modal_window_img');
$title = yit_get_post_meta($post->ID, '_modal_window_title');
$text = yit_get_post_meta($post->ID, '_modal_window_text');
$icon = yit_get_post_meta($post->ID, '_modal_window_icon');

$img_html = '<img src="' . $img . '">';

if( isset ( $icon['select'] )  && $icon['select'] == 'icon' ){
    $icon_short = 'link_icon_type = "theme-icon" link_icon_theme ="' . $icon['icon'] . '"';
}
elseif ( isset ( $icon['select'] ) && $icon['select'] == 'custom' ){
    $icon_short = 'link_icon_type = "custom" link_icon_url ="' . $icon['custom'] . '"';
}
else {
    $icon_short = '';
}

if( $show == 'yes' ) : ?>
    <div id="modal-window">
        <?php echo do_shortcode( '[modal title="' . $title . '" link_text_opener="' . $text . '" link_text_size="15" opener="text" ' . $icon_short . ']' . $img_html . '[/modal]' ) ?>
    </div>
<?php endif ?>

<div class="clear"></div>