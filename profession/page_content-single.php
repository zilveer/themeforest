<?php if ( opt('sidebar_position') == 1) { ?>

	<div class="post-detail-content">
		<div class="blog-detail-title">
			<h4><?php echo ( single_post_title( '', false ) ); ?></h4>
		</div>
		
		<div class="blog-detail-seperator"></div>

		<div class="row">
			<div class="blog-post-detail span9">
		
				<div <?php post_class(); ?> id="post_<?php the_ID(); ?>">
				
						<?php the_content(); ?>
						
				</div>
				
			</div>
		</div>
		
	</div>
	
<?php } elseif ( opt('sidebar_position') ==  0 ) { ?>

	<div class="post-detail-content">

		<div class="blog-detail-title">
			<h4><?php echo ( single_post_title( '', false ) ); ?></h4>
		</div>

		<div class="blog-detail-seperator"></div>

		<div class="row">
			<div class="blog-post-detail span12">

				<div <?php post_class(); ?> id="post_<?php the_ID(); ?>">
				
						<?php the_content(); ?>
						
						<div class="pagelink">
							<?php wp_link_pages(); ?>
						</div>
						
				</div>
				
			</div>
		</div>
		
	</div>
<?php }