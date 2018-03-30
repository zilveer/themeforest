<?php

global $mr_tailor_theme_options;

$blog_with_sidebar = "";
if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";

?>

<section class="no-results not-found">
	
	<div class="row">
	
	<?php if ( $blog_with_sidebar != "yes" ) :  ?>
		<div class="large-8 large-centered text-center columns without-sidebar">
	<?php endif; ?>	
	
		<header class="page-header">
			<h1 class="page-title"><?php _e( 'Nothing Found', 'mr_tailor' ); ?></h1>
		</header><!-- .page-header -->
	
		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	
				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mr_tailor' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	
			<?php elseif ( is_search() ) : ?>
	
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mr_tailor' ); ?></p>
				<?php get_search_form(); ?>
	
			<?php else : ?>
	
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mr_tailor' ); ?></p>
				<?php get_search_form(); ?>
	
			<?php endif; ?>
		</div><!-- .page-content -->
		
	</div><!--.large-8-->
	
	<?php if ( $blog_with_sidebar != "yes" ) : ?>
		</div>
	<?php endif; ?>	
		
</section><!-- .no-results -->
