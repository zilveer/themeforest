<?php

/*
Template Name: Front page
*/

global $ABdev_sticky_header;
$ABdev_sticky_header = 1;

get_header();
?>

	<div id="ABdev_sticky_header">
		<section id="frontpage_slider">
			<?php 
			$values = get_post_custom( $post->ID );  
			if( isset( $values['revslider_alias'][0]) && $values['revslider_alias'][0] != '' ){
				if(function_exists('putRevSlider')){
					putRevSlider( $values['revslider_alias'][0] );
				}
			}
			else{
				_e('You did not select any slider in <i>Front Page Options</i> metabox.', 'ABdev_aeron');
			}
			?>
		</section>
	</div>

	<div id="ABdev_sticky_header_content">
		<?php if ( have_posts()) : while (have_posts()) : the_post(); 
			the_content();
		endwhile;
		endif;
		?>
	</div>

<?php get_footer();