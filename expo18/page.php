<?php

get_header(); ?>


		<div class="container-col-w-sidebar">
    	<h1 class="main-h1"><?php the_title(); ?></h1>
    </div>
    <div class="clear"></div>
        
		<div class="container-col-w-sidebar">

			<!-- Content -->
        <?php echo get_option(OM_THEME_PREFIX . 'code_after_page_h1'); ?>

				<?php while (have_posts()) : the_post(); ?>
	
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<?php the_content(); ?>
					</div>
					
				<?php endwhile; ?>
				
				<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_content'); ?>
				
				<?php wp_link_pages(array('before' => '<div class="navigation-pages"><span>'.__('Pages:', 'om_theme').'</span>', 'after' => '</div>', 'next_or_number' => 'number')); ?>
			<!-- /Content -->

			<?php if(get_option(OM_THEME_PREFIX . 'hide_comments_pages') != 'true') : ?>
				<?php comments_template('',true); ?>
			<?php endif; ?>			
		</div>

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
		
		<div class="clear"></div>
		
<?php get_footer(); ?>