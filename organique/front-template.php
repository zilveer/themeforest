<?php
/**
 * Template Name: Front page
 *
 * @package Organique
 */

// WP header
get_header();

// titles
$lead  = get_theme_mod( 'front_lead', 'Awesome oppurtunity to save a lof of money on' );
$title = get_theme_mod( 'front_title', 'Fresh organic food' );

// btn 1
$front_btn_1_txt   = get_theme_mod( 'front_btn_1_txt', 'Buy theme' );
$front_btn_1_link  = get_theme_mod( 'front_btn_1_link', 'http://www.proteusthemes.com' );
$front_btn_1_style = get_theme_mod( 'front_btn_1_style', 'warning' );
$front_btn_1_blank = get_theme_mod( 'front_btn_1_blank', 'no' );

// btn 2
$front_btn_2_txt   = get_theme_mod( 'front_btn_2_txt', 'More details' );
$front_btn_2_link  = get_theme_mod( 'front_btn_2_link', 'http://www.proteusthemes.com' );
$front_btn_2_style = get_theme_mod( 'front_btn_2_style', 'jumbotron' );
$front_btn_2_blank = get_theme_mod( 'front_btn_2_blank', 'no' );

// pattern
$custom_pattern = get_theme_mod( 'front_bg_pattern_custom', false );
$pattern        = empty( $custom_pattern ) ? get_theme_mod( 'front_bg_pattern', 'pattern-1' ) : sprintf( '" style="background-image: url(%s);', $custom_pattern ) ;

?>

<div class="jumbotron  js--add-gradient  <?php echo $pattern; ?>">
	<div class="container">
		<div class="jumbotron__container">
			<?php if ( ! empty( $lead ) ): ?>
			<h2 class="jumbotron__subtitle">
				<?php echo $lead; ?>
			</h2>
			<?php endif ?>
			<?php if ( ! empty( $title ) ): ?>
			<h1 class="jumbotron__title">
				<?php echo $title; ?>
			</h1>
			<?php endif ?>
			<?php if ( ! empty( $front_btn_1_txt ) ): ?>
			<a class="btn  btn-<?php echo $front_btn_1_style; ?>" href="<?php echo $front_btn_1_link; ?>"<?php echo 'yes' === $front_btn_1_blank ? ' target="_blank"' : ''; ?>><?php echo $front_btn_1_txt; ?></a>
			<?php endif ?>
			 &nbsp;
			<?php if ( ! empty( $front_btn_2_txt ) ): ?>
			<a class="btn  btn-<?php echo $front_btn_2_style; ?>" href="<?php echo $front_btn_2_link; ?>"<?php echo 'yes' === $front_btn_2_blank ? ' target="_blank"' : ''; ?>><?php echo $front_btn_2_txt; ?></a>
			<?php endif ?>

		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php
				if ( have_posts() ) {
					the_post();
					the_content();
				}
			?>
		</div>
	</div>
</div>


<?php

get_footer();
