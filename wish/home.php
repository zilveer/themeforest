<?php get_header(); ?>
<?php
			if ( function_exists("rwmb_meta") ) {
				$images_c = rwmb_meta( 'wish_header_bg', 'type=image&size=full', get_option( 'page_for_posts' ) );
			}else{
				$images_c = array();
			}
			
			?>

		<!-- BLOG STARTS
			========================================================================= -->
		<div class="container-fluid blog-page page-template-home">
			<!-- Post Starts -->
			<?php $num = get_option( 'posts_per_page' ); $wish = 0; ?>
			
			<?php query_posts('post_type=post&post_status=publish&posts_per_page='.$num.'&paged='. get_query_var('paged'));  ?>
			
						<?php if(have_posts()): while(have_posts()): the_post();  ?>
						
						
						<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						
						<?php $wish = $wish+1;  ?>
			
				<?php endwhile; ?>
				
				<?php wish_posts_navigation(); ?>
				
				<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>
				
						<?php endif; ?>
			
			
		</div>
		<!-- /. BLOG ENDS
			========================================================================= -->
		
<?php get_footer() ?>