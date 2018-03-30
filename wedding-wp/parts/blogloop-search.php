<article id="post-<?php the_ID(); ?>" class="blog-post"> 
<?php

global $webnus_options;

?>
	<?php if( 1 == $webnus_options->webnus_blog_meta_date_enable() ) { ?>
	<div class="col-md-2 alpha">
	  <div class="blog-date-sec">
		<h3><?php the_time('d') ?></h3>
		<span><?php the_time('M Y') ?></span> </div>
	</div>
	<?php } ?>
	<div class="col-md-10 omega">

	  <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>

	 
	  <div class="postmetadata">
		<?php if( 1 == $webnus_options->webnus_blog_meta_author_enable() ) { ?>	
		<h6 class="blog-author"><strong><?php _e('by','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_author(); ?> </h6>
		<?php } ?>
		<?php if( 1 == $webnus_options->webnus_blog_meta_category_enable() ) { ?>
		<h6 class="blog-cat"><strong><?php _e('in','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_category(', ') ?> </h6>
		<?php } ?>
		<?php if( 1 == $webnus_options->webnus_blog_meta_comments_enable() ) { ?>
		<h6 class="blog-comments"><strong> - </strong> <?php comments_number(  ); ?> </h6>
		<?php } ?>
		
	  </div>
	 <p>
	  <?php 
		echo get_the_excerpt();
	  ?>
	  </p>
	  </div>
	<hr class="vertical-space1">
</article>