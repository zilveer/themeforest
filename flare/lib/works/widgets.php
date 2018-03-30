<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 *
 * 1. class BTP_Custom_Works_Widget
 * 2. class BTP_Popular_Works_Widget
 * 3. class BTP_Recent_Works_Widget
 * 4. class BTP_Related_Works_Widget
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* Function called by action/hook 'widgets_init' */
function btp_work_init_custom_works_widget() {
	register_widget( 'BTP_Custom_Works_Widget' );
}
add_action( 'widgets_init', 'btp_work_init_custom_works_widget' );



class BTP_Custom_Works_Widget extends WP_Widget {
	
	function BTP_Custom_Works_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_custom_works', 'description' => __('Custom works based on ids', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_custom_works_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_custom_works_widget', __('BTP Custom Works', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Start composing output */
		$out = '';
				
		/* Before widget (defined by themes). */
		$out .= $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			$out .= $before_title . $title . $after_title;
		
		$shortcode = '[custom_works ';
			$shortcode .= 'entry_ids="'.$instance['entry_ids'].'" ';
			$shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_featured_media'] ? 'featured_media,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$shortcode .= 'hide="'.$hide.'" ';
		$shortcode .= ']';	
			
		$out .= do_shortcode($shortcode);		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['entry_ids'] 			= strip_tags( $new_instance['entry_ids'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_featured_media']= btp_bool($new_instance['hide_featured_media']);
		$instance['hide_date'] 			= btp_bool($new_instance['hide_date']);
		$instance['hide_comments_link']	= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories']	= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags']			= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);
		
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		
		$templates = btp_work_get_collection_templates();

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Featured works', 'btp_theme'),
			'entry_ids'				=> '',
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_featured_media'	=> false,
			'hide_date'				=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'entry_ids' ); ?>"><?php _e('Entry IDs', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'entry_ids' ); ?>" name="<?php echo $this->get_field_name( 'entry_ids' ); ?>" value="<?php echo $instance['entry_ids']; ?>" style="width:100%;" /><br />
			<span class="description"><?php _e( 'Comma separated list of entry IDs', 'btp_theme' ); ?></span>
		</p>		
	
		<p>			
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>		
		
		<p>
			<?php _e( 'Hide collection elements:', 'btp_theme'); ?>
			<br />
			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php echo 'title'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>" name="<?php echo $this->get_field_name( 'hide_featured_media' ); ?>" value="true" <?php if($instance['hide_featured_media']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>"><?php echo 'featured_media'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php echo 'date'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php echo 'comments_link'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php echo 'summary'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php echo 'categories'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php echo 'tags'; ?></label>
			<br />			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php echo 'button_1'; ?></label>
		</p>
	<?php
	}
}



/* Function called by action/hook 'widgets_init' */
function btp_work_init_popular_works_widget() {
	register_widget( 'BTP_Popular_Works_Widget' );
}
add_action( 'widgets_init', 'btp_work_init_popular_works_widget' );




class BTP_Popular_Works_Widget extends WP_Widget {
	
	function BTP_Popular_Works_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_popular_works', 'description' => __('The most popular works on your site based on comment count', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_popular_works_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_popular_works_widget', __('BTP Popular Works', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Start composing output */
		$out = '';
				
		/* Before widget (defined by themes). */
		$out .= $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			$out .= $before_title . $title . $after_title;
		
		$shortcode = '[popular_works ';
			$shortcode .= 'max="'.$instance['max'].'" ';
			$shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_featured_media'] ? 'featured_media,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$shortcode .= 'hide="'.$hide.'" ';
		$shortcode .= ']';	
			
		$out .= do_shortcode($shortcode);		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['max'] 				= absint( $new_instance['max'] );
		$instance['template'] 			= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 		= btp_bool($new_instance['hide_title']);
		$instance['hide_featured_media']= btp_bool($new_instance['hide_featured_media']);
		$instance['hide_date'] 			= btp_bool($new_instance['hide_date']);
		$instance['hide_comments_link']	= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories']	= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags']			= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 		= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 		= btp_bool($new_instance['hide_button_1']);

		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		$templates = btp_work_get_collection_templates();

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Popular works', 'btp_theme'),
			'max'					=> 1,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_featured_media'	=> false,
			'hide_date'				=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,		
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum entries to display', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
		</p>
		
		<p>		
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<?php _e( 'Hide collection elements:', 'btp_theme'); ?>
			<br />
			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php echo 'title'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>" name="<?php echo $this->get_field_name( 'hide_featured_media' ); ?>" value="true" <?php if($instance['hide_featured_media']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>"><?php echo 'featured_media'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php echo 'date'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php echo 'comments_link'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php echo 'summary'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php echo 'categories'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php echo 'tags'; ?></label>
			<br />			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php echo 'button_1'; ?></label>
		</p>
	<?php
	}	
}



/* Function called by action/hook 'widgets_init' */
function btp_work_init_recent_works_widget() {
	register_widget( 'BTP_Recent_Works_Widget' );
}
add_action( 'widgets_init', 'btp_work_init_recent_works_widget' );


class BTP_Recent_Works_Widget extends WP_Widget {
	
	function BTP_Recent_Works_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_recent_works', 'description' => __('The most recent works on your site', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_recent_works_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_recent_works_widget', __('BTP Recent Works', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Start composing output */
		$out = '';
				
		/* Before widget (defined by themes). */
		$out .= $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			$out .= $before_title . $title . $after_title;
		
		$shortcode = '[recent_works ';
			$shortcode .= 'cat="'.$instance['cat'].'" ';
			$shortcode .= 'max="'.$instance['max'].'" ';
			$shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_featured_media'] ? 'featured_media,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$shortcode .= 'hide="'.$hide.'" ';
		$shortcode .= ']';
		
		$out .= do_shortcode( $shortcode );		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] 					= strip_tags( $new_instance['title'] );
		$instance['cat'] 					= strip_tags( $new_instance['cat'] );
		$instance['max'] 					= absint( $new_instance['max'] );
		$instance['template'] 				= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 			= btp_bool($new_instance['hide_title']);
		$instance['hide_featured_media'] 	= btp_bool($new_instance['hide_featured_media']);
		$instance['hide_date'] 				= btp_bool($new_instance['hide_date']);
		$instance['hide_comments_link']		= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories']		= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags']				= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 			= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 			= btp_bool($new_instance['hide_button_1']);

		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {
		$templates = btp_work_get_collection_templates();

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Recent works', 'btp_theme'),
			'cat'					=> '',
			'max'					=> 1,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_featured_media'	=> false,
			'hide_date'				=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,		
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Work category slug (optional)', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" value="<?php echo $instance['cat']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum entries to display', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
		</p>
		
		<p>		
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<?php _e( 'Hide collection elements:', 'btp_theme'); ?>
			<br />
			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php echo 'title'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>" name="<?php echo $this->get_field_name( 'hide_featured_media' ); ?>" value="true" <?php if($instance['hide_featured_media']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>"><?php echo 'featured_media'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php echo 'date'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php echo 'comments_link'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php echo 'summary'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php echo 'categories'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php echo 'tags'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php echo 'button_1'; ?></label>
		</p>
	<?php
	}
}



/* Function called by action/hook 'widgets_init' */
function btp_work_init_related_works_widget() {
	register_widget( 'BTP_Related_Works_Widget' );
}
add_action( 'widgets_init', 'btp_work_init_related_works_widget' );



class BTP_Related_Works_Widget extends WP_Widget {
	
	function BTP_Related_Works_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_related_works', 'description' => __('Related works based on relation tags', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_related_works_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_related_works_widget', __('BTP Related Works', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Start composing output */
		$out = '';
				
		/* Before widget (defined by themes). */
		$out .= $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			$out .= $before_title . $title . $after_title;
		
		$shortcode = '[related_works ';
			$shortcode .= 'entry_id="'.$instance['entry_id'].'" ';
			$shortcode .= 'max="'.$instance['max'].'" ';
			$shortcode .= 'template="'.$instance['template'].'" ';
			
			$hide = '';
			$hide .= $instance['hide_title'] ? 'title,' : '';
			$hide .= $instance['hide_featured_media'] ? 'featured_media,' : '';
			$hide .= $instance['hide_date'] ? 'date,' : '';
			$hide .= $instance['hide_comments_link'] ? 'comments_link,' : '';
			$hide .= $instance['hide_categories'] ? 'categories,' : '';
			$hide .= $instance['hide_tags'] ? 'tags,' : '';
			$hide .= $instance['hide_summary'] ? 'summary,' : '';
			$hide .= $instance['hide_button_1'] ? 'button_1,' : '';
			$hide = trim($hide, ",");
			
			$shortcode .= 'hide="'.$hide.'" ';
		$shortcode .= ']';	
			
		$out .= do_shortcode( $shortcode );		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance['title'] 					= strip_tags( $new_instance['title'] );
		$instance['entry_id'] 				= strip_tags( $new_instance['entry_id'] );
		$instance['max'] 					= absint( $new_instance['max'] );
		$instance['template'] 				= strip_tags( $new_instance['template'] );		
		$instance['hide_title'] 			= btp_bool($new_instance['hide_title']);
		$instance['hide_featured_media']	= btp_bool($new_instance['hide_featured_media']);
		$instance['hide_date'] 				= btp_bool($new_instance['hide_date']);
		$instance['hide_comments_link']		= btp_bool($new_instance['hide_comments_link']);
		$instance['hide_categories']		= btp_bool($new_instance['hide_categories']);
		$instance['hide_tags']				= btp_bool($new_instance['hide_tags']);
		$instance['hide_summary'] 			= btp_bool($new_instance['hide_summary']);
		$instance['hide_button_1'] 			= btp_bool($new_instance['hide_button_1']);

		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {

		$templates = btp_work_get_collection_templates();
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 				=> __('Related works', 'btp_theme'),
			'entry_id'				=> '',
			'max'					=> 1,
			'template'				=> key($templates),			
			'hide_title'			=> false,
			'hide_featured_media'	=> false,
			'hide_date'				=> false,
			'hide_comments_link'	=> false,
			'hide_categories'		=> false,
			'hide_tags'				=> false,		
			'hide_summary'			=> false,
			'hide_button_1'			=> false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'entry_id' ); ?>"><?php _e('Related entry ID (optional)', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'entry_id' ); ?>" name="<?php echo $this->get_field_name( 'entry_id' ); ?>" value="<?php echo $instance['entry_id']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum entries to display', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
		</p>
		
		<p>			
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template', 'btp_theme'); ?>:</label>			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" style="width:100%;">
				<?php foreach($templates as $key => $value): ?>
					<?php if($key == $instance['template']): ?>
						<option selected="selected" value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>	
			</select>			 
		</p>
		
		<p>
			<?php _e( 'Hide collection elements:', 'btp_theme'); ?>
			<br />
			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" value="true" <?php if($instance['hide_title']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php echo 'title'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>" name="<?php echo $this->get_field_name( 'hide_featured_media' ); ?>" value="true" <?php if($instance['hide_featured_media']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_featured_media' ); ?>"><?php echo 'featured_media'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" value="true" <?php if($instance['hide_date']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_date' ); ?>"><?php echo 'date'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>" name="<?php echo $this->get_field_name( 'hide_comments_link' ); ?>" value="true" <?php if($instance['hide_comments_link']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_comments_link' ); ?>"><?php echo 'comments_link'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_summary' ); ?>" name="<?php echo $this->get_field_name( 'hide_summary' ); ?>" value="true" <?php if($instance['hide_summary']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_summary' ); ?>"><?php echo 'summary'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_categories' ); ?>" name="<?php echo $this->get_field_name( 'hide_categories' ); ?>" value="true" <?php if($instance['hide_categories']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_categories' ); ?>"><?php echo 'categories'; ?></label>
			<br />
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_tags' ); ?>" name="<?php echo $this->get_field_name( 'hide_tags' ); ?>" value="true" <?php if($instance['hide_tags']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_tags' ); ?>"><?php echo 'tags'; ?></label>
			<br />			
			<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'hide_button_1' ); ?>" name="<?php echo $this->get_field_name( 'hide_button_1' ); ?>" value="true" <?php if($instance['hide_button_1']) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_button_1' ); ?>"><?php echo 'button_1'; ?></label>
		</p>
	<?php
	}
}
?>