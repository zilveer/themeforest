<?php require_once( '../../../../../../wp-load.php' ); ?>
<script type="text/javascript">
jQuery('.media-list-item').click(function() { 
	var $ischecked=jQuery('.media-list #addtitledesc').is(':checked'); // check if add title / description is checked
	var $item_url=jQuery(this).find('.media-list-url').val();
	var $parentid_url=jQuery(this).closest('td').find('.get-media-list');
	$item_url = $item_url.replace(/https?:\/\/[^\/]+/i, "");
	jQuery($parentid_url).val($item_url);

	if($ischecked) {
		var $item_title=jQuery(this).find('.media-list-title').val();
		var $item_desc=jQuery(this).find('.media-list-desc').val();
		var $parentid_title=jQuery(this).closest('tr').find('.get-media-list-title');
		var $parentid_desc=jQuery(this).closest('tr').find('.get-media-list-desc');
		jQuery($parentid_title).val($item_title);
		jQuery($parentid_desc).val($item_desc);
	}
	jQuery('div.media-list').remove();
	display_image();
});

jQuery('#media-list .pagebutton').click(function() { 
	var $getpage= jQuery(this).attr('id');
	jQuery('div.image-list-wrap ul').remove();
	jQuery('div.image-list-wrap').append('<div class="ajax-loader"></div>');
	load_pagination($getpage);
});
</script>
<div class="image-list-wrap">
<ul>
<?php
 $paged=$_GET['page'];
 $args=array(
 'post_type' => 'attachment',
 'post_status' => 'inherit',
 'paged' => $paged,
 'post_mime_type' => image,
 'posts_per_page' => 27,
 'caller_get_posts'=> 1
);
$featured_query = new wp_query($args);
$count='0';
while ($featured_query->have_posts()) : $featured_query->the_post(); 
		if($count=='9') $clear = 'clear'; else $clear='';
        echo '<li class="media-list-item '.$clear.'">';
		echo  wp_get_attachment_image( $post->ID, $size=array(40,40) );
		echo '<input name="image-url" class="media-list-url" type="hidden" value="'.wp_get_attachment_url( $post->ID ).'" />';
		echo '<input name="image-title" class="media-list-title" type="hidden" value="'.$post->post_title.'" />';
		echo '<input name="image-desc" class="media-list-desc" type="hidden" value="'.$post->post_content.'" />';
        echo '</li>';	
$count++;	
endwhile; 
?>
</ul>
</div>
<div class="clear"></div>
<?php 
$baseURL = ''; 
pagination_media($featured_query,$baseURL); 
function pagination_media( $query, $baseURL ) {
	$page = $query->query_vars["paged"];
	if ( !$page ) $page = 1;
	$qs = $_SERVER["QUERY_STRING"] ? "?".$_SERVER["QUERY_STRING"] : "";
	// Only necessary if there's more posts than posts-per-page
	if ( $query->found_posts > $query->query_vars["posts_per_page"] ) {
		echo '<ul class="paging">';
		// Previous link?
		if ( $page > 1 ) {
				echo '<li class="pagebutton previous" id="'.($page-1).'"><span>&laquo; previous</span></li>';
		}
		// Loop through pages
		for ( $i=1; $i <= $query->max_num_pages; $i++ ) {
			// Current page or linked page?
			if ( $i == $page ) {
				echo '<li class="pagebutton active">'.$i.'</li>';
			} else {
				echo '<li class="pagebutton" id="'.$i.'"><span>'.$i.'</span></li>';
			}
		}
		// Next link?
		if ( $page < $query->max_num_pages ) {
				echo '<li class="pagebutton next" id="'.($page+1).'"><span>next &raquo;</span></li>';
		}
		echo '</ul>';
	}
}
?>