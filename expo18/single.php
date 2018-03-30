<?php

get_header(); ?>

		<?php $post_sidebar_show=true; ?>

		<?php if (have_posts()) : the_post(); ?>

			<?php
				if(get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'sidebar_show', true) == 'hide')
					$post_sidebar_show=false;
			?>

			<?php if ($post_sidebar_show) { ?>

				<div class="container-col-w-sidebar">
		    	<h1 class="main-h1"><?php the_title(); ?></h1>
		    </div>
		    <div class="clear"></div>
		    
				<div class="container-col-w-sidebar">

			<?php } else { ?>

				<div class="container-col-full-width">
			  	<h1 class="main-h1"><?php the_title(); ?></h1>
			
			<?php } ?>

				<?php echo get_option(OM_THEME_PREFIX . 'code_after_post_h1'); ?>
				<div <?php post_class('single'); ?> id="post-<?php the_ID(); ?>">
					<div class="post-date"><?php the_time( get_option('date_format') ); ?></div>
					<div class="post-meta">
						
						<?php
							if(get_option(OM_THEME_PREFIX.'post_hide_categories') != 'true') {
								if($categories = get_the_category_list(', ')) { ?>
									<span class="post-categories">
										<?php echo $categories; ?>
									</span>
						<?php
								}
							} ?>
						
						<?php if($tags = get_the_tag_list('', ', ', '' )) { ?>
							<span class="post-tags">
								<?php echo $tags; ?>
							</span>
						<?php } ?>
						
					</div>

					<?php if(has_post_thumbnail() && get_option(OM_THEME_PREFIX.'post_single_show_thumb') == 'true') { ?>
						<div class="post-single-thumb">
							<?php the_post_thumbnail('thumbnail-post-single'); ?>
						</div>
					<?php } ?>

					<div class="post-text">
						<?php the_content(); ?>
						<div class="clear"></div>
					</div>
				</div>
	
				<?php wp_link_pages(array('before' => '<div class="navigation-pages"><span>'.__('Pages:', 'om_theme').'</span>', 'after' => '</div>', 'next_or_number' => 'number')); ?>
					
				<?php echo get_option(OM_THEME_PREFIX . 'code_after_post_content'); ?>

				<?php if(get_option(OM_THEME_PREFIX . 'hide_comments_post') != 'true') : ?>
					<?php comments_template('',true); ?>
				<?php endif; ?>
					
		
			</div>
		<?php else : ?>

			<div class="container-col-w-sidebar">
	    	<h1 class="main-h1"><?php _e('Error 404 - Not Found', 'om_theme') ?></h1>
	    </div>
	    <div class="clear"></div>
	    
			<div class="container-col-w-sidebar">
				<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>
			</div>

		<?php endif; ?>

		<?php if ($post_sidebar_show) { ?>
			<div class="container-col-sidebar">
							<!-- Sidebar -->
							<div class="sidebar-inner">
								<?php
									// alternative sidebar
									$alt_sidebar=intval(get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'sidebar', true));
									if($alt_sidebar && $alt_sidebar <= intval(get_option(OM_THEME_PREFIX."sidebars_num")) ) {
										if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'alt-sidebar-'.$alt_sidebar ) ) ;
									} else {
										get_sidebar();
									}
								?>
							</div>
							<!-- /Sidebar -->
			</div>
		<?php } ?>
		
		<div class="clear"></div>
		
<?php get_footer(); ?>