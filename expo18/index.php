<?php

$blog_page_id=get_option('page_for_posts');
if($blog_page_id)
	$blog = get_post($blog_page_id);
else
	$blog=false;

$sidebar_show=true;
if($blog) {
	$template_name = get_post_meta( $blog->ID, '_wp_page_template', true );
	if($template_name == 'template-full-width.php') {
		$sidebar_show=false;
	}
}

get_header(); ?>

		<?php if($blog) {?>
		<div class="<?php if ($sidebar_show) echo 'container-col-w-sidebar'; else echo 'container-col-full-width'; ?>">
    	<h1 class="main-h1"><?php echo $blog->post_title; ?></h1>
    </div>
    <div class="clear"></div>
  	<?php } ?>
    
		<div class="<?php if ($sidebar_show) echo 'container-col-w-sidebar'; else echo 'container-col-full-width'; ?>">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
		    <?php 
					get_template_part( 'includes/post-type-standard' );
		    ?>

				
					<?php endwhile; ?>

				<?php
					$nav_prev=get_previous_posts_link(__('Newer Entries', 'om_theme'));
					$nav_next=get_next_posts_link(__('Older Entries', 'om_theme'));
					if( $nav_prev || $nav_next ) {
						?>
						<div class="navigation-prev-next">
							<?php if($nav_prev){?><div class="navigation-prev"><?php echo $nav_prev; ?></div><?php } ?>
							<?php if($nav_next){?><div class="navigation-next"><?php echo $nav_next; ?></div><?php } ?>
							<div class="clear"></div>
						</div>
						<?php
					}		
				?>

			<?php else : ?>

				<h2><?php _e('Error 404 - Not Found', 'om_theme') ?></h2>
			
				<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>

			<?php endif; ?>

		</div>
			
		<?php if ($sidebar_show) { ?>

		<div class="container-col-sidebar">
			<!-- Sidebar -->
			<div class="sidebar-inner">
			<?php
				// alternative sidebar
				if($blog)
					$alt_sidebar=intval(get_post_meta($blog->ID, OM_THEME_SHORT_PREFIX.'sidebar', true));
				if($blog && $alt_sidebar && $alt_sidebar <= intval(get_option(OM_THEME_PREFIX."sidebars_num")) ) {
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