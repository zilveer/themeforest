<?php
/* ==========================================================================
       Portfolio
   ========================================================================== */
function mom_min_portfolio($atts, $content) {
	extract(shortcode_atts(array(
		'columns' => 'four',
		'nav' => 'both',
		'count' => 12
	), $atts));
	ob_start();
	wp_enqueue_script('prettyPhoto');
	$rndn = rand(0,100);
	$cols = 'portfolio-'.$columns.'-column';

?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".mom-portfolio a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, deeplinking: false});
		});
	</script>
	<?php if($nav == 'both' || $nav == 'filter') {
			//wp_enqueue_script('isotope'); // with plugins.js
	?>
	<script>
		jQuery(document).ready(function($){
			var t = true;
			<?php if(is_rtl()) { ?>
				$.Isotope.prototype._positionAbs = function( x, y ) {
					return { right: x, top: y };
				};
				t = false;
			<?php } ?>
			var $container = $('.portfolion_<?php echo $rndn; ?>');
			$container.isotope({
			filter: '*',
			layoutMode : 'fitRows',
			transformsEnabled: t,
			animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false,
			}
		});
		$('.pt_filtern_<?php echo $rndn; ?> li a').click(function(){
			var selector = $(this).attr('data-filter');
			$container.isotope({
			filter: selector,
			animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false,
			}});
			return false;
		});
		});
	</script>
	<ul class="portfolio-filter pt_filtern_<?php echo $rndn; ?>">
                <li class="all current"><a href="#" data-filter="*"><?php _e('All', 'framework'); ?></a></li>
		<?php 
			$portCats = get_terms("portfolio_category");
			$pc_count = count($portCats);
			if ( $pc_count > 0 ){
				foreach ( $portCats as $portCat ) {
						echo '<li><a href="#"  data-filter=".'.$portCat->slug.'">' . $portCat->name . '</a></li>';
				}
			}
		?>
       </ul> <!-- portfolio filter -->
       <?php } ?>
       <div class="mom-portfolio">
           <ul class="portfolio-list <?php echo $cols; ?> portfolion_<?php echo $rndn; ?>">
	       		<?php
				global $paged;
				$args = array(
				'posts_per_page' => $count,
				'post_type' => 'portfolio',
				'paged' => $paged 
				);
			$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<?php
			global $post;
			$taxonomy = 'portfolio_category';
			$terms = get_the_terms( $post->ID, $taxonomy);
		?>
	       <li class="portfolio_item <?php
				if (! empty($terms)) {
				foreach ($terms as $term ) {
				echo $term->slug.' ';
				}
				}
				?>">
                   <div class="portfolio-image">
                   <img src="<?php echo mom_post_image('mom-portfolio-'.$columns); ?>" data-hidpi="<?php echo mom_post_image('mom-portfolio-two'); ?>" alt="<?php the_title(); ?>">
                   <div class="pt-overlay">
                       <div class="ov-content">
                       <h3 class="ov-title"><?php the_title(); ?></h3>
                       <div class="ov-nav">
                       <a href="<?php the_permalink(); ?>" class="ov-link"><i class="brankic-icon-link"></i></a>
                       <a href="<?php echo mom_post_image('full'); ?>" rel="prettyPhoto['portfolio']" class="ov-zoom"><i class="brankic-icon-zoom-in"></i></a>
                       </div>
                       </div>
                   </div> <!-- overlay -->
                   </div> <!-- portfolio image -->
		   <?php if ($columns == 'one') { ?>
		       <div class="portfolio-details">
				<h2 class="pt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 400, '...');
					?>
				</p>
				<a href="<?php the_permalink(); ?>" class="button">Read More</a>
				<!--<a href="#" class="button">Visit Website</a>-->
			</div> <!-- details -->
		   <?php } ?>
               </li> <!-- portfolio item -->

<?php endwhile; else: ?>
<?php endif; ?>
		</ul> <!-- portfolio list -->
       </div> <!-- mom portfolio -->
<?php if ($nav == 'pagination' || $nav == 'both') { ?>
<?php mom_pagination($query->max_num_pages); ?>
<?php } ?>
<?php wp_reset_postdata(); ?>
       
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('portfolio', 'mom_min_portfolio');
