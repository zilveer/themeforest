<?php 

get_header(); ?>
		
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>">
		<div class="swm_column swm_custom_two_third">			
		
			<?php
			if ( have_posts() ) while ( have_posts() ) : the_post();	

			$swm_content = get_the_content();

			if ($swm_content == '') {
				?> &nbsp; <?php
			} else {
				the_content();
			}	

			$args = array(
				'before'           => '<div class="clear"></div><div class="pagination_menu">' . __('Pages: ', 'swmtranslate'),
				'after'            => '</div>',
				'link_before'      => '<span class="wp_link_pages_custom">',
				'link_after'       => '</span>',
				'next_or_number'   => 'number',
				'nextpagelink'     => __('Next Page ', 'swmtranslate'),
				'previouspagelink' => __('Previous Page ', 'swmtranslate'),
				'pagelink'         => '%',
				'echo'             => 1
			);

			wp_link_pages( $args );	
			
			endwhile;		
			
			/* ----------------------------------------------------------------------------------
				Page Comments
			---------------------------------------------------------------------------------- */	
			
			$swm_page_comments = get_theme_mod('swm_commnets_in_pages');
			
			if ($swm_page_comments) {	
				comments_template('', true); 	
			}
			
			?>

			<div class="clear"></div>				
			
		</div>	
		
		<?php 
		get_sidebar();  ?>

	</div>

	<?php

get_footer(); 

?>