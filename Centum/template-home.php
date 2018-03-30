<?php
/**
 * Template Name: Home Page Template
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage centum
 * @since centum 1.0
 */

get_header();

$slider_on  = ot_get_option( 'slider_on' );
$slider_type =  ot_get_option( 'incr_slider_home' );

if ($slider_type == "royal") {
	$slides = ot_get_option( 'mainslider', array() );
	if ( $slider_on == 'yes' && !empty( $slides )) {
		get_template_part('slider');
	}
}

if ($slider_type == "revolution") {
	if ( $slider_on == 'yes') {
		$style = get_theme_mod( 'centum_layout_style', 'boxed' ) ;
		if (function_exists('icl_get_languages')) {
			  $languages = icl_get_languages('skip_missing=0&orderby=code');
			   if(!empty($languages)){
			   		foreach($languages as $l){

			   			if(ICL_LANGUAGE_CODE == $l['language_code']) {
			   			echo '<section class="slider">';
			   				if($style == 'boxed') { echo '<div class="container"><div class="sixteen columns">'; }
			   					putRevSlider(ot_get_option( 'incr_revo_slider'.$l['language_code']));
			   				if($style == 'boxed') { echo '</div></div>'; }
			   			echo "</section>";
			   			}
			   		}
			   }
		} else {

			echo '<section class="slider">';
			if($style == 'boxed') { echo '<div class="container"><div class="sixteen columns">'; }
				putRevSlider(ot_get_option( 'incr_revo_slider' ));
			if($style == 'boxed') { echo '</div></div>'; }
			echo "</section>";
		}
	}

}


 while (have_posts()) : the_post(); ?>
	<!-- 960 Container -->
	<div class="container">
	<div <?php post_class('post home clearfix'); ?> id="post-<?php the_ID(); ?>" >
			<?php the_content() ?>
	</div>
	<!-- Post -->
<?php endwhile; // End the loop. Whew.  ?>
<?php get_footer(); ?>