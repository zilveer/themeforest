<?php
/* Template Name: Blog */

// Get blog posts
$blog_query = new WP_Query( array(
	'post_type'	=> 'post',
	'paged'		=> risen_page_num() // returns/corrects $paged so pagination works on static front page
) );

// Header
get_template_part( 'header', 'page' ); // this makes $content_title available

?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'blog' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>
		
			<?php if ( $content_title ) : // this comes from header-page.php; empty if no title should show at top of content ?>	
			<header class="title-with-right">
				<h1 class="page-title"><?php echo $content_title; ?></h1>
				<div class="page-title-right"><?php risen_post_count_message( $blog_query ); ?></div>
				<div class="clear"></div>
			</header>
			<?php endif; ?>
			
			<?php if ( trim( strip_tags( $post->post_content ) ) ) : // has content ?>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
			
			<?php get_template_part( 'loop', 'blog' ); // loop and show each, if any ?>

			<?php risen_posts_nav( $blog_query, __( '<span>&larr;</span> Newer Posts', 'risen' ), __( 'Older Posts <span>&rarr;</span>', 'risen' ) ); ?>
			
			<?php if ( ! $blog_query->have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, there are no blog posts to show.', 'risen' ); ?></p>
			<?php endif; ?>
			
		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'blog' ); ?>
			
<?php endwhile; ?>

<?php get_footer(); ?>