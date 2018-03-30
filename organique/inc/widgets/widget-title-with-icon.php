<?php
/**
 * Featured link widget
 * ====================
 * Featured links are used at the top of the front page
 *
 * @package Organique
 */

/**************************************
 * Title & Icon Widget
 * -----------------------------------
 * List of the latest news on the home page
 **************************************/

class Organique_Title_Icon_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			false, // ID, auto generate when false
			_x( 'Organique: Title with Icon', 'backend', 'organique_wp' ), // Name
			array(
				'description' => _x( 'Widget for the front page below the head - select title, subtitle and icon', 'backend', 'organique_wp'),
			)
		);

		if( is_admin() ) {
			wp_enqueue_style( 'glyph-icons', get_template_directory_uri() . '/assets/stylesheets/glyphicons.css' );
			wp_enqueue_script( 'organique-admin-utils', get_template_directory_uri() . '/assets/js/admin.js', array( 'jquery' ) );
		}
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>
		<?php if ( ! empty( $instance['link'] ) ): ?>
			<a href="<?php echo $instance['link']; ?>" <?php echo 'yes' === $instance['new_window'] ? 'target="_blank"' : ''; ?>>
		<?php endif ?>
		<div class="banners-box">
			<?php if ( ! empty( $instance['icon'] ) ) : ?>
				<span class="glyphicon  <?php echo $instance['icon']; ?>  glyphicon--banners"></span>
			<?php endif ?>
			<b class="banners__title"><?php echo $instance['title']; ?></b>
			<?php echo $instance['subtitle']; ?>
		</div>
		<?php if ( ! empty( $instance['link'] ) ): ?>
			</a>
		<?php endif ?>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['subtitle']   = strip_tags( $new_instance['subtitle'] );
		$instance['link']       = esc_url( $new_instance['link'] );
		$instance['new_window'] = sanitize_key( $new_instance['new_window'] );
		$instance['icon']       = sanitize_key( $new_instance['icon'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title      = empty( $instance['title'] ) ? '' : $instance['title'];
		$subtitle   = empty( $instance['subtitle'] ) ? '' : $instance['subtitle'];
		$link       = empty( $instance['link'] ) ? '' : $instance['link'];
		$new_window = empty( $instance['new_window'] ) ? 'yes' : $instance['new_window'];
		$icon       = empty( $instance['icon'] ) ? '' : $instance['icon'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _ex( 'Title', 'backend', 'organique_wp'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _ex( 'Subtitle', 'backend', 'organique_wp'); ?>:</label> <br />
			<input style="width: 100%;" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo $subtitle; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _ex( 'Link (leave empty if you don\'t want the link)', 'backend', 'organique_wp'); ?>:</label> <br />
			<input style="width: 100%;" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _ex( 'Open link in a new tab?', 'backend', 'organique_wp'); ?></label>
			<select id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>">
				<option value="yes" <?php selected( $new_window, 'yes' ) ?>><?php _ex( 'Yes', 'backend', 'organique_wp' ); ?></option>
				<option value="no" <?php selected( $new_window, 'no' ) ?>><?php _ex( 'No', 'backend', 'organique_wp' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _ex( 'Icon', 'backend', 'organique_wp'); ?>:</label> <br />
			<small><?php printf( _x( 'Click on the icon below or manually select from the %s website', 'backend', 'organique_wp'), '<a href="http://getbootstrap.com/components/#glyphicons-glyphs" target="_blank">Glyphicons</a>' ); ?>.</small>
			<small><?php _ex( 'Click on the icon below to select it.', 'backend', 'organique_wp' ); ?></small>
			<input style="width: 100%;" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo $icon; ?>" class="js--icon-input" /> <br><br>
			<span style="font-size: 120%;">
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-asterisk"><i class="glyphicon  glyphicon-asterisk"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-plus"><i class="glyphicon  glyphicon-plus"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-euro"><i class="glyphicon  glyphicon-euro"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-minus"><i class="glyphicon  glyphicon-minus"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-cloud"><i class="glyphicon  glyphicon-cloud"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-envelope"><i class="glyphicon  glyphicon-envelope"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-pencil"><i class="glyphicon  glyphicon-pencil"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-glass"><i class="glyphicon  glyphicon-glass"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-music"><i class="glyphicon  glyphicon-music"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-search"><i class="glyphicon  glyphicon-search"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-heart"><i class="glyphicon  glyphicon-heart"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-star"><i class="glyphicon  glyphicon-star"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-star-empty"><i class="glyphicon  glyphicon-star-empty"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-user"><i class="glyphicon  glyphicon-user"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-ok"><i class="glyphicon  glyphicon-ok"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-remove"><i class="glyphicon  glyphicon-remove"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-off"><i class="glyphicon  glyphicon-off"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-cog"><i class="glyphicon  glyphicon-cog"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-home"><i class="glyphicon  glyphicon-home"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-file"><i class="glyphicon  glyphicon-file"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-time"><i class="glyphicon  glyphicon-time"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-road"><i class="glyphicon  glyphicon-road"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-download-alt"><i class="glyphicon  glyphicon-download-alt"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-download"><i class="glyphicon  glyphicon-download"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-upload"><i class="glyphicon  glyphicon-upload"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-inbox"><i class="glyphicon  glyphicon-inbox"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-play-circle"><i class="glyphicon  glyphicon-play-circle"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-repeat"><i class="glyphicon  glyphicon-repeat"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-refresh"><i class="glyphicon  glyphicon-refresh"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-flag"><i class="glyphicon  glyphicon-flag"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-headphones"><i class="glyphicon  glyphicon-headphones"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-barcode"><i class="glyphicon  glyphicon-barcode"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-tag"><i class="glyphicon  glyphicon-tag"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-tags"><i class="glyphicon  glyphicon-tags"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-book"><i class="glyphicon  glyphicon-book"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-bookmark"><i class="glyphicon  glyphicon-bookmark"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-camera"><i class="glyphicon  glyphicon-camera"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-picture"><i class="glyphicon  glyphicon-picture"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-map-marker"><i class="glyphicon  glyphicon-map-marker"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-tint"><i class="glyphicon  glyphicon-tint"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-check"><i class="glyphicon  glyphicon-check"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-chevron-left"><i class="glyphicon  glyphicon-chevron-left"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-chevron-right"><i class="glyphicon  glyphicon-chevron-right"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-plus-sign"><i class="glyphicon  glyphicon-plus-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-minus-sign"><i class="glyphicon  glyphicon-minus-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-remove-sign"><i class="glyphicon  glyphicon-remove-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-ok-sign"><i class="glyphicon  glyphicon-ok-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-question-sign"><i class="glyphicon  glyphicon-question-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-info-sign"><i class="glyphicon  glyphicon-info-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-ban-circle"><i class="glyphicon  glyphicon-ban-circle"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-arrow-left"><i class="glyphicon  glyphicon-arrow-left"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-arrow-right"><i class="glyphicon  glyphicon-arrow-right"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-arrow-up"><i class="glyphicon  glyphicon-arrow-up"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-arrow-down"><i class="glyphicon  glyphicon-arrow-down"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-exclamation-sign"><i class="glyphicon  glyphicon-exclamation-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-gift"><i class="glyphicon  glyphicon-gift"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-leaf"><i class="glyphicon  glyphicon-leaf"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-fire"><i class="glyphicon  glyphicon-fire"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-warning-sign"><i class="glyphicon  glyphicon-warning-sign"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-plane"><i class="glyphicon  glyphicon-plane"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-calendar"><i class="glyphicon  glyphicon-calendar"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-random"><i class="glyphicon  glyphicon-random"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-comment"><i class="glyphicon  glyphicon-comment"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-chevron-up"><i class="glyphicon  glyphicon-chevron-up"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-chevron-down"><i class="glyphicon  glyphicon-chevron-down"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-shopping-cart"><i class="glyphicon  glyphicon-shopping-cart"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-bell"><i class="glyphicon  glyphicon-bell"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-certificate"><i class="glyphicon  glyphicon-certificate"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-thumbs-up"><i class="glyphicon  glyphicon-thumbs-up"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-thumbs-down"><i class="glyphicon  glyphicon-thumbs-down"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-hand-right"><i class="glyphicon  glyphicon-hand-right"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-hand-left"><i class="glyphicon  glyphicon-hand-left"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-hand-up"><i class="glyphicon  glyphicon-hand-up"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-hand-down"><i class="glyphicon  glyphicon-hand-down"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-circle-arrow-right"><i class="glyphicon  glyphicon-circle-arrow-right"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-circle-arrow-left"><i class="glyphicon  glyphicon-circle-arrow-left"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-circle-arrow-up"><i class="glyphicon  glyphicon-circle-arrow-up"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-circle-arrow-down"><i class="glyphicon  glyphicon-circle-arrow-down"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-globe"><i class="glyphicon  glyphicon-globe"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-wrench"><i class="glyphicon  glyphicon-wrench"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-dashboard"><i class="glyphicon  glyphicon-dashboard"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-heart-empty"><i class="glyphicon  glyphicon-heart-empty"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-phone"><i class="glyphicon  glyphicon-phone"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-pushpin"><i class="glyphicon  glyphicon-pushpin"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-usd"><i class="glyphicon  glyphicon-usd"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-gbp"><i class="glyphicon  glyphicon-gbp"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-flash"><i class="glyphicon  glyphicon-flash"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-send"><i class="glyphicon  glyphicon-send"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-credit-card"><i class="glyphicon  glyphicon-credit-card"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-transfer"><i class="glyphicon  glyphicon-transfer"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-cutlery"><i class="glyphicon  glyphicon-cutlery"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-earphone"><i class="glyphicon  glyphicon-earphone"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-phone-alt"><i class="glyphicon  glyphicon-phone-alt"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-tower"><i class="glyphicon  glyphicon-tower"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-copyright-mark"><i class="glyphicon  glyphicon-copyright-mark"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-registration-mark"><i class="glyphicon  glyphicon-registration-mark"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-tree-conifer"><i class="glyphicon  glyphicon-tree-conifer"></i></a>
				<a class="js--selectable-icon" href="#" data-iconname="glyphicon-tree-deciduous"><i class="glyphicon  glyphicon-tree-deciduous"></i></a>
			</span>
		</p>

		<?php
	}

} // class Organique_Title_Icon_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Organique_Title_Icon_Widget" );' ) );


