<?php

function om_widget_recent_portfolio_init() {
	register_widget( 'om_widget_recent_portfolio' );
}
add_action( 'widgets_init', 'om_widget_recent_portfolio_init' );

/* Widget Class */

class om_widget_recent_portfolio extends WP_Widget {

	function __construct() {
	
		parent::__construct(
			'om_widget_recent_portfolio',
			__('Custom Recent Portfolio','om_theme'),
			array(
				'classname' => 'om_widget_recent_portfolio',
				'description' => __('The most recent portfolio items', 'om_theme')
			)
		);
	}

	/* Front-end display of widget. */
		
	function widget( $args, $instance ) {
		extract( $args );
	
		$title = apply_filters('widget_title', $instance['title'] );
		$instance['postcount'] = intval($instance['postcount']);
	
		echo $before_widget;
	
		if ( $title )
			echo $before_title . $title . $after_title;

		$arg=array (
			'post_type' => 'portfolio',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => $instance['postcount']
		);

		if($instance['randomize'] == 'true') {
			$arg['orderby']='rand';
		} else {
			$sort=get_option(OM_THEME_PREFIX . 'portfolio_sort');
			if($sort == 'date_asc') {
				$arg['orderby'] = 'date';
				$arg['order'] = 'ASC';
			} elseif($sort == 'date_desc') {
				$arg['orderby'] = 'date';
				$arg['order'] = 'DESC';
			}
		}
		
		
		if($instance['category'] != 0) {
			$arg['tax_query']=array(
				array('taxonomy'=>'portfolio-type', 'terms' => $instance['category']),
			);
		}
			
		$query = new WP_Query($arg);
		
    if ($query->have_posts()) {
    	?><div class="portfolio-small-preview"><?php
    	while ($query->have_posts()) {
    		$query->the_post();

				$link=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'portfolio_custom_link', true);
				if(!$link)
					$link=get_permalink();
					
    		?>
				<div class="portfolio-small-preview">
					<?php if(has_post_thumbnail()) { ?>
						<div class="pic"><a href="<?php echo $link ?>" class="show-hover-link"><?php the_post_thumbnail('portfolio-thumb'); ?><span class="after"></span></a></div>
					<?php } ?>
					<div class="title"><a href="<?php echo $link ?>"><?php the_title(); ?></a></div>
					<div class="tags fs-s"><?php the_terms(get_the_ID(), 'portfolio-type', '', ', ', ''); ?></div>
				</div>
				<?php
      }
      ?></div><?php
    }
	
		wp_reset_query();
	
		echo $after_widget;
	
	}


	/* Sanitize widget form values as they are saved. */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['postcount'] = $new_instance['postcount'];
		$instance['category'] = $new_instance['category'];
		$instance['randomize'] = $new_instance['randomize'];
			
		return $instance;
	}


	/* Back-end widget form. */
		 
	function form( $instance ) {
	
		// Set up some default widget settings
		$defaults = array(
			'title' => 'Recent Works',
			'postcount' => '2',
			'category' => 0,
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'om_theme') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of posts', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>

		<!-- Category: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Portfolio category:', 'om_theme') ?></label>
			<?php
				$args = array(
					'show_option_all'    => __('All Categories', 'om_theme'),
					'show_option_none'   => __('No Categories', 'om_theme'),
					'hide_empty'         => 0, 
					'echo'               => 1,
					'selected'           => $instance['category'],
					'hierarchical'       => 0, 
					'name'               => $this->get_field_name( 'category' ),
					'id'         		     => $this->get_field_id( 'category' ),
					'class'              => '',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'portfolio-type',
					'hide_if_empty'      => false 	
				);
		
				wp_dropdown_categories( $args );

			?>
		</p>
		
		<!-- Randomize: Check Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'randomize' ); ?>"><?php _e('Randomize items', 'om_theme') ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'randomize' ); ?>" name="<?php echo $this->get_field_name( 'randomize' ); ?>" value="true" <?php if( $instance['randomize'] == 'true') echo 'checked="checked"'; ?> />
		</p>
					
	<?php
	}
}
?>