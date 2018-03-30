<div id="gmet_content_wrap" class="wp-editor-container">

    <ul>
	<?php 
	$args = array( 'post_type'=> 'template', 'posts_per_page'   => 999);
	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );
	$url = admin_url( 'themes.php?page=distinctive-page-builder&action=edit&template=' ); ?>
		<li>
			<p class="block-title"><?php echo $post->post_title; ?></p>
			<textarea id="shortcode">&#91;template id="<?php echo $post->ID ?>"&#93;</textarea>
			<a id="copy-button" class="btn" href="#" class="">Use</a>
			<a id="edit-button" class="btn" href="<?php echo $url; echo $post->ID; ?>" class="">Edit</a>
		</li>
	<?php endforeach; ?>
	</ul>

</div>