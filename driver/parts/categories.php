<?php
$categories = get_terms($taxonomy);

if(!empty($categories) && !isset($categories->errors)) {

	if($taxonomy == 'video-category') {
	
		$archive_page = get_iron_option('page_for_videos');
		$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );
	
	} else if($taxonomy == 'category') {
	
		$archive_page = get_option('page_for_posts');
		$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );
	
	}

?>
	<!-- widget-box -->
	<section class="widget-box">
		<!-- title-box -->
		<header class="title-box">
			<h2><?php echo __("CATEGORIES", IRON_TEXT_DOMAIN); ?></h2>
		</header>
		<nav id="cat-list">
			<ul>
	<?php if ( $archive_page ) { ?>
				<li><a href="<?php echo esc_url($archive_page); ?>"><i class="fa fa-plus"></i> <?php _e("All", IRON_TEXT_DOMAIN); ?></a></li>
	<?php } ?>
	<?php foreach($categories as $term): ?>
	
	<?php
	$activeClass = "";
	if ( is_category() ) {
	
		$cterm = get_category( get_query_var('cat') );
		$activeClass = ($cterm->term_id == $term->term_id) ? 'class="active"' : '';
		
	}elseif ( is_tax() ) {
	
		$taxonomy = get_query_var('taxonomy');
		$cterm = get_term_by( 'slug', get_query_var('term'), $taxonomy );
		$activeClass = ($cterm->term_id == $term->term_id) ? 'active' : '';
	}	
	?>
				<li><a class="<?php echo esc_attr($activeClass); ?>" href="<?php echo esc_url(get_term_link( $term, $taxonomy )); ?>"><i class="fa fa-plus"></i> <?php echo esc_html($term->name); ?></a></li>
	<?php endforeach; ?>
			</ul>
		</nav>
	</section>
<?php 
}
?>	