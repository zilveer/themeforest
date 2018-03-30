<?php
/** Round Date
  *
  * This layout shows posts one under another with a large
  * image on top The image is joined with a binder graphic
  * to the post underneath it.
  *
  * The post contains a meta section in its sidebar and a
  * section showing the title, excerpt and read more links.
  *
  * @package The Beauty Salon
  *
  */
  global $blueprint, $framework, $parent, $indent_side;
  $other_side = ( $indent_side == 'right' ) ? 'left' : 'right';
  $show_meta = get_post_meta( $blueprint->master_page->ID, 'show_meta', true);
  $other_side = ( $show_meta != 'hide' ) ? $other_side : '';
?>
<div <?php post_class( 'post-layout-rounddate' ) ?>>
	<?php if( has_post_thumbnail() ) : ?>
		<div class='image'><a href='<?php the_permalink() ?>' class='imagelink hoverlink'><?php the_post_thumbnail( 'rf_col_1' ) ?></a></div>
	<?php endif ?>

	<div class='post-content indent <?php echo $indent_side ?>'>

		<?php if( $show_meta != 'hide' ) : ?>
		<aside class='post-meta <?php echo $indent_side ?>'>

			<h3 class='post-date round'>
				<span class='month'><?php the_time( 'M' ) ?></span>
				<span class='day'><?php the_time( 'd' ) ?></span>
			</h3>

			<div class='clear'></div>

			<ul class='primaries'>
			<li class='meta post-author'>By <?php the_author_posts_link() ?></li>

			<?php if( has_category() ) : ?>
				<li class='meta post-category'>
				In <?php the_category( ', ' ) ?>
				</li>
			<?php endif ?>

			<?php if( comments_open() ) : ?>
			<li class='meta post-comments'>
				<a href='<?php comments_link(); ?>'><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></a>
			</li>
			<?php endif ?>

			</ul>
		</aside>
		<?php endif ?>

		<div class='post-text <?php echo $other_side ?>'>

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