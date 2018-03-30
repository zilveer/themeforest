<div class="entry-body">

	<a href="<?php echo ss_framework_get_custom_field( 'ss_link_src', $post->ID ); ?>" title="<?php printf( esc_attr__('External link to %s', 'ss_framework'), the_title_attribute('echo=0') ); ?>" target="_blank">
		<h1 class="title"><?php the_title(); ?></h1>
	</a>

	<?php echo ss_framework_post_content(); ?>

</div><!-- end .entry-body -->

<div class="entry-meta">

	<?php echo ss_framework_post_meta(); ?>

</div><!-- end .entry-meta -->