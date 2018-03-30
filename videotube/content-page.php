<?php if( !defined('ABSPATH') ) exit;?>
<?php 
	if( has_post_thumbnail() ){
		print '<a href="'.get_permalink($post->ID).'">'. get_the_post_thumbnail(NULL,'blog-large-thumb', array('class'=>'img-responsive')) .'</a>';
	}
?>
<div class="post-header">
	<h2>
		<?php the_title();?>
	</h2>
</div>
<div class="post-entry">
	<?php the_content();?>
	<?php 
		$defaults = array(
			'before' => '<ul class="pagination">',
			'after' => '</ul>',
			'before_link' => '<li>',
			'after_link' => '</li>',
			'current_before' => '<li class="active">',
			'current_after' => '</li>',
			'previouspagelink' => '&laquo;',
			'nextpagelink' => '&raquo;'
		);  
		bootstrap_link_pages( $defaults );
	?>
</div>