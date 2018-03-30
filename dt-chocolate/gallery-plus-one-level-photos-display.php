<?php
global $post, $paged, $myterms, $wp_query, $postgalleryplus;
$post_3p = $postgalleryplus->get_post_option('albums_3p');
$parents = array();
foreach($myterms->posts as $p) {
	if( post_password_required($p->ID) )
		continue;
	$parents[] = $p->ID;
}

$paged = get_query_var('paged');
if( empty($paged) ) {
	$paged = 1;
	//$paged = get_query_var('page');
}

$args = array(
	'post_type' 	=>'attachment',
	'post_status' 	=>'inherit',
	'orderby'		=>'menu_order',
	'order'			=>'ASC',
	'paged'			=>$paged
);

if( !empty($post_3p) ) {
	$args['posts_per_page'] = $post_3p;
}

if( !empty($parents) ) {
dt_parent_where_query(implode(',', $parents));

add_filter('posts_where', 'dt_posts_parents_where');
$attachments = new Wp_Query($args);
remove_filter( 'posts_where' , 'dt_posts_parents_where' );

}
//var_dump( $attachments );

if( isset($attachments) && $attachments->posts ):
	global $photos_count_gal;
    foreach( $attachments->posts as $attachment ):
		setup_postdata($attachment);
		$photos_count_gal++;
		
		$image = wp_get_attachment_image_src($attachment->ID, 'large');
		$size = 's';
		$k = $image[1] / $image[2];
		switch($size) {
			case 's':
				$w = 220;
				break;
			case 'm':
				$w = 460;
				break;
			case 'l':
				$w = 700;
				break;
		}
		$h = ceil($w / $k);

		$tmp_src = dt_clean_thumb_url($image[0]);

		$small_image = get_template_directory_uri().'/thumb.php?src='.$tmp_src.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1';
		$big_image = $image[0];
?>
<div class="galonelvel with_href folio_box col_<?php echo $size; ?>" title="<?php echo esc_attr($attachment->post_excerpt); ?>">
	<a style="display: none;" href="<?php echo $big_image; ?>" title="">
		<img src="<?php echo $small_image; ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>" />
	</a>
	<div class="highslide-caption">
		<?php
		echo $attachment->post_excerpt;
	   	if( is_lb_enabled() && dt_get_theme_options('enable_in_photos') ):	
			$q_args = array( 'img' => urlencode(current(wp_get_attachment_image_src($attachment->ID, 'thumbnail'))), 'src' => urlencode(get_permalink($attachment->ID)) );

			dt_get_like_window( $q_args );	
		endif;
		?>
	</div>
	<div class="folio" style="background: url(<?php echo $small_image; ?>) 0 0; height: <?php echo $h; ?>px; width: <?php echo $w; ?>px;">  
		<i style="height: <?php echo $h; ?>px; width: <?php echo $w; ?>px;"></i>
	</div>
</div>   
<?php
	endforeach;
endif;
if( isset($attachments) )
$wp_query = $attachments;
?>
