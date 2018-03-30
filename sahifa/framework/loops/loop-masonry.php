<?php wp_enqueue_script( 'tie-masonry' ); ?>

<div class="post-listing archive-box masonry-grid" id="masonry-grid">

<?php while ( have_posts() ) : the_post(); ?>

	<article <?php tie_post_class('item-list'); ?>>
	
		<h2 class="post-box-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		
		<?php get_template_part( 'framework/parts/meta-archives' ); ?>					

		
		<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>	
		
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('tie-large');  ?>
				<span class="fa overlay-icon"></span>
			</a>
		</div><!-- post-thumbnail /-->
		
		<?php endif; ?>
			
		<div class="entry">
			<p><?php tie_excerpt() ?></p>
			<a class="more-link" href="<?php the_permalink() ?>"><?php _eti( 'Read More &raquo;' ) ?></a>
		</div>

		<?php if( tie_get_option( 'archives_socail' ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>
		
		<div class="clear"></div>
	</article><!-- .item-list -->
	
<?php endwhile;?>
</div>
	<script>
		jQuery(document).ready(function() {
			<?php if( is_rtl() ){ ?>
						
				jQuery.Isotope.prototype._positionAbs = function( x, y ) {
				  return { right: x, top: y };
				};
				var transforms = false;
			<?php }else{ ?>
				var transforms = true;
			<?php } ?>		
					
			var $container = jQuery('#masonry-grid.post-listing');

			jQuery($container).imagesLoaded(function() {
				$container.isotope({
					itemSelector : '.item-list',
					resizable: false,
					transformsEnabled: transforms,
					animationOptions: {
						duration: 400,
						easing: 'swing',
						queue: false
					},
					masonry: {}
				});
			});
			
			/* Events on Window resize */
			jQuery(window).smartresize(function(){
				$container.isotope();
			});
		
		});
	</script>
