<?php

get_header(); ?>

		<div class="block-6 no-mar content-with-sidebar">
			
			<div class="block-6 bg-color-main">
				<div class="block-inner">
					<?php
	          if ( current_user_can( 'edit_post', $post->ID ) )
	      	    edit_post_link( __('edit', 'om_theme'), '<div class="edit-post-link">[', ']</div>' );
	    		?>
	    		
	    		<article>
	    			
						<div class="tbl-bottom">
							<div class="tbl-td">
								<h1 class="page-h1"><?php the_title(); ?></h1>
							</div>
							<?php if(get_option(OM_THEME_PREFIX . 'show_breadcrumbs') == 'true') { ?>
								<div class="tbl-td">
									<?php om_breadcrumbs(get_option(OM_THEME_PREFIX . 'breadcrumbs_caption')) ?>
								</div>
							<?php } ?>
						</div>
						<div class="clear page-h1-divider"></div>
					
	          <?php if (have_posts()) : ?>

   						<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_h1'); ?>

	          	<?php while (have_posts()) : the_post(); ?>

									<?php
										$desc=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'testimonial_author_desc', true);
										if($desc) { ?><div class="clear"></div><p class="post-title-comment" style="margin:0 0 3px 0"><?php echo $desc; ?></p><?php } 
									?>
					
									<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
										<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
											<div class="content-block left"><?php the_post_thumbnail() ?></div>
										<?php } ?>
										<?php the_content(); ?>
									</div>
									
							<?php endwhile; ?>
								
							<?php wp_link_pages(array('before' => '<div class="navigation-pages"><span>'.__('Pages:', 'om_theme').'</span>', 'after' => '</div>', 'next_or_number' => 'number')); ?>
								
							<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_content'); ?>
		
						<?php else : ?>
			
							<h2><?php _e('Error 404 - Not Found', 'om_theme') ?></h2>
						
							<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>
		
						<?php endif; ?>

					</article>	

				</div>
			</div>

			<?php
				$fb_comments=false;
				if(function_exists('om_facebook_comments') && get_option(OM_THEME_PREFIX . 'fb_comments_pages') == 'true') {
						if(get_option(OM_THEME_PREFIX . 'fb_comments_position') == 'after')
							$fb_comments='after';
						else
							$fb_comments='before';
				}
			?>
			
			<?php if($fb_comments == 'before') { om_facebook_comments();	} ?>
			
			<?php if(get_option(OM_THEME_PREFIX . 'hide_comments_pages') != 'true') : ?>
				<?php comments_template('',true); ?>
			<?php endif; ?>
			
			<?php if($fb_comments == 'after') { om_facebook_comments();	} ?>	
						
		</div>


		<div class="block-3 no-mar sidebar">
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
		
		<!-- /Content -->
		
		<div class="clear anti-mar">&nbsp;</div>

<?php get_footer(); ?>