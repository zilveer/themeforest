<?php 
/**
  * Ads Widgets
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

/**
 * ads 120 x 240  Widget 
 **********************************************************************/

add_action( 'widgets_init', 'van_ads120_240_init' );
function van_ads120_240_init() {
	register_widget('van_ads120_240');
}

class van_ads120_240 extends WP_Widget {
	function van_ads120_240() {
		$options = array('classname' => 'ads120_240-widget','description' => 'Ads 120 x 240 widget');
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_240-widget' );
		$this->WP_Widget( 'ads120_240-widget','( '.THEME_NAME .' ) - Ads 120x240', $options, $control);
	}
	function widget( $args, $instance ) {
		extract( $args );

		$title          = apply_filters('widget_title', $instance['title'] );
		$new_tab    = ( $instance['new_tab'] ) ? 'target="_blank"' : '';
		$show_bg    = $instance['show_bg'];
		$one_column = ( $instance['one_column'] ) ? 'one_column' : '' ;
		$ads_bg	  = ($show_bg) ? "ads-trs" : "";

		if( !$show_bg ){
			echo  $before_widget . $before_title . $title . $after_title;
		}else{
			echo "<div class=\"widget\">";
		}
		?>
		<div class="ads120-240 <?php echo $one_column; ?>  <?php echo $ads_bg; ?>">
		<?php for ($i=1; $i<3 ; $i++):?>
		<?php if( isset($instance['code_'.$i]) and $instance['code_'.$i] !== "")  { ?>
		  		<div class="ads-content"><?php echo $instance['code_'.$i]; ?></div>
		<?php } elseif(isset($instance['img_'.$i]) and $instance['img_'.$i] !== "") { ?>
		  		<div class="ads-content"><a href="<?php echo esc_url( $instance['link_'.$i] ); ?>" <?php echo $new_tab; ?> ><img src="<?php echo $instance['img_'.$i] ?>" alt="" /></a></div>
		<?php } ?>
		<?php endfor; ?>
		<div class="clear"></div>
		</div>
		
		<?php
		 if(!$show_bg) {
			echo $after_widget;
		}else{
			echo "</div> <!-- .widget -->";
		}
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['show_bg']    = strip_tags( $new_instance['show_bg'] );
		$instance['new_tab'] 	= strip_tags( $new_instance['new_tab'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		for($i=1 ; $i<3 ; $i++ ){ 
			$instance['img_'.$i]  = strip_tags( $new_instance['img_'.$i] );
			$instance['link_'.$i] = strip_tags( $new_instance['link_'.$i] );
			$instance['code_'.$i] =  $new_instance['code_'.$i] ;
		}
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' =>__( 'advertisement' , 'van'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'van') ?></label>
			<input  class="widefat" type="text"id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_bg' ); ?>">Transparent background  ( hide title):</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_bg' ); ?>" name="<?php echo $this->get_field_name( 'show_bg' ); ?>" value="true" <?php if( isset( $instance['show_bg'] ) && $instance['show_bg'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>">Show one column :</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( isset( $instance['one_column'] ) && $instance['one_column'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>">Open links in a new tab:</label>
			<input  type="checkbox" id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="true" <?php if( isset( $instance['new_tab'] ) && $instance['new_tab'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<?php for($i=1 ; $i<3 ; $i++ ): ?>
		<span style="display:block; font-weight:bold; padding:10px; border-top:2px solid #cacaca;">ADS <?php if( isset($i) ){ echo $i; } ?> :</span>
		<p>
			<label for="<?php echo $this->get_field_id( 'img_'.$i ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> image patch : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'img_'.$i ); ?>" name="<?php echo $this->get_field_name( 'img_'.$i ); ?>" value="<?php if( isset( $instance['img_'.$i] ) ){ echo esc_attr( $instance['img_'.$i] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_'.$i  ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> link : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'link_'.$i); ?>" name="<?php echo $this->get_field_name( 'link_'.$i ); ?>" value="<?php if( isset( $instance['link_'.$i] ) ){ echo esc_attr( $instance['link_'.$i] ); } ?>" />
		</p>
		<strong style="max-width:250px; margin:0 auto; "> OR : </strong>
		<p>
			<label for="<?php echo $this->get_field_id( 'code_'.$i ); ?>"> Ads <?php if( isset($i) ){ echo $i; } ?> Code </label>
			<textarea  class="widefat" id="<?php echo $this->get_field_id( 'code_'.$i  ); ?>" name="<?php echo $this->get_field_name( 'code_'.$i  ); ?>" ><?php if( isset( $instance['code_'.$i] ) ){ echo $instance['code_'.$i]; } ?></textarea>
		</p>
		<?php endfor; ?>


		<?php	
	}
}
/**
 * ads 125 x 125 Widget
 **********************************************************************/
add_action( 'widgets_init', 'van_ads125_125_init' );
function van_ads125_125_init() {
	register_widget('van_ads125_125');
}

class van_ads125_125 extends WP_Widget {

	function van_ads125_125() {
		$options = array('classname' => 'ads125_125-widget','description' => 'Ads 125 x 125 widget');
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads125_125-widget' );
		$this->WP_Widget( 'ads125_125-widget','( '.THEME_NAME .' ) - Ads 125x125', $options, $control);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title      = apply_filters('widget_title', $instance['title'] );
		$new_tab    = ( $instance['new_tab'] ) ? 'target="_blank"' : '';
		$show_bg    = $instance['show_bg'];
		$one_column = ( $instance['one_column'] ) ? 'one_column' : '' ;
		$ads_bg		= ($show_bg) ? "ads-trs" : "";
		if( !$show_bg ){
			echo  $before_widget . $before_title . $title . $after_title;
		}else{
			echo "<div class=\"widget\">";
		}
		?>
		<div class="ads125-125 <?php echo $one_column; ?> <?php echo $ads_bg; ?>">
			<?php for ($i=1; $i<7 ; $i++):?>
				  <?php if( isset($instance['code_'.$i]) and $instance['code_'.$i] !== "")  { ?>
				  		<div class="ads-content"><?php echo $instance['code_'.$i]; ?></div>
				  <?php } elseif(isset($instance['img_'.$i]) and $instance['img_'.$i] !== "") { ?>
				  		<div class="ads-content"><a href="<?php echo esc_url( $instance['link_'.$i] ); ?>" <?php echo $new_tab; ?> ><img src="<?php echo $instance['img_'.$i] ?>" alt="" /></a></div>
				  <?php } ?>
			<?php endfor; ?>
			<div class="clear"></div>
		</div>
		<?php
		 if(!$show_bg) {
			echo $after_widget;
		}else{
			echo "</div> <!-- .widget -->";
		}
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['show_bg']    = strip_tags( $new_instance['show_bg'] );
		$instance['new_tab'] 	= strip_tags( $new_instance['new_tab'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		for($i=1 ; $i<7 ; $i++ ){ 
			$instance['img_'.$i]  = strip_tags( $new_instance['img_'.$i] );
			$instance['link_'.$i] = strip_tags( $new_instance['link_'.$i] );
			$instance['code_'.$i] =  $new_instance['code_'.$i] ;
		}
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' =>__( 'advertisement' , 'van'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'van') ?></label>
			<input  class="widefat" type="text"id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_bg' ); ?>">Transparent background  ( hide title):</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_bg' ); ?>" name="<?php echo $this->get_field_name( 'show_bg' ); ?>" value="true" <?php if( isset( $instance['show_bg'] ) && $instance['show_bg'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>">Show one column :</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( isset( $instance['one_column'] ) && $instance['one_column'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>">Open links in a new tab:</label>
			<input  type="checkbox" id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="true" <?php if( isset( $instance['new_tab'] ) && $instance['new_tab'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<?php for($i=1 ; $i<7 ; $i++ ): ?>
		<span style="display:block; font-weight:bold; padding:10px; border-top:2px solid #cacaca;">ADS <?php if( isset($i) ){ echo $i; } ?> :</span>
		<p>
			<label for="<?php echo $this->get_field_id( 'img_'.$i ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> image patch : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'img_'.$i ); ?>" name="<?php echo $this->get_field_name( 'img_'.$i ); ?>" value="<?php if( isset( $instance['img_'.$i] ) ){ echo esc_attr( $instance['img_'.$i] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_'.$i  ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> link : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'link_'.$i); ?>" name="<?php echo $this->get_field_name( 'link_'.$i ); ?>" value="<?php if( isset( $instance['link_'.$i] ) ){ echo esc_attr( $instance['link_'.$i] ); } ?>" />
		</p>
		<strong style="max-width:250px; margin:0 auto; "> OR : </strong>
		<p>
			<label for="<?php echo $this->get_field_id( 'code_'.$i ); ?>"> Ads <?php if( isset($i) ){ echo $i; } ?> Code </label>
			<textarea  class="widefat" id="<?php echo $this->get_field_id( 'code_'.$i  ); ?>" name="<?php echo $this->get_field_name( 'code_'.$i  ); ?>" ><?php if( isset( $instance['code_'.$i] ) ){ echo $instance['code_'.$i]; } ?></textarea>
		</p>
		<?php endfor; ?>


		<?php	
	}
}

 /**
 * ads 160 x 600 Widget
 **********************************************************************/ 

add_action( 'widgets_init', 'van_ads160_600_init' );
function van_ads160_600_init() {
	register_widget('van_ads160_600');
}

class van_ads160_600 extends WP_Widget {

	function van_ads160_600() {
		$options = array('classname' => 'ads160_600-widget','description' => 'Ads 160 x 600 widget');
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads160_600-widget' );
		$this->WP_Widget( 'ads160_600-widget','( '.THEME_NAME .' ) - Ads 160x600', $options, $control);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title      = apply_filters('widget_title', $instance['title'] );
		$new_tab    = ( $instance['new_tab'] ) ? 'target="_blank"' : '';
		$show_bg    = $instance['show_bg'];
		$ads_bg		= ($show_bg) ? "ads-trs" : "";
		if( !$show_bg ){
			echo  $before_widget . $before_title . $title . $after_title;
		}else{
			echo "<div class=\"widget\">";
		}
		?>
		<div class="ads160-600 <?php echo $ads_bg; ?>">
		  <?php if( isset($instance['code']) and $instance['code'] !== "")  { ?>
		  		<div class="ads-content"><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></div>
		  <?php } elseif(isset($instance['img']) and $instance['img'] !== "") { ?>
		  		<div class="ads-content"><a href="<?php echo esc_url( $instance['link'] ); ?>" <?php echo $new_tab; ?> ><img src="<?php echo $instance['img'] ?>" alt="" /></a></div>
		  <?php } ?>
		<div class="clear"></div>
		</div>
		<?php
		 if(!$show_bg) {
			echo $after_widget;
		}else{
			echo "</div> <!-- .widget -->";
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['show_bg']    = strip_tags( $new_instance['show_bg'] );
		$instance['new_tab'] 	= strip_tags( $new_instance['new_tab'] );
		$instance['img']  = strip_tags( $new_instance['img'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['code'] =  $new_instance['code'] ;
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'advertisement' , 'van'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'van') ?></label>
			<input  class="widefat" type="text"id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_bg' ); ?>">Transparent background  ( hide title):</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_bg' ); ?>" name="<?php echo $this->get_field_name( 'show_bg' ); ?>" value="true" <?php if( isset( $instance['show_bg'] ) && $instance['show_bg'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>">Open links in a new tab:</label>
			<input  type="checkbox" id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="true" <?php if( isset( $instance['new_tab'] ) && $instance['new_tab'] ){ echo 'checked="checked"'; } ?>  />
		</p>

		<span style="display:block; font-weight:bold; padding:10px; border-top:2px solid #cacaca;">ADS <?php if( isset($i) ){ echo $i; } ?> :</span>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> image patch : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['img'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link'  ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> link : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'link'); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['link'] ); } ?>" />
		</p>
		<strong style="max-width:250px; margin:0 auto; "> OR : </strong>
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"> Ads <?php if( isset($i) ){ echo $i; } ?> Code </label>
			<textarea  class="widefat" id="<?php echo $this->get_field_id( 'code'  ); ?>" name="<?php echo $this->get_field_name( 'code'  ); ?>" ><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></textarea>
		</p>
		<?php	
	}
}
 /**
 *  ads 250 x 250 Widget
 **********************************************************************/
add_action( 'widgets_init', 'van_ads250_250_init' );
function van_ads250_250_init() {
	register_widget('van_ads250_250');
}

class van_ads250_250 extends WP_Widget {

	function van_ads250_250() {
		$options = array('classname' => 'ads250_250-widget','description' => 'Ads 250 x 250 widget');
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads250_250-widget' );
		$this->WP_Widget( 'ads250_250-widget','( '.THEME_NAME .' ) - Ads 250x250', $options, $control);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title      = apply_filters('widget_title', $instance['title'] );
		$new_tab    = ( $instance['new_tab'] ) ? 'target="_blank"' : '';
		$show_bg    = $instance['show_bg'];
		$ads_bg		= ($show_bg) ? "ads-trs" : "";
		if( !$show_bg ){
			echo  $before_widget . $before_title . $title . $after_title;
		}else{
			echo "<div class=\"widget\">";
		}
		?>
		<div class="ads250-250 <?php echo $ads_bg; ?>">
		  <?php if( isset($instance['code']) and $instance['code'] !== "")  { ?>
		  		<div class="ads-content"><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></div>
		  <?php } elseif(isset($instance['img']) and $instance['img'] !== "") { ?>
		  		<div class="ads-content"><a href="<?php echo esc_url( $instance['link'] ); ?>" <?php echo $new_tab; ?> ><img src="<?php echo $instance['img'] ?>" alt="" /></a></div>
		  <?php } ?>
		</div>
		<?php
		 if(!$show_bg) {
			echo $after_widget;
		}else{
			echo "</div> <!-- .widget -->";
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['show_bg']    = strip_tags( $new_instance['show_bg'] );
		$instance['new_tab'] 	= strip_tags( $new_instance['new_tab'] );
		$instance['img']  = strip_tags( $new_instance['img'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['code'] =  $new_instance['code'] ;
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array( 'title' =>__( 'advertisement' , 'van'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'van') ?></label>
			<input  class="widefat" type="text"id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_bg' ); ?>">Transparent background  ( hide title):</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_bg' ); ?>" name="<?php echo $this->get_field_name( 'show_bg' ); ?>" value="true" <?php if( isset( $instance['show_bg'] ) && $instance['show_bg'] ){ echo 'checked="checked"'; } ?>  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>">Open links in a new tab:</label>
			<input  type="checkbox" id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="true" <?php if( isset( $instance['new_tab'] ) && $instance['new_tab'] ){ echo 'checked="checked"'; } ?>  />
		</p>

		<span style="display:block; font-weight:bold; padding:10px; border-top:2px solid #cacaca;">ADS <?php if( isset($i) ){ echo $i; } ?> :</span>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> image patch : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['img'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link'  ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> link : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'link'); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['link'] ); } ?>" />
		</p>
		<strong style="max-width:250px; margin:0 auto; "> OR : </strong>
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"> Ads <?php if( isset($i) ){ echo $i; } ?> Code </label>
			<textarea  class="widefat" id="<?php echo $this->get_field_id( 'code'  ); ?>" name="<?php echo $this->get_field_name( 'code'  ); ?>" ><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></textarea>
		</p>


		<?php	
	}
}
 /**
 * ads 300 x 250 Widget 
 **********************************************************************/
add_action( 'widgets_init', 'van_ads300_250_init' );
function van_ads300_250_init() {
	register_widget('van_ads300_250');
}
class van_ads300_250 extends WP_Widget {
	function van_ads300_250() {
		$options = array('classname' => 'ads300_250-widget','description' => 'Ads 300 x 250 widget');
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_250-widget' );
		$this->WP_Widget( 'ads300_250-widget','( '.THEME_NAME .' ) - Ads 300x250', $options, $control);
	}
	function widget( $args, $instance ) {
		extract( $args );
		$new_tab    = ( $instance['new_tab'] ) ? 'target="_blank"' : '';
		echo "<div class=\"widget\">";
		?>
		<div class="ads300-250 ads-trs">
		  <?php if( isset($instance['code']) and $instance['code'] !== "")  { ?>
		  		<div class="ads-content"><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></div>
		  <?php } elseif(isset($instance['img']) and $instance['img'] !== "") { ?>
		  		<div class="ads-content"><a href="<?php echo esc_url( $instance['link'] ); ?>" <?php echo $new_tab; ?> ><img src="<?php echo $instance['img'] ?>" alt="" /></a></div>
		  <?php } ?>
		</div>
		<?php
		echo "</div> <!-- .widget -->";
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['new_tab'] 	= strip_tags( $new_instance['new_tab'] );
		$instance['img']  = strip_tags( $new_instance['img'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['code'] =  $new_instance['code'] ;
		return $instance;
	}
	function form( $instance ) {
		$defaults = array();
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>">Open links in a new tab:</label>
			<input  type="checkbox" id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="true" <?php if( isset( $instance['new_tab'] ) && $instance['new_tab'] ){ echo 'checked="checked"'; } ?>  />
		</p>

		<span style="display:block; font-weight:bold; padding:10px; border-top:2px solid #cacaca;">ADS <?php if( isset($i) ){ echo $i; } ?> :</span>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> image patch : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['img'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link'  ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> link : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'link'); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['link'] ); } ?>" />
		</p>
		<strong style="max-width:250px; margin:0 auto; "> OR : </strong>
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"> Ads <?php if( isset($i) ){ echo $i; } ?> Code </label>
			<textarea  class="widefat" id="<?php echo $this->get_field_id( 'code'  ); ?>" name="<?php echo $this->get_field_name( 'code'  ); ?>" ><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></textarea>
		</p>


		<?php	
	}
}
 /**
 * ads 300 x 600 Widget 
 **********************************************************************/
add_action( 'widgets_init', 'van_ads300_600_init' );
function van_ads300_600_init() {
	register_widget('van_ads300_600');
}

class van_ads300_600 extends WP_Widget {
	function van_ads300_600() {
		$options = array('classname' => 'ads300_600-widget','description' => 'Ads 300 x 600 widget');
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_600-widget' );
		$this->WP_Widget( 'ads300_600-widget','( '. THEME_NAME  .' ) - Ads 300x600', $options, $control);
	}
	function widget( $args, $instance ) {
		extract( $args );
		$new_tab    = ( $instance['new_tab'] ) ? 'target="_blank"' : '';
		echo "<div class=\"widget\">";
		?>
		<div class="ads300-600 ads-trs">
		  <?php if( isset($instance['code']) and $instance['code'] !== "")  { ?>
		  		<div class="ads-content"><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></div>
		  <?php } elseif(isset($instance['img']) and $instance['img'] !== "") { ?>
		  		<div class="ads-content"><a href="<?php echo esc_url( $instance['link'] ); ?>" <?php echo $new_tab; ?> ><img src="<?php echo $instance['img'] ?>" alt="" /></a></div>
		  <?php } ?>
		</div>
		<?php
		echo "</div> <!-- .widget -->";
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['new_tab'] 	= strip_tags( $new_instance['new_tab'] );
		$instance['img']  = strip_tags( $new_instance['img'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['code'] =  $new_instance['code'] ;
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>">Open links in a new tab:</label>
			<input  type="checkbox" id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="true" <?php if( isset( $instance['new_tab'] ) && $instance['new_tab'] ){ echo 'checked="checked"'; } ?>  />
		</p>

		<span style="display:block; font-weight:bold; padding:10px; border-top:2px solid #cacaca;">ADS <?php if( isset($i) ){ echo $i; } ?> :</span>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> image patch : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['img'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link'  ); ?>">Ads <?php if( isset($i) ){ echo $i; } ?> link : </label>
			<input  class="widefat"  type="text" id="<?php echo $this->get_field_id( 'link'); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php if( isset( $instance['img'] ) ){ echo esc_attr( $instance['link'] ); } ?>" />
		</p>
		<strong style="max-width:600px; margin:0 auto; "> OR : </strong>
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"> Ads <?php if( isset($i) ){ echo $i; } ?> Code </label>
			<textarea  class="widefat" id="<?php echo $this->get_field_id( 'code'  ); ?>" name="<?php echo $this->get_field_name( 'code'  ); ?>" ><?php if( isset( $instance['code'] ) ){ echo $instance['code']; } ?></textarea>
		</p>
		<?php	
	}
}