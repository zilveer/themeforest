<?php

class portfolio_categories extends WP_Widget

{

    function __construct()

    {

        $widget_ops = array( 

            'classname' => 'portfolio-categories', 

            'description' => __('Get list of portfolio categories, created on portfolio custom type.', 'yit') 

        );



        $control_ops = array( 'id_base' => 'portfolio-categories' );



        WP_Widget::__construct( 'portfolio-categories', 'Portfolio Categories', $widget_ops, $control_ops );

    }

    

    function form( $instance )

    {

        /* Impostazioni di default del widget */

        $defaults = array( 

            'title' => 'Portfolio Categories',
            'project_post_type' => 0

        );

        

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p><label>

            <strong><?php _e( 'Widget Title', 'yit' ) ?>:</strong><br />

            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />

        </label></p>                     

        <p>

            <label for="<?php echo $this->get_field_id( 'project_post_type' ); ?>">Portfolio:

                 <select id="<?php echo $this->get_field_id( 'project_post_type' ); ?>" name="<?php echo $this->get_field_name( 'project_post_type' ); ?>">
					 <?php $portfolios = yit_portfolios(); ?>
					 <?php foreach( $portfolios as $portfolio ): ?>
					 	 <option value="<?php echo $portfolio->ID ?>"<?php if($portfolio->ID == $instance['project_post_type']): ?> selected="selected"<?php endif ?>><?php echo $portfolio->post_title ? $portfolio->post_title : 'Portfolio ID: ' . $portfolio->ID ?></option>
					 <?php endforeach ?>
                 </select>

            </label>

        </p>       

        <p><?php _e( 'Show a list of portfolio categories, for portfolio custom types.', 'yit' ) ?></p>

        <?php

    }

    

    function widget( $args, $instance )

    {                                                

        extract( $args );



        $title = apply_filters('widget_title', $instance['title'] );     

        $project_post_types = isset( $instance['project_post_type']) ? $instance['project_post_type'] : 0;

        

        echo $before_widget;

        echo $before_title . $title . $after_title;    
        
        
        $portfolios = yit_portfolios(); 

        
		if( $project_post_types ) {
	        
			$i = 0;
	        foreach( $portfolios as $portfolio ) {
	        	if($portfolio->ID == $project_post_types) { ?>
	        		
	        		
	        		
				<ul id="gallery_categories_widget" class="<?php if( 1 && yit_portfolio_get_setting('filter_active', $portfolio->ID) ): ?> gallery-categories-quicksand<?php else: ?> gallery-categories-disabled<?php endif ?>">
					<?php $cats = yit_portfolio_get_setting( 'categories', $portfolio->ID ) ?>
					<li class="segment-1"><a data-value="all" href="<?php echo get_post_permalink($portfolio->ID) ?>"><?php _e('All', 'yit') ?></a></li>
	        		<?php if (isset($cats) && $cats != '') : ?>
						<?php foreach( $cats as $cat=>$name ): ?>
				         	<?php if( yit_work_items_in_category($cat, $portfolio->ID) ): ?>
				           		<li class="segment-<?php echo ++$i ?>"><a href="<?php echo esc_url( add_query_arg('cat', $cat, get_post_permalink($portfolio->ID)) ) ?>" data-value="<?php echo strtolower(preg_replace('/\s+/', '-', $cat)) ?>"><?php echo $name ?></a></li>
							<?php endif ?>
						<?php endforeach ?>
					<?php endif ?>
				</ul>
				<?php break;
	        	}
	        }
		}    


        echo $after_widget;

    }                     



    function update( $new_instance, $old_instance ) 

    {

        $instance = $old_instance;



        $instance['title'] = strip_tags( $new_instance['title'] );          
         
        $instance['project_post_type'] = $new_instance['project_post_type'];



        return $instance;

    }

    

}     

?>