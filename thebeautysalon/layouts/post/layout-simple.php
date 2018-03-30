<?php
/** Simple
  *
  * This layout shows posts one under another with no image,
  * just the title, the excerpt and the read more link
  *
  * @package The Beauty Salon
  *
  */
  global $blueprint, $theme_options, $framework;
  $indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';

?>
<div <?php post_class( 'post-layout-simple' ) ?>>
	<div class='post-content indent <?php echo $indent_side ?>'>
		<div class='post-text'>
			<?php if( $post->post_title != '' ) : ?>
				<h1 class='post-title'><a class='primary' href='<?php the_permalink() ?>'><?php the_title() ?></a></h1>
			<?php endif ?>

			<div class='content'>
				<?php the_excerpt() ?>
			</div>
			<a title='Read the full post' class='read-more' href='<?php the_permalink() ?>'><?php echo $framework->options['read_more'] ?><span class='read-more-arrow'></span></a>
		</div>
		<div class='clear'></div>
	</div>
</div>