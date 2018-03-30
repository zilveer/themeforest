<?php
/** Thumbnailed
  *
  * This layout shows posts one under another with no image,
  * just the title, the excerpt and the read more link
  *
  * @package The Beauty Salon
  *
  */
  global $blueprint, $theme_options, $framework, $indent_side;
  $other_side = ( $indent_side == 'right' ) ? 'left' : 'right';

  $has_image = has_post_thumbnail();
  $no_image = ( empty( $has_image ) ) ? 'no-image' : '';
?>
<div <?php post_class( 'post-layout-thumbnail' ) ?>>

	<div class='post-content indent <?php echo $indent_side ?>'>

		<?php if( !empty( $has_image ) ) : ?>
			<div class='image <?php echo $indent_side ?>'><a href='<?php the_permalink() ?>' class='imagelink hoverlink'><?php the_post_thumbnail( 'eb_large_thumb' ) ?></a></div>
		<?php endif ?>


		<div class='post-text <?php echo $other_side  ?> <?php echo $no_image ?>'>
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