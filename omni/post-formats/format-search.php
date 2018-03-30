<?php
global $post;

$more_text = esc_html__( 'Read more', 'omni' );

?>
<div class="blog_wrap">
	<div class="title">
		<h3>
			<a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>" title=""><?php echo get_the_title( get_the_ID() ); ?></a>
		</h3>
	</div>
	<!-- end title -->

	<div class="post_desc">
		<p><?php echo get_the_excerpt(); ?></p>
		<a class="btn btn-primary" href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>"><?php echo $more_text; ?></a>
	</div>
</div>

