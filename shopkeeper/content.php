<?php
	global $shopkeeper_theme_options;
?>

<div class="intro-effect-fadeout">

	<?php 
	$thumb_url = "";
	if ( has_post_thumbnail() ) {
		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
	}
	?>
    
    <?php  
	$single_post_header_thumb_class = "";
	$single_post_header_thumb_class = "";
	$single_post_header_thumb_style = "";
	$single_post_header_parralax = "";
	
	if ( is_single() && has_post_thumbnail() && ! post_password_required() ) { 
		
		if (get_post_meta( $post->ID, 'post_featured_image_meta_box_check', true )) {
			$post_featured_image_option = get_post_meta( $post->ID, 'post_featured_image_meta_box_check', true );
		} else {
			$post_featured_image_option = "on";
		}
		
		if ( (isset($post_featured_image_option)) && ($post_featured_image_option == "on") ) {
			$single_post_header_thumb_class = "with-thumb";		
			$single_post_header_thumb_style = 'background-image:url('.$thumb_url.')';
			$single_post_header_parralax = 'data-stellar-background-ratio="0.5"';
		} else {
			$single_post_header_thumb_class = "";
			$single_post_header_thumb_style = "";
			$single_post_header_parralax = '';
		}
		
	}
	?>
    
    <div  class="header single-post-header <?php echo $single_post_header_thumb_class; ?>">	   
        
		<?php if  ( $single_post_header_thumb_class == "with-thumb" ) : ?>
			<div <?php echo $single_post_header_parralax; ?> class="single-post-header-bkg"  style="<?php echo $single_post_header_thumb_style; ?>"></div>
			<div class="single-post-header-overlay"></div>
		<?php endif; ?>	
		
		<div class="row">
            <div class="xxlarge-6 xlarge-8 large-12 large-centered columns">
                <div class="title">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="post_meta"> <?php shopkeeper_entry_meta(); ?></div>
                </div>
            </div>
        </div>	
    </div>
    
</div><!--.intro-effect-fadeout-->

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <div class="row">
        
		<?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
		<div class="xxlarge-8 xlarge-10 large-12 large-centered columns with-sidebar">
		<?php else : ?>
		<div class="xxlarge-6 xlarge-8 large-10 large-centered columns without-sidebar">
		<?php endif; ?>
		
			<div class="row">
			
				<?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
				<div class="large-9 columns">
				<?php else : ?>
				<div class="large-12 columns">
				<?php endif; ?>
					
					<div class="entry-content blog-single">
						<?php the_content( __( 'Continue Reading <span class="meta-nav">&rarr;</span>', 'shopkeeper' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'shopkeeper' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->
				
					<?php if ( is_single() ) : ?>
					
					<footer class="entry-meta">
						
						<div class="post_tags"> <?php shopkeeper_entry_tags(); ?></div>
						
					</footer><!-- .entry-meta -->
					
					<?php endif; ?>
					
				</div><!-- .columns-->
						
				<?php if ( (isset($shopkeeper_theme_options['sidebar_blog_listing'])) && ($shopkeeper_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
				<div class="large-3 columns">
					<?php get_sidebar(); ?>
				</div><!-- .columns-->
				<?php endif; ?>
					
			</div><!-- .row-->
                               
        </div><!-- .columns -->
		
    </div><!-- .row -->

</div><!-- #post -->
