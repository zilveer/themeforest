<?php 

global $post;

$gallery_instance = THB_Shortcode::$instance_number;

$attr = array();
$output = '';

extract(array(
	'order'      => 'ASC',
	'orderby'    => 'menu_order ID',
	'id'         => $post->ID,
	'size'       => $size,
	'include'    => '',
	'exclude'    => ''
));

$id = intval($id);
if ( 'RAND' == $order )
	$orderby = 'none';

$attachments = array();

$gallery_shortcode = thb_get_post_meta($id, 'gallery_shortcode');

$pattern = '/ids="([^\"]+)"/i';
preg_match_all($pattern, $gallery_shortcode, $matches, PREG_OFFSET_CAPTURE);

if( isset($matches[1]) && !empty($matches[1]) ) {
	$attachments = explode(',', $matches[1][0][0]);
	array_walk($attachments, 'trim');
}
else {
	return '';
}

if ( empty($attachments) ) {
	return '';
}

if ( is_feed() ) {
	$output = "\n";
	foreach ( $attachments as $att_id )
		$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
	return $output;
}

$el_id = 'gallery_' . $gallery_instance;

?>

<div class="thb-gallery flexslider" id="<?php echo $el_id; ?>" data-id="<?php echo $gallery_id; ?>">
	<ul class="slides">
		<?php foreach( $attachments as $id ) : ?>
		<li>
			<?php
				if( isset($link) && $link == 'file' ) {
					echo wp_get_attachment_link($id, $size, false, false);
				}
				else {
					echo wp_get_attachment_link($id, $size, true, false);
				}
			?>
		</li>
		<?php endforeach; ?>
	</ul>
</div>