<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php 
		get_template_part('postformats/format', get_post_format() );
		the_title('<h1 class="blog-title"><a href="'. get_permalink() .'">', '</a></h1>'); 
		get_template_part('loop/content', 'meta');
		the_excerpt();
	?>
	
	<a href="<?php the_permalink(); ?>"><?php echo get_option('blog_read_more','read more'); ?></a> &rarr;
	
	<div class="pad45"></div>

</div>
