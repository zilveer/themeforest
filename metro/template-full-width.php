<?php
/*
Template Name: Full-width Page
*/

get_header(); ?>

		<div class="block-full bg-color-main content-without-sidebar">
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
      		
          <?php echo get_option(OM_THEME_PREFIX . 'code_after_page_h1'); ?>

					<?php while (have_posts()) : the_post(); ?>
		
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							<?php the_content(); ?>
						</div>
						
					<?php endwhile; ?>
					
					<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_content'); ?>
				
				</article>
				
				<?php wp_link_pages(array('before' => '<div class="navigation-pages"><span class="title">'.__('Pages:', 'om_theme').'</span>', 'after' => '</div>', 'pagelink' => '<span class="item">%</span>', 'next_or_number' => 'number')); ?>
							
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
		
		<!-- /Content -->
		
		<div class="clear anti-mar">&nbsp;</div>

<?php get_footer(); ?>