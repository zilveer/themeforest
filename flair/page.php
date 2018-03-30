<?php
	get_header();
	the_post();
	
	$subtitle = get_post_meta( $post->ID, '_ebor_the_subtitle', true );
?>
			
<div class="pad90"></div>
<div class="pad60"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-12">
		
			<?php 
				the_title('<h1 class="wow fadeInRightBig" data-wow-offset="80" data-wow-duration="2s">', '</h1>'); 
				if( $subtitle )
					echo '<div class="lead wow fadeInRightBig" data-wow-offset="80" data-wow-duration="2s">'. htmlspecialchars_decode($subtitle) .'</div>';
			?>

		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
		
			<?php
				the_content();
				wp_link_pages();
			?>

		</div>
	</div>
</div>
	
<div class="pad60"></div>

<?php get_footer();