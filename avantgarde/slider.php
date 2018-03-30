<?php global $theme_prefix;  
		if(empty($slider_count)){ $slider_count = "sidebar"; }
		if($theme_prefix['slider-visibility'] == "1" & is_home() ){ ?><!-- Slider Start -->
		<?php if($slider_count != "sidebar"){  ?>
		<div class="title pos-center margint50 marginb20"><h6><?php  echo esc_attr($theme_prefix['slider-title']); ?></h6></div><?php }else{ ?>
		<div class="title underline-sidebar pos-center margint60"><h6><?php  echo esc_attr($theme_prefix['slider-title']); ?></h6></div><?php }?>
		<div class="flexslider-home home-slider home-grid">
			<ul class="slides">
				<?php 
					
					$slider_count = $theme_prefix['slider-count']; // Slider Grid
					if($slider_count == "sidebar") { $slider_count = "1"; $slidertype= "sidebar-slider"; } else { $slidertype= ""; }
					$slider_post_item_count = $theme_prefix['slider-post-item'];  // Slider Post Count

					// WP_Query arguments
					$args = array (
					'order'                  => 'DESC',
					'orderby'                => 'date',
					'posts_per_page'         => $slider_post_item_count, // Slider Post Count
					'ignore_sticky_posts'    => 1,
					     'meta_query' => array(
					      array(
					           'key' => 'theme2035_editor_pick',
					           'value' => 'Yes',
					           'compare' => 'Not Exist!',
					           )
					      ),
					 'post_status'=>'publish',
					);

					// The Query
					$query = new WP_Query( $args );

					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
						$query->the_post();

						$image = "";
						if (has_post_thumbnail( $post->ID ) ):

						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-slider-'.$slider_count.'-grid' );
						$image = $image[0];
						endif;
						if($image == ""){

						if($slider_count == 3){
							$image = IMAGES."/slider-no-image-3.jpg"; 
						}else if($slider_count == 1){ 
							$image = IMAGES."/slider-no-image-1.jpg";
						}else {
							$image = IMAGES."/slider-no-image-1.jpg";
						}

						}
					?>

					<li class="slide-block <?php echo esc_attr($slidertype); ?> home-slider-<?php echo esc_attr($slider_count); ?>-grid">
						<img alt="" class="img-responsive" src="<?php echo esc_attr($image);?>" />
						<div class="slider-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<date><?php echo esc_attr($post_date = the_time('F j')); ?></date>
						</div>
					</li>

					<?php 
					}
				}else {
					echo __("<h4 class='margint20'>No post found for slider! You need to add post for slider. You can find information in documentation. If you don't want slider you can close it from theme options.</h4>","2035Themes-fm");
				}

				// Restore original Post Data
				wp_reset_postdata();

				?>
			  </ul>
		</div>
<?php } ?><!-- Slider Finish -->