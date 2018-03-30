<?php

##ADS 125*125 ------------------------------------------ #
add_action( 'widgets_init', 'ads125_widget_box' );
function ads125_widget_box() {
	register_widget( 'ads125_widget' );
}
class ads125_widget extends WP_Widget {
	function ads125_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan125-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads125-widget' );
		parent::__construct( 'ads125-widget', THEME_NAME .' - '.__( 'Ads 125*125' , 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];


		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan125<?php echo $one_column ?>">
		<?php for($i=1 ; $i<11 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<11 ; $i++ ){
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) )  echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) )  echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>"><?php _e( 'One column:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) )  echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php
		for($i=1 ; $i<11 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS' , 'tie') ?> <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php printf( __( 'Ads %s image path:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php printf( __( 'Ads %s Link:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php printf( __( 'Ads %s Adsense code:', 'tie' ), $i ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}



##ASD 120*90 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_90_widget_box' );
function ads120_90_widget_box() {
	register_widget( 'ads120_90_widget' );
}
class ads120_90_widget extends WP_Widget {
	function ads120_90_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan120_90-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_90-widget' );
		parent::__construct( 'ads120_90-widget', THEME_NAME .' - '.__( 'Ads 120*90' , 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan120-90<?php echo $one_column ?>">
		<?php for($i=1 ; $i<11 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<11 ; $i++ ){
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>"><?php _e( 'One column:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php
		for($i=1 ; $i<11 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS' , 'tie') ?> <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php printf( __( 'Ads %s image path:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php printf( __( 'Ads %s Link:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php printf( __( 'Ads %s Adsense code:', 'tie' ), $i ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 120*60 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_60_widget_box' );
function ads120_60_widget_box() {
	register_widget( 'ads120_60_widget' );
}
class ads120_60_widget extends WP_Widget {
	function ads120_60_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan120_60-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_60-widget' );
		parent::__construct( 'ads120_60-widget', THEME_NAME .' - '.__( 'Ads 120*60' , 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( empty( $tran_bg ) ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>

		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan120-60<?php echo $one_column ?>">
		<?php for($i=1 ; $i<11 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<11 ; $i++ ){
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>"><?php _e( 'One column:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php
		for($i=1 ; $i<11 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS' , 'tie') ?> <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php printf( __( 'Ads %s image path:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php printf( __( 'Ads %s Link:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php printf( __( 'Ads %s Adsense code:', 'tie' ), $i ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 120*600 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_600_widget_box' );
function ads120_600_widget_box() {
	register_widget( 'ads120_600_widget' );
}
class ads120_600_widget extends WP_Widget {
	function ads120_600_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan120_600-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_600-widget' );
		parent::__construct( 'ads120_600-widget', THEME_NAME .' - '.__( 'Ads 120*600' , 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan120-600<?php echo $one_column ?>">
		<?php for($i=1 ; $i<3 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<3 ; $i++ ){
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>"><?php _e( 'One column:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php
		for($i=1 ; $i<3 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS' , 'tie') ?> <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php printf( __( 'Ads %s image path:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php printf( __( 'Ads %s Link:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php printf( __( 'Ads %s Adsense code:', 'tie' ), $i ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 120*240 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_240_widget_box' );
function ads120_240_widget_box() {
	register_widget( 'ads120_240_widget' );
}
class ads120_240_widget extends WP_Widget {
	function ads120_240_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan120_240-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_240-widget' );
		parent::__construct( 'ads120_240-widget', THEME_NAME .' - '.__( 'Ads 120*240' , 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan120-240<?php echo $one_column ?>">
		<?php for($i=1 ; $i<5 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<5 ; $i++ ){
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>"><?php _e( 'One column:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php
		for($i=1 ; $i<5 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS' , 'tie') ?> <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php printf( __( 'Ads %s image path:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php printf( __( 'Ads %s Link:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php printf( __( 'Ads %s Adsense code:', 'tie' ), $i ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}



##ASD 160*600 ------------------------------------------ #
add_action( 'widgets_init', 'ads160_600_widget_box' );
function ads160_600_widget_box() {
	register_widget( 'ads160_600_widget' );
}
class ads160_600_widget extends WP_Widget {
	function ads160_600_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan160_600-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads160_600-widget' );
		parent::__construct( 'ads160_600-widget', THEME_NAME .' - '.__( 'Ads 160*600' , 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan160-600">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS:' , 'tie') ?></em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php _e( 'Ads image path:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php _e( 'Ads Link:', 'tie' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php _e( ' Ads Adsense code:', 'tie' ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}


##ASD 300*600 ------------------------------------------ #
add_action( 'widgets_init', 'ads300_600_widget_box' );
function ads300_600_widget_box() {
	register_widget( 'ads300_600_widget' );
}
class ads300_600_widget extends WP_Widget {
	function ads300_600_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan300_600-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_600-widget' );
		parent::__construct( 'ads300_600-widget', THEME_NAME .' - '.__( 'Ads 300*600' , 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan300-600">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS:' , 'tie') ?></em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php _e( 'Ads image path:', 'tie' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php _e( 'Ads Link:', 'tie' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php _e( ' Ads Adsense code:', 'tie' ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}



##ASD 250*250 ------------------------------------------ #
add_action( 'widgets_init', 'ads250_250_widget_box' );
function ads250_250_widget_box() {
	register_widget( 'ads250_250_widget' );
}
class ads250_250_widget extends WP_Widget {
	function ads250_250_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan250_250-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads250_250-widget' );
		parent::__construct( 'ads250_250-widget', THEME_NAME .' - '.__( 'Ads 250*250' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan250-250">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS:' , 'tie') ?></em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php _e( 'Ads image path:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php _e( 'Ads Link:', 'tie' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php _e( ' Ads Adsense code:', 'tie' ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}






##ASD 300*100 ------------------------------------------ #
add_action( 'widgets_init', 'ads300_100_widget_box' );
function ads300_100_widget_box() {
	register_widget( 'ads300_100_widget' );
}
class ads300_100_widget extends WP_Widget {
	function ads300_100_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan300_100-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_100-widget' );
		parent::__construct( 'ads300_100-widget',THEME_NAME .' - '.__( 'Ads 300*100' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan300-100">
		<?php for($i=1 ; $i<5 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<5 ; $i++ ){
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php
		for($i=1 ; $i<5 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS' , 'tie') ?> <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php printf( __( 'Ads %s image path:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php printf( __( 'Ads %s Link:', 'tie' ), $i ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php printf( __( 'Ads %s Adsense code:', 'tie' ), $i ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 300*250 ------------------------------------------ #
add_action( 'widgets_init', 'ads300_250_widget_box' );
function ads300_250_widget_box() {
	register_widget( 'ads300_250_widget' );
}
class ads300_250_widget extends WP_Widget {
	function ads300_250_widget() {
		$widget_ops = array( 'classname' => 'e3lan e3lan300_250-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_250-widget' );
		parent::__construct( 'ads300_250-widget',THEME_NAME .' - '.__( 'Ads 300*250', 'tie' ) , $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ;
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="e3lan-widget-content e3lan300-250">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="e3lan-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="e3lan-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src="<?php echo $instance[ 'ads'.$i.'_img' ] ?>" alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>"><?php _e( 'Content Only:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Check this box to hide widget title and background.' , 'tie') ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e( 'Open links in a new window:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>"><?php _e( 'Nofollow:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold"><?php _e( 'ADS:' , 'tie') ?></em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>"><?php _e( 'Ads image path:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>"><?php _e( 'Ads Link:', 'tie' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><?php _e( ' Ads Adsense code:', 'tie' ) ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}

?>