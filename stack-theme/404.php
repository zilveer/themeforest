<?php get_header(); ?>

<div id="content" class="post-content">
<div class="container">

	<?php if(theme_options('page', '404_page')){
		$stacks = get_post_meta(theme_options('page', '404_page'), '_stack_builder_stacks', true);
		
		if( is_array( $stacks ) ) {
			foreach ($stacks as $stack) {
				$stack['id'] = 'stack-'.$post->ID.'-'.$stack['stack_id'];
				if( $stack['template_id'] == 'page_content' ) {
					$stack['template_id'] = 'page_content_full_width';
					gen_stack( $stack );
				} else {
					gen_stack( $stack );
				}
			}
		} else { // In case no stack meta
			$stack = array( 'template_id' => 'page_content_full_width' );
			$stack['id'] = 'stack-'.$post->ID;
			gen_stack( $stack );
		}
	} else { get_template_part('/stacks/stack', 'title'); } ?>


</div>
</div>

<?php get_footer(); ?>