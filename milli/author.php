<?php 
	get_header();
	get_sidebar();
?>

	<section id="content" class="clearfix">
	
		<div class="about-author image-caption">
		  <div style="float: left;">
		  	<?php echo get_avatar( get_the_author_meta('email'), 100 ); ?>
		  </div>
		  <div style="overflow: hidden; padding: 0 0 50px 25px;">
		    <h3 class="article-title"><?php echo get_option('author_details_title','About the author'); ?></h3>
		    <?php 
		    	printf(wpautop( '%s: %s' ), get_the_author(), get_the_author_meta('description')); 
		    ?>
		  </div>
		  <div class="clear"></div>
		</div>
		<hr style="margin-bottom: 50px;"/>
	
		<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				
				get_template_part('loop/content','main');
			
			endwhile;	
			else : 
				
				get_template_part('loop/content','none');
				
			endif;
			
			echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
		?>
	
	</section>
	
<?php	
	get_footer();