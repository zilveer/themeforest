<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage grace
 * 
 */

$single = 'single';

if (is_singular(TB_PRIEST_CPT)) $single = 'priest';
if (is_singular(TB_CHURCH_CPT)) $single = 'church';
if (is_singular(TB_EVENT_CPT)) $single = 'event';
if (is_singular(TB_SERMON_CPT)) $single = 'sermon';
if (is_singular(TB_GALLERY_CPT)) $single = 'gallery';

get_header();

if ($single == 'church' || $single == 'event') {
	global $post;
	$postID = $post->ID;
	
	$postCustom = get_post_custom($postID);

	$googleMapURL = (isset($postCustom['_tb_google_map_url'][0])) ? $postCustom['_tb_google_map_url'][0] : FALSE;
	$googleMapType = (isset($postCustom['_tb_google_map_type'][0])) ? $postCustom['_tb_google_map_type'][0] : FALSE;
	$googleMapZoom = (isset($postCustom['_tb_google_map_zoom'][0])) ? $postCustom['_tb_google_map_zoom'][0] : FALSE;
	$googleMapHeight = (isset($postCustom['_tb_google_map_height'][0])) ? $postCustom['_tb_google_map_height'][0] : FALSE;
	
	if ($googleMapURL) { ?>
	<div class="mapHolderWide"><div class="mapHolder"><?php echo tb_google_map($googleMapURL, $googleMapType, $googleMapZoom, $googleMapHeight); ?></div></div>
	<?php }
}

if ($single == 'sermon') {
	global $post;
	$postID = $post->ID;
	
	if (get_post_meta($postID, '_tb_google_map', true) == 'yes') {

		$churchID = get_post_meta($postID, '_tb_church', true);
		
		if ($churchID) {
			$churchCustom = get_post_custom($churchID);

			$googleMapURL = (isset($churchCustom['_tb_google_map_url'][0])) ? $postCustom['_tb_google_map_url'][0] : FALSE;
			$googleMapType = (isset($churchCustom['_tb_google_map_type'][0])) ? $postCustom['_tb_google_map_type'][0] : FALSE;
			$googleMapZoom = (isset($churchCustom['_tb_google_map_zoom'][0])) ? $postCustom['_tb_google_map_zoom'][0] : FALSE;
			$googleMapHeight = (isset($churchCustom['_tb_google_map_height'][0])) ? $postCustom['_tb_google_map_height'][0] : FALSE;
			
			if ($googleMapURL) { ?>
			<div class="mapHolderWide"><div class="mapHolder"><?php echo tb_google_map($googleMapURL, $googleMapType, $googleMapZoom, $googleMapHeight); ?></div></div>
			<?php }
		
		}	
	}
}

st_before_content($columns='');
get_template_part( 'loop', $single );
st_after_content();
get_sidebar();
get_footer();
?>