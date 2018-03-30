<?php 
	get_header();
	the_post();
	
	$format = get_post_format();
	if(!( $format )) 
		$format = 'standard';
	
	if( is_active_sidebar('primary') && get_post_meta( $post->ID, '_ebor_disable_sidebar', true ) !=='on' ){
		get_sidebar();
		$sidebar = 'has-sidebar';
	} else {
		$sidebar = 'no-sidebar';
	}
?>

<section id="content" class="clearfix">
	
	<article id="post-<?php the_ID(); ?>" <?php post_class($sidebar); ?>>
	
		<div class="format-<?php echo $format; ?>-wrapper clearfix">
			<?php 
				get_template_part( 'postformats/format', $format );
			?>
		</div>
		
		<?php 
			the_title('<h2 class="article-title entry-title"><a href="'. get_permalink().'">','</a></h2>'); 
			
			if( get_option( 'single_meta','1') == '1' )
				get_template_part('loop/content','meta');
			
			the_content();
			wp_link_pages();
			
			the_tags('#',' #','');
		?>
		
		<hr style="margin-top: 50px; margin-bottom: 40px;"/>
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
			if( comments_open() )
				comments_template();
		?>
	
	</article>

</section>

<?php	
	get_footer();