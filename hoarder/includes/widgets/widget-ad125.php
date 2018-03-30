<?php

/*-------------------------------------------------------------------------------------

	Plugin Name: Custom 125x125 Ad Unit
	Plugin URI: http://www.themezilla.com
	Description: A widget that allows the selection and configuration of 6 125x125 ad units
	Version: 1.0
	Author: ThemeZilla
	Author URI: http://www.themezilla.com

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Create the widget
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'zilla_ads_widgets' );

function zilla_ads_widgets() {
	register_widget( 'zilla_Ad_Widget' );
}

/*-----------------------------------------------------------------------------------*/
/*  Widget class
/*-----------------------------------------------------------------------------------*/
class zilla_ad_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function zilla_Ad_Widget() {

	/* Widget settings --------------------------------------------------------------*/
	$widget_ops = array (
		'classname' => 'zilla-ad-widget',
		'description' => __('A widget that allows the display and configuration of 6 125x125 ads blocks.', 'zilla')
	);

	/* Widget control settings ------------------------------------------------------*/
	$control_ops = array (
		'width' => 300,
		'height' => 350,
		'id_base' => 'zilla-ad-widget'
	);

	/* Create the widget ------------------------------------------------------------*/
	$this->WP_Widget( 'zilla-ad-widget', __('Custom 125x125 Ads', 'zilla'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	/* Our variables from the widget settings --------------------------------------*/
	$title = apply_filters('widget_title', $instance['title'] );
	$ad1 = $instance['ad1'];
	$ad2 = $instance['ad2'];
	$ad3 = $instance['ad3'];
	$ad4 = $instance['ad4'];
	$ad5 = $instance['ad5'];
	$ad6 = $instance['ad6'];
	$link1 = $instance['link1'];
	$link2 = $instance['link2'];
	$link3 = $instance['link3'];
	$link4 = $instance['link4'];
	$link5 = $instance['link5'];
	$link6 = $instance['link6'];
	$randomize = $instance['random'];

	/* Build ads order in a new array ---------------------------------------------*/
	$ads = array();
		
	/* Display Ad 1 ---------------------------------------------------------------*/
	if ( $link1 ) {
		$ads[] = '<a href="' . $link1 . '"><img src="' . $ad1 . '" width="125" height="125" alt="" /></a>';
    } elseif ( $ad1 ) {
	 	$ads[] = '<img src="' . $ad1 . '" width="125" height="125" alt="" />';
 	}
	
	/* Display Ad 2 ---------------------------------------------------------------*/
	if ( $link2 ) {
		$ads[] = '<a href="' . $link2 . '"><img src="' . $ad2 . '" width="125" height="125" alt="" /></a>';
	} elseif ( $ad2 ) {
	 	$ads[] = '<img src="' . $ad2 . '" width="125" height="125" alt="" />';
 	}
		
	/* Display Ad 3 ---------------------------------------------------------------*/
	if ( $link3 ) {
		$ads[] = '<a href="' . $link3 . '"><img src="' . $ad3 . '" width="125" height="125" alt="" /></a>';
	} elseif ( $ad3 ) {
	 	echo '<img src="' . $ad3 . '" width="125" height="125" alt="" />';
	}
	
	/* Display Ad 4 ---------------------------------------------------------------*/
	if ( $link4 ) {
		$ads[] = '<a href="' . $link4 . '"><img src="' . $ad4 . '" width="125" height="125" alt="" /></a>';
	} elseif ( $ad4 ) {
	 	$ads[] = '<img src="' . $ad4 . '" width="125" height="125" alt="" />';
	}
	
	/* Display Ad 5 ---------------------------------------------------------------*/
	if ( $link5 ) {
		$ads[] = '<a href="' . $link5 . '"><img src="' . $ad5 . '" width="125" height="125" alt="" /></a>';
	} elseif ( $ad5 ) {
	 	$ads[] = '<img src="' . $ad5 . '" width="125" height="125" alt="" />';
	}
	
	/* Display Ad 6 ---------------------------------------------------------------*/
	if ( $link6 ) {
		$ads[] = '<a href="' . $link6 . '"><img src="' . $ad6 . '" width="125" height="125" alt="" /></a>';
	} elseif ( $ad6 ) {
	 	$ads[] = '<img src="' . $ad6 . '" width="125" height="125" alt="" />';
 	}
 	
 	/* Randomize order if selected ------------------------------------------------*/
	if ($randomize) {
		shuffle($ads);
	}

    /* Display widget -------------------------------------------------------------*/
	echo $before_widget;

	if ( $title ) { echo $before_title . $title . $after_title; }

	echo '<div class="ads-125 clearfix">';
	foreach($ads as $ad){
		echo $ad;
	}
	echo '</div>';

	echo $after_widget;
}


/*--------------------------------------------------------------------------------*/
/*	Update Widget
/*--------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Strip tags to remove HTML (important for text inputs) ---------------------*/
	$instance['title'] = strip_tags( $new_instance['title'] );

	/* No need to strip tags -----------------------------------------------------*/
	$instance['ad1'] = $new_instance['ad1'];
	$instance['ad2'] = $new_instance['ad2'];
	$instance['ad3'] = $new_instance['ad3'];
	$instance['ad4'] = $new_instance['ad4'];
	$instance['ad5'] = $new_instance['ad5'];
	$instance['ad6'] = $new_instance['ad6'];
	$instance['link1'] = $new_instance['link1'];
	$instance['link2'] = $new_instance['link2'];
	$instance['link3'] = $new_instance['link3'];
	$instance['link4'] = $new_instance['link4'];
	$instance['link5'] = $new_instance['link5'];
	$instance['link6'] = $new_instance['link6'];
	$instance['random'] = $new_instance['random'];
	
	return $instance;
}


/*------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*------------------------------------------------------------------------------*/
	
function form( $instance ) {
	$template_uri = get_template_directory_uri();

	/* Set defaults ------------------------------------------------------------*/
	$defaults = array(
		'title' => 'Our Sponsors',
		'ad1' => $template_uri . "/images/advert_125.jpg",
		'link1' => 'http://www.themezilla.com',
		'ad2' => $template_uri . "/images/advert_125.jpg",
		'link2' => 'http://www.themezilla.com',
		'ad3' => '',
		'link3' => '',
		'ad4' => '',
		'link4' => '',
		'ad5' => '',
		'link5' => '',
		'ad6' => '',
		'link6' => '',
		'random' => false
	);
		
	$instance = wp_parse_args( (array) $instance, $defaults ); 
	
	/* Build our form fields --------------------------------------------------*/
	?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'ad1' ); ?>"><?php _e('Ad 1 image url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>" value="<?php echo $instance['ad1']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Ad 1 link url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'ad2' ); ?>"><?php _e('Ad 2 image url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>" value="<?php echo $instance['ad2']; ?>" />
	</p>
		
	<p>
		<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Ad 2 link url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'ad3' ); ?>"><?php _e('Ad 3 image url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>" value="<?php echo $instance['ad3']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Ad 3 link url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'ad4' ); ?>"><?php _e('Ad 4 image url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>" value="<?php echo $instance['ad4']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Ad 4 link url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'ad5' ); ?>"><?php _e('Ad 5 image url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad5' ); ?>" name="<?php echo $this->get_field_name( 'ad5' ); ?>" value="<?php echo $instance['ad5']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'link5' ); ?>"><?php _e('Ad 5 link url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link5' ); ?>" name="<?php echo $this->get_field_name( 'link5' ); ?>" value="<?php echo $instance['link5']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'ad6' ); ?>"><?php _e('Ad 6 image url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'ad6' ); ?>" name="<?php echo $this->get_field_name( 'ad6' ); ?>" value="<?php echo $instance['ad6']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'link6' ); ?>"><?php _e('Ad 6 link url:', 'zilla') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link6' ); ?>" name="<?php echo $this->get_field_name( 'link6' ); ?>" value="<?php echo $instance['link6']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'random' ); ?>"><?php _e('Randomize ads order?', 'zilla') ?></label>
		<?php if ($instance['random']){ ?>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>" checked="checked" />
		<?php } else { ?>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>"  />
		<?php } ?>
	</p>
	
	<?php
	}
}
?>