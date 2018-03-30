<?php get_header(); ?>

<?php if (have_posts()) :
	
	?><div class="bottom-spacer"></div>
	<div id="page-post" class="shell clearfix"><?php
	
		while (have_posts()) : the_post();

			$post_options = get_post_meta($post->ID,'_post_options',true);
			$sidebar_choice = get_post_meta($post->ID, '_post_sidebar_choice', true);
			if (!$sidebar_choice){ $sidebar_choice = 'default-sidebar'; }
			$sidebar_type = get_post_meta($post->ID,'_post_sidebar_layout',true);
			$sidebar_type = (!empty($sidebar_type) ? $sidebar_type = $sidebar_type[0] : $sidebar_type = false);
			
			if ($sidebar_type == 'left'){
				$page_type = 'right';
				$featured_image_size = 'sm';
			} else if ($sidebar_type == 'right'){
				$page_type = 'left';
				$featured_image_size = 'sm';
			} else if ($sidebar_type == 'no-sidebar'){
				$page_type = 'full';
				$featured_image_size = 'full';
			} else {
				$page_type = ot_get_option('default_page_type','full');
				if ($page_type == 'full'): $featured_image_size = 'full'; else : $featured_image_size = 'sm'; endif;
				switch($page_type):
				
					case 'full' :
						$sidebar_type = 'no-sidebar';
					break;
					case 'left' :
						$sidebar_type = 'right';
					break;
					case 'right' :
						$sidebar_type = 'left';
					break;
				
				endswitch;
			}
			
			?><article <?php post_class($page_type.' page-content'); ?>><?php
				
				if (!is_array($post_options) || !in_array('hide_post_breadcrumbs',$post_options)): ?><?php js_breadcrumbs(); ?><?php endif;
				if (!is_array($post_options) || !in_array('hide_post_title',$post_options)): ?><h1 class="page-title"><span><?php the_title(); ?></span></h1><?php endif;

				?><div class="post-meta">
					<span><i class="fa fa-calendar"></i> <?php echo boxy_relativeTime(get_the_time('U')) ?></span>
					<span><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
					<span><i class="fa fa-comment"></i> <a href="#comments"><?php comments_number(__('No comments','espresso'),__('1 comment','espresso'),'% '.__('comments','espresso')); ?></a></span>
				</div><?php

				if (has_post_thumbnail()){
					if ('gallery' != get_post_format($post->ID) && 'audio' != get_post_format($post->ID) && 'video' != get_post_format($post->ID)){
						echo '<div class="featured-image">'; the_post_thumbnail('single-featured-'.$featured_image_size); echo '</div>'; 
					}
				}
				
				the_content();
				
				$categories_list = get_the_category_list( __( ', ', 'espresso' ) );
				if ( $categories_list ) {
					echo '<span class="categories-links"><strong>'.__('Categories','espresso').':</strong> ' . $categories_list . '</span>';
				}
			
				$tag_list = get_the_tag_list( '', __( ', ', 'espresso' ) );
				if ( $tag_list ) {
					echo '<span class="tags-links"><strong>'.__('Tags','espresso').':</strong> ' . $tag_list . '</span>';
				}
				
				if ( $categories_list || $tag_list ) { echo '<br />'; }
				
				if ( get_the_author_meta( 'description' )) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
				<div id="author-info">
					<h2><?php printf( __( 'About %s', 'espresso' ), get_the_author() ); ?></h2>
					<div class="avatar-wrap">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 55 ) ); ?>
					</div><!-- #author-avatar -->
					<div class="description">
						<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
						<p class="author-link"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'espresso' ), get_the_author() ); ?>
						</a></p>
					</div>
				</div><!-- #author-info -->
				<?php endif;
				
				comments_template();
				
				wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %');
				
			?></article><?php
			
			if ($sidebar_type && $sidebar_type != 'no-sidebar'){ ?>
				<aside class="<?php echo $sidebar_type; ?>">
					<?php dynamic_sidebar($sidebar_choice); ?>
				</aside>
			<?php }
		
		endwhile;
		
	?></div><?php
	
endif;

get_footer();