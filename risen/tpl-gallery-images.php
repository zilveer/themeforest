<?php
/* Template Name: Gallery - All Images */

// Get posts without image
$gallery_query = new WP_Query( array(
	'post_type'			=> 'risen_gallery',
	'posts_per_page'	=> risen_option( 'gallery_per_page' ) ? risen_option( 'gallery_per_page' ) : risen_option_default( 'gallery_per_page' ),
	'paged'				=> risen_page_num(), // returns/corrects $paged so pagination works on static front page
	'meta_query' 		=> array(
		array(
			'key'				=> '_risen_gallery_type',
			'value'				=> 'image',
			'compare'			=> '='
		)
	)
) );

// Header
get_template_part( 'header', 'page' ); // this makes $content_title available

?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'gallery' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>			
		
			<?php if ( $content_title ) : // this comes from header-page.php; empty if no title should show at top of content ?>	
			<header class="title-with-right">
				<h1 class="page-title"><?php echo $content_title; ?></h1>
				<div class="page-title-right"><?php risen_post_count_message( $gallery_query ); ?></div>
				<div class="clear"></div>
			</header>
			<?php endif; ?>

			<?php if ( trim( strip_tags( $post->post_content ) ) ) : // has content ?>
				<div class="post-content"> <!-- confines heading font to this content -->
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
			
			<?php get_template_part( 'loop', 'gallery' ); // loop and show each, if any ?>

			<?php risen_posts_nav( $gallery_query, _x( '<span>&larr;</span> Newer Items', 'gallery', 'risen' ), _x( 'Older Items <span>&rarr;</span>', 'gallery', 'risen' ) ); ?>
			
			<?php if ( ! $gallery_query->have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, there are no items to show.', 'risen' ); ?></p>
			<?php endif; ?>

		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'gallery' ); ?>
			
<?php endwhile; ?>

<?php get_footer(); ?>