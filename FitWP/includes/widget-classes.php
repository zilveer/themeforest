<?php
/*
 * Plugin Name: DD Classes Widget
 * Plugin URI: http://themeforest.net/user/DDStudios/portfolio
 * Description: A widget that displays recent classes
 * Version: 1.0
 * Author: Dany Duchaine
 * Author URI: http://themeforest.net/user/DDStudios/
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'dd_classes_widgets' );

/*
 * Register widget.
 */
function dd_classes_widgets() {
	register_widget( 'DD_Classes_Widget' );
}

/*
 * Widget class.
 */
class dd_classes_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function DD_Classes_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'dd_classes_widget', 'description' => __('A widget that displays your latest classes.', 'localization') );

		 /* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dd_classes_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'dd_classes_widget', __('DD Classes Widget','localization'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
                $title = apply_filters('widget_title', $instance['title'] );
	$categories = $instance['categories'];
		$postcount = $instance['postcount'];
                $viewall = $instance['viewall'];
	
		/* Before widget (defined by themes). */
 
              
                
         
                
		
              	/* Before widget (defined by themes). */
        echo $before_widget;
                
         
             
        	
        ?>

  <h3>
      
      <?php echo $title ?>
      
      
           <?php if ($viewall != '') { ?>
                    

                  <span class="viewall"><a href="<?php echo $viewall ?>"><?php _e('view all', 'localization'); ?></a></span>
                  
                                <?php } ?>
      
  
  </h3>
                    
              
                  
                
                     <ul class="classesPost dd_classes_widget clearfix ">
                    
                         
                                           
                 <?php if (($categories  == '0') || ($categories  === '')) { ?>
                                                   
                       <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$arguments = array(
    'post_type' => 'post_classes',
    'post_status' => 'publish',
    'paged' => $paged,
    'showposts' => $postcount
);


$classes_query = new WP_Query($arguments);

dd_set_query($classes_query);

?>
                                                   
                                                               <?php } else { ?>
                                                   
                                                               <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;



          $arguments = array(
                        'posts_per_page' => $postcount,
               'post_status' => 'publish',
    'paged' => $paged,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'classes_item_types',
                                        'field' => 'id',
                                        'terms' => $categories
                                )
                        )
                );
          
$classes_query = new WP_Query($arguments);

dd_set_query($classes_query);

?>               
                                                               <?php } ?>   
                     
                       <?php if ($classes_query->have_posts()) : while ($classes_query->have_posts()) : $classes_query->the_post(); ?>
                      
                        <li>
                            
                              <?php 

$thumbimg = get_post_meta(get_the_ID(), 'thumbimg', true);


?>
                            
                            <div class="wrapper">
                                
                                
                                <?php if( $thumbimg) { ?>
                                
                                  <div class="postThumb"><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbimg; ?>" alt="" /></a></div>
    
      <?php } ?>
                                
                                
                            
                            <div class="postDetails">
                                
                                <a href="<?php the_permalink(); ?>" class="postTitle"><h1><?php the_title(); ?></h1></a>
                                <?php the_excerpt(); ?>
                                 <a class="button-small-theme rounded3" href="<?php the_permalink(); ?>"><?php _e('MORE INFO', 'localization'); ?></a>
                                
                            </div>
                                
                            </div>
                            
                        </li>
                        
           
      <?php endwhile; ?>
                    
                

<?php endif; ?>
                     
                </ul>
                    
          



		<?php 

		/* After widget (defined by themes). */
                
		
        echo $after_widget;
                
         
		
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
                $instance['title'] = strip_tags( $new_instance['title'] );
                  $instance['categories'] = strip_tags( $new_instance['categories'] );
	
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
                $instance['viewall'] = strip_tags( $new_instance['viewall'] );
		

		/* No need to strip tags for.. */

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
                'title' => 'OUR CLASSES',
                 'categories' => 'ALL',

		'postcount' => '5',
				);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

            
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of posts', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
                
                     <p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">
					<?php _e('Category:', 'ototw'); ?>
					<br />
			</label>
			
			<?php wp_dropdown_categories( 
				array( 
					'name' => $this->get_field_name("categories"), 
					'selected' => $instance["categories"], 
					'taxonomy'  => 'classes_item_types',
                                        'show_option_all' => 'All',
										'hide_if_empty' => 1
				) 
			); ?>
			
		</p>
                
                <!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'viewall' ); ?>"><?php _e('"View All" button URL', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'viewall' ); ?>" name="<?php echo $this->get_field_name( 'viewall' ); ?>" value="<?php echo $instance['viewall']; ?>" />
		</p>
		
		<!-- Tweettext: Text Input -->
				
	<?php
	}
}
?>