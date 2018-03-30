<?php
	get_header();
	the_post();
	
	$layout = get_post_meta( $post->ID, '_ebor_layout_checkbox', true );
	if( $layout == '-1' || $layout == 'on' )
		$layout == 'left';
		
	$subtitle = get_post_meta( $post->ID, '_ebor_the_subtitle', true );
?>

<div class="offset"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-10 col-lg-10 col-sm-offset-1">
			<div id="single">

				<?php 
					the_title('<h1>', '</h1>'); 
					if( $subtitle )
						echo '<div class="lead">'. $subtitle .'</div>';
						
					get_template_part('postformats/format', get_post_format());
				?>
			
				<div class="row pad30">
				
					<?php get_template_part('inc/content', 'portfolio-' . $layout); ?>
					
				</div>
				
				<div class="pad90"></div>
	
			</div>
		</div>
	</div>
</div>

<?php get_footer();