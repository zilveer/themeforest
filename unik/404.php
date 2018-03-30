<?php
/**
 * This template is used to show a nice not found page
 * 
 */
global $unik_data;
get_header();

?>
<div id="primary" class="content-area">
	<div id="inside" class="<?php if(isset($slider_shortcode) && !empty($slider_shortcode)){echo 'full-slider';} ?>">	
		<div class="site-content" >
			<div class="row">
			<?php				
				if(isset($unik_data['page_404']) && $unik_data['page_404']!='Select a page:'): /* Get page from theme option */ 
				$page_404 = explode('-',$unik_data['page_404']); 
					
				$temp = $wp_query; 
				$wp_query = null; 

				$wp_query = new WP_Query( 'page_id='.$page_404[1] );
				
				while ($wp_query->have_posts()) : $wp_query->the_post(); 
					
				$layout = get_post_meta($post->ID,THEMENAME.'_page_layout',true); 	
			?>

				<div id="post-content" class="<?php if($layout=='left'){echo 'right col-lg-8';} elseif($layout=='nosidebar'){echo 'full col-lg-12' ;} else{echo 'col-lg-8';} ?>">
					<div class="<?php if(get_post_meta($post->ID,THEMENAME.'_disable_page_bg',true)==0){ echo "bg-block-1";} ?>">
						<?php edit_post_link( __( 'Edit', THEMENAME ), ' <small class="edit-link">', '</small>' ); ?>
						
						<div class="content-wrap">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								

								<?php
									$hidetitle = intval(get_post_meta($post->ID,THEMENAME.'_hide_title',true));
									$customtitle = get_post_meta($post->ID,THEMENAME.'_custom_title',true);	
									$secondarytitle = get_post_meta($post->ID,THEMENAME.'_secondary_title',true);
								?>

								<?php if($hidetitle!==1): ?>
									<div class="page-title <?php if(get_post_meta($post->ID,THEMENAME.'_disable_page_bg',true)==1){echo "bg-block-1";} ?>">
										<h1 class="entry-title"><?php if($customtitle!==''){echo $customtitle;} else the_title(); ?></h1>
									
										<?php if(!empty($secondarytitle)):?>
											<h3 class="secondary-title"><?php echo $secondarytitle ; ?></h3>
										<?php endif; ?>
									
									</div>
								<?php endif; ?><!-- .entry-header -->
								
								<?php $carousel_images = get_post_meta($post->ID, THEMENAME.'_post_carousel');  ?>
								<?php if($carousel_images): ?><!-- Find carousel images if available -->
								
								
								<div class="flexslider thumbnail-carousel clearfix entry-thumbnail">
									<ul class="slides">
									<?php foreach($carousel_images as $carousel_image): 
										$image = wp_get_attachment_image_src($carousel_image, 'ext-large' );
										$full_image = wp_get_attachment_image_src($carousel_image, 'full' );
										$image_data = wp_get_attachment_metadata($carousel_image); 
										
									 ?>
										 <li>
											<img src="<?php echo $image[0]; ?>" alt="<?php echo $image_data['image_meta']['title']; ?>">
										 </li>
									<?php endforeach; ?>
									</ul>	
								</div><!-- Flex slider carousel -->

							<?php 
								else: // no carousel image found, so go for post thumbnail
								
								if ( has_post_thumbnail() && ! post_password_required() ) : ?>
								<div class="entry-thumbnail">
									<?php the_post_thumbnail(); ?>
								</div>
								<?php endif;?><!-- .entry-thumbnail -->
							<?php endif; ?>

							<div class="entry-content clearfix">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', THEMENAME ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
							</div><!-- .entry-content -->
							
						</article><!-- #post -->
					
						
						
						</div>
					</div>
				</div><!--Left column -->
				
				<?php if($layout!=='nosidebar'): ?>
				<div class="col-lg-4 <?php echo $layout; ?> sidebar">
					<?php get_sidebar(); ?>
				</div>
				<?php endif; ?><!--Right column -->

				<style type="text/css">
				<?php
					// page custom css
					echo get_post_meta($post->ID,THEMENAME.'_page_css',true);
				?>
				</style>

				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
				
				<?php else: /* No page found from theme option */ ?>
					<div class="content-wrap bg-block-1">
						<h2><?php _e("The page you are looking is not here. Try our search form",THEMENAME)?></h2>
					<?php get_search_form(); ?>
					</div>
				<?php	endif; ?>				
			</div><!-- .row -->
		</div><!-- .site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->
	
<?php get_footer(); ?>