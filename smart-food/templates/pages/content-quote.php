<?php
/**
 * @package smartfood
 */
?>

<article id="post-<?php the_ID(); ?>" <?php tdp_attr( 'post' ); ?>>

	<div class="col-md-12 column post-content">
		<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h2>
	</div>

	<div class="col-md-12 column">
		<blockquote class="media quote-container">
			<p class="the-quote"><?php echo esc_textarea( get_field('quote') ); ?></p>
		</blockquote>
		<p class="quote-author">- <?php echo esc_textarea( get_field('quote_author') ); ?>.</p>
	</div>

</article><!-- #post-## -->