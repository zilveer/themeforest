<?php if ( !defined( 'ABSPATH' ) ) exit;
/*

	This template uses for some purposes only e.g. for search page.
	It only comes with a title and excerpt.
	No featured images.

*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post-template post-t8'); ?>>

	<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

	<?php

		the_excerpt();

		st_post_meta( true, true, false, false, false, false, true );

	?>

	<div class="clear"><!-- --></div>

</div><!-- .post-template -->