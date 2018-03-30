<?php get_header(get_post_meta($post->ID, 'header_choice_select', true)); ?>

<div id="container_bg">
	<div id="content_full">  
	
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</div>
		<?php endwhile; ?>




	<div id="portfolio_details">
	<?php if ( get_post_meta($post->ID, 'pf_meta_box_text2', true) ) : ?>
	<span class="portfolio_detail_title"><?php echo get_post_meta($post->ID, 'pf_meta_box_text', true) ?></span> <?php echo get_post_meta($post->ID, 'pf_meta_box_text2', true) ?></br> 
	<?php endif; ?>
	<?php if ( get_post_meta($post->ID, 'pf_meta_box_text4', true) ) : ?>
	<span class="portfolio_detail_title"><?php echo get_post_meta($post->ID, 'pf_meta_box_text3', true) ?></span> <?php echo get_post_meta($post->ID, 'pf_meta_box_text4', true) ?><br/>
	<?php endif; ?>
	<?php if ( get_post_meta($post->ID, 'pf_meta_box_text6', true) ) : ?>
	<span class="portfolio_detail_title"><?php echo get_post_meta($post->ID, 'pf_meta_box_text5', true) ?></span> <?php echo get_post_meta($post->ID, 'pf_meta_box_text6', true) ?><br/> 
	<?php endif; ?> 
	</div>
	 

	<div class="clear"></div>

	<?php comments_template( '', true ); ?>  
	  
	</div><!--#content_full--> 
</div><!--#container-->  
<?php get_footer(); ?>