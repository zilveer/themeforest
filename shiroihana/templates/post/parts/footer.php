<?php

$sections = wp_parse_args( Youxi()->option->get( 'blog_sections' ), array(
	'values' => array()
));

if( ! empty( $sections['values'] ) ) : ?>

<footer class="entry-footer">

	<?php do_action( 'shiroi_before_post_footer_content' );

	$templates = array(
		'author'   => 'parts/author', 
		'comments' => 'parts/comments', 
		'adjacent' => 'parts/nav', 
		'related'  => 'parts/related', 
		'sharing'  => 'parts/sharing'
	);

	foreach( $sections['values'] as $section ):
		if( isset( $templates[ $section ] ) ):
			Youxi()->templates->get( $templates[ $section ], get_post_format(), 'post' );
		endif;
	endforeach;

	do_action( 'shiroi_after_post_footer_content' ); ?>

</footer>

<?php endif; ?>
