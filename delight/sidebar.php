<?php
/**
 * @package WordPress
 * @subpackage Delight
 */

?>


<?php

$margin = '';

if(is_single()){
	global $custom_options; $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
	if (isset($meta_options['sliding_page'])) {
		if ($meta_options['sliding_page']== 'open') { 
			$class = 'open_toggle';
		} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='open') {
			$class = 'open_toggle';
		} elseif ($meta_options['sliding_page']== 'always') { 
			$class = 'open_toggle always_open';
		} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='always') {
			$class = 'open_toggle always_open';
		}
	}
		
	if ( (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'left') || ((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']== 'default' || $meta_options['sidebar_position']== '') && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
		$margin = 'leftsidebar';
	}
	
	if(isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'nosidebar') {
		$sidebar = 'false';
	} else {
		$sidebar = 'true';
	}
	if(get_post_meta($post->ID, 'pix_select_sidebar', true)!='No sidebar' && get_post_meta($post->ID, 'pix_select_sidebar', true)!=''){
		$the_sidebar = get_post_meta($post->ID, 'pix_select_sidebar', true);
	} else {
		$the_sidebar = get_pix_option('pix_sidebar_posts');
	}
} elseif(is_page()){
	global $custom_options; $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
	if (isset($meta_options['sliding_page'])) {
		if ($meta_options['sliding_page']== 'open') { 
			$class = 'open_toggle';
		} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='open') {
			$class = 'open_toggle';
		} elseif ($meta_options['sliding_page']== 'always') { 
			$class = 'open_toggle always_open';
		} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='always') {
			$class = 'open_toggle always_open';
		}
	}
		
	if (isset($meta_options['sidebar_position'])) {
		if (($meta_options['sidebar_position']== 'left') || (($meta_options['sidebar_position']== 'default' || $meta_options['sidebar_position']== '') && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
			$margin = 'leftsidebar';
		}
	}
	
	if(isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'nosidebar') {
		$sidebar = 'false';
	} else {
		$sidebar = 'true';
	}
	if(get_post_meta($post->ID, 'pix_select_sidebar', true)!='No sidebar' && get_post_meta($post->ID, 'pix_select_sidebar', true)!=''){
		$the_sidebar = get_post_meta(get_the_ID(), 'pix_select_sidebar', true);
	} else {
		$the_sidebar = get_pix_option('pix_sidebar_pages');
	}
} elseif(is_category()) {
	$the_category = get_query_var('cat');
	$pix_array_category = get_pix_option('pix_array_category_'.$the_category);
	$sidebar = 'true';
	if ($pix_array_category[0]== 'open') { 
		$class = 'open_toggle';
	} elseif ($pix_array_category[0]== 'default' && get_pix_option('pix_sliding_page')=='open') {
		$class = 'open_toggle';
	} elseif ($pix_array_category[0]== 'always') { 
		$class = 'open_toggle always_open';
	} elseif ($pix_array_category[0]== 'default' && get_pix_option('pix_sliding_page')=='always') {
		$class = 'open_toggle always_open';
	} 
	if ($pix_array_category[1]== 'leftsidebar'|| ($pix_array_category[1]=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
		$margin = 'leftsidebar';
	}
	if($pix_array_category[3]!='none'){
		$the_sidebar = $pix_array_category[3];
	} else {
		$the_sidebar = get_pix_option('pix_sidebar_categories');
	}
} elseif(is_tax()) {
	$the_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$the_term = $the_term->term_id;
	$pix_array_term = get_pix_option('pix_array_term_'.$the_term);
	$sidebar = 'true';
	if ($pix_array_term[5]== 'show' || $pix_array_term[6]== 'show' ) { 
		$class = 'open_toggle always_open';
	} else {
		if ($pix_array_term[0]== 'open') { 
			$class = 'open_toggle';
		} elseif ($pix_array_term[0]== 'default' && get_pix_option('pix_sliding_page')=='open') {
			$class = 'open_toggle';
		} elseif ($pix_array_term[0]== 'always') { 
			$class = 'open_toggle always_open';
		} elseif ($pix_array_term[0]== 'default' && get_pix_option('pix_sliding_page')=='always') {
			$class = 'open_toggle always_open';
		}
	}
	if ($pix_array_term[1]== 'leftsidebar'|| ($pix_array_term[1]=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
		$margin = 'leftsidebar';
	}
	if($pix_array_term[3]!='none'){
		$the_sidebar = $pix_array_term[3];
	} else {
		$the_sidebar = get_pix_option('pix_sidebar_taxonomies');
	}
} elseif(is_archive()) {
	$sidebar = 'true';
	if (get_pix_option('pix_archive_sliding_page')== 'open') { 
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_archive_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='open') {
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_archive_sliding_page')== 'always') { 
		$class = 'open_toggle always_open';
	} elseif (get_pix_option('pix_archive_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='always') {
		$class = 'open_toggle always_open';
	} 
	if (get_pix_option('pix_archive_sidebar')== 'leftsidebar'|| (get_pix_option('pix_archive_sidebar')=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
		$margin = 'leftsidebar';
	}
	$the_sidebar = get_pix_option('pix_sidebar_archives');
} elseif(is_search()) {
	$sidebar = 'true';
	if (get_pix_option('pix_searchpage_sliding_page')== 'open') { 
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_searchpage_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='open') {
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_searchpage_sliding_page')== 'always') { 
		$class = 'open_toggle always_open';
	} elseif (get_pix_option('pix_searchpage_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='always') {
		$class = 'open_toggle always_open';
	} 
	if (get_pix_option('pix_searchpage_sidebar')== 'leftsidebar' || (get_pix_option('pix_searchpage_sidebar')=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
		$margin = 'leftsidebar';
	}
	$the_sidebar = get_pix_option('pix_sidebar_search');
} elseif(is_404()) {
	$sidebar = 'true';
	if (get_pix_option('pix_404_sliding_page')== 'open') { 
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_404_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='open') {
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_404_sliding_page')== 'always') { 
		$class = 'open_toggle always_open';
	} elseif (get_pix_option('pix_404_sliding_page')== 'default' && get_pix_option('pix_sliding_page')=='always') {
		$class = 'open_toggle always_open';
	} 
	if (get_pix_option('pix_404_sidebar')== 'leftsidebar' || (get_pix_option('pix_404_sidebar')=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
		$margin = 'leftsidebar';
	}
	$the_sidebar = get_pix_option('pix_sidebar_404');
}
?>
<?php if($sidebar=='true') { ?>
    <aside class="<?php echo $class.' '.$margin; ?>">
    	<div>
<?php  dynamic_sidebar($the_sidebar); ?>

        </div>
    </aside>
<?php } ?>
