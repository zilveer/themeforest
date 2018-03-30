<?php 

get_header(); ?>
				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>" >	
			<div class="swm_column swm_custom_two_third">			

				<?php
				if (have_posts()) :
					while (have_posts()) : the_post();
						?>
						<div class="raw">
							<?php
								the_content('');
							?>
						</div>
						<?php
					endwhile;					
				endif;
				?>

				<div class="clear"></div>

				<?php 

					$swm_portfolio_comments = get_theme_mod('swm_portfolio_comments');		
					if ($swm_portfolio_comments) {						
						comments_template('', true); 						
					}	

				?>
			
				<div class="clear"></div>
			</div>			
		
		<?php get_sidebar(); ?>

	</div>	<?php
 
get_footer();