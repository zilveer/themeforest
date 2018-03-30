<?php global $unf_options; ?>
<?php //IMAGE Format?>
<div <?php post_class( 'clearfix blog-posts thepost' ); ?>>
	<?php if( $unf_options['unf_post_layout'] == '2') { echo '<div class="compact-post-layout">';}?>

	<div class="image-post-wrapper">
	<?php
	if ( get_the_post_thumbnail() != '' ) {

	  echo '<a href="'; the_permalink(); echo '" class="image-post-image">';
	   the_post_thumbnail( 'post-featured' );
	  echo '</a>';

	} else {

		 echo '<a href="'; the_permalink(); echo '" class="image-post-image">';
		 echo '<img src="';
		 echo catch_that_image();
		 echo '" alt="';
		 echo the_title();
		 echo '" />';
		 echo '</a>';

	}?>
	<h2><a href="<?php echo the_permalink();?>" class="image-post-title"><?php the_title(); ?></a></h2>
	<?php get_template_part('library/unf/postmeta');?>
	</div>

	<?php if( $unf_options['unf_post_layout'] == '2') { echo '</div>';}?>

</div>