<?php
/*
 * Template name: Boxed, no sidebar
 */

get_header(); ?>
<header class="entry-header">
	<?php vivaco_ultimate_title(); ?>
</header><!-- .entry-header -->
<div id="main-content">
		<div class="container inner">
			<div class="col-sm-12">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
						//the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
					?>
					<div class="entry-content">
						<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();
								// Include the page content template.
								the_content();
							endwhile;
						?>
					</div>
				</article>
			</div>
	</div>

</div>

<?php get_footer(); ?>