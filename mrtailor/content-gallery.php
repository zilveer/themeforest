<?php
	global $mr_tailor_theme_options;

    $blog_with_sidebar = "";
    if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>

<div class="row">

<?php if ( $blog_with_sidebar == "yes" ) : ?>
    <div class="large-12 columns">
<?php else : ?>
    <div class="large-8 large-centered columns without-sidebar">
<?php endif; ?>

        <header class="entry-header">
            <?php if ( is_single() ) : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php else : ?>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
            <?php endif; // is_single() ?>
            
            <div class="post_header_date"><?php mr_tailor_post_header_entry_date(); ?></div>
            
        </header><!-- .entry-header -->
        
    </div><!-- .columns -->
</div><!-- .row -->
  
  
<div class="gallery-slider-wrapper">
    <div class="gallery-slider">
        <div class="swiper-container post-id-<?php echo $post->ID; ?> format-gallery-swiper">
            <div class="swiper-wrapper">
    
                <?php
    
                    $galleryImages = grab_ids_from_gallery(); 
                    $imagesCount = count(grab_ids_from_gallery());
    
                    if ($imagesCount > 0) {
                        for ($i = 0; $i < $imagesCount; $i++) {
                            if (!empty($galleryImages[$i])) {
    
                                //$imageMarkup = wp_get_attachment_image( $galleryImages[$i], array(1200,900) );
                                $imageSrc = wp_get_attachment_image_src( $galleryImages[$i], array(1200,900) );
    
                            ?>
    
                                <div class="swiper-slide"><img src="<?php echo $imageSrc[0]; ?>"></div>
    
                            <?php
                            }
                        }
                    }
                ?>
    
            </div>
    
            <div class="swiper-prev swiper-prev_<?php echo $post->ID; ?> show-for-medium-up"></div>
            <div class="swiper-next swiper-next_<?php echo $post->ID; ?> show-for-medium-up"></div>
            
            <div class="pagination"></div>
    
        </div>
    </div>
</div>

<script>
	jQuery(document).ready(function($) {
	
	"use strict";
		
		if ($(window).innerWidth() > 1024) {
			var slides = 2;
			var pag = '';
			var pagination_click = false;
		} else {
			var slides = 1;
			var pag = '.pagination';
			var pagination_click = true;
		}
		
		var gallerySwiper_<?php echo $post->ID; ?> = new Swiper('.swiper-container.post-id-<?php echo $post->ID; ?>', { 
			
			speed:300,
			centeredSlides: true,
            loop: true,
			resizeReInit: true,
			calculateHeight: true,
			
			<?php if ( $blog_with_sidebar == "yes" ) : ?>
				pagination: '.pagination',
                paginationClickable: true,
			<?php else : ?>
				pagination: pag,
				paginationClickable: pagination_click,
			<?php endif; ?>
			
			<?php if ( $blog_with_sidebar == "yes" ) : ?>
				slidesPerView: 1,
			<?php else : ?>
				slidesPerView: slides,
			<?php endif; ?>
			onInit: after_swiper()
			
		});
		
		$('.swiper-prev_<?php echo $post->ID; ?>').click(function(){
			gallerySwiper_<?php echo $post->ID; ?>.swipePrev();
		});

		$('.swiper-next_<?php echo $post->ID; ?>').click(function(){
			gallerySwiper_<?php echo $post->ID; ?>.swipeNext();
		});

		function after_swiper() {
			setTimeout(function() {	
			   $('.gallery-slider-wrapper').css('visibility','visible');
			   $('.gallery-slider-wrapper').css('opacity','1');
			}, 300);
		}
        
        $(window).load(function() {
			
			gallerySwiper_<?php echo $post->ID; ?>.reInit();
			
		});
        
		$(window).resize(function(){

			gallerySwiper_<?php echo $post->ID; ?>.reInit();

        });
        
		
	});
</script>

<div class="row">
            
	<?php if ( $blog_with_sidebar == "yes" ) : ?>
        <div class="large-12 columns">
    <?php else : ?>
        <div class="large-8 large-centered columns without-sidebar">
    <?php endif; ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="entry-content">
                <?php
                if( ($post->post_excerpt) && (!is_single()) ) {
                    the_excerpt();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Continue reading &rarr;', 'mr_tailor'); ?></a>
                <?php
                } else {
                    the_content( __( 'Continue reading &rarr;', 'mr_tailor' ) );
                }
                ?>
				<?php if ( is_single() || ! get_post_gallery() ) : ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mr_tailor' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                <?php else : ?>
                    <?php //echo get_post_gallery(); ?>
                <?php endif; // is_single() ?>
            </div><!-- .entry-content -->
        
            <?php if ( is_single() ) : ?>
            
				<?php if ( (isset($mr_tailor_theme_options['sharing_options_blog'])) && ($mr_tailor_theme_options['sharing_options_blog'] == "1" ) ) : ?>
					<div class="box-share-container post-share-container">
						<a class="trigger-share-list" href="#"><i class="fa fa-share-alt"></i><?php _e( 'Share this post', 'mr_tailor' )?></a>
						<div class="box-share-list">
							
							<?php
								//Get the Thumbnail URL
								$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
							?>
                            
                            <div class="box-share-list-inner">
								<a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a>
								<a href="//twitter.com/share?url=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a>
								<a href="//plus.google.com/share?url=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-google-plus"></i><span>Google</span></a>
								<a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($src[0]) ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" class="box-share-link" target="_blank"><i class="fa fa-pinterest"></i><span>Pinterest</span></a>
							</div><!--.box-share-list-inner-->
							
						</div><!--.box-share-list-->
					</div>
				<?php endif; ?>
			
				<footer class="entry-meta">
					
						<?php mr_tailor_entry_meta(); echo "."; ?>
						
						<?php //edit_post_link( __( 'Edit', 'mr_tailor' ), '<div class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</div>' ); ?>
					
				</footer><!-- .entry-meta -->
            
            <?php endif; ?>

        </article><!-- #post -->

    </div><!-- .columns -->
</div><!-- .row -->
