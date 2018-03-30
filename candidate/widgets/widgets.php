<?php
$icon_arr = candidat_custom_fontello_classes();



add_action( 'widgets_init', 'candidat_custom_widget' );
function candidat_custom_widget() {
	register_widget( 'Candidat_WP_Widget_Calendar' );
	
	register_widget( 'Candidat_WP_Nav_Menu_Widget1' );

	register_widget( 'Candidat_Banner_Icon_Widget' );
	register_widget( 'Candidat_Banner_Donate_Widget' );
	register_widget( 'Candidat_WP_Widget_Social' );
	register_widget( 'Candidat_Featured_Video_Widget' );
	register_widget( 'Candidat_Banner_Img_Widget' );
	register_widget( 'Candidat_My_Flickr_Widget' );
	register_widget( 'Candidat_WP_Widget_Recent_Posts1' );
	register_widget( 'Candidat_Instagram_Widget' );
	register_widget( 'Candidat_Mailchimp_Widget' );
	
	
	
	if ( class_exists( 'WC_Widget_Products' ) ) {
    unregister_widget( 'WC_Widget_Products' );
    include_once( 'class-wc-widget-products.php' );
    register_widget( 'Candidat_WC_Widget_Products' );
    }

	if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
    unregister_widget( 'WC_Widget_Recent_Reviews' );
    include_once( 'class-wc-widget-recent-reviews.php' );
    register_widget( 'Candidat_WC_Widget_Recent_Reviews' );
    }
	
	if ( class_exists( 'WC_Widget_Top_Rated_Products' ) ) {
    unregister_widget( 'WC_Widget_Top_Rated_Products' );
    include_once( 'class-wc-widget-top-rated-products.php' );
    register_widget( 'Candidat_WC_Widget_Top_Rated_Products' );
    }
	
	if ( class_exists( 'WC_Widget_Recently_Viewed' ) ) {
    unregister_widget( 'WC_Widget_Recently_Viewed' );
    include_once( 'class-wc-widget-recently-viewed.php' );
    register_widget( 'Candidat_WC_Widget_Recently_Viewed' );
    }

	
}





/**
 * Calendar widget class
 *
 * @since 2.8.0
 */
class Candidat_WP_Widget_Calendar extends WP_Widget {

	function Candidat_WP_Widget_Calendar() {
		$widget_ops = array( 'classname' => 'widget_calendar_custom', 'description' => __('A calendar of your site&#8217;s Posts.', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_calendar_custom' ); //default width = 250
		parent::__construct( 'widget_calendar_custom', 'candidate'.' - '.__('Custom Calendar', 'candidate'), $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract($args);

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		
		
			
		
		
		
		echo $before_widget;
		if ( $title ) echo $before_title . esc_attr($title) . $after_title;
		echo '<div class="responsive-calendar sidebar-calendar">';
			
		echo '<div class="controls">
									<a class="pull-left" data-go="prev"><div class="btn"><i class="icons icon-left-dir"></i></div></a>
									<h4><span data-head-month></span> <span data-head-year></span></h4>
									<a class="pull-right" data-go="next"><div class="btn"><i class="icons icon-right-dir"></i></div></a>
								</div>';
								
								
		//get_calendar();
		
		
		echo '<div class="day-headers">
				<div class="day header">M</div>
				<div class="day header">T</div>
				<div class="day header">W</div>
				<div class="day header">T</div>
				<div class="day header">F</div>
				<div class="day header">S</div>
				<div class="day header">S</div>
			</div>
			
			<div class="days" data-group="days">
			<!-- the place where days will be generated -->
			</div>';
			
		
		echo '</div>';
		echo $after_widget;
		
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

	<?php
	}
}


/**
 * Navigation Menu footer widget class
 *
 * @since 3.0.0
 */
 class Candidat_WP_Nav_Menu_Widget1 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Add a custom menu to your footer sidebar.', 'candidate') );
		parent::__construct( 'nav_menu_custom', 'candidate'.' - '.__('Custom Menu Bottom', 'candidate'), $widget_ops );
	}
	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
		$nav_menu2 = ! empty( $instance['nav_menu2'] ) ? wp_get_nav_menu_object( $instance['nav_menu2'] ) : false;

		
		
		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		
		if ( !empty($instance['title']) ) {
			echo $args['before_title'] . esc_attr($instance['title']) . $args['after_title'];
		}
		
        echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 menu-container">';	
		
		wp_nav_menu( array( 'fallback_cb' => '',  'menu_class'      => 'menu', 'container' => false, 'menu' => $nav_menu, 'depth'           => 1, 'walker' => new сandidat_widget_walker_nav_menu ) );

		 echo '</div>';	
	
		echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 menu-container">';	
		
		wp_nav_menu( array( 'fallback_cb' => '',  'menu_class'      => 'menu', 'container' => false, 'menu' => $nav_menu2, 'depth'           => 1, 'walker' => new сandidat_widget_walker_nav_menu ) );

		 echo '</div>';	
		
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		
		
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		$instance['nav_menu2'] = (int) $new_instance['nav_menu2'];
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'nav_menu' => '', 'nav_menu2' => '') );

		$title = esc_attr( $instance['title'] );
		
		$nav_menu = esc_attr($instance['nav_menu'] ); 
		$nav_menu2 = esc_attr($instance['nav_menu2'] );
		

		
		// Get menus
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
		$menus2 = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo $title; ?>" />
		</p>
		
		
	
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php _e('Select Menu1:', 'candidate'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. $menu->name . '</option>';
			}
		?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('nav_menu2')); ?>"><?php _e('Select Menu2:', 'candidate'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('nav_menu2')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu2')); ?>">
		<?php
	
			foreach ( $menus2 as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu2, $menu->term_id, true )
					. '>'. $menu->name . '</option>';
			}
		?>
			</select>
		</p>
		
		
		<?php
	}
}


class сandidat_widget_walker_nav_menu extends Walker_Nav_Menu {



     function start_lvl( &$output, $depth = 0, $args = array() ) {
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='sidebar-dropdown'><li><ul>\n";
	}


	 function end_lvl( &$output, $depth = 0, $args = array() ) {
		
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></li></ul>\n";
	}


// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}



////////////////Candidat_Banner_Icon_Widget//////////////////////////////////////////////////////////////////////////////
class Candidat_Banner_Icon_Widget extends WP_Widget {
	
	function Candidat_Banner_Icon_Widget() {
		$widget_ops = array( 'classname' => 'widget_banner_icon', 'description' => __('Banner with Icon', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_banner_icon' ); //default width = 250
		parent::__construct( 'widget_banner_icon', 'candidate'.' - '.__('Banner Icon', 'candidate'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text_banner = $instance['text_banner'];
		$icon = $instance['icon'];
		$custom_link = $instance['custom_link'];
		$custom_links_target = $instance['custom_links_target'];
		$color_button = $instance['color_button'];

		$custom_color1 = '';
	   if($color_button != '') {
		   $custom_color1 = ' style=background:'.$color_button.' ';
		}
		
		
		echo '<div class="banner-wrapper">
					<a class="banner  " href="'. esc_url($custom_link) .'" target="'. $custom_links_target .'"   '. $custom_color1 .' >
						<i class="icons '. esc_attr($icon) .'"></i>
						<h4>'. esc_html($title) .'</h4>
						<p>'. esc_html($text_banner) .'</p>
					</a>
				</div>';	

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['text_banner'] = strip_tags( $new_instance['text_banner'] );
		$instance['custom_link'] = strip_tags( $new_instance['custom_link'] );
		$instance['custom_links_target'] = strip_tags( $new_instance['custom_links_target'] );
		$instance['color_button'] = strip_tags( $new_instance['color_button'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text_banner' => '', 'icon' => '', 'custom_links_target' => '', 'custom_link' => '', 'color_button' => '' ) );
		$title = strip_tags($instance['title']);
		$text_banner = esc_textarea($instance['text_banner']);
		$custom_link = $instance['custom_link'];
		$custom_links_target = $instance['custom_links_target'];	
		$icon = $instance['icon'];	
		$color_button = $instance['color_button'];
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text_banner')); ?>" name="<?php echo esc_attr($this->get_field_name('text_banner')); ?>"><?php echo $text_banner; ?></textarea>

		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e( 'Select Icon:', 'candidate' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php 
			$setting = array();
			$setting['options'] = candidat_custom_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $option_value, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link')); ?>"><?php _e('URL Banner:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link')); ?>" type="text" value="<?php echo esc_attr($custom_link); ?>" /></p>
		
		<p>
		<label><?php _e( 'Target:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('custom_links_target')); ?>" id="<?php echo esc_attr($this->get_field_id('custom_links_target')); ?>" class="widefat">
			<option value="_self"<?php selected( $instance['custom_links_target'], '_self' ); ?>><?php _e( 'Same window', 'candidate' ); ?></option>
			<option value="_blank"<?php selected( $instance['custom_links_target'], '_blank' ); ?>><?php _e( 'New window', 'candidate' ); ?></option>
		</select>
		</p>
		
		
		
		<fieldset id="banner_slider_upgrade_area">
		<p><label><strong><?php _e( 'Color Button:', 'candidate' ); ?></strong></label></p>
		
		<?php 		
		$output = '';
		$output = '<input  name="'. esc_attr($this->get_field_name('color_button')) .'" class="color-picker-banner" type="text" id="'. esc_attr($this->get_field_name('color_button')) .'" value="'. esc_attr($instance['color_button']) .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {  
					$(".color-picker-banner").iris();
			});           
			</script>'; 
		echo $output;	
		 ?>
		
		</fieldset>
		
		
	<?php
	}
}


////////////////Candidat_Banner_Donate_Widget//////////////////////////////////////////////////////////////////////////////
class Candidat_Banner_Donate_Widget extends WP_Widget {
	
	function Candidat_Banner_Donate_Widget() {
		$widget_ops = array( 'classname' => 'widget_banner_donate', 'description' => __('Banner Donate.', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_banner_donate' ); //default width = 250
		parent::__construct( 'widget_banner_donate', 'candidate'.' - '.__('Banner Donate', 'candidate'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_text', empty( $instance['title'] ) ? '' : $instance['title'], $instance );
		
		$text_amount1 = $instance['text_amount1'];
		$text_amount2 = $instance['text_amount2'];
		$text_amount3 = $instance['text_amount3'];
		$url_amount = $instance['url_amount'];
		$org_donate = $instance['org_donate'];
		
		$css_class='';
		
		$currency = $instance['currency_amount'];
		if ( empty( $currency ) ) {
			$currency = 'USD';
		}
		
		$currency_code_symbol = homeshop_get_woocommerce_currency_symbol( $currency );	 
		
		
		echo '<div class="banner-wrapper">
					<div class="banner donate-banner '. esc_attr($css_class) .'">
						<h5>'. $title .'</h5>
						<form name="_xclick" id="sd_paypalform"  action="https://www.paypal.com/uk/cgi-bin/webscr" method="post">';
						if($text_amount1 != '') {
							echo '<input value="' . esc_attr($text_amount1) . '" class="other_amt sd_object sd_usermod sd_radio" id="donate-amount-1" type="radio" name="sd_radio" checked>
							<label for="donate-amount-1">'. $currency_code_symbol .''. esc_attr($text_amount1) .'</label>';
						}
						if($text_amount2 != '') {
							echo '<input value="' . esc_attr($text_amount2) . '" class="sd_object sd_usermod sd_radio" id="donate-amount-2" type="radio" name="sd_radio">
							<label for="donate-amount-2">'. $currency_code_symbol .''. esc_attr($text_amount2) .'</label>';
						}	
						if($text_amount3 != '') {
							echo '<input value="' . esc_attr($text_amount3) . '" class="sd_object sd_usermod sd_radio" id="donate-amount-3" type="radio" name="sd_radio">
							<label for="donate-amount-3">'. $currency_code_symbol .''. esc_attr($text_amount3) .'</label>';
						}	
							
							
							
			echo '<input type="hidden" name="cmd" value="_donations" id="cmd"/>
							<input type="hidden" name="no_shipping" value="2"/>
							<input type="hidden" name="no_note" value="1"/>
							<input type="hidden" name="tax" value="0"/>
							<input type="hidden" name="business" value="' . esc_html( $url_amount ) . '" class="sd_object paypal_object" />
							<input type="hidden" name="bn" value="' . esc_html( $org_donate ) . '" class="sd_object paypal_object"/>
							<input type="hidden" name="currency_code" value="' . esc_html( $currency ) . '" class="sd_object paypal_object"/>
							
							
							<input type="submit" name="submit"  value="' . __( "Donate", 'candidate' ) . '" class="sd_object" id="sd_submit"  >
							
							
						</form>	
					</div>';
				
				
				
	//		Javascript
	$return_SD = '<script type="text/javascript">';
	$return_SD .= 'jQuery(document).ready(function($){
				
				$("#sd_paypalform #sd_submit").before(\'<input type="hidden" name="amount" value="\' + $(".other_amt").val() + \'" class="sd_object paypal_object" id="paypal_amount" />\');
				
				$(".sd_object.sd_usermod").change(function() {
					$("#sd_paypalform #paypal_amount").val($(this).val()); 
				});';

	$return_SD .= '});
		</script>';


	echo $return_SD;			
				
				
				echo '</div>';

	


				

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		
		$instance['text_amount1'] = strip_tags($new_instance['text_amount1']);
		$instance['text_amount2'] = strip_tags( $new_instance['text_amount2'] );
		$instance['text_amount3'] = strip_tags( $new_instance['text_amount3'] );
		$instance['url_amount'] = strip_tags( $new_instance['url_amount'] );
		$instance['currency_amount'] = strip_tags( $new_instance['currency_amount'] );
		$instance['org_donate'] = strip_tags( $new_instance['org_donate'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text_amount1' => '', 'text_amount2' => '', 'text_amount3' => '', 'url_amount' => '', 'currency_amount' => '' , 'org_donate' => '' ) );
		$title = esc_textarea($instance['title']);
		$text_amount1 = $instance['text_amount1'];
		$text_amount2 = $instance['text_amount2'];
		$text_amount3 = $instance['text_amount3'];	
		$url_amount = $instance['url_amount'];	
		$currency_amount = $instance['currency_amount'];	
		$org_donate = $instance['org_donate'];	
	
	
	
	
	$homeshop_currency_code_options = homeshop_get_woocommerce_currencies();
	foreach ( $homeshop_currency_code_options as $code => $name ) {
		$homeshop_currency_code_options[ $code ] = $name . " (" . $code . ")";
	}	
	$homeshop_currency_code_options = array_flip($homeshop_currency_code_options);


	
	
	
	
	
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		
		<p><label for="<?php echo esc_attr($this->get_field_id('text_amount1')); ?>"><?php _e('Amount1:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_amount1')); ?>" name="<?php echo esc_attr($this->get_field_name('text_amount1')); ?>" type="text" value="<?php echo esc_attr($text_amount1); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('text_amount2')); ?>"><?php _e('Amount2:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_amount2')); ?>" name="<?php echo esc_attr($this->get_field_name('text_amount2')); ?>" type="text" value="<?php echo esc_attr($text_amount2); ?>" /></p>
	
		<p><label for="<?php echo esc_attr($this->get_field_id('text_amount3')); ?>"><?php _e('Amount3:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_amount3')); ?>" name="<?php echo esc_attr($this->get_field_name('text_amount3')); ?>" type="text" value="<?php echo esc_attr($text_amount3); ?>" /></p>
	
		<p><label for="<?php echo esc_attr($this->get_field_id('url_amount')); ?>"><?php _e('PayPal Email Address:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url_amount')); ?>" name="<?php echo esc_attr($this->get_field_name('url_amount')); ?>" type="text" value="<?php echo esc_attr($url_amount); ?>" /></p>
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('org_donate')); ?>"><?php _e('Organization:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('org_donate')); ?>" name="<?php echo esc_attr($this->get_field_name('org_donate')); ?>" type="text" value="<?php echo esc_attr($org_donate); ?>" /></p>
		
		<p>
		<label><?php _e( 'Currency Amount1:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('currency_amount')); ?>" id="<?php echo esc_attr($this->get_field_id('currency_amount')); ?>" class="widefat">

		<?php 
		$setting = array();
		$setting['options'] = $homeshop_currency_code_options; 
		foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $option_value, $currency_amount ); ?>><?php echo esc_html( $option_key ); ?></option>
		<?php endforeach; ?>

		</select>
		</p>
	<?php
	}
}



/**
 * Social widget class
 */
class Candidat_WP_Widget_Social extends WP_Widget {

	function Candidat_WP_Widget_Social() {
		$widget_ops = array( 'classname' => 'widget_social', 'description' => __('A social button for your site.', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_social' ); //default width = 250
		parent::__construct( 'widget_social', 'candidate'.' - '.__('Social widget', 'candidate'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$custom_links_target =  $instance['custom_links_target'];
		$social_show =  $instance['social_show'];
		
		
		$custom_link1 = $instance['custom_link1'];
		$custom_link2 = $instance['custom_link2'];
		$custom_link3 = $instance['custom_link3'];
		$custom_link4 = $instance['custom_link4'];
		$custom_link5 = $instance['custom_link5'];
		$custom_link6 = $instance['custom_link6'];

		$custom_link7 = $instance['custom_link7'];
		
		
		$output  = '<div class="social-media ">
					<span class="small-caption">'. esc_html($title) .':</span>
					<ul class="social-icons">';
					if($custom_link1 != '' && $custom_link1 != '#' ) {
		$output  .= '<li class="facebook"><a href="'. esc_url($custom_link1) .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>';
						}	
						if($custom_link2 != '' && $custom_link2 != '#' ) {	
		$output  .= '<li class="twitter"><a href="'. esc_url($custom_link2) .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>';
						}	
						if($custom_link3 != '' && $custom_link3 != '#' ) {	
		$output  .= '<li class="google"><a href="'. esc_url($custom_link3) .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>';
						}	
						if($custom_link4 != '' && $custom_link4 != '#' ) {	
		$output  .= '<li class="youtube"><a href="'. esc_url($custom_link4) .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Youtube"><i class="icons icon-youtube-1"></i></a></li>';
						}	
						if($custom_link5 != '' && $custom_link5 != '#' ) {	
		$output  .= '<li class="flickr"><a href="'. esc_url($custom_link5) .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Flickr"><i class="icons icon-flickr-4"></i></a></li>';
						}	
						if($custom_link6 != '' && $custom_link6 != '#' ) {	
		$output  .= '<li class="email"><a href="'. esc_url($custom_link6) .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>';
						}	
						if($custom_link7 != '' && $custom_link7 != '#' ) {	
	$output  .= '<li class="linkedin"><a href="'. $custom_link7 .'"  target="'. $custom_links_target .'" class="tooltip-ontop" title="LinkedIn"><i class="icons icon-linkedin"></i></a></li>';
					}		
		$output  .= '</ul>';
						
						if($social_show != '_hide' ) {	
		$output  .= '<ul class="social-buttons">
							<li>
								<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35" style="border:none; overflow:hidden; height:21px; padding-top:1px; width:50px;"></iframe>
							</li>
							<li class="facebook-share">
								<div class="fb-share-button" data-href="'. get_permalink() .'" data-type="button_count"></div>
							</li>
							<li class="twitter-share">
								<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
							</li>
						</ul>';
					}
	$output  .= '</div>';
	

	echo $output;

	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'custom_link1' => '', 'custom_link2' => '', 'custom_link3' => '', 'custom_link4' => '', 'custom_link5' => '', 'custom_link6' => '', 'custom_link7' => '', 'social_show' => '',  'custom_links_target' => '' ) );
		$title = $instance['title'];
		
		$custom_links_target =  $instance['custom_links_target'];
		$social_show =  $instance['social_show'];

		$custom_link1 = $instance['custom_link1'];
		$custom_link2 = $instance['custom_link2'];
		$custom_link3 = $instance['custom_link3'];
		$custom_link4 = $instance['custom_link4'];
		$custom_link5 = $instance['custom_link5'];
		$custom_link6 = $instance['custom_link6'];
		$custom_link7 = $instance['custom_link7'];
		
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<br>


		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link1')); ?>"><?php _e('Facebook URL Link:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link1')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link1')); ?>" type="text" value="<?php echo esc_attr($custom_link1); ?>" /></label></p>


		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link2')); ?>"><?php _e('Twitter URL Link:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link2')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link2')); ?>" type="text" value="<?php echo esc_attr($custom_link2); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link3')); ?>"><?php _e('Google Plus URL Link:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link3')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link3')); ?>" type="text" value="<?php echo esc_attr($custom_link3); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link4')); ?>"><?php _e('Youtube URL Link:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link4')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link4')); ?>" type="text" value="<?php echo esc_attr($custom_link4); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link5')); ?>"><?php _e('Flickr URL Link:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link5')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link5')); ?>" type="text" value="<?php echo esc_attr($custom_link5); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link6')); ?>"><?php _e('Email URL Link:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link6')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link6')); ?>" type="text" value="<?php echo esc_attr($custom_link6); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link7')); ?>"><?php _e('LinkedIn URL Link:', 'candidate'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link7')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link7')); ?>" type="text" value="<?php echo esc_attr($custom_link7); ?>" /></label></p>
		
		
		<p>
		<label><?php _e( 'Target:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('custom_links_target')); ?>" id="<?php echo esc_attr($this->get_field_id('custom_links_target')); ?>" class="widefat">
			<option value="_self"<?php selected( $instance['custom_links_target'], '_self' ); ?>><?php _e( 'Same window', 'candidate' ); ?></option>
			<option value="_blank"<?php selected( $instance['custom_links_target'], '_blank' ); ?>><?php _e( 'New window', 'candidate' ); ?></option>
		</select>
		</p>
		
		
		<p>
		<label><?php _e( 'Social Show:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('social_show')); ?>" id="<?php echo esc_attr($this->get_field_id('social_show')); ?>" class="widefat">
			<option value="_show"<?php selected( $instance['social_show'], '_show' ); ?>><?php _e( 'Show', 'candidate' ); ?></option>
			<option value="_hide"<?php selected( $instance['social_show'], '_hide' ); ?>><?php _e( 'Hide', 'candidate' ); ?></option>
		</select>
		</p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'custom_link1' => '', 'custom_link2' => '', 'custom_link3' => '', 'custom_link4' => '', 'custom_link5' => '', 'custom_link6' => '', 'custom_link7' => '', 'social_show' => '',  'custom_links_target' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['custom_links_target'] =  $new_instance['custom_links_target'];
		$instance['social_show'] =  $new_instance['social_show'];

		$instance['custom_link1'] = $new_instance['custom_link1'];
		$instance['custom_link2'] = $new_instance['custom_link2'];
		$instance['custom_link3'] = $new_instance['custom_link3'];
		$instance['custom_link4'] = $new_instance['custom_link4'];
		$instance['custom_link5'] = $new_instance['custom_link5'];
		$instance['custom_link6'] = $new_instance['custom_link6'];
		$instance['custom_link7'] = $new_instance['custom_link7'];

		return $instance;
	}
}





////////////////Candidat_Featured_Video_Widget//////////////////////////////////////////////////////

class Candidat_Featured_Video_Widget extends WP_Widget {
	
	function Candidat_Featured_Video_Widget() {
		$widget_ops = array( 'classname' => 'widget_featured_video', 'description' => __('Featured Video.', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_featured_video' ); //default width = 250
		parent::__construct( 'widget_featured_video', 'candidate'.' - '.__('Featured Video', 'candidate'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$video_link = $instance['video_link'];
		$custom_link = $instance['custom_link'];
		$custom_link_text = $instance['custom_link_text'];
		$custom_links_target = $instance['custom_links_target'];
		$type_video = $instance['type_video'];
		
		$css_class = '';
		
		echo '<!-- Featured Video -->
						<div class="sidebar-box white featured-video '. esc_attr($css_class) .'">
							<h3>'. esc_html($title) .'</h3>';
							
					if($type_video == 'youtube') {
		echo '<iframe width="560" height="315" src="//www.youtube.com/embed/'. $video_link .'?wmode=transparent" allowfullscreen></iframe>';
					}		
					if($type_video == 'vimeo') {
		echo '<iframe width="560" height="315" src="http://player.vimeo.com/video/'. $video_link .'?js_api=1&amp;js_onLoad=player'. $video_link .'_1798970533.player.moogaloopLoaded" allowfullscreen></iframe>';
					}			
					if($type_video == 'html5') {
		echo '<video width="100%" height="115"  id="home_video_featured" class="entry-video video-js vjs-default-skin" poster="" data-aspect-ratio="2.41" data-setup="{}" controls>
		<source src="'. $video_link .'.mp4" type="video/mp4"/>
	<source src="'. $video_link .'.webm" type="video/webm"/>
	<source src="'. $video_link .'.ogg" type="video/ogg"/></video>';
					}			
							
		echo '<a href="'. esc_url($custom_link) .'" target="'. esc_attr($custom_links_target) .'" class="button transparent button-arrow">'. esc_html($custom_link_text) .'</a>
	
						</div>
						<!-- /Featured Video -->';	

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['video_link'] = strip_tags($new_instance['video_link']);
		$instance['custom_link'] = strip_tags( $new_instance['custom_link'] );
		$instance['custom_link_text'] = strip_tags( $new_instance['custom_link_text'] );
		$instance['custom_links_target'] = strip_tags( $new_instance['custom_links_target'] );
		$instance['type_video'] = strip_tags( $new_instance['type_video'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'video_link' => '', 'type_video' => '', 'custom_links_target' => '', 'custom_link' => '', 'custom_link_text' => '' ) );
		$title = strip_tags($instance['title']);
		
		$video_link = $instance['video_link'];
		$custom_link = $instance['custom_link'];
		$custom_link_text = $instance['custom_link_text'];	
		$custom_links_target = $instance['custom_links_target'];	
		$type_video = $instance['type_video'];	
	
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		
		<p><label for="<?php echo esc_attr($this->get_field_id('video_link')); ?>"><?php _e('Video URL:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('video_link')); ?>" name="<?php echo esc_attr($this->get_field_name('video_link')); ?>" type="text" value="<?php echo esc_attr($video_link); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link')); ?>"><?php _e('Button URL:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link')); ?>" type="text" value="<?php echo esc_attr($custom_link); ?>" /></p>
	
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link_text')); ?>"><?php _e('Button Text:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link_text')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link_text')); ?>" type="text" value="<?php echo esc_attr($custom_link_text); ?>" /></p>
	
		<p>
		<label><?php _e( 'Target:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('custom_links_target')); ?>" id="<?php echo esc_attr($this->get_field_id('custom_links_target')); ?>" class="widefat">
			<option value="_self"<?php selected( $instance['custom_links_target'], '_self' ); ?>><?php _e( 'Same window', 'candidate' ); ?></option>
			<option value="_blank"<?php selected( $instance['custom_links_target'], '_blank' ); ?>><?php _e( 'New window', 'candidate' ); ?></option>
		</select>
		</p>
		
		<p>
		<label><?php _e( 'Type Video:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('type_video')); ?>" id="<?php echo esc_attr($this->get_field_id('type_video')); ?>" class="widefat">
			<option value="youtube"<?php selected( $instance['type_video'], 'youtube' ); ?>><?php _e( 'youtube', 'candidate' ); ?></option>
			<option value="vimeo"<?php selected( $instance['type_video'], 'vimeo' ); ?>><?php _e( 'vimeo', 'candidate' ); ?></option>
			<option value="html5"<?php selected( $instance['type_video'], 'html5' ); ?>><?php _e( 'html5', 'candidate' ); ?></option>
		</select>
		</p>	
	<?php
	}
}







////////////////Candidat_Banner_Img_Widget//////////////////////////////////////////////////////////////

class Candidat_Banner_Img_Widget extends WP_Widget {
	
	function Candidat_Banner_Img_Widget() {
		$widget_ops = array( 'classname' => 'widget_banner_img', 'description' => __('Banner with Image', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_banner_img' ); //default width = 250
		parent::__construct( 'widget_banner_img', 'candidate'.' - '.__('Banner', 'candidate'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$custom_link_text = $instance['custom_link_text'];
		$custom_image = $instance['custom_image'];
		$custom_link = $instance['custom_link'];
		$custom_links_target = $instance['custom_links_target'];

		
		echo '<!-- Image Banner -->
				<div class="sidebar-box image-banner ">
					<a target="'. esc_attr($custom_links_target) .'" href="'. esc_url($custom_link) .'">
						<img src="'. esc_url($custom_image) .'" alt="">
						<h3>'. esc_html($title) .'</h3>
						<span class="button transparent button-arrow">'. esc_html($custom_link_text) .'</span>
					</a>
				</div>
				<!-- /Image Banner -->';

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['custom_link_text'] = strip_tags($new_instance['custom_link_text']);
		$instance['custom_image'] = strip_tags( $new_instance['custom_image'] );
		$instance['custom_link'] = strip_tags( $new_instance['custom_link'] );
		$instance['custom_links_target'] = strip_tags( $new_instance['custom_links_target'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'custom_link_text' => '', 'custom_image' => '', 'custom_links_target' => '', 'custom_link' => '' ) );
		$title = strip_tags($instance['title']);
		$custom_link_text = $instance['custom_link_text'];
		$custom_link = $instance['custom_link'];
		$custom_links_target = $instance['custom_links_target'];	
		$custom_image = $instance['custom_image'];	
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_image')); ?>"><?php _e('Path Image:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_image')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_image')); ?>" type="text" value="<?php echo esc_attr($custom_image); ?>" /></p>
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link_text')); ?>"><?php _e('Banner Text:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link_text')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link_text')); ?>" type="text" value="<?php echo esc_attr($custom_link_text); ?>" /></p>


		<p><label for="<?php echo esc_attr($this->get_field_id('custom_link')); ?>"><?php _e('URL Banner:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_link')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_link')); ?>" type="text" value="<?php echo esc_attr($custom_link); ?>" /></p>
		
		<p>
		<label><?php _e( 'Target:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('custom_links_target')); ?>" id="<?php echo esc_attr($this->get_field_id('custom_links_target')); ?>" class="widefat">
			<option value="_self"<?php selected( $instance['custom_links_target'], '_self' ); ?>><?php _e( 'Same window', 'candidate' ); ?></option>
			<option value="_blank"<?php selected( $instance['custom_links_target'], '_blank' ); ?>><?php _e( 'New window', 'candidate' ); ?></option>
		</select>
		</p>
		
	<?php
	}
}




////////////////Candidat_My_Flickr_Widget//////////////////////////////////////////////////////////////////////////////
class Candidat_My_Flickr_Widget extends WP_Widget {
	
	function Candidat_My_Flickr_Widget() {
		$widget_ops = array( 'classname' => 'widget_flickr_img', 'description' => __('Flickr Image', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_flickr_img' ); //default width = 250
		parent::__construct( 'widget_flickr_img', 'candidate'.' - '.__('Flickr images', 'candidate'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$flickr_id = $instance['flickr_id'];
		$count = $instance['count'];
		$type = $instance['type'];
		$display = $instance['display'];

		$output = "";
		$output .= "\n\t".'<div class="sidebar-box white flickr-photos ">';
		$output .= '<h3>'. esc_html($title) .'</h3>';
		$output .= '<ul class="flickr-feed">';

		$output .= "\n\t".'</ul>'."\n";
		echo $output;
		?> <script type="text/javascript"> 

		jQuery(document).ready(function($){
					$('.flickr-feed').jflickrfeed({
								limit: <?php echo $count; ?>,
								qstrings: {
									id: '<?php echo $flickr_id; ?>'
								},
								itemTemplate: 
								'<li>' +
									'<a href="{{link}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a>' +
								'</li>'
							});
		});

		</script> <?php
		
		echo '</div>'."\n";
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['display'] = strip_tags( $new_instance['display'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'flickr_id' => '', 'count' => '', 'type' => '', 'display' => '' ) );
		$title = strip_tags($instance['title']);
		$flickr_id = $instance['flickr_id'];
		$count = $instance['count'];
		$type = $instance['type'];	
		$display = $instance['display'];	
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>"><?php _e('Flickr ID:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr_id')); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" /></p>
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e('Count:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></p>


		<p>
		<label><?php _e( 'Type:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('type')); ?>" id="<?php echo esc_attr($this->get_field_id('type')); ?>" class="widefat">
			<option value="user"<?php selected( $instance['type'], 'user' ); ?>><?php _e( 'User', 'candidate' ); ?></option>
			<option value="group"<?php selected( $instance['type'], 'group' ); ?>><?php _e( 'Group', 'candidate' ); ?></option>
		</select>
		</p>
		
		<p>
		<label><?php _e( 'Display:', 'candidate' ); ?></label>
		<select name="<?php echo esc_attr($this->get_field_name('display')); ?>" id="<?php echo esc_attr($this->get_field_id('display')); ?>" class="widefat">
			<option value="latest"<?php selected( $instance['display'], 'latest' ); ?>><?php _e( 'Latest', 'candidate' ); ?></option>
			<option value="random"<?php selected( $instance['display'], 'random' ); ?>><?php _e( 'Random', 'candidate' ); ?></option>
		</select>
		</p>
		
	<?php
	}
}


/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class Candidat_WP_Widget_Recent_Posts1 extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_latest_posts', 'description' => __( "Your site&#8217;s most Popular Posts.", 'candidate') );
		parent::__construct('latest-posts', 'candidate'.' - '.__('Popular Posts', 'candidate'), $widget_ops);
		$this->alt_option_name = 'widget_latest_posts';

	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args( (array) $instance, array( 
					'title' 				=> '', 
					'num_items'			=> ''
				) );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'candidate' );

		$css_class = '';
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$num_items = ( ! empty( $instance['num_items'] ) ) ? absint( $instance['num_items'] ) : 5;
		if ( ! $num_items ) {
			$num_items = 5;
		}
	$args = array(  
    'post_type' => 'post',  
	'orderby' => 'date',
	'order' => 'desc',
    'posts_per_page' => $num_items  
	);  
		   
	$myposts = get_posts( $args );


	
	$output  = '<!-- Popular News -->
						<div class="sidebar-box white '. esc_attr($css_class) .'">
							<h3>'. esc_html($title) .'</h3>
							<ul class="popular-news">';


	$count=0;
	foreach( $myposts as $post ) :  setup_postdata($post);
			$post_id = $post->ID;
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			//$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'th-sidebar'); 

	$count++;
	$output .=  '<li>
					<div class="thumbnail">
						<img src="' . esc_url($post_thumbnail_url[0]) . '" alt="">
					</div>
					
					<div class="post-content">
						<h6><a href="'. esc_url(get_permalink($post_id)) .'">'. esc_html(get_the_title($post_id)) .'</a></h6>
						<div class="post-meta">
							<span>by <a href="'. esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) .'">'. esc_html(get_the_author()) .'</a></span>
							<span>'. get_the_time('F j, Y g:i a', $post_id) .'</span>
						</div>
					</div>
				</li>';

	endforeach; 	
	
	$output .=  '</ul></div><!-- /Popular News -->';
 
    echo $output;	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['num_items'] = (int) $new_instance['num_items'];
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'color' => '', 'icon' => '', 'show_date' => '', 'number' => '' ) );
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$num_items    = isset( $instance['num_items'] ) ? absint( $instance['num_items'] ) : 5;
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'candidate' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>"><?php _e( 'Number of posts to show:', 'candidate' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'num_items' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_items' )); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" size="3" /></p>
<?php
	}
}




////////////////INSTAGRAM PHOTOS Widget//////////////////////////////////////////////////////////////////////////////
class Candidat_Instagram_Widget extends WP_Widget {
	
	function Candidat_Instagram_Widget() {
		$widget_ops = array( 'classname' => 'widget_instagram', 'description' => __('INSTAGRAM', 'candidate') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'widget_instagram' ); //default width = 250
		parent::__construct( 'widget_instagram', 'candidate'.' - '.__('INSTAGRAM PHOTOS', 'candidate'), $widget_ops, $control_ops );
	}

	
	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$inst_id = $instance['inst_id'];
		$count = $instance['count'];

		
		echo '<!-- Instagram Photos -->
						<div class="sidebar-box white flickr-photos animate-onscroll">
							<h3>'. esc_html($title) .'</h3>
							<ul id="instagram-feed">
							</ul>';	
						
			?> <script type="text/javascript"> 

		jQuery(document).ready(function($){
		
						/* Instagram Feed */
						function enableInstagramFeed(){
							
							if($('#instagram-feed').length){
								var instagram_feed = new Instafeed({
									get: 'popular',
									clientId: '<?php echo $inst_id; ?>',
									target: 'instagram-feed',
									template: '<li><a target="_blank" href="{{link}}"><img src="{{image}}" /></a></li>',
									resolution: 'standard_resolution',
									limit: <?php echo $count; ?>
								});
								instagram_feed.run();
							}
							
						};
						enableInstagramFeed();
		});

		</script> <?php			
		echo '</div>
						<!-- /Instagram Photos -->';				

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['inst_id'] = strip_tags($new_instance['inst_id']);
		$instance['count'] = strip_tags( $new_instance['count'] );
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'inst_id' => '', 'count' => '' ) );
		$title = strip_tags($instance['title']);
		$inst_id = esc_textarea($instance['inst_id']);
		$count = $instance['count'];
		
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

	
		<p><label for="<?php echo $this->get_field_id('inst_id'); ?>"><?php _e('ID Instagram(0ce2a8c0d92248cab8d2a9d024f7f3ca):', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('inst_id'); ?>" name="<?php echo $this->get_field_name('inst_id'); ?>" type="text" value="<?php echo esc_attr($inst_id); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number Instagram:', 'candidate'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></p>
		
	
		
	<?php
	}
}



/**
 * Candidat_Mailchimp_Widget
 */
class Candidat_Mailchimp_Widget extends WP_Widget {
	var $data = '';

	function __construct() {
		$widget_ops = array( 'description' => __('Use this widget to add a mailchimp newsletter to your site.','candidate') );
		parent::__construct( 'zn_mailchimp',  'candidate'.' - '.__('Newsletter', 'candidate'), $widget_ops );

	}
	
	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		?>
		
		
		<form id="newsletter" action="#" method="POST">
						<span class="ajax-loader"></span>
						
						<?php
						if ( !empty($instance['title']) ) {
							echo '<h5>' . esc_html($instance['title']) . '</h5>';
							} else { ?>
							<h5><strong><?php _e( 'Sign up', 'candidate' ); ?></strong> <?php _e( 'for email updates', 'candidate' ); ?></h5>
							<?php }
						?>	
						
						
						
						<div class="newsletter-form">
						
							<div class="newsletter-email">
								<input id="s-email" type="text" name="email" placeholder="Email address">
							</div>
							
							<div class="newsletter-zip">
								<input type="text" name="newsletter-zip" placeholder="Zip code">
							</div>
							
							<div class="newsletter-submit">
								<input type="submit" id="signup_submit" name="newsletter-submit" value="">
								<i class="icons icon-right-thin"></i>
							</div>
							
						</div>
						<div id="mailchimp-sign-up1" style="font-size:10px;" ><p>.</p></div>
		</form>
		

		<?php	
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		
		$data_mailchimp_api = get_option('sense_mailchimp_api');
		if ( $data_mailchimp_api == '' ) {
			echo __('Please enter your MailChimp API KEY in the theme options pannel prior of using this widget.','candidate');
			return;
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','candidate') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>

		<?php
	}
}

?>