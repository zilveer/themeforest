<?php $type = isset( $GLOBALS['post-carousel'] ) ? ' type="simple"' : null ?>

<div class="entry-body">

	<?php echo do_shortcode('[quote author="' . ss_framework_get_custom_field( 'ss_quote_author', $post->ID ) . '"' . $type . ']' . ss_framework_get_custom_field( 'ss_quote', $post->ID ) . '[/quote]'); ?>

	<?php echo ss_framework_post_content(); ?>	

</div><!-- end .entry-body -->

<div class="entry-meta">

	<?php echo ss_framework_post_meta(); ?>

</div><!-- end .entry-meta -->