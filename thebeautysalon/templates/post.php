<?php
/** Single Post
  *
  * This file is used to display the contents of
  * single posts
  *
  * @package Elderberry
  *
  */

  global $blueprint, $framework;
  $indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';
  $metabar = ( $blueprint->post_has( 'metabar' ) ) ? 'has-bar' : 'no-bar';
?>

<div class='post-content post-layout-single <?php echo $metabar ?>'>

	<?php if( has_post_thumbnail() AND $blueprint->has_thumbnail() ) : ?>
		<div class='image'><?php the_post_thumbnail( 'rf_col_1' ) ?></div>
	<?php endif ?>

	<div class='indent <?php echo $indent_side ?> '>
		<?php if( $blueprint->post_has( 'metabar' )  ) : ?>
		<aside class='post-meta <?php echo $indent_side ?>'>

			<h3 class='post-date round'>
				<span class='month'><?php the_time( 'M' ) ?></span>
				<span class='day'><?php the_time( 'd' ) ?></span>
			</h3>

			<div class='clear'></div>

			<ul class='primaries'>

			<?php if( $blueprint->post_has( 'metaauthor' ) ) : ?>
			<li class='meta post-author'>By <?php the_author_posts_link() ?></li>
			<?php endif ?>

			<?php if( has_category() AND $blueprint->post_has( 'metacategories' ) ) : ?>
				<li class='meta post-category'>
				In <?php the_category( ', ' ) ?>
				</li>
			<?php endif ?>

			<?php if( has_tag() AND $blueprint->post_has( 'metatags' ) ) : ?>
				<li class='meta post-tags'>
				In <?php the_tags( '' ) ?>
				</li>
			<?php endif ?>


			<?php if( comments_open() AND $blueprint->post_has( 'metacomments' ) ) : ?>
			<li class='meta post-comments'>
				<a href='<?php comments_link(); ?>'><?php comments_number( '0 comments', '1 comment', '% comments' ); ?></a>
			</li>
			<?php endif ?>

			</ul>
		</aside>
		<?php endif ?>


		<div class='post-text <?php echo $blueprint->get_sidebar_position() ?>'>

			<?php if( $post->post_title != '' ) : ?>
				<h1 class='post-title'><a class='primary' href='<?php the_permalink() ?>'><?php the_title() ?></a></h1>
			<?php endif ?>


			<div class='content'>
				<?php the_content() ?>
			</div>

		</div>
		<div class='clear'></div>
	</div>

	<?php
		$author_description = get_the_author_meta( 'description' );
		if( $blueprint->post_has( 'authorbox' ) AND !empty( $author_description ) ) :
		$authorbox_image = ( $blueprint->post_has( 'authorimage' ) ) ? 'has-authorimage' : 'no-authorimage';
	?>

		<div class='indent <?php echo $indent_side ?> <?php echo $authorbox_image ?> author-box'>
			<?php if( $blueprint->post_has( 'authorimage' ) ) : ?>
				<aside class='<?php echo $indent_side ?>'>
					<div class='image'>
						<?php echo get_avatar( $post->post_author, 100 ) ?>
					</div>
				</aside>
			<?php endif ?>
			<div class='authorbox-content <?php echo $blueprint->get_sidebar_position() ?>'>
				<h2 class='primary title'>About <?php the_author() ?></h2>
				<div class='content'>
				<?php echo wpautop( $author_description ) ?>
				</div>
			</div>
		</div>

	<?php endif ?>

</div>

<div class='link-pages'>
<?php wp_link_pages(  ); ?>
</div>