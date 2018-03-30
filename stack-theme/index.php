<?php get_header(); 
	$postspage_id = get_option('page_for_posts'); 
?>

<div id="content" class="post-content">

	<?php get_template_part('/stacks/stack', 'title'); ?>

	<?php 
		$stacks = get_post_meta($postspage_id, '_stack_builder_stacks', true);
		if( is_array( $stacks ) ) {
			foreach ($stacks as $stack) {
				if( $stack['template_id'] == 'page_content' ) {
					$stack['template_id'] = 'page_blog';
					gen_stack( $stack );
				} else {
					gen_stack( $stack );
				}
			}
		} else { // In case no stack meta
			$stack = array( 'template_id' => 'page_blog' );
			gen_stack( $stack );
		}
	?>

</div>

<?php get_footer(); ?>