<?php 
/**
 * The home template
 *
 */
get_header();
?>
      <!-- Orbit Slider -->
      <section id="orbit-slider" class="content-box">
        <div id="featured-slider">
            <?php
			global $stylico_theme_options;
			
			//get all slides from custom post type (slide)
			$query_slides = new WP_Query( 'posts_per_page=-1&post_type=stylico-slide&orderby=menu_order&order=ASC' );
			
			if ($query_slides->have_posts()) : while ($query_slides->have_posts()) : $query_slides->the_post();
			
			//get custom fields
			$custom_fields = get_post_custom( get_the_ID() );
			$slide_url = $custom_fields["slide_url"][0];
			?>
                <?php
				//check that all slides have an image
				if ( has_post_thumbnail() ) $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'full');
                else
					echo '<script>alert("One of your slides does not have an image. This is not allowed, please set an image for each slide!");</script>';
				?>
                
                <?php if ( !empty($slide_url) ) : //add a tag if slide has url ?>
                <a href="<?php echo $slide_url; ?>" data-thumb="<?php echo get_template_directory_uri() .'/inc/timthumb.php?src='. $image_attributes[0] . '&w=80&h=60&zc=1&q=100'; ?>" data-caption="#caption-<?php the_ID(); ?>" target="_blank" >
                <?php endif; ?>
				
                <img data-caption="#caption-<?php the_ID(); ?>" src="<?php echo get_template_directory_uri() .'/inc/timthumb.php?src='. $image_attributes[0] . '&w=940&h=250&zc=1&q=100'; ?>" 
				<?php if ( empty($slide_url) ) : ?>
                    data-thumb="<?php echo get_template_directory_uri() .'/inc/timthumb.php?src='. $image_attributes[0] . '&w=80&h=60&zc=1&q=100'; ?>" 
				<?php endif; ?> />
                               
                <?php if ( !empty($slide_url) ) : //close a tag ?>
                </a>
                <?php endif; ?>
                
                <?php if($post->post_content != "") : ?>
                <span class="orbit-caption" id="caption-<?php the_ID(); ?>" >
                  <?php the_content(); ?>
                </span>
                <?php endif; ?>
            
            <?php endwhile; endif; wp_reset_query(); ?>
            
        </div>
        <script type="text/javascript">
		    //init orbit slider
			jQuery(document).ready(function() {
				jQuery('#featured-slider').orbit({ animation: "<?php echo $stylico_theme_options['slider']['animation']; ?>", 
				                                   captionAnimation: "<?php echo $stylico_theme_options['slider']['caption_animation']; ?>",
												   animationSpeed: <?php echo $stylico_theme_options['slider']['animation_speed']; ?>,
												   captionAnimationSpeed: <?php echo $stylico_theme_options['slider']['caption_animation_speed']; ?>,
												   advanceSpeed: <?php echo $stylico_theme_options['slider']['advance_speed']; ?>,
												   timer: <?php echo empty( $stylico_theme_options['slider']['timer'] ) ? 0 : 1; ?>,
												   pauseOnHover: <?php echo empty( $stylico_theme_options['slider']['pause_hover'] ) ? 0 : 1; ?>,
												   startClockOnMouseOut: <?php echo empty( $stylico_theme_options['slider']['clock_mouseout'] ) ? 0 : 1; ?>
												});
			});
        </script>
        
      </section>
      
      <!-- Area with 3 different widgets -->
      <section id="home-widget-areas" class="clearfix">
      
        <div id="home-widget-area-left" class="grid_4 alpha">
            <?php if ( ! dynamic_sidebar( 'home-left' ) ) : ?>
                <div class="widget content-box">
                    <h3 class="widget-title ribbon-blue"><?php _e( 'Widgetized Area', 'stylico'); ?></h3>
                    <p>This is a widget area and you can put your own widgets here. Just go to Appearance &rarr; Widgets in your wp-admin.</p>
                </div>
            <?php endif; ?>
            <?php if( !empty( $stylico_theme_options['mainpage']['widget_left_url']) ) : ?>
                <a href="<?php  echo $stylico_theme_options['mainpage']['widget_left_url']; ?>" class="big-button" target="_self"><?php echo $stylico_theme_options['mainpage']['widget_left_button_text']; ?></a>
            <?php endif; ?>
        </div>
        <div id="home-widget-area-center" class="grid_4">
            <?php if ( ! dynamic_sidebar( 'home-center' ) ) : ?>
                <div class="widget content-box">
                    <h3 class="widget-title ribbon-lila"><?php _e( 'Widgetized Area', 'stylico'); ?></h3>
                    <p>This is a widget area and you can put your own widgets here. Just go to Appearance &rarr; Widgets in your wp-admin.</p>
                </div>
            <?php endif; ?>
            <?php if( !empty( $stylico_theme_options['mainpage']['widget_center_url']) ) : ?>
                <a href="<?php echo $stylico_theme_options['mainpage']['widget_center_url']; ?>" class="big-button" target="_self"><?php echo $stylico_theme_options['mainpage']['widget_center_button_text']; ?></a>
            <?php endif; ?>
        </div>
        <div id="home-widget-area-right" class="grid_4 omega">
            <?php if ( ! dynamic_sidebar( 'home-right' ) ) : ?>
                <div class="widget content-box">
                    <h3 class="widget-title ribbon-green"><?php _e( 'Widgetized Area', 'stylico'); ?></h3>
                    <p>This is a widget area and you can put your own widgets here. Just go to Appearance &rarr; Widgets in your wp-admin.</p>
                </div>
            <?php endif; ?>
            <?php if( !empty( $stylico_theme_options['mainpage']['widget_right_url']) ) : ?>
                <a href="<?php echo $stylico_theme_options['mainpage']['widget_right_url']; ?>" class="big-button" target="_self"><?php echo $stylico_theme_options['mainpage']['widget_right_button_text']; ?></a>
            <?php endif; ?>
        </div>
        
      </section>
      
      
      <section id="main" class="content-box container_12">
          <article class="inner-content">
          <?php
		  //get bottom page
		  $page_id = $stylico_theme_options['mainpage']['bottom_page'];
		  $home_bottom_query = null;
		  $home_bottom_query = new WP_Query( array('page_id' => $page_id,
                                       'post_type' => 'page',
                                       'post_status' => 'publish',
                                       'posts_per_page' => 1,
                                       'caller_get_posts'=> 1) 
									   );
		  
		  //start loop						   
		  if ($home_bottom_query->have_posts()) : while ($home_bottom_query->have_posts()) : $home_bottom_query->the_post(); ?>
          
          <!-- Display bottom page -->
          <h2 class="post-title"><?php echo the_title(); ?></h2>
          <div class="entry-content"><?php the_content();  ?></div>
          
          <?php endwhile; ?>
          
          <?php else : ?>

          <!-- Display error when no page has been found -->
          <h2 class="post-title"><?php _e('No Page found!', 'stylico'); ?></h2>
          <div class="entry-content"><?php printf(__('Sorry, there is no page with an ID of %s. Please go to the theme options and select another page you would like to show here.', 'stylico'), $page_id); ?></div>
          
          <?php endif; wp_reset_query();?>
		  
		  </article>
      </section>

<?php get_footer(); ?>