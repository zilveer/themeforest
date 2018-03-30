<?php get_header(); ?>
		<!-- container -->
		<div class="container">
		<div class="boxed">
		
			<!-- single-post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
				<?php
					if(is_page_title_uppercase() == true){
						echo '<div class="page-title uppercase">';
					} else {
						echo '<div class="page-title">';
					};
				?>
					<span class="heading-t"></span>
					<?php the_title('<h1>','</h1>'); ?>
					<?php
						iron_page_title_divider();
					?>
				</div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
			</article>
		</div>
		</div>
<?php get_footer(); ?>