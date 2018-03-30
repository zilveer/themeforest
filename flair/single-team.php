<?php
	get_header();
	the_post();
	
	$quote = get_post_meta( $post->ID, '_ebor_the_team_quote', true );
?>

<div class="container">
	<div class="row">
		<div class="col-sm-10 col-lg-10 col-sm-offset-1">
			<div id="single">
		
				<?php 
					the_title('<h1>', '</h1>'); 
					if( $quote )
						echo '<div class="lead">'. $quote .'</div>';
				?>
				
				<div class="text-center"><?php get_template_part('loop/loop','social'); ?></div>
				<div class="pad25"></div>
				
				<?php the_content(); ?>
				
				<div class="clearfix"></div>
				<div class="pad90"></div>
				
			</div>
		</div>
	</div>
</div>
					
<?php get_footer();	