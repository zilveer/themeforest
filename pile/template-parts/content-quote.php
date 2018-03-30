<?php
/**
 * The template used for displaying quote post format content on archives
 *
 * @package Pile
 * @since   Pile 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article article--quote  one-whole lap-one-half desk-one-third' ); ?>>

	<a href="<?php the_permalink(); ?>" class="article__wrap  article__link">

		<?php $content = get_the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pile' ) );

		// test if there is a </blockquote> tag in here
		if ( strpos($content,'</blockquote>') !== false ) {
			echo strip_tags($content,'<p><em><strong><i><br><h3><h4><h5><h6><blockquote><iframe><embed><object><script>');
		} else {
			// we will wrap the whole content in blockquote since this is definitely intended as a quote
			echo '<blockquote>' . strip_tags($content,'<p><em><strong><i><br><h3><h4><h5><h6><blockquote><iframe><embed><object><script>') . '</blockquote>';
		} ?>

	</a>
</article>
