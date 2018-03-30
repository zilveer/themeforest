<?php

$basil_is_non_singular = basil_is_non_singular();
$blog_column_count = 0;

if ( have_posts() ) {
	
	$postListStyle = ot_get_option('to_general_blog_style','List');

	if ($basil_is_non_singular) { echo '<div class="basilOnPage basilPost'.$postListStyle.'">'; }
	
	while ( have_posts() ) { the_post(); global $post;

		if ($basil_is_non_singular) {
		
			global $blog_column_count;
			$blog_column_count++;
			get_template_part('singlerow','post');
		
		} else {
			
			$post_ID = get_the_ID();
			$post_permalink = get_permalink($post_ID);
			$post_type = get_post_type($post_ID);
			
			?><div id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>><?php
				
				$disable_post_meta = ot_get_option('to_disable_post_meta','no');
				$disable_post_meta = ($disable_post_meta == 'yes' ? true : false);
				$hide_featured_image = carbon_get_post_meta($post->ID, 'post_hide_featured_image');
			
				# Post Meta
				if ($post_type == 'post') {
					if (!$disable_post_meta): basil_post_meta(); endif;
					if ('video' != get_post_format($post->ID) && !$hide_featured_image){ the_post_thumbnail(); }
				}
		
				# Post Content
				basil_the_content();
				
			?></div><?php
			
			if ( is_single()){
				
				if (!$disable_post_meta): 
				
				echo '<div class="cats-tags">';
				
					# Link Pages
					wp_link_pages();
				
					# Categories
					$categories_list = get_the_category_list( __( ', ', 'basil' ) );
					if ( $categories_list ) {
						echo '<span class="categories-links"><strong>'.__('Categories','basil').':</strong> ' . $categories_list . '</span>';
					}
				
					# Tags
					$tag_list = get_the_tag_list( '', __( ', ', 'basil' ) );
					if ( $tag_list ) {
						echo '<span class="tags-links"><strong>'.__('Tags','basil').':</strong> ' . $tag_list . '</span>';
					}
				
				echo '</div>';
				
				if(class_exists('cooked_plugin') && $post_type == 'post') {
				
					$user_data = get_user_by( 'id', $post->post_author );
					
					?><br><div id="cooked-profile-page">
					<div class="cp-profile-header cookedClearFix directory-pane">
			
						<?php
						
							$username = get_the_author_meta('user_login',$user_data->ID);
							$author_archive = get_author_posts_url($user_data->ID);
							$username = cp_create_slug($username);
						
						?>
			
						<div class="cp-avatar">
							<?php echo ($author_archive ? '<a href="'.$author_archive.'">' : '') . cp_avatar($user_data->ID,150) . ($author_archive ? '</a>' : ''); ?>
						</div>
						
						<?php
						
							$user_meta = get_user_meta($user_data->ID);
							$user_url = $user_data->data->user_url;
							$user_desc = $user_meta['description'][0];
							$h3_class = '';
							
						?>
						
						<div class="cp-info">
							<div class="cp-user">
								<h4 class="<?php echo $h3_class; ?>"><?php _e('Author','basil'); ?>: <?php echo ($author_archive ? '<a href="'.$author_archive.'">' : '') . get_user_meta( $user_data->ID, 'nickname', true ) . ($author_archive ? '</a>' : ''); ?></h4>
								<?php if ($user_desc){ echo wpautop($user_desc); } ?>
							</div>
						</div>
				
					</div></div><?php
				}
				
				endif;
				
			}
			
			# Page Navigation
			if ( is_singular() && !is_page()) {
				basil_single_post_pagination();
			}
			
			# Comments
			if ( is_page() && comments_open() || is_single() && comments_open() ) {
				comments_template();
			}
			
		}
	
	}
	
	if ($basil_is_non_singular) { echo '</div>'; }

	# Pagination
	basil_non_singular_pagination();

} else {

	# Content
	$no_content = wpautop( __('No Posts have been found...', 'basil') );
	echo apply_filters('the_content', $no_content);

	# Search Form
	get_search_form();
	
}
